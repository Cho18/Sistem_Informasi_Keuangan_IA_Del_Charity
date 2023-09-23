<?php

namespace App\Http\Controllers;

use App\Exports\FileBeasiswaExport;
use App\Http\Requests\FileBeasiswaRequest;
use App\Models\file_beasiswa;
use App\Models\dokumen;
use App\Models\penerima_beasiswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FileBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $logfile_beasiswa = DB::table('file_beasiswa')
            ->join('penerima_beasiswa', 'file_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->join('dokumen', 'file_beasiswa.dokumen_id', '=', 'dokumen.id')
            ->select('file_beasiswa.*', 'penerima_beasiswa.name_awarde', 'dokumen.name')
            ->where('penerima_beasiswa.id', $user->penerima_beasiswa_id)
            ->orderBy('tanggal_upload', 'desc')
            ->orderBy('dokumen_id', 'asc')
            ->get();

        $dokumen = dokumen::all();

        return view('layanan_administratif.unggah_berkas.index', compact([
            'logfile_beasiswa',
            'dokumen'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileBeasiswaRequest $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $awardee = $user->penerima_beasiswa;
        
        $aj = new file_beasiswa();
        $aj->penerima_beasiswa_id = $awardee->id;
        
        // Menyimpan file dokumen pada direktori yang ditentukan
        $dokumen = $request->file('file_beasiswa');
        $nama_asli = $dokumen->getClientOriginalName();
        $dokumen_path = $dokumen->storeAs('file_beasiswa', $nama_asli);
        $aj->file_beasiswa = $dokumen_path;
        
        $aj->dokumen_id = $request->input('dokumen_id');
        $aj->tanggal_upload = Carbon::now();
        $aj->status = 'belum diproses';
        $aj->save();

        return redirect('/file_beasiswa')
            ->with('success', 'Berkas berhasil dikirimkan');
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('search');

        $file_beasiswa = file_beasiswa::leftJoin('dokumen', 'file_beasiswa.dokumen_id', '=', 'dokumen.id')
            ->leftJoin('penerima_beasiswa', 'file_beasiswa.penerima_beasiswa_id', '=', 'penerima_beasiswa.id')
            ->select('file_beasiswa.*')
            ->where(function ($query) use ($searchTerm) {
                $query->where('dokumen.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('file_beasiswa.tanggal_upload', 'like', '%' . $searchTerm . '%')
                    ->orWhere('file_beasiswa.status', 'like', '%' . $searchTerm . '%');
            })
            ->whereHas('penerima_beasiswa', function ($q) use ($user) {
                $q->where('id', $user->penerima_beasiswa_id);
            })
            ->orderBy('file_beasiswa.status', 'desc')
            ->orderBy('file_beasiswa.tanggal_upload', 'desc')
            ->orderBy('dokumen.name', 'asc')
            ->get();

        return Excel::download(new FileBeasiswaExport($file_beasiswa), 'Daftar File Beasiswa.xlsx');
    }
}
