<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPengadaanController extends Controller
{
    public function index()
    {
        $detailPengadaan = DB::table('detail_pengadaan')
            ->join('pengadaan', 'detail_pengadaan.pengadaan_id', '=', 'pengadaan.pengadaan_id')
            ->join('barang', 'detail_pengadaan.barang_id', '=', 'barang.barang_id')
            ->select('detail_pengadaan.*', 'pengadaan.vendor_id', 'barang.nama_barang')
            ->get();

        return view('dashboard.detail_pengadaan.index', compact('detailPengadaan'));
    }

    public function create()
    {
        $pengadaan = DB::table('pengadaan')->get();
        $barang = DB::table('barang')->get();
        return view('dashboard.detail_pengadaan.create', compact('pengadaan', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengadaan_id' => 'required|exists:pengadaan,pengadaan_id',
            'barang_id' => 'required|exists:barang,barang_id',
            'harga_satuan' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        DB::select('CALL sp_insert_detail_pengadaan(?, ?, ?, ?)', [
            $request->pengadaan_id,
            $request->barang_id,
            $request->harga_satuan,
            $request->jumlah,
        ]);

        return redirect()->route('detailPengadaan.index')->with('success', 'Detail Pengadaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detailPengadaan = DB::table('detail_pengadaan')->where('detail_pengadaan_id', $id)->first();
        $pengadaan = DB::table('pengadaan')->get();
        $barang = DB::table('barang')->get();

        if (!$detailPengadaan) {
            abort(404, 'Data detail pengadaan tidak ditemukan.');
        }

        return view('dashboard.detail_pengadaan.edit', compact('detailPengadaan', 'pengadaan', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pengadaan_id' => 'required|exists:pengadaan,pengadaan_id',
            'barang_id' => 'required|exists:barang,barang_id',
            'harga_satuan' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        $subtotal = $request->harga_satuan * $request->jumlah;

        DB::table('detail_pengadaan')
            ->where('detail_pengadaan_id', $id)
            ->update([
                'pengadaan_id' => $request->pengadaan_id,
                'barang_id' => $request->barang_id,
                'harga_satuan' => $request->harga_satuan,
                'jumlah' => $request->jumlah,
                'subtotal' => $subtotal,
            ]);

        return redirect()->route('detailPengadaan.index')->with('success', 'Detail Pengadaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('detail_pengadaan')->where('detail_pengadaan_id', $id)->delete();

        return redirect()->route('detailPengadaan.index')->with('success', 'Detail Pengadaan berhasil dihapus!');
    }
}
