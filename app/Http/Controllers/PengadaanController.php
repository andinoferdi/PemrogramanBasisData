<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'vendor_id' => 'required|integer',
        'subtotal_nilai' => 'required|integer',
        'ppn' => 'required|numeric|min:0|max:100', 
    ]);

    $total_nilai = $request->subtotal_nilai * (1 + $request->ppn / 100);

    DB::select('CALL InsertPengadaan(?, ?, ?, ?, ?, ?)', [
        $request->user_id,
        $request->vendor_id,
        0,
        $request->subtotal_nilai,
        $request->ppn,
        $total_nilai, 
    ]);

    return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil ditambahkan!');
}

public function update(Request $request, $id)
{
    
    $request->validate([
        'user_id' => 'required|integer',
        'vendor_id' => 'required|integer',
        'subtotal_nilai' => 'required|integer',
        'ppn' => 'required|numeric|min:0|max:100', 
    ]);

    $data = [
        'user_id' => $request->user_id,
        'vendor_id' => $request->vendor_id,
        'subtotal_nilai' => $request->subtotal_nilai,
        'ppn' => $request->ppn,
        'total_nilai' => $request->subtotal_nilai * (1 + $request->ppn / 100),
    ];

    if (auth()->user()->role_id == '1') {
        $data['status'] = $request->status;
    }

    DB::table('pengadaan')
        ->where('pengadaan_id', $id)
        ->update($data);

    return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil diperbarui!');
}


    public function delete($id)
    {
        DB::table('pengadaan')
            ->where('pengadaan_id', $id)
            ->delete();

        return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dihapus!');
    }
}
