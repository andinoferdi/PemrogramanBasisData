<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{

    public function satuan()
    {
        $satuan = DB::table('satuan')->get();
        return view('dashboard.satuan.index', compact('satuan'));
    }

    public function satuanCreate()
    {
        return view('dashboard.satuan.create');
    }

    public function satuanEdit($id)
    {
        $satuan = DB::table('satuan')->where('satuan_id', $id)->first();

        if (!$satuan) {
            abort(404, 'Data satuan tidak ditemukan.');
        }

        return view('dashboard.satuan.edit', compact('satuan'));
    }

    public function barang()
    {
        $barangs = DB::table('barang')
            ->join('satuan', 'barang.satuan_id', '=', 'satuan.satuan_id')
            ->select('barang.*', 'satuan.nama_satuan')
            ->get();

        return view('dashboard.barang.index', compact('barangs'));
    }

    public function barangCreate()
    {
        $satuan = DB::table('satuan')->get();
        return view('dashboard.barang.create', compact('satuan'));
    }

    public function barangEdit($id)
    {
        $barang = DB::table('barang')->where('barang_id', $id)->first();
        $satuan = DB::table('satuan')->get();

        if (!$barang) {
            abort(404, 'Barang tidak ditemukan.');
        }

        return view('dashboard.barang.edit', compact('barang', 'satuan'));
    }

    public function vendor()
    {
        $vendor = DB::table('vendor')->get();
        return view('dashboard.vendor.index', compact('vendor'));
    }

    public function vendorCreate()
    {
        return view('dashboard.vendor.create');
    }

    public function vendorEdit($id)
    {
        $vendor = DB::table('vendor')->where('vendor_id', $id)->first();

        if (!$vendor) {
            abort(404, 'Data vendor tidak ditemukan.');
        }

        return view('dashboard.vendor.edit', compact('vendor'));
    }

    public function role()
    {
        $roles = DB::table('role')->get();
        return view('dashboard.role.index', compact('roles'));
    }

    public function roleCreate()
    {
        return view('dashboard.role.create');
    }

    public function roleEdit($id)
    {
        $role = DB::table('role')->where('role_id', $id)->first();

        if (!$role) {
            abort(404, 'Role tidak ditemukan.');
        }

        return view('dashboard.role.edit', compact('role'));
    }

    public function user()
    {
        $users = DB::table('user')
            ->join('role', 'user.role_id', '=', 'role.role_id')
            ->select('user.*', 'role.nama_role')
            ->get();

        return view('dashboard.user.index', compact('users'));
    }

    public function userCreate()
    {
        $roles = DB::table('role')->get();
        return view('dashboard.user.create', compact('roles'));
    }

    public function userEdit($id)
    {
        $user = DB::table('user')->where('user_id', $id)->first();
        $roles = DB::table('role')->get();

        if (!$user) {
            abort(404, 'User tidak ditemukan.');
        }

        return view('dashboard.user.edit', compact('user', 'roles'));
    }
}
