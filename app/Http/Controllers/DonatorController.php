<?php

namespace App\Http\Controllers;

use App\Exports\DonatorExport;
use App\Http\Requests\DonatorRequest;
use App\Models\bph;
use App\Models\donator;
use App\Models\donator_donasi;
use App\Models\donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donator= donor::count();
        // $donator= donor::with('user', 'donator_donasi', 'bph')
        //     ->orderBy('name', 'asc')
        //     ->get();

        // $donator_donasi = donator_donasi::all();
        $bph = bph::all();

        $donator = DB::table('donors')
            ->join('bph', 'donors.bph_id', '=', 'bph.id')
            ->select('donors.*', 'bph.nama')
            ->orderBy('code_name', 'asc')
            ->get();

        return view('daftar_anggota.donator.index', compact([
            'donator',
            'bph',
        ]));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bph = bph::all();

        return view('daftar_anggota.donator.add', compact(
            'bph'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonatorRequest $request)
    {
        $don = new donor;
        $don->create($request->all());

        return redirect('/anggota_donator')
            ->with('success', 'Donator berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donator= donor::with('bph')->findorFail($id);

        return view('daftar_anggota.donator.detail_pribadi', compact([
            'donator'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function edit(donor $donor, $id)
    {
        $donator = donor::with('user')
            ->findorFail($id);

        $bph = bph::where('id', '!=', $donator->bph_id)
                ->get();

        $dd = User::where('id', '!=', $donator->user_id)
            ->where('role_id', '=', '3')
            ->get(['id', 'name']);

        return view('daftar_anggota.donator.edit', [
            'donator'   => $donator,
            'bph'       => $bph,
            'dd'        => $dd,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\donator  $donor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $donator = donor::findOrfail($id);

        $donator->update($request->all());

        return redirect('/anggota_donator')
            ->with('update', 'Data donator berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $donator = Donor::findOrFail($id);

        $jumlahDonator = $donator->pemasukan()->count();

        if ($jumlahDonator > 0) {
            return redirect('/anggota_donator')
                ->with('error', 'Donator tidak dapat dihapus karena memiliki catatan pemasukan terkait');
        }

        $buktiDonasi = $donator->bukti_donasi()->count();

        if ($buktiDonasi > 0) {
            return redirect('/anggota_donator')
                ->with('error', 'Donator tidak dapat dihapus karena memiliki catatan bukti donasi terkait');
        }

        $donator->delete();

        return redirect('/anggota_donator')->with('delete', 'Donator berhasil dihapus');
    }

    // public function export(Request $request)
    // {
    //     $searchTerm = $request->input('search');

    //     $donator = donor::select(
    //         'id',                       'name', 
    //         'code_name',                'place_of_birth',
    //         'date_of_birth',            'gender',
    //         'religion',                 'address',
    //         'study_program',            'faculty',
    //         'generation',               'email',
    //         'phone_number',             'alumni',
    //         'date_of_joining',          'struktur_donator',
    //         'description',               'bph_id',
    //     )

    //     ->when($searchTerm, function ($query, $searchTerm) {
    //         $query->where('name', 'like', '%' . $searchTerm . '%')
    //             ->orWhere('code_name', 'like', '%' . $searchTerm . '%')
    //             ->orWhere('date_of_joining', 'like', '%' . $searchTerm . '%')
    //             ->orWhere('struktur_donator', 'like', '%' . $searchTerm . '%');
    //     })
    //     ->orderBy('name', 'asc')
    //     ->get();

    //     return Excel::download(new DonatorExport($donator), 'Daftar Anggota Donator.xlsx');
    // }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $donator = donor::join('bph', 'donors.bph_id', '=', 'bph.id')
            ->select('donors.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('bph.nama', 'like', '%' . $searchTerm . '%')
                    ->orWhere('donors.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('donors.code_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('donors.alumni', 'like', '%' . $searchTerm . '%')
                    ->orWhere('donors.date_of_joining', 'like', '%' . $searchTerm . '%')
                    ->orWhere('donors.struktur_donator', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('donors.name', 'asc')
            ->get();

        return Excel::download(new DonatorExport($donator), 'Daftar Anggota Donator.xlsx');
    }
}
