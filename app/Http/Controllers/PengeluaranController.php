<?php

namespace App\Http\Controllers;

use App\Exports\PengeluaranExport;
use App\Http\Requests\PengeluaranRequest;
use App\Models\jenis_pengeluaran;
use App\Models\penerima_beasiswa;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pengeluaran = Pengeluaran::join('penerima_beasiswa', 'pengeluaran.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
        //     ->join('jenis_pengeluaran', 'pengeluaran.jenis_pengeluaran_id', '=', 'jenis_pengeluaran.id')
        //     ->select(
        //         'pengeluaran.*',
        //         'penerima_beasiswa.name_awarde',
        //         'jenis_pengeluaran.name_of_type_expenditure as name_of_type_expenditure'
        //     )
        //     ->orderBy('pengeluaran.expenditure_date', 'desc')
        //     ->orderBy('jenis_pengeluaran.name_of_type_expenditure', 'asc')
        //     ->orderBy('penerima_beasiswa.name_awarde', 'asc')
        //     ->get();

        // $pengeluaran = pengeluaran::with('jenis_pengeluaran', 'penerima_beasiswa')
        //     ->orderBy('expenditure_date', 'desc')
        //     ->get();

        $pengeluaran = pengeluaran::with('penerima_beasiswa', 'jenis_pengeluaran')
            ->orderBy('expenditure_date', 'desc')
            ->get()
            ->sortBy(function ($item) {
                $jenisPengeluaran = $item->jenis_pengeluaran;
                $awardee = $item->penerima_beasiswa;

                if ($jenisPengeluaran && $awardee) {
                    return [
                        $jenisPengeluaran->name_of_type_expenditure,
                        $awardee->name_awarde
                    ];
                } else {
                    return [
                        $jenisPengeluaran->name_of_type_expenditure,
                    ];
                }
            });
        $jenis_pengeluaran = jenis_pengeluaran::all();
        $penerima_beasiswa = penerima_beasiswa::all();

        return view('pengeluaran_dana.daftar_pengeluaran.index', compact([
            'pengeluaran',
            'jenis_pengeluaran',
            'penerima_beasiswa',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pengeluaran = jenis_pengeluaran::select('id', 'name_of_type_expenditure')
            ->get();

        $penerima_beasiswa = penerima_beasiswa::select('id', 'name_awarde')
            ->get();

        return view('pengeluaran_dana.daftar_pengeluaran.add', [
            'pengeluaran' => $pengeluaran,
            'penerima_beasiswa' => $penerima_beasiswa
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengeluaranRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('proof_of_expenditure')) {
            $file = $request->file('proof_of_expenditure');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $request->donor_id . '_' . $originalFileName;
            $filePath = $file->storeAs('bukti_pengeluaran', $fileName);
            $validatedData['proof_of_expenditure'] = $filePath;
        }   
        pengeluaran::create($validatedData);

        return redirect('/daftar_pengeluaran')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(pengeluaran $pengeluaran, $id)
    {
        $pg = pengeluaran::with('jenis_pengeluaran', 'penerima_beasiswa')
            ->findOrFail($id);

        $jenis_pengeluaran = jenis_pengeluaran::where('id', '!=', $pg->jenis_pengeluaran_id)
            ->get(['id', 'name_of_type_expenditure']);

        $penerima_beasiswa = penerima_beasiswa::where('id', '!=', $pg->penerima_beasiswa_id)
            ->get(['id', 'name_awarde']);

        return view('pengeluaran_dana.daftar_pengeluaran.edit', [
            'pg' => $pg, 
            'jenis_pengeluaran' => $jenis_pengeluaran,
            'penerima_beasiswa' => $penerima_beasiswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(PengeluaranRequest $request, $id)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('proof_of_expenditure')) {
            if ($request->oldImage) {
                Storage::delete('bukti_pengeluaran/' . $request->oldImage);
            }
            $file = $request->file('proof_of_expenditure');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $originalFileName;
            $filePath = $file->storeAs('bukti_pengeluaran', $fileName);
            $validatedData['proof_of_expenditure'] = $filePath;
        }        

        $pg = pengeluaran::findOrFail($id);

        $pg->update($validatedData);

        return redirect('/daftar_pengeluaran')
            ->with('update', 'Data pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pengeluaran = pengeluaran::findorfail($id);
        $pengeluaran->delete();

        return redirect('/daftar_pengeluaran')
            ->with('delete', 'Pengeluaran Berhasil Dihapus');
    }

    public function print()
    {
        $expense = DB::table('pengeluaran')
            ->sum('total_expenditure');

        $pengeluaran= pengeluaran::with('jenis_pengeluaran', 'penerima_beasiswa')
            ->get();

        return view('pengeluaran_dana.daftar_pengeluaran.print', compact([
            'pengeluaran', 'expense'
        ]));   
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $pengeluaran = pengeluaran::leftJoin('jenis_pengeluaran', 'pengeluaran.jenis_pengeluaran_id', '=', 'jenis_pengeluaran.id')
            ->leftJoin('penerima_beasiswa', 'pengeluaran.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('pengeluaran.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('jenis_pengeluaran.name_of_type_expenditure', 'like', '%' . $searchTerm . '%')
                    ->orWhere('penerima_beasiswa.name_awarde', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pengeluaran.total_expenditure', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pengeluaran.expenditure_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pengeluaran.expenditure_description', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('pengeluaran.expenditure_date', 'desc')
            ->orderBy('jenis_pengeluaran.name_of_type_expenditure', 'asc')
            ->orderBy('penerima_beasiswa.name_awarde', 'asc')
            ->get();

        return Excel::download(new PengeluaranExport($pengeluaran), 'Daftar Pengeluaran.xlsx');
    }
}
