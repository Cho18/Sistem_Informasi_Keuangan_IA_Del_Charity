<?php

namespace App\Http\Controllers;

use App\Models\list_user;
use App\Http\Requests\Storelist_userRequest;
use App\Http\Requests\Updatelist_userRequest;
use App\Models\User;

class DaftarPeranBPHController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bph = User::where('role_id', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pengguna_dan_peran.user_bph.index', [
            'bph' => $bph
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\list_user  $list_user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list_user = User::findorfail($id);
        $list_user->delete();

        return redirect('/daftar_peran_bph')
            ->with('delete', 'List user bph berhasil dihapus');
    }
}
