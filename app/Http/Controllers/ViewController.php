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

    public function pengadaan()
    {
        $pengadaan = DB::table('pengadaan')
            ->join('vendor', 'pengadaan.vendor_id', '=', 'vendor.vendor_id')
            ->select('pengadaan.*', 'vendor.nama_vendor')
            ->get();

        return view('dashboard.pengadaan.index', compact('pengadaan'));
    }

    public function pengadaanCreate()
    {
        $users = DB::table('user')->get();
        $vendor = DB::table('vendor')->get();
        return view('dashboard.pengadaan.create', compact('users', 'vendor'));
    }

    public function pengadaanEdit($id)
    {
        $pengadaan = DB::table('pengadaan')->where('pengadaan_id', $id)->first();
        $users = DB::table('user')->get();
        $vendor = DB::table('vendor')->get();

        if (!$pengadaan) {
            abort(404, 'Data pengadaan tidak ditemukan.');
        }

        return view('dashboard.pengadaan.edit', compact('pengadaan', 'users', 'vendor'));
    }

   public function marginPenjualan()
    {
        $marginPenjualan = DB::table('margin_penjualan')
            ->join('user', 'margin_penjualan.user_id', '=', 'user.user_id')
            ->select('margin_penjualan.*', 'user.username')
            ->get();

        return view('dashboard.margin_penjualan.index', compact('marginPenjualan'));
    }

    public function marginPenjualanCreate()
    {
        $users = DB::table('user')->get();
        return view('dashboard.margin_penjualan.create', compact('users'));
    }

    public function marginPenjualanEdit($id)
    {
        $marginPenjualan = DB::table('margin_penjualan')->where('margin_penjualan_id', $id)->first();
        $users = DB::table('user')->get();

        if (!$marginPenjualan) {
            abort(404, 'Data margin penjualan tidak ditemukan.');
        }

        return view('dashboard.margin_penjualan.edit', compact('marginPenjualan', 'users'));
    }

    public function penjualan()
    {
        $penjualan = DB::table('penjualan')
            ->join('user', 'penjualan.user_id', '=', 'user.user_id')
            ->join('margin_penjualan', 'penjualan.margin_penjualan_id', '=', 'margin_penjualan.margin_penjualan_id')
            ->select('penjualan.*', 'user.username', 'margin_penjualan.persen')
            ->get();

        return view('dashboard.penjualan.index', compact('penjualan'));
    }

    public function penjualanCreate()
    {
        $users = DB::table('user')->get();
        $margin_penjualan = DB::table('margin_penjualan')->get();
        return view('dashboard.penjualan.create', compact('users', 'margin_penjualan'));
    }

    public function penjualanEdit($id)
    {
        $penjualan = DB::table('penjualan')->where('penjualan_id', $id)->first();
        $users = DB::table('user')->get();
        $margin_penjualan = DB::table('margin_penjualan')->get();

        if (!$penjualan) {
            abort(404, 'Data penjualan tidak ditemukan.');
        }

        return view('dashboard.penjualan.edit', compact('penjualan', 'users', 'margin_penjualan'));
    }
    
}
