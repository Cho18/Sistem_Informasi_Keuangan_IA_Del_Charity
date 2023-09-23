<?php

namespace App\Http\Controllers;

use App\Models\pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasukanKeuanganController extends Controller
{
    public function index()
    {
        $pemasukan = DB::table('pemasukan')
            ->select(DB::raw('SUM(donation_amount) as total_donation, donation_date'))
            ->groupBy('donation_date')
            ->orderBy('donation_date', 'desc')
            ->get();

        return view('publik.keuangan.pemasukan.index', compact('pemasukan'));
    }

    public function filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $pemasukan = DB::table('pemasukan')
            ->select(DB::raw('SUM(donation_amount) as total_donation, donation_date'))
            ->groupBy('donation_date')
            ->orderBy('donation_date', 'desc');

        // Apply filters if they are provided
        if (!empty($start_date)) {
            if (empty($end_date)) {
                $pemasukan->whereDate('donation_date', $start_date);
            } else {
                $pemasukan->whereBetween('donation_date', [$start_date, $end_date]);
            }
        }

        $pemasukan = $pemasukan->get();

        return view('publik.keuangan.pemasukan.index', compact('pemasukan'));
    }
}
