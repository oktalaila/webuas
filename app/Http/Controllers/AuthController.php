<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * TAMPILKAN HALAMAN LOGIN
     */
    public function showLogin()
    {
        return Inertia::render('auth/Login');
    }

    /**
     * TAMPILKAN HALAMAN REGISTER
     */
    public function showRegister()
    {
        return Inertia::render('auth/Register');
    }

    /**
     * PROSES LOGIN
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 2. Coba cocokkan dengan database
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
            'is_active' => true,
        ])) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            // 3. Redirect berdasarkan role
            if ($role === 'admin') {
                return redirect('/dashboard');
            }

            if ($role === 'pegawai') {
                return redirect('/dashboard');
            }

            // Pembeli → balik ke halaman yang dituju sebelum login
            return redirect()->intended('/');
        }

        // Jika gagal login
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * PROSES REGISTER
     */
    public function register(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // 2. Buat akun baru, otomatis role pembeli
        $user = User::create([
            'nama'      => $validated['nama'],
            'username'  => $validated['username'],
            'password'  => Hash::make($validated['password']),
            'role'      => 'pembeli',
            'is_active' => true,
        ]);

        // 3. Langsung login dan arahkan ke katalog
        Auth::login($user);
        return redirect('/');
    }

    /**
     * PROSES LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}