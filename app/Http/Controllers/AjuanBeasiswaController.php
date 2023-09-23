<?php

namespace App\Http\Controllers;

use App\Exports\AjuanBeasiswaExport;
use App\Exports\FileBeasiswaExport;
use App\Http\Requests\AjuanBeasiswaRequest;
use App\Models\ajuan_beasiswa;
use App\Models\beasiswa;
use App\Models\penerima_beasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AjuanBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $ajuan_beasiswa = DB::table('ajuan_beasiswa')
            ->join('penerima_beasiswa', 'ajuan_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('ajuan_beasiswa.*', 'penerima_beasiswa.name_awarde')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('layanan_administratif.ajuan_beasiswa.index', compact([
            'ajuan_beasiswa',
        ]));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan_administratif.ajuan_beasiswa.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // ...
    public function store(Request $request)
    {
        $user = Auth::user();
        $awardee = $user->penerima_beasiswa;

        // Periksa apakah pengguna sudah mengajukan beasiswa dalam rentang waktu 6 bulan terakhir
        $existingBeasiswa = ajuan_beasiswa::where('penerima_beasiswa_id', $awardee->id)
            ->where('semester', $request->input('semester'))
            ->whereDate('created_at', '>=', now()->subMonths(6)->toDateString())
            ->first();

        if ($existingBeasiswa) {
            return redirect('/ajuan_beasiswa')
                ->with('error', 'Anda sudah mengajukan beasiswa dalam rentang waktu 6 bulan terakhir');
        }

        // Periksa apakah pilihan semester yang diinputkan sudah ada dalam data beasiswa
        $existingSemester = ajuan_beasiswa::where('penerima_beasiswa_id', $awardee->id)
            ->where('semester', $request->input('semester'))
            ->first();

        if ($existingSemester) {
            return redirect('/ajuan_beasiswa')
                ->with('error', 'Anda sudah mengajukan beasiswa untuk semester yang dipilih.');
        }

        // Validasi total_bursar berdasarkan studi program pengguna
        $studyProgram = $user->penerima_beasiswa->study_program;
        $totalBursar = $request->input('total_bursar');

        if (($studyProgram === 'D3 Teknologi Informasi' || $studyProgram === 'D3 Teknologi Komputer') && $totalBursar > 5500000) {
            return redirect('/ajuan_beasiswa')
                ->with('error', 'Anda hanya dapat mengajukan bursar maksimal Rp. 5.500.000,00 untuk studi program ini.');
        } elseif (($studyProgram === 'S1 Informatika' || $studyProgram === 'S1 Sistem Informasi' || $studyProgram === 'S1 Teknik Elektro' || $studyProgram === 'S1 Manajemen Rekayasa' || $studyProgram === 'D4 Teknologi Rekayasa Perangkat Lunak') && $totalBursar > 6500000) {
            return redirect('/ajuan_beasiswa')
                ->with('error', 'Anda hanya dapat mmengajukan bursar maksimal Rp. 6.500.000,00 untuk studi program ini.');
        } elseif ($studyProgram === 'S1 Teknik Bioproses' && $totalBursar > 7000000) {
            return redirect('/ajuan_beasiswa')
                ->with('error', 'Anda hanya dapat mengajukan bursar maksimal Rp. 7.000.000,00 untuk studi program ini.');
        }

        // Simpan data beasiswa baru
        $beasiswa = new ajuan_beasiswa();
        $beasiswa->penerima_beasiswa_id = $awardee->id;
        $beasiswa->total_bursar = $totalBursar;
        $beasiswa->semester = $request->input('semester');
        $beasiswa->deskripsi = $request->input('deskripsi');
        $beasiswa->status = 'belum diproses';
        $beasiswa->save();

        return redirect('/ajuan_beasiswa')
            ->with('success', 'Ajuan beasiswa berhasil ditambahkan');
    }

    public function export(Request $request)
    {
        $user = Auth::user();

        $searchTerm = $request->input('search');
            
        $ajuanbeasiswa = DB::table('ajuan_beasiswa')
            ->join('penerima_beasiswa', 'ajuan_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('ajuan_beasiswa.*')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->where(function ($query) use ($searchTerm) {
                $query->Where('ajuan_beasiswa.total_bursar', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.semester', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.status', 'like', '%' . $searchTerm . '%')
                    ->orWhere('ajuan_beasiswa.deskripsi', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('ajuan_beasiswa.status', 'desc')
            ->orderBy('ajuan_beasiswa.semester', 'desc')
            ->get();
        return Excel::download(new AjuanBeasiswaExport($ajuanbeasiswa), 'Daftar Ajuan Beasiswa Saya.xlsx');
    }
}
