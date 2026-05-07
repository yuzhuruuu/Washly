<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required|string|email|max:255|unique:pelanggans',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Simpan ke tabel pelanggans
        $pelanggan = Pelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Langsung login-kan setelah daftar
        Auth::guard('pelanggan')->login($pelanggan);

        return redirect('/dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang di Washly.');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Coba login sebagai Admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        // 2. Coba login sebagai Pelanggan
        if (Auth::guard('pelanggan')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // 3. Coba login sebagai Kurir
        if (Auth::guard('kurir')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/kurir/dashboard');
        }

        // Jika semua gagal
        return back()->withErrors([
            'email' => 'Email atau password salah, ege!',
        ])->onlyInput('email');
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