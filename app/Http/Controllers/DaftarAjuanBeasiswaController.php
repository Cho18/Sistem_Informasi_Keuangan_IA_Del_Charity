<?php

namespace App\Http\Controllers;

use App\Exports\DaftarAjuanBeasiswaExport;
use App\Http\Requests\AjuanBeasiswaRequest;
use App\Models\ajuan_beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DaftarAjuanBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ajuan_beasiswa = DB::table('ajuan_beasiswa')
            ->join('penerima_beasiswa', 'ajuan_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('ajuan_beasiswa.*', 'penerima_beasiswa.name_awarde', 'penerima_beasiswa.id as penerima_beasiswa_id')
            ->orderBy('status', 'desc')
            ->orderBy('semester', 'desc')
            ->orderBy('penerima_beasiswa.name_awarde', 'asc')
            ->get();
        
        return view('layanan_administratif.daftar_ajuan_beasiswa.index', compact([
            'ajuan_beasiswa',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\beasiswa  $beasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ajuan_beasiswa = ajuan_beasiswa::findOrFail($id);

        return view('layanan_administratif.daftar_ajuan_beasiswa.edit', compact([
            'ajuan_beasiswa',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\beasiswa  $beasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $beasiswa = ajuan_beasiswa::findOrFail($id);

        $beasiswa->update($request->all());

        return redirect('/daftar_ajuan_beasiswa')
            ->with('update', 'Ajuan beasiswa berhasil diperbarui');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $daftarajuanbeasiswa = ajuan_beasiswa::join('penerima_beasiswa', 'ajuan_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('ajuan_beasiswa.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('penerima_beasiswa.name_awarde', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.total_bursar', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.semester', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.deskripsi', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.status', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('ajuan_beasiswa.status', 'desc')
            ->orderBy('ajuan_beasiswa.semester', 'desc')
            ->orderBy('penerima_beasiswa.name_awarde', 'asc')
            ->get();

        return Excel::download(new DaftarAjuanBeasiswaExport($daftarajuanbeasiswa), 'Daftar Ajuan Beasiswa Awardee.xlsx');
    }
}
