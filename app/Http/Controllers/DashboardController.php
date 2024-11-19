<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Vendor;
use App\Models\Role;
use App\Models\User;
use App\Models\Satuan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
       

        return view('dashboard.index');
    }
}
