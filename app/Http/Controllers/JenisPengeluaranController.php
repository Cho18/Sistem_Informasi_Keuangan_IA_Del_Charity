<?php

namespace App\Http\Controllers;

use App\Exports\JenisPengeluaranExport;
use App\Http\Requests\JenisPengeluaranRequest;
use App\Models\jenis_pengeluaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JenisPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_pengeluaran = jenis_pengeluaran::with('pengeluaran')
            ->orderBy('name_of_type_expenditure', 'asc')
            ->get();;

        return view('pengeluaran_dana.jenis_pengeluaran.index', compact('jenis_pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengeluaran_dana.jenis_pengeluaran.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisPengeluaranRequest $request)
    {
        $jp = new jenis_pengeluaran;
        $jp->create($request->all());

        return redirect('/jenis_pengeluaran')
            ->with('success', 'Jenis pengeluaran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jenis_pengeluaran  $jenis_pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(jenis_pengeluaran  $jenis_pengeluaran, $id)
    {
        $jp = jenis_pengeluaran::findOrFail($id);

        return view('pengeluaran_dana.jenis_pengeluaran.edit', [
            'jp' => $jp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jenis_pengeluaran  $jenis_pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(JenisPengeluaranRequest $request, $id)
    {
        $jp = jenis_pengeluaran::findOrfail($id);

        $jp->update($request->all());

        return redirect('/jenis_pengeluaran')
            ->with('update', 'Data jenis pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jenis_pengeluaran  $jenis_pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jp = jenis_pengeluaran::findOrFail($id);

        $jumlahPengeluaran = $jp->pengeluaran()->count();

        if ($jumlahPengeluaran > 0) {
            return redirect('/jenis_pengeluaran')
                ->with('error', 'Jenis pengeluaran tidak dapat dihapus karena memiliki catatan pengeluaran terkait');
        }

        $jp->delete();

        return redirect('/jenis_pengeluaran')
            ->with('delete', 'Jenis pengeluaran berhasil dihapus');
    }

    public function export(Request $request)
    {
        $searchTerm = $request->input('search');

        $jenis_pengeluaran = jenis_pengeluaran::select(
            'id', 
            'name_of_type_expenditure', 
            'description_of_type_expenditure'
        )
        ->when($searchTerm, function ($query, $searchTerm) {
            $query->where('name_of_type_expenditure', 'like', '%' . $searchTerm . '%')
                ->orWhere('description_of_type_expenditure', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('name_of_type_expenditure', 'asc')
        ->get();

        return Excel::download(new JenisPengeluaranExport($jenis_pengeluaran), 'Daftar Jenis Pengeluaran.xlsx');
    }
}

