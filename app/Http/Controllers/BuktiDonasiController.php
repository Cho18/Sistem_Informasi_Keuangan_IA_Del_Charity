<?php

namespace App\Http\Controllers;

use App\Exports\BuktiDonasiExport;
use App\Http\Requests\DonasiRequest;
use App\Models\bukti_donasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BuktiDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $donasi = DB::table('bukti_donasi')
            ->join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->select('bukti_donasi.*', 'donors.name')
            ->where('donors.id', $user->donor_id)
            ->orderBy('status', 'desc')
            ->orderBy('donation_date', 'desc')
            ->orderBy('type_account', 'asc')
            ->get();

        $total = $donasi->sum('donation_amount');

        return view('layanan_administratif.bukti_donasi.index', compact([
            'donasi',
            'total',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan_administratif.bukti_donasi.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(DonasiRequest $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $donor = $user->donor;
    
        $validatedData = $request->validated();
    
        if ($request->hasFile('bukti_transaksi')) {
            $file = $request->file('bukti_transaksi');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName = $user_id . '_' . $originalFileName;
            $filePath = $file->storeAs('bukti_transaksi', $fileName);
            $validatedData['bukti_transaksi'] = $filePath;
        }
    
        $donasi = bukti_donasi::create([
            'donor_id' => $donor->id,
            'donation_amount' => $validatedData['donation_amount'],
            'donation_date' => $validatedData['donation_date'],
            'type_account' => $validatedData['type_account'],
            'description' => $validatedData['description'],
            'bukti_transaksi' => $validatedData['bukti_transaksi'],
            'status' => 'belum diproses',
        ]);
    
        return redirect('/bukti_donasi')
            ->with('success', 'Bukti donasi Anda berhasil ditambahkan');
    }

    public function export(Request $request)
    {
        $user = Auth::user();

        $searchTerm = $request->input('search');

        $donator = bukti_donasi::join('donors', 'bukti_donasi.donor_id', '=', 'donors.id')
            ->select('bukti_donasi.*')
            ->where('donors.id', $user->donor_id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('donors.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.donation_amount', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.donation_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.type_account', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.description', 'like', '%' . $searchTerm . '%')
                    ->orWhere('bukti_donasi.status', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('bukti_donasi.status', 'desc')
            ->orderBy('bukti_donasi.donation_date', 'desc')
            ->orderBy('donors.name', 'asc')
            ->orderBy('bukti_donasi.type_account', 'asc')
            ->get();

        return Excel::download(new BuktiDonasiExport($donator), 'Daftar Bukti Donasi Saya.xlsx');
    }
}
