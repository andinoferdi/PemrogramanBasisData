<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KartuStokController extends Controller
{
    public function index()
    {
        $kartuStok = DB::table('v_kartu_stok')->get();
        return view('dashboard.kartu_stok.index', compact('kartuStok'));
    }
}
