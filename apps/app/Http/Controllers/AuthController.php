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
            'username' => 'required|string|max:255|unique:pelanggans',
            'email' => 'required|string|email|max:255|unique:pelanggans',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Simpan ke tabel pelanggans
        Pelanggan::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // Auto-login DIMATIKAN. User akan dilempar ke halaman login.
        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login untuk memesan laundry.');
    }

    public function login(Request $request)
    {
        // Karena di form login kamu atribut namenya masih 'email', kita tangkap pakai 'email'
        // Tapi kita tetep fleksibel ngecek ini email atau username
        $identity = $request->input('email') ?? $request->input('login_identity'); 
        $password = $request->input('password');

        $loginField = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 1. Coba login sebagai Admin
        if (Auth::guard('admin')->attempt([$loginField => $identity, 'password' => $password])) {
            $request->session()->regenerate();
            // Redirect disesuaikan dengan rute FE yang baru
            return redirect()->intended('/dashboard/admin');
        }

        // 2. Coba login sebagai Pelanggan
        if (Auth::guard('pelanggan')->attempt([$loginField => $identity, 'password' => $password])) {
            $request->session()->regenerate();
            // Redirect disesuaikan dengan rute FE yang baru
            return redirect()->intended('/dashboard/pelanggan');
        }

        // 3. Coba login sebagai Kurir
        if (Auth::guard('kurir')->attempt([$loginField => $identity, 'password' => $password])) {
            $request->session()->regenerate();
            // Redirect disesuaikan dengan rute FE yang baru
            return redirect()->intended('/dashboard/kurir');
        }

        // Jika semua gagal (Password / Email salah)
        return back()->withErrors([
            'email' => 'Email/Username atau password salah!',
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