<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
   // Handle login
public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    // Mengambil user berdasarkan username
    $user = User::where('username', $request->username)->first();

    // Verifikasi password (tanpa Hash::check)
    if ($user && $request->password === $user->password) { // Perbandingan langsung
        Auth::login($user);
        return redirect()->intended('/'); // Mengarahkan ke halaman utama setelah login berhasil
    }

    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ]);
}


    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password
            'role_id' => 2 // Set a default role for the new user, if needed
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
