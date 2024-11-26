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

        DB::table('satuan')
            ->where('satuan_id', $id)
            ->update([
                'nama_satuan' => $request->input('nama_satuan'),
            ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diperbarui!');
    }

    public function delete($id)
    {
        DB::table('satuan')
            ->where('satuan_id', $id)
            ->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus!');
    }
}
