<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapitulasiPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::table('jenis_pengeluaran')
            ->leftJoin('pengeluaran', 'jenis_pengeluaran.id', '=', 'pengeluaran.jenis_pengeluaran_id')
            ->select('jenis_pengeluaran.name_of_type_expenditure', DB::raw('YEAR(pengeluaran.expenditure_date) as year'), DB::raw('SUM(pengeluaran.total_expenditure) as total_expenditure'))
            ->groupBy('jenis_pengeluaran.name_of_type_expenditure', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('jenis_pengeluaran.name_of_type_expenditure', 'asc')
            ->get();
    
        return view('pengeluaran_dana.rekapitulasi_pengeluaran.index', compact('results'));
    }
    

    // public function filter(Request $request)
    // {
    //     $month = $request->input('month');
    //     $year = $request->input('year');

    //     $results = $this->getData($month, $year);

    //     return view('pengeluaran_dana.rekapitulasi_pengeluaran.index', compact('results', 'month', 'year'));
    // }

    // private function getData($month = null, $year = null)
    // {
    //     $query = DB::table('jenis_pengeluaran')
    //         ->leftJoin('pengeluaran', 'jenis_pengeluaran.id', '=', 'pengeluaran.jenis_pengeluaran_id')
    //         ->select('jenis_pengeluaran.name_of_type_expenditure', 'pengeluaran.expenditure_date', DB::raw('SUM(pengeluaran.total_expenditure) as total_expenditure'))
    //         ->groupBy('jenis_pengeluaran.name_of_type_expenditure', 'pengeluaran.expenditure_date')
    //         ->orderBy('jenis_pengeluaran.name_of_type_expenditure')
    //         ->orderBy('pengeluaran.expenditure_date');

    //     if ($month) {
    //         $query->whereMonth('pengeluaran.expenditure_date', $month);
    //     }

    //     if ($year) {
    //         $query->whereYear('pengeluaran.expenditure_date', $year);
    //     }

    //     $results = $query->get();

    //     return $results;
    // }
}
