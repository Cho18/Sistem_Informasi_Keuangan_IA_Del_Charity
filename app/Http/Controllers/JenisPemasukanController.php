<?php

namespace App\Http\Controllers;

use App\Exports\JenisPemasukanExport;
use App\Http\Requests\JenisPemasukanRequest;
use App\Models\jenis_pemasukan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JenisPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_pemasukan = jenis_pemasukan::orderBy('name_of_type_income', 'asc')
            ->get();;

        return view('pemasukan_dana.jenis_pemasukan.index', compact('jenis_pemasukan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPemasukanRequest $request)
    {
        $jenis_pemasukan = new jenis_pemasukan;
        $jenis_pemasukan->create($request->all());

        return redirect('/jenis_pemasukan')
            ->with('success', 'Jenis pemasukan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jenis_pemasukan  $jenis_pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(jenis_pemasukan $jenis_pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jenis_pemasukan  $jenis_pemasukan
     * @return \Illuminate\Http\Response
     */
    public function edit(jenis_pemasukan $jenis_pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenis_pemasukan  $jenis_pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jenis_pemasukan = jenis_pemasukan::findOrfail($id);

        $jenis_pemasukan->update($request->all());

        return redirect('/jenis_pemasukan')
            ->with('update', 'Data jenis pemasukan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenis_pemasukan  $jenis_pemasukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(jenis_pemasukan $jenis_pemasukan, $id)
    {
        $jenis_pemasukan = jenis_pemasukan::findOrFail($id);

        $jumlahPemasukan = $jenis_pemasukan->pemasukan()->count();

        if ($jumlahPemasukan > 0) {
            return redirect('/jenis_pemasukan')
                ->with('error', 'Jenis pemasukan tidak dapat dihapus karena memiliki catatan pemasukan terkait');
        }

        $jenis_pemasukan->delete();

        return redirect('/jenis_pemasukan')
            ->with('delete', 'Jenis pemasukan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $jenis_pemasukan = jenis_pemasukan::select(
            'id', 
            'name_of_type_income', 
            'description_of_type_income'
        )
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('name_of_type_income', 'like', '%' . $searchTerm . '%')
                ->orWhere('description_of_type_income', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('name_of_type_income', 'asc')
        ->get();

        return Excel::download(new JenisPemasukanExport($jenis_pemasukan), 'Daftar Jenis Pemasukan.xlsx');
    }
}
