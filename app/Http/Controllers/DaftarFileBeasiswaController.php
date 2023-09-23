<?php

namespace App\Http\Controllers;

use App\Exports\DaftarFileBeasiswaExport;
use App\Models\file_beasiswa;
use App\Models\dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DaftarFileBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $file_beasiswa = DB::table('file_beasiswa')
            ->join('penerima_beasiswa', 'file_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->join('dokumen', 'file_beasiswa.dokumen_id', '=', 'dokumen.id')
            ->select('file_beasiswa.*', 'penerima_beasiswa.name_awarde', 'penerima_beasiswa.id as penerima_beasiswa_id', 'dokumen.name as dokumen_name', 'dokumen_id as dokumen_id')
            ->orderBy('file_beasiswa.status', 'desc')
            ->orderBy('file_beasiswa.tanggal_upload', 'desc')
            ->orderBy('penerima_beasiswa.name_awarde', 'asc')
            ->orderBy('dokumen.name', 'asc')
            ->get();

        return view('layanan_administratif.unggahan_berkas_awardee.index', compact([
            'file_beasiswa',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aj = file_beasiswa::findOrFail($id);

        return view('layanan_administratif.unggahan_berkas_awardee.edit', compact([
            'aj',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aj = file_beasiswa::findOrfail($id);

        $aj->update($request->all());

        return redirect('/daftar_file_beasiswa')
            ->with('update', 'File beasiswa Awardee berhasil diperbarui');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $file_beasiswa = file_beasiswa::leftJoin('dokumen', 'file_beasiswa.dokumen_id', '=', 'dokumen.id')
            ->leftJoin('penerima_beasiswa', 'file_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('file_beasiswa.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('dokumen.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('penerima_beasiswa.name_awarde', 'like', '%' . $searchTerm . '%')
                    ->orWhere('file_beasiswa.tanggal_upload', 'like', '%' . $searchTerm . '%')
                    ->orWhere('file_beasiswa.status', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('file_beasiswa.status', 'desc')
            ->orderBy('file_beasiswa.tanggal_upload', 'desc')
            ->orderBy('penerima_beasiswa.name_awarde', 'asc')
            ->orderBy('dokumen.name', 'asc')
            ->get();

        return Excel::download(new DaftarFileBeasiswaExport($file_beasiswa), 'Unggahan Berkas Awardee.xlsx');
    }
}
