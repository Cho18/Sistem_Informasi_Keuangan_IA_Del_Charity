<?php

namespace App\Http\Controllers;

use App\Models\jenis_pengeluaran;
use App\Models\pengeluaran;
use Illuminate\Http\Request;

class PengeluaranKeuanganController extends Controller
{
    public function index() {
        $pengeluaran = pengeluaran::with('jenis_pengeluaran', 'penerima_beasiswa')
            ->orderBy('expenditure_date', 'desc')
            ->orderBy('jenis_pengeluaran_id', 'asc')
            ->orderBy('penerima_beasiswa_id', 'asc')
            ->get();
            
        $jenis_pengeluaran = jenis_pengeluaran::all();

        return view('publik.keuangan.pengeluaran.index', compact(
            'pengeluaran',
            'jenis_pengeluaran',
        ));
    }

    public function filter(Request $request){
        $jenis_pengeluaran = jenis_pengeluaran::all();
    
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $jenis_pengeluaran_id = $request->input('jenis_pengeluaran_id');
        
        $pengeluaran = pengeluaran::with('jenis_pengeluaran');
    
        // Apply filters if they are provided
        if (!empty($start_date)) {
            if (empty($end_date)) {
                $pengeluaran->whereDate('expenditure_date', $start_date);
            } else {
                $pengeluaran->whereBetween('expenditure_date', [$start_date, $end_date]);
            }
        }
    
        // Apply "jenis_pengeluaran" filter if it is provided
        if (!empty($jenis_pengeluaran_id)) {
            $pengeluaran->where('jenis_pengeluaran_id', $jenis_pengeluaran_id);
        }
    
        $pengeluaran = $pengeluaran->orderBy('expenditure_date', 'desc')->get();
        
        return view('publik.keuangan.pengeluaran.index', compact(
            'pengeluaran',
            'jenis_pengeluaran',
        ));
    }
    
}
