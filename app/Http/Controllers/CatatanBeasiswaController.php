<?php

namespace App\Http\Controllers;

use App\Exports\CatatanBeasiswaExport;
use App\Models\penerima_beasiswa;
use App\Models\pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CatatanBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $logawardee = DB::table('pengeluaran')
            ->join('penerima_beasiswa', 'pengeluaran.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('pengeluaran.*', 'penerima_beasiswa.name_awarde')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->orderBy('expenditure_date', 'desc')
            ->get();

        $total = $logawardee->sum('total_expenditure');

        return view('catatan.beasiswa.index', compact([
            'logawardee',
            'total',
        ]));
    }

    public function export(Request $request)
    {
        $user = Auth::user();

        $searchTerm = $request->input('search');
        $pengeluaran = DB::table('pengeluaran')
            ->join('penerima_beasiswa', 'pengeluaran.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('pengeluaran.*')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->where(function ($query) use ($searchTerm) {
                $query->Where('penerima_beasiswa.name_awarde', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pengeluaran.total_expenditure', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pengeluaran.expenditure_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pengeluaran.expenditure_description', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('pengeluaran.expenditure_date', 'desc')
            ->orderBy('penerima_beasiswa.name_awarde', 'asc')
            ->get();

        return Excel::download(new CatatanBeasiswaExport($pengeluaran), 'Catatan Beasiswa Saya.xlsx');
    }
}
