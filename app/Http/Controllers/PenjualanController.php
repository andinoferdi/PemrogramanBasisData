<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function create()
    {
        $users = DB::table('user')->get();
        $margin_penjualan = DB::table('margin_penjualan')->get();
        return view('penjualan.create', compact('users', 'margin_penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'margin_penjualan_id' => 'required|integer',
            'subtotal_nilai' => 'required|integer',
            'ppn' => 'required|numeric|min:0|max:100',
        ]);

        $marginPenjualan = DB::table('margin_penjualan')
            ->where('margin_penjualan_id', $request->margin_penjualan_id)
            ->first();

        $margin = ($marginPenjualan->persen / 100) * $request->subtotal_nilai;
        $ppn = ($request->ppn / 100) * $request->subtotal_nilai;
        $totalNilai = $request->subtotal_nilai + $margin + $ppn;

        DB::table('penjualan')->insert([
            'user_id' => $request->user_id,
            'margin_penjualan_id' => $request->margin_penjualan_id,
            'subtotal_nilai' => $request->subtotal_nilai,
            'ppn' => $request->ppn,
            'total_nilai' => $totalNilai,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'margin_penjualan_id' => 'required|integer',
            'subtotal_nilai' => 'required|integer',
            'ppn' => 'required|numeric|min:0|max:100',
        ]);

        $marginPenjualan = DB::table('margin_penjualan')
            ->where('margin_penjualan_id', $request->margin_penjualan_id)
            ->first();

        $margin = ($marginPenjualan->persen / 100) * $request->subtotal_nilai;

        $ppn = ($request->ppn / 100) * $request->subtotal_nilai;

        $totalNilai = $request->subtotal_nilai + $margin + $ppn;

        DB::table('penjualan')
            ->where('penjualan_id', $id)
            ->update([
                'user_id' => $request->user_id,
                'margin_penjualan_id' => $request->margin_penjualan_id,
                'subtotal_nilai' => $request->subtotal_nilai,
                'ppn' => $request->ppn,
                'total_nilai' => $totalNilai,
            ]);

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function delete($id)
    {
        DB::table('penjualan')->where('penjualan_id', $id)->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
