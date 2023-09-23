<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DaftarPeranDonator extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donor = User::where('role_id', 3)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengguna_dan_peran.user_donator.index', [
            'donor' => $donor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_donor = User::findorfail($id);
        $user_donor->delete();

        return redirect('/daftar_peran_donator')
            ->with('delete', 'List user donator berhasil dihapus');
    }
}
