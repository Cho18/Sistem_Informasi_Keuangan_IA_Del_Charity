<?php

namespace App\Http\Controllers;

use App\Exports\AwardeeExport;
use App\Http\Requests\PenerimaBeasiswaRequest;
use App\Imports\AwardeeImport;
use App\Models\jenis_pengeluaran;
use App\Models\penerima_beasiswa;
use App\Models\pengeluaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PenerimaBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();

        $penerima_beasiswa= penerima_beasiswa::with('pengeluaran', 'user')
            ->orderBy('name_awarde', 'asc')
            ->get();

        // $penerima_beasiswa->each(function ($item) use ($today) {
        //         if ($item->end_date_as_awardee === null || $item->end_date_as_awardee->greaterThanOrEqualTo($today)) {
        //             $item->status_beasiswa = 'Masih Aktif';
        //         } else {
        //             $item->status_beasiswa = 'Tidak Aktif';
        //         }
        //     });

        return view('daftar_anggota.penerima_beasiswa.index', compact([
            'penerima_beasiswa'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('id', 'name')
            ->where('role_id', '=', '4')
            ->get();

        $penerima_beasiswa = jenis_pengeluaran::select('id', 'name_of_type_expenditure')
            ->get();

        return view('daftar_anggota.penerima_beasiswa.add', [
            'penerima_beasiswa' => $penerima_beasiswa, 
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenerimaBeasiswaRequest $request)
    {
        $awarde = new penerima_beasiswa;
        $awarde->create($request->all());

        return redirect('/anggota_awardee')
            ->with('success', 'Awardee berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penerima_beasiswa  $penerima_beasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penerima_beasiswa= penerima_beasiswa::findorFail($id);

        return view('daftar_anggota.penerima_beasiswa.detail_pribadi', compact([
            'penerima_beasiswa'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penerima_beasiswa  $penerima_beasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(penerima_beasiswa $penerima_beasiswa, $id)
    {
        $pb = penerima_beasiswa::with('pengeluaran', 'user')
            ->findorFail($id);

        $pengeluaran = pengeluaran::where('id', '!=', $pb->pengeluaran_id)
            ->get(['id', 'jenis_pengeluaran_id']);

        $us = User::where('id', '!=', $pb->user_id)
            ->where('role_id', '=', '4')
            ->get(['id', 'name']);

        return view('daftar_anggota.penerima_beasiswa.edit', [
            'pb' => $pb, 
            'pengeluaran' => $pengeluaran, 
            'us' => $us,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penerima_beasiswa  $penerima_beasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penerima_beasiswa $penerima_beasiswa, $id)
    {
        $pb = penerima_beasiswa::findOrfail($id);

        $pb->update($request->all());

        return redirect('/anggota_awardee')
            ->with('update', 'Data awardee berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penerima_beasiswa  $penerima_beasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $awardee = penerima_beasiswa::findOrFail($id);

        $jumlahAwardee = $awardee->pengeluaran()->count();

        if ($jumlahAwardee > 0) {
            return redirect('/anggota_awardee')
                ->with('error', 'Awardee tidak dapat dihapus karena memiliki catatan pengeluaran terkait.');
        }

        $jumlahAjuan = $awardee->ajuan_beasiswa()->count();

        if ($jumlahAjuan > 0) {
            return redirect('/anggota_awardee')
                ->with('error', 'Awardee tidak dapat dihapus karena memiliki catatan ajuan beasiswa terkait.');
        }

        $awardee->delete();

        return redirect('/anggota_awardee')->with('delete', 'Penerima beasiswa berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $donator = penerima_beasiswa::select(
            'id',                                       'name_awarde',
            'nim_awarde',                               'study_program',
            'faculty',                                  'generation',
            'email_academics_awarde',                   'date_set_as_awardee',
            'end_date_as_awardee',                      'total_spp_awarde',
            'date_of_birth',                            'place_of_birth',
            'gender',                                   'gender',
            'religion',                                 'religion',
            'address',                                  'email_awarde',
            'phone_number_awarde',                      'child_of_awarde',
            'number_of_siblings_awarde',                'account_type_awarde',
            'account_number_awarde',                    'name_owner_of_account',
            'instagram_awarde',                         'facebook_awarde',
            'hobby',                                    'name_of_father_awarde',
            'father_occupation_of_awarde',              'father_income_of_awarde',
            'father_phone_number_awarde',               'name_of_mother_awarde',
            'mother_occupation_of_awarde',              'mother_income_of_awarde',
            'mother_phone_number_awarde',               'address_of_parents_awarde',
            'dependents_of_parents_awarde',             'description',
            'status',
        )

        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('name_awarde', 'like', '%' . $searchTerm . '%')
                ->orWhere('nim_awarde', 'like', '%' . $searchTerm . '%')
                ->orWhere('study_program', 'like', '%' . $searchTerm . '%')
                ->orWhere('faculty', 'like', '%' . $searchTerm . '%')
                ->orWhere('date_set_as_awardee', 'like', '%' . $searchTerm . '%')
                ->orWhere('status', 'like', '%' . $searchTerm . '%')
                ->orWhere('generation', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('name_awarde', 'asc')
        ->get();

        return Excel::download(new AwardeeExport($donator), 'Daftar Anggota Awardee.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new AwardeeImport, $request->file('file'));

        return redirect('/anggota_awardee')
            ->with('success', 'Awardee berhasil ditambahkan');
    }
}

