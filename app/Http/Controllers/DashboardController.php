<?php

namespace App\Http\Controllers;

use App\Models\ajuan;
use App\Models\beasiswa;
use App\Models\bph;
use App\Models\donasi;
use App\Models\donator;
use App\Models\donator_donasi;
use App\Models\donor;
use App\Models\jenis_pengeluaran;
use App\Models\pemasukan;
use App\Models\penerima_beasiswa;
use App\Models\pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donator = donor::count();
        $awardee = penerima_beasiswa::count();
        $bph = bph::count();
        $income = DB::table('pemasukan')->sum('donation_amount');
        $expense = DB::table('pengeluaran')->sum('total_expenditure');
        $balance = $income - $expense;

        $currentYear = now()->year;
        
        $donator_donasi = pemasukan::all();

        $total_pemasukan = pemasukan::select(DB::raw("CAST(SUM(donation_amount) as int) as donation_amount"))
            ->whereYear('donation_date', '=', $currentYear)
            ->groupBy(DB::raw("MONTH(donation_date)"))
            ->pluck('donation_amount');

        $bulan_pemasukan = pemasukan::select(DB::raw("MONTHNAME(MAX(donation_date)) as bulan"))
            ->whereYear('donation_date', '=', $currentYear)
            ->groupBy(DB::raw("MONTH(donation_date)"))
            ->orderBy(DB::raw("MONTH(donation_date)"))
            ->pluck('bulan');

        $total_pengeluaran = pengeluaran::select(DB::raw("CAST(SUM(total_expenditure) as int) as total_expenditure"))
            ->whereYear('expenditure_date', '=', $currentYear)
            ->groupBy(DB::raw("MONTH(expenditure_date)"))
            ->pluck('total_expenditure');

        $bulan_pengeluaran = pengeluaran::select(DB::raw("MONTHNAME(MAX(expenditure_date)) as bulan"))
            ->whereYear('expenditure_date', '=', $currentYear)
            ->groupBy(DB::raw("MONTH(expenditure_date)"))
            ->orderBy(DB::raw("MONTH(expenditure_date)"))
            ->pluck('bulan');

        $pg = DB::table('pengeluaran')
            ->select('jenis_pengeluaran_id', 'jenis_pengeluaran.name_of_type_expenditure', DB::raw('SUM(total_expenditure) as total'))
            ->join('jenis_pengeluaran', 'pengeluaran.jenis_pengeluaran_id', '=', 'jenis_pengeluaran.id')
            ->groupBy('jenis_pengeluaran_id', 'jenis_pengeluaran.name_of_type_expenditure')
            ->get()
            ->map(function($item) {
                return [
                    'jenis_pengeluaran' => $item->name_of_type_expenditure,
                    'total_expenditure' => $item->total
                ];
            });

        $encodedJpengeluaran = json_encode($pg->pluck('jenis_pengeluaran'));
        $encodedTpengeluaran = json_encode($pg->pluck('total_expenditure'));

        // dd($encodedJpengeluaran);

        return view('dashboard.index', compact(
            'donator',      'expense',                      
            'awardee',      'balance',                        'total_pengeluaran',
            'total_pemasukan',      'bulan_pengeluaran',
            'bph',         'bulan_pemasukan',                   'encodedJpengeluaran',
            'income',                          'encodedTpengeluaran',
        ));
    }
}
