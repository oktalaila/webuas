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
     * PROSES LOGIN (Lampu Lalu Lintas)
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 2. Coba cocokkan dengan database
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password'], 'is_active' => true])) {
            
            $request->session()->regenerate();
            $role = Auth::user()->role;

            // 3. LAMPU LALU LINTAS: Pisahkan rute berdasarkan jabatan
            if ($role === 'admin' || $role === 'pegawai') {
                return redirect()->intended('/dashboard');
            }

            // Jika pembeli, kembalikan ke Katalog Depan
            return redirect()->intended('/');
        }

        // Jika salah password / username
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * PROSES REGISTER (Pendaftaran Pembeli Baru)
     */
    public function register(Request $request)
    {
        // 1. Validasi input pendaftaran
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // 2. Ciptakan akun baru (otomatis diberi kasta 'pembeli')
        $user = User::create([
            'nama' => $validated['nama'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'pembeli',
            'is_active' => true,
        ]);

        // 3. Langsung loginkan pembeli tersebut dan lempar ke Katalog
        Auth::login($user);
        return redirect('/');
    }

    /**
     * PROSES LOGOUT (Cabut Kunci Akses)
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah keluar, kembalikan menjadi tamu di halaman depan
        return redirect('/');
    }
}