<?php

namespace App\Http\Controllers;

use App\Models\bph;
use Illuminate\Http\Request;

class ProfilBPHController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profil.bph.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function show(bph $bph)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bph = bph::findOrFail($id);

        return view('profil.bph.edit', compact([
            'bph',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->input('id');
        
        $bph = bph::findOrFail($id);

        $bph->update($request->all());

        return redirect('/profil_bph')
            ->with('update', 'Data diri Anda berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bph  $bph
     * @return \Illuminate\Http\Response
     */
    public function destroy(bph $bph)
    {
        //
    }
}
