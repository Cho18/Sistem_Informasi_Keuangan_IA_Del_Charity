<?php

namespace App\Http\Controllers;

use App\Exports\CatatanDonasiExport;
use App\Models\pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CatatanDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $donorDonations = DB::table('pemasukan')
            ->join('donors', 'pemasukan.donor_id', '=', 'donors.id')
            ->select('pemasukan.*', 'donors.name')
            ->where('donors.id', $user->donor_id)
            ->orderBy('donation_date', 'desc')
            ->orderBy('type_account', 'asc')
            ->get();

        $total = $donorDonations->sum('donation_amount');

        return view('catatan.donasi.index', compact([
            'donorDonations',
            'total',
        ]));
    }

    public function export(Request $request)
    {
        $user = Auth::user();

        $searchTerm = $request->input('search');

        $donator = DB::table('pemasukan')
            ->join('donors', 'pemasukan.donor_id', '=', 'donors.id')
            ->select('pemasukan.*')
            ->where('donors.id', $user->donor_id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('donors.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.donation_amount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.donation_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.type_account', 'like', '%' . $searchTerm . '%')
                    ->orWhere('pemasukan.description', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('pemasukan.donation_date', 'desc')
            ->orderBy('pemasukan.type_account', 'asc')
            ->get();

        return Excel::download(new CatatanDonasiExport($donator), 'Catatan Donasi Saya.xlsx');
    }
}
