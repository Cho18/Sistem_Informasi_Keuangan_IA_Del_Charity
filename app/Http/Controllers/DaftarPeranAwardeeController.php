<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DaftarPeranAwardeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awardee = User::where('role_id', 4)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengguna_dan_peran.user_awardee.index', [
            'awardee' => $awardee
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
        $user_awardee = User::findorfail($id);
        $user_awardee->delete();

        return redirect('/daftar_peran_awardee')
            ->with('delete', 'List user awardee berhasil dihapus');
    }
}
