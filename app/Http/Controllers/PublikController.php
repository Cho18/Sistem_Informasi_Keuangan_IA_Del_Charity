<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublikController extends Controller
{
    public function index()
    {
        return view('publik.home.index');
    }
}
