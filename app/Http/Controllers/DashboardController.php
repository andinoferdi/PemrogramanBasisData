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
        $searchTerm = $request->input('search');
        
        $barangResults = [];
        $vendorResults = [];
        $roleResults = [];
        $userResults = [];
        $satuanResults = [];

        if ($searchTerm) {
            $barangResults = Barang::where('nama_barang', 'LIKE', "%{$searchTerm}%")->get();
            $vendorResults = Vendor::where('nama_vendor', 'LIKE', "%{$searchTerm}%")->get();
            $roleResults = Role::where('nama_role', 'LIKE', "%{$searchTerm}%")->get();
            $userResults = User::where('username', 'LIKE', "%{$searchTerm}%")->get();
            $satuanResults = Satuan::where('nama_satuan', 'LIKE', "%{$searchTerm}%")->get();
        }

         $topBarangs = Barang::select('nama_barang', 'status')
                            ->orderBy('status', 'desc')
                            ->take(5)
                            ->get();

        $users = User::with('role')->get();

        return view('dashboard.index', compact('barangResults', 'vendorResults', 'roleResults', 'userResults', 'satuanResults', 'searchTerm', 'topBarangs', 'users'));
    }
}
