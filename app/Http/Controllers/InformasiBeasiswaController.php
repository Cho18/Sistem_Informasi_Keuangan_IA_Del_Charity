<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->input('year');

        $results = $this->getData($year);

        return view('pengeluaran_dana.informasi_beasiswa.index', compact('results', 'year'));
    }

    public function filter(Request $request)
    {
        $year = $request->input('year');

        $results = $this->getData(null, $year); // Calling the getData function with $year parameter

        return view('pengeluaran_dana.informasi_beasiswa.index', compact('results', 'year'));
    }

    private function getData($month = null, $year = null)
    {
        $query = DB::table('pengeluaran')
            ->leftJoin('penerima_beasiswa', 'pengeluaran.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('penerima_beasiswa.id as penerima_beasiswa_id', 'penerima_beasiswa.name_awarde', DB::raw('SUM(pengeluaran.total_expenditure) as total_expenditure'))
            ->whereNotNull('pengeluaran.penerima_beasiswa_id')
            ->whereNotNull('pengeluaran.jenis_pengeluaran_id')
            ->groupBy('penerima_beasiswa.id', 'penerima_beasiswa.name_awarde')
            ->orderBy('penerima_beasiswa.name_awarde');

        if ($year) {
            $query->whereYear('pengeluaran.expenditure_date', $year);
        }

        $results = $query->get();

        return $results;
    }

}
