<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nama_barang' => 'required',
            'satuan_id' => 'required',
            'status' => 'required',
            'harga' => 'required|integer',
        ]);

        DB::select('CALL InsertBarang(?, ?, ?, ?, ?)', [
            $request->jenis,
            $request->nama_barang,
            $request->satuan_id,
            $request->status,
            $request->harga,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'nama_barang' => 'required',
            'satuan_id' => 'required',
            'status' => 'required',
            'harga' => 'required|integer',
        ]);

        DB::table('barang')
        ->where('barang_id', $id)
        ->update([
            'jenis' => $request->input('jenis'),
            'nama_barang' => $request->input('nama_barang'),
            'satuan_id' => $request->input('satuan_id'),
            'status' => $request->input('status'),
            'harga' => $request->input('harga'),
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('barang')->where('barang_id', $id)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
