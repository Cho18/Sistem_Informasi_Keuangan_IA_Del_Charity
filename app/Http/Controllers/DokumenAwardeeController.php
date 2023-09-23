<?php

namespace App\Http\Controllers;

use App\Exports\DaftarDokumenExport;
use App\Http\Requests\DokumenRequest;
use App\Models\dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DokumenAwardeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumen = dokumen::orderBy('name', 'asc')
            ->get();

        return view('arsip_dokumen.dokumen_awardee.index', compact([
            'dokumen',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */

    public function store(DokumenRequest $request)
    {
        $validatedData = $request->validated();
        
        // Menyimpan file dokumen pada direktori yang ditentukan
        $dokumen = $request->file('dokumen');
        $nama_asli = $dokumen->getClientOriginalName();
        $dokumen_path = $dokumen->storeAs('dokumen', $nama_asli);
        $validatedData['dokumen'] = $dokumen_path;
        
        dokumen::create($validatedData);

        return redirect('/dokumen_awardee')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        return view('arsip_dokumen.dokumen_awardee.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(DokumenRequest $request, $id)
    {
        $dok = dokumen::findOrFail($id);

        // Mengupdate judul dokumen
        $dok->name = $request->input('name');

        // Memeriksa apakah file dokumen diunggah
        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            $nama_asli = $dokumen->getClientOriginalName();
            $dokumen_path = $dokumen->storeAs('dokumen', $nama_asli);
            Storage::delete($dok->dokumen);
            $dok->dokumen = $dokumen_path;
        }

        $dok->save();

        return redirect('/dokumen_awardee')
            ->with('update', 'Dokumen berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dokumen  $dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(dokumen $dokumen, $id)
    {
        $dokumen = dokumen::findorfail($id);
        

        $jumlahDok = $dokumen->ajuan()->count();

        if ($jumlahDok > 0) {
            return redirect('/dokumen_awardee')
                ->with('error', 'Dokumen tidak dapat dihapus karena memiliki catatan file beasiswa terkait');
        }

        $dokumen->delete();

        return redirect('/dokumen_awardee')
            ->with('delete', 'Dokumen berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $dokumen = dokumen::select(
            'id', 
            'name', 
            'dokumen'
        )
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('name', 'asc')
        ->get();

        return Excel::download(new DaftarDokumenExport($dokumen), 'Daftar Dokumen Awardee.xlsx');
    }
}
