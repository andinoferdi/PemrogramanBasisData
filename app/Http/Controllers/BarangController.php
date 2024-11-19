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
        $request->harga         
    ]);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|alpha|max:1',
            'nama_barang' => 'required|string|max:45',
            'satuan_id' => 'required|integer|exists:satuan,satuan_id',
            'status' => 'required|boolean',
            'harga' => 'required|integer|min:0',
        ]);

        try {
            DB::select('CALL UpdateBarang(?, ?, ?, ?, ?, ?)', [
                $id,
                $request->input('jenis'),
                $request->input('nama_barang'),
                $request->input('satuan_id'),
                $request->input('status'),
                $request->input('harga'),
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->with('error', 'Gagal memperbarui barang: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::select('CALL DeleteBarang(?)', [$id]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('barang.index')->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }
}
