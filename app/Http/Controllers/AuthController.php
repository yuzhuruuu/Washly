<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
       $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:pelanggans', // <--- TAMBAHIN INI
            'email' => 'required|string|email|max:255|unique:pelanggans',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Simpan ke tabel pelanggans
        $pelanggan = Pelanggan::create([
            'nama' => $request->nama,
            'username' => $request->username, // <--- TAMBAHIN INI JUGA
            'email' => $request->email,
            'password' => Hash::make($request->password), // Jangan lupa import Hash ya kalau belum
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Langsung login-kan setelah daftar
        Auth::guard('pelanggan')->login($pelanggan);

        return redirect('/dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang di Washly.');

    }

    public function login(Request $request)
    {
        $identity = $request->input('login_identity');
        $password = $request->input('password');

        $loginField = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 1. Coba login sebagai Admin
        if (Auth::guard('admin')->attempt([$loginField => $identity, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // 2. Coba login sebagai Pelanggan
        if (Auth::guard('pelanggan')->attempt([$loginField => $identity, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // 3. Coba login sebagai Kurir
        if (Auth::guard('kurir')->attempt([$loginField => $identity, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended('/kurir/dashboard');
        }

        // Jika semua gagal
        return back()->withErrors([
            'login_identity' => 'Email/Username atau password salah!',
        ])->onlyInput('login_identity');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin sedang aktif
        Auth::guard('admin')->logout();
        Auth::guard('pelanggan')->logout();
        Auth::guard('kurir')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}