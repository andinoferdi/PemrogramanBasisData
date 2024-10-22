<?php

// app/Http/Controllers/BarangController.php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('dashboard.barang.index', compact('barang'));
    }

   public function create()
{
    $satuan = Satuan::all();
    return view('dashboard.barang.create', compact('satuan'));
}


    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'idsatuan' => 'required',
            'status' => 'required',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

   public function edit($id)
{
    $barang = Barang::findOrFail($id);
    $satuan = Satuan::all();
    return view('dashboard.barang.edit', compact('barang', 'satuan'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'idsatuan' => 'required',
            'status' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
