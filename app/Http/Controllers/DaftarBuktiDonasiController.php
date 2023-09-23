<?php

namespace App\Http\Controllers;

use App\Exports\DaftarBuktiDonasiExport;
use App\Models\bukti_donasi;
use App\Models\donasi;
use App\Models\donor;
use App\Notifications\BuktiDonasiNotifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DaftarBuktiDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bdonasi = DB::table('bukti_donasi')
            ->sum('donation_amount');

        $donasi = DB::table('bukti_donasi')
            ->join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->select('bukti_donasi.*', 'donors.name', 'donors.id as donor_id')
            ->orderBy('status', 'desc')
            ->orderBy('donation_date', 'desc')
            ->orderBy('donors.name', 'asc')
            ->get();
        
        return view('layanan_administratif.daftar_bukti_donasi.index', compact([
            'donasi',
            'bdonasi',
        ]));
    }

    /**
     * Show the form for editing the specifiexd resource.
     *
     * @param  \App\Models\donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donasi = bukti_donasi::findOrFail($id);

        return view('layanan_administratif.daftar_bukti_donasi.edit', compact([
            'donasi',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\donasi  $donasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $donasi = bukti_donasi::findOrFail($id);
        $donasi->update($request->all());

        if ($donasi->status == 'Sudah diproses') {
            $donator = Donor::find($donasi->donor_id);
            
            if ($donator && $donator->user) {
                $donator->user->notify(new BuktiDonasiNotifikasi());
            }
        }
        

        return redirect('/daftar_bukti_donasi')
            ->with('update', 'Bukti donasi donator berhasil diperbarui');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $donator = bukti_donasi::join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->select('bukti_donasi.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('donors.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.donation_amount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.donation_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.type_account', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.status', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('bukti_donasi.status', 'desc')
            ->orderBy('bukti_donasi.donation_date', 'desc')
            ->orderBy('donors.name', 'asc')
            ->get();

        return Excel::download(new DaftarBuktiDonasiExport($donator), 'Daftar Bukti Donasi Donator.xlsx');
    }
}
