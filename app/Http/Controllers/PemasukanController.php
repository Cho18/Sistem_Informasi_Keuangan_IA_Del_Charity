<?php

namespace App\Http\Controllers;

use App\Exports\DonasiDonatorExport;
use App\Exports\PemasukanExport;
use App\Http\Requests\PemasukanRequest;
use App\Models\donator;
use App\Models\donor;
use App\Models\jenis_pemasukan;
use App\Models\pemasukan;
use App\Models\donors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan = pemasukan::with('donor', 'jenis_pemasukan')
            ->orderBy('donation_date', 'desc')
            ->get()
            ->sortBy(function ($item) {
                $jenisPemasukan = $item->jenis_pemasukan;
                $donor = $item->donor;

                if ($jenisPemasukan && $donor) {
                    return [
                        $jenisPemasukan->name_of_type_income,
                        $donor->name
                    ];
                } else {
                    return [
                        $jenisPemasukan->name_of_type_income,
                    ];
                }
            })
            ->sortBy('type_account');
        $jenis_pemasukan = jenis_pemasukan::all();
        $donator = donor::all();

        return view('pemasukan_dana.daftar_pemasukan.index', compact([
            'pemasukan',
            'donator',
            'jenis_pemasukan',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemasukan = donor::select('id', 'name')
            ->get();

        return view('pemasukan_dana.daftar_pemasukan.add', [
            'pemasukan' => $pemasukan
        ]);

    }

    /**                 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemasukanRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('bukti_transaksi')) {
            $file = $request->file('bukti_transaksi');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $request->donor_id . '_' . $originalFileName;
            $filePath = $file->storeAs('bukti_transaksi', $fileName);
            $validatedData['bukti_transaksi'] = $filePath;
        }              

        pemasukan::create($validatedData);

        return redirect('/daftar_pemasukan')
            ->with('success', 'Pemasukan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $dd = pemasukan::with('donor')
            ->findorFail($id);

        $donator = donor::where('id', '!=', $dd->donor_id)
            ->get(['id', 'name']);

        return view('pemasukan_dana.daftar_pemasukan.edit', [
            'dd' => $dd, 
            'donator' => $donator
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(PemasukanRequest $request, $id)
    {   
        $validatedData = $request->validated();

        if ($request->hasFile('bukti_transaksi')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $file = $request->file('bukti_transaksi');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $originalFileName;
            $filePath = $file->storeAs('bukti_transaksi', $fileName);
            $validatedData['bukti_transaksi'] = $filePath;
        }        

        $dd = pemasukan::findOrFail($id);

        $dd->update($validatedData);

        return redirect('/daftar_pemasukan')
            ->with('update', 'Pemasukan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dd = pemasukan::findorfail($id);
        $dd->delete();

        return redirect('/daftar_pemasukan')
            ->with('delete', 'Pemasukan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $pemasukan = pemasukan::leftJoin('jenis_pemasukan', 'pemasukan.jenis_pemasukan_id', '=', 'jenis_pemasukan.id')
            ->leftJoin('donors', 'pemasukan.donor_id', '=', 'donors.id')
            ->select('pemasukan.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('jenis_pemasukan.name_of_type_income', 'like', '%' . $searchTerm . '%')
                    ->orWhere('donors.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.donation_amount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.donation_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.type_account', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.description', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('pemasukan.donation_date', 'desc')
            ->orderBy('jenis_pemasukan.name_of_type_income', 'asc')
            ->orderBy('donors.name', 'asc')
            ->get();

        return Excel::download(new PemasukanExport($pemasukan), 'Daftar Pemasukan.xlsx');
    }
}
