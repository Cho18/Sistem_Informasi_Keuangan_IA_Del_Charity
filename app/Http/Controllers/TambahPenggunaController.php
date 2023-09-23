<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Models\Add;
use App\Models\bph;
use App\Models\donator;
use App\Models\donor;
use App\Models\penerima_beasiswa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahPenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();

        $bph = bph::all();

        $donator = donor::all();

        $awardee = penerima_beasiswa::all();
        
        return view('pengguna_dan_peran.add.index', compact([
            'role', 
            'donator', 
            'awardee',
            'bph',
        ]));
    }

    public function process(AddRequest $request)
    {
        $password = $request->input('password');
        $request->merge([
            'password' => Hash::make($password),
        ]);
        
        $bphId = $request->input('bph_id');
        $donorId = $request->input('donor_id');
        $awardeeId = $request->input('penerima_beasiswa_id');
        
        if (!empty($bphId) && User::where('bph_id', $bphId)->exists()) {
            return redirect('/add')
                ->with('error', 'Donator sudah memiliki akun.');
        }
        if (!empty($donorId) && User::where('donor_id', $donorId)->exists()) {
            return redirect('/add')
                ->with('error', 'Donator sudah memiliki akun.');
        }
        if (!empty($awardeeId) && User::where('penerima_beasiswa_id', $awardeeId)->exists()) {
            return redirect('/add')
                ->with('error', 'Awardee sudah memiliki akun.');
        }

        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('public/profile');
            $request->merge([
                'profile' => str_replace('public/', '', $profilePath),
            ]);
        } else {
            $request->merge([
                'profile' => 'profile/foto-profile.png',
            ]);
        }
        
        $user = User::create($request->all());

        return redirect('/tambah_pengguna')
            ->with('success', 'Akun user berhasil ditambahkan');
    }
}
