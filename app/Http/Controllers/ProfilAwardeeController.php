<?php

namespace App\Http\Controllers;

use App\Models\penerima_beasiswa;
use Illuminate\Http\Request;

class ProfilAwardeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profil.awardee.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $awardee = penerima_beasiswa::findOrFail($id);

        return view('profil.awardee.edit', compact([
            'awardee',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->input('id');
        
        $awardee = penerima_beasiswa::findOrFail($id);

        $awardee->update($request->all());

        return redirect('/profil_awardee')
            ->with('update', 'Data diri Anda berhasil diperbarui');
    }
}
