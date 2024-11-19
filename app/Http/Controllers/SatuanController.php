<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nama_satuan' => 'required|string|max:255',
    ]);

    DB::select('CALL InsertSatuan(?)', [
        $request->nama_satuan
    ]);

    return redirect()->route('satuan.index')->with('success', 'Satuan berhasil ditambahkan!');
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:255',
        ]);

        $result = DB::select('CALL UpdateSatuan(?, ?)', [
            $id,
            $request->input('nama_satuan'),
        ]);

        if ($result) {
            return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui!');
        }

        return redirect()->route('satuan.index')->with('error', 'Gagal memperbarui satuan.');
    }

    public function delete($id)
    {
        $result = DB::select('CALL DeleteSatuan(?)', [$id]);

        if ($result) {
            return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus!');
        }

        return redirect()->route('satuan.index')->with('error', 'Gagal menghapus satuan.');
    }
}
