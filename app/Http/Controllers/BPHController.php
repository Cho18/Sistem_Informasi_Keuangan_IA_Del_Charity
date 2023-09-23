<?php

namespace App\Http\Controllers;

use App\Exports\BPHExport;
use App\Models\bph;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BPHController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bph = bph::orderBy('nama', 'asc')
            ->get();

        return view('daftar_anggota.bph.index', compact(
            'bph',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bph.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bph = new bph();
        $bph->create($request->all());

        return redirect('/anggota_bph')
            ->with('success', 'BPH berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bph = bph::findorFail($id);

        return view('daftar_anggota.bph.show', compact(
            'bph'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function edit(bph $bph, $id)
    {
        $bph = bph::findOrFail($id);

        return view('daftar_anggota.bph.edit', compact(
            'bph',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bph = bph::findOrfail($id);

        $bph->update($request->all());

        return redirect('/anggota_bph')
            ->with('update', 'Data BPH berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bph = bph::findorfail($id);

        $jumlahDonator = $bph->donor()->count();

        if ($jumlahDonator > 0) {
            return redirect('/anggota_donator')
                ->with('error', 'BPH tidak dapat dihapus karena masih menjadi PIC pada anggota donator terkait');
        }

        $bph->delete();

        return redirect('/anggota_bph')
            ->with('delete', 'BPH berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $jenis_pengeluaran = bph::select(
            'id', 
            'nama', 
            'angkatan', 
            'status', 
            'divisi'
        )
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('nama', 'like', '%' . $searchTerm . '%')
                ->orWhere('angkatan', 'like', '%' . $searchTerm . '%')
                ->orWhere('status', 'like', '%' . $searchTerm . '%')
                ->orWhere('divisi', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('nama', 'asc')
        ->get();

        return Excel::download(new BPHExport($jenis_pengeluaran), 'Daftar Anggota BPH.xlsx');
    }
}
