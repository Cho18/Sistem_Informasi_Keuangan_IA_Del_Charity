<?php

namespace App\Http\Controllers;

use App\Models\donor;
use App\Models\profil;
use Illuminate\Http\Request;

class ProfilDonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profil.donator.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donatur = donor::findOrFail($id);

        return view('profil.donator.edit', compact([
            'donatur',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        
        $donor = donor::findOrFail($id);

        $donor->update($request->all());

        return redirect('/profil_donator')
            ->with('update', 'Data diri Anda berhasil diperbarui');
    }
}
