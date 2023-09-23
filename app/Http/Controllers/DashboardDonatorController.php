<?php

namespace App\Http\Controllers;

use App\Models\penerima_beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardDonatorController extends Controller
{
    public function index() {
        $expense = DB::table('pengeluaran')->sum('total_expenditure');
        $awardee = penerima_beasiswa::count();

        $user = Auth::user();

        $donasi = DB::table('bukti_donasi')
            ->join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->where('donors.id', $user->donor_id)
            ->get();
        $tdonasi = $donasi->sum('donation_amount');
        // $sudah = $donasi->where('status', '=', 'Sudah diproses');
        // $belum = $donasi->where('status', '=', 'Belum diproses')->count();

        $sudah = DB::table('bukti_donasi')
            ->join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->where('donors.id', $user->donor_id)
            ->where('bukti_donasi.status', 'sudah diproses')
            ->count();

        $belum = DB::table('bukti_donasi')
            ->join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->where('donors.id', $user->donor_id)
            ->where('bukti_donasi.status', 'belum diproses')
            ->count();

        $donorDonations = DB::table('pemasukan')
            ->join('donors', 'pemasukan.donor_id', '=', 'donors.id')
            ->where('donors.id', $user->donor_id)
            ->get();

        $total = $donorDonations->sum('donation_amount');

        // dd($tdonasi, $sudah, $belum);

        return view('dashboard.index_donator', compact(
            'tdonasi',      'sudah',
            'expense',      'belum',
            'awardee',
            'total',
        ));
    }
}
