<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardAwardeeController extends Controller
{
    public function index() {
        $user = Auth::user();

        $logawardee = DB::table('pengeluaran')
            ->join('penerima_beasiswa', 'pengeluaran.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->get();

        $total = $logawardee->sum('total_expenditure');

        $beasiswa = DB::table('ajuan_beasiswa')
            ->join('penerima_beasiswa', 'ajuan_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->get();

        $tbeasiswa = $beasiswa->sum('total_bursar');
        $sudah = $beasiswa->where('status', '=', 'Sudah diproses')->count();
        $belum = $beasiswa->where('status', '=', 'Belum diproses')->count();

        $file = DB::table('file_beasiswa')
        ->join('penerima_beasiswa', 'file_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
        ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
        ->get();  
        
        $sudah2 = $file->where('status', '=', 'Sudah diproses')->count();
        $belum2 = $file->where('status', '=', 'Belum diproses')->count();

        return view('dashboard.index_awardee', compact(
            'total',            'sudah',        'sudah2',
            'tbeasiswa',        'belum',        'belum2',
        ));
    }
}
