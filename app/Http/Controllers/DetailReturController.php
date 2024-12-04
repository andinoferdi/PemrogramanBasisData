<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailReturController extends Controller
{
    public function index()
    {
        // Mengambil data detail_retur, detail_penerimaan, barang, dan retur dengan join
        $detailRetur = DB::table('detail_retur')
            ->join('detail_penerimaan', 'detail_retur.detail_penerimaan_id', '=', 'detail_penerimaan.detail_penerimaan_id')
            ->join('barang', 'detail_penerimaan.barang_id', '=', 'barang.barang_id')
            ->join('retur', 'detail_retur.retur_id', '=', 'retur.retur_id')
            ->select('detail_retur.*', 'barang.nama_barang', 'retur.retur_id')
            ->get();

        return view('dashboard.detail_retur.index', compact('detailRetur'));
    }

    public function create()
    {
        // Ambil semua data penerimaan yang ada
        $retur = DB::table('retur')->get();
        $detailPenerimaan = DB::table('detail_penerimaan')
            ->join('barang', 'detail_penerimaan.barang_id', '=', 'barang.barang_id')
            ->select('detail_penerimaan.detail_penerimaan_id', 'barang.nama_barang')
            ->get();

        return view('dashboard.detail_retur.create', compact('retur', 'detailPenerimaan'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'retur_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'alasan' => 'required|string|max:200',
            'detail_penerimaan_id' => 'required|integer',
        ]);

        // Insert data ke tabel detail_retur
        DB::table('detail_retur')->insert([
            'retur_id' => $request->retur_id,
            'jumlah' => $request->jumlah,
            'alasan' => $request->alasan,
            'detail_penerimaan_id' => $request->detail_penerimaan_id,
        ]);

        return redirect()->route('detail_retur.index')->with('success', 'Detail Retur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Ambil data detail retur yang ingin diubah
        $detailRetur = DB::table('detail_retur')->where('detail_retur_id', $id)->first();
        $retur = DB::table('retur')->get();
        $detailPenerimaan = DB::table('detail_penerimaan')
            ->join('barang', 'detail_penerimaan.barang_id', '=', 'barang.barang_id')
            ->select('detail_penerimaan.detail_penerimaan_id', 'barang.nama_barang')
            ->get();

        return view('dashboard.detail_retur.edit', compact('detailRetur', 'retur', 'detailPenerimaan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'retur_id' => 'required|integer',
            'jumlah' => 'required|integer',
            'alasan' => 'required|string|max:200',
            'detail_penerimaan_id' => 'required|integer',
        ]);

        // Update data di tabel detail_retur
        DB::table('detail_retur')
            ->where('detail_retur_id', $id)
            ->update([
                'retur_id' => $request->retur_id,
                'jumlah' => $request->jumlah,
                'alasan' => $request->alasan,
                'detail_penerimaan_id' => $request->detail_penerimaan_id,
            ]);

        return redirect()->route('detail_retur.index')->with('success', 'Detail Retur berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus data dari tabel detail_retur
        DB::table('detail_retur')->where('detail_retur_id', $id)->delete();

        return redirect()->route('detail_retur.index')->with('success', 'Detail Retur berhasil dihapus!');
    }
}
