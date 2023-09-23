<?php

namespace App\Http\Controllers;

use App\Exports\InformasiDonasiExport;
use App\Models\pemasukan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InformasiDonasiController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $results = $this->getData($month, $year);

        return view('pemasukan_dana.informasi_donasi.index', compact('results', 'month', 'year'));
    }

    public function filter(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $results = $this->getData($month, $year);

        return view('pemasukan_dana.informasi_donasi.index', compact('results', 'month', 'year'));
    }

    private function getData($month = null, $year = null)
    {
        $query = DB::table('donors')
            ->leftJoin('pemasukan', 'donors.id', '=', 'pemasukan.donor_id')
            ->select('donors.name', DB::raw('SUM(pemasukan.donation_amount) as total_donation_amount'))
            ->groupBy('donors.name')
            ->orderBy('donors.name');

        if ($month) {
            $query->whereMonth('pemasukan.donation_date', $month);
        }

        if ($year) {
            $query->whereYear('pemasukan.donation_date', $year);
        }

        $results = $query->get();

        return $results;
    }

    public function export(Request $request)
{
    $searchTerm = $request->input('search');

    $query = pemasukan::join('donors', 'pemasukan.donor_id', '=', 'donors.id')
        ->select('pemasukan.*')
        ->where(function ($query) use ($searchTerm) {
            $query->where('donors.name', 'like', '%' . $searchTerm . '%')
                ->orWhere('pemasukan.donation_amount', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('donors.name', 'asc');

    $donator = $query->get();

    $results = $this->getData();
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $data = new Collection([
        'results' => $results,
        'donator' => $donator, // Include the $donator variable in the $data collection
        'months' => $months,
    ]);

    return Excel::download(new InformasiDonasiExport($data), 'Informasi Donasi Donator.xlsx');
}
}
