<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:45',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|exists:role,role_id',
        ]);

        try {
            $hashedPassword = bcrypt($request->input('password'));
            DB::select('CALL InsertUser(?, ?, ?)', [
                $request->input('username'),
                $hashedPassword,
                $request->input('role_id'),
            ]);

            return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:45',
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|integer|exists:role,role_id',
        ]);

        try {
            $hashedPassword = $request->input('password') ? bcrypt($request->input('password')) : null;

            DB::table('user')
                ->where('user_id', $id)
                ->update([
                    'username' => $request->input('username'),
                    'password' => $hashedPassword ?? DB::table('user')->where('user_id', $id)->value('password'),
                    'role_id' => $request->input('role_id'),
                ]);

            return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Gagal memperbarui user: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::table('user')->where('user_id', $id)->delete();

            return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
