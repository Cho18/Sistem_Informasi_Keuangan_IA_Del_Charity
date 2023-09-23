<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapitulasiPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::table('jenis_pemasukan')
            ->leftJoin('pemasukan', 'jenis_pemasukan.id', '=', 'pemasukan.jenis_pemasukan_id')
            ->select('jenis_pemasukan.name_of_type_income', DB::raw('YEAR(pemasukan.donation_date) as year'), DB::raw('SUM(pemasukan.donation_amount) as donation_amount'))
            ->groupBy('jenis_pemasukan.name_of_type_income', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('jenis_pemasukan.name_of_type_income', 'asc')
            ->get();
    
        return view('pemasukan_dana.rekapitulasi_pemasukan.index', compact('results'));
    }
}
