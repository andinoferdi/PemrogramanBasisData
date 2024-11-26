<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:100',
            'badan_hukum' => 'required|in:P,C',
            'status' => 'required|in:A,I',
        ]);

        try {
            DB::select('CALL InsertVendor(?, ?, ?)', [
                $request->input('nama_vendor'),
                $request->input('badan_hukum'),
                $request->input('status'),
            ]);

            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.index')->with('error', 'Gagal menambahkan vendor: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:100',
            'badan_hukum' => 'required|in:P,C',
            'status' => 'required|in:A,I',
        ]);

        try {
            DB::table('vendor')
                ->where('vendor_id', $id)
                ->update([
                    'nama_vendor' => $request->input('nama_vendor'),
                    'badan_hukum' => $request->input('badan_hukum'),
                    'status' => $request->input('status'),
                ]);

            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.index')->with('error', 'Gagal memperbarui vendor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::table('vendor')->where('vendor_id', $id)->delete();

            return redirect()->route('vendor.index')->with('success', 'Vendor berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('vendor.index')->with('error', 'Gagal menghapus vendor: ' . $e->getMessage());
        }
    }
}
