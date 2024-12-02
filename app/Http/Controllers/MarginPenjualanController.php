<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarginPenjualanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'persen' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:0,1',
            'user_id' => 'required|integer|exists:user,user_id',
        ]);

        DB::table('margin_penjualan')->insert([
            'persen' => $request->persen,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('margin_penjualan.index')->with('success', 'Margin Penjualan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persen' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:0,1',
            'user_id' => 'required|integer|exists:user,user_id',
        ]);

        DB::table('margin_penjualan')
            ->where('margin_penjualan_id', $id)
            ->update([
                'persen' => $request->persen,
                'status' => $request->status,
                'user_id' => $request->user_id,
            ]);

        return redirect()->route('margin_penjualan.index')->with('success', 'Margin Penjualan berhasil diperbarui!');
    }

    public function delete($id)
    {
        DB::table('margin_penjualan')
            ->where('margin_penjualan_id', $id)
            ->delete();

        return redirect()->route('margin_penjualan.index')->with('success', 'Margin Penjualan berhasil dihapus!');
    }
}
