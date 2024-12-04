<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenerimaanController extends Controller
{
    public function index()
    {
        $detailPenerimaan = DB::table('detail_penerimaan')
            ->join('barang', 'detail_penerimaan.barang_id', '=', 'barang.barang_id')
            ->join('penerimaan', 'detail_penerimaan.penerimaan_id', '=', 'penerimaan.penerimaan_id')
            ->select('detail_penerimaan.*', 'barang.nama_barang', 'penerimaan.penerimaan_id')
            ->get();

        return view('dashboard.detail_penerimaan.index', compact('detailPenerimaan'));
    }

    public function create()
    {
        $barang = DB::table('barang')->get();
        $penerimaan = DB::table('penerimaan')->get();
        return view('dashboard.detail_penerimaan.create', compact('barang', 'penerimaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'harga_satuan_terima' => 'required|integer',
            'jumlah_terima' => 'required|integer',
            'penerimaan_id' => 'required|integer',
        ]);

        $subtotal_terima = $request->harga_satuan_terima * $request->jumlah_terima;

        DB::statement('CALL insert_detail_penerimaan(?, ?, ?, ?, ?)', [
            $request->barang_id,
            $request->harga_satuan_terima,
            $request->jumlah_terima,
            $request->penerimaan_id,
            $subtotal_terima
        ]);

        return redirect()->route('detail_penerimaan.index')->with('success', 'Detail penerimaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detailPenerimaan = DB::table('detail_penerimaan')->where('detail_penerimaan_id', $id)->first();
        $barang = DB::table('barang')->get();
        $penerimaan = DB::table('penerimaan')->get();

        return view('dashboard.detail_penerimaan.edit', compact('detailPenerimaan', 'barang', 'penerimaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'harga_satuan_terima' => 'required|integer',
            'jumlah_terima' => 'required|integer',
            'penerimaan_id' => 'required|integer',
        ]);

        $subtotal_terima = $request->harga_satuan_terima * $request->jumlah_terima;

        DB::table('detail_penerimaan')
            ->where('detail_penerimaan_id', $id)
            ->update([
                'barang_id' => $request->barang_id,
                'harga_satuan_terima' => $request->harga_satuan_terima,
                'jumlah_terima' => $request->jumlah_terima,
                'subtotal_terima' => $subtotal_terima,
                'penerimaan_id' => $request->penerimaan_id,
            ]);

        return redirect()->route('detail_penerimaan.index')->with('success', 'Detail penerimaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('detail_penerimaan')
            ->where('detail_penerimaan_id', $id)
            ->delete();

        return redirect()->route('detail_penerimaan.index')->with('success', 'Detail penerimaan berhasil dihapus!');
    }
}
