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

        Pelanggan::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

        public function login(Request $request)
        {
            $identity = $request->input('email');
            $password = $request->input('password');
            $isEmail = filter_var($identity, FILTER_VALIDATE_EMAIL);

            // 1. Coba login sebagai Admin (DIPAKSA langsung ke URL dashboard)
            if (Auth::guard('admin')->attempt([($isEmail ? 'email' : 'username') => $identity, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect('/dashboard/admin'); // Menggunakan redirect() biasa biar gak loop
            }

            // 2. Coba login sebagai Kurir (HANYA BISA PAKAI USERNAME)
            if (Auth::guard('kurir')->attempt(['username' => $identity, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect('/dashboard/kurir'); // Menggunakan redirect() biasa
            }

            // 3. Coba login sebagai Pelanggan (DIPAKSA langsung ke URL dashboard)
            if (Auth::guard('pelanggan')->attempt([($isEmail ? 'email' : 'username') => $identity, 'password' => $password])) {
                $request->session()->regenerate();
                return redirect('/dashboard/pelanggan'); // Menggunakan redirect() biasa
            }

            return back()->withErrors([
                'email' => 'Login gagal! Pastikan username/email dan password benar.',
            ])->withInput($request->only('email'));
        }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('pelanggan')->logout();
        Auth::guard('kurir')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}