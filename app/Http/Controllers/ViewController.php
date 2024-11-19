<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function satuan()
    {
        $satuan = DB::select('CALL SelectAllSatuan()');
        return view('dashboard.satuan.index', compact('satuan'));
    }

    public function satuanCreate()
    {
        return view('dashboard.satuan.create');
    }

    public function satuanEdit($id)
    {
        $satuan = DB::select('SELECT * FROM satuan WHERE satuan_id = ?', [$id]);

        if (empty($satuan)) {
            abort(404, 'Data satuan tidak ditemukan.');
        }

        return view('dashboard.satuan.edit', ['satuan' => $satuan[0]]);
    }

    public function barang()
    {
        $barang = DB::select('CALL SelectAllBarang()');
        return view('dashboard.barang.index', compact('barang'));
    }

    public function barangCreate()
    {
        $satuan = DB::select('CALL SelectAllSatuan()');
        return view('dashboard.barang.create', compact('satuan'));
    }

    public function barangEdit($id)
    {
        $barang = DB::select('SELECT * FROM barang WHERE barang_id = ?', [$id]);
        $satuan = DB::select('CALL SelectAllSatuan()');

        if (empty($barang)) {
            abort(404, 'Data barang tidak ditemukan.');
        }

        return view('dashboard.barang.edit', [
            'barang' => $barang[0],
            'satuan' => $satuan,
        ]);
    }

    public function vendor()
    {
        $vendor = DB::select('CALL SelectAllVendors()');
        return view('dashboard.vendor.index', compact('vendor'));
    }

    public function vendorCreate()
    {
        return view('dashboard.vendor.create');
    }

    public function vendorEdit($id)
    {
        $vendor = DB::select('SELECT * FROM vendor WHERE vendor_id = ?', [$id]);

        if (empty($vendor)) {
            abort(404, 'Vendor tidak ditemukan.');
        }

        return view('dashboard.vendor.edit', ['vendor' => $vendor[0]]);
    }

    public function role()
    {
        $roles = DB::select('CALL SelectAllRole()');
        return view('dashboard.role.index', compact('roles'));
    }

    public function roleCreate()
    {
        return view('dashboard.role.create');
    }

    public function roleEdit($id)
    {
        $role = DB::select('SELECT * FROM role WHERE role_id = ?', [$id]);

        if (empty($role)) {
            abort(404, 'Role tidak ditemukan.');
        }

        return view('dashboard.role.edit', ['role' => $role[0]]);
    }

    public function user()
    {
        $users = DB::select('CALL SelectAllUsers()');
        return view('dashboard.user.index', compact('users'));
    }

    public function userCreate()
    {
        $roles = DB::select('CALL SelectAllRole()');
        return view('dashboard.user.create', compact('roles'));
    }

    public function userEdit($id)
    {
        $user = DB::select('SELECT * FROM user WHERE user_id = ?', [$id]);
        $roles = DB::select('CALL SelectAllRole()');

        if (empty($user)) {
            abort(404, 'User tidak ditemukan.');
        }

        return view('dashboard.user.edit', [
            'user' => $user[0],
            'roles' => $roles,
        ]);
    }
}
