<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//panggil model BukuModel
use App\Models\User;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_user' => 'required|string',
            'email_user' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data['password'] = bcrypt($data['password']); // Enkripsi kata sandi

        $user = User::create($data); // Simpan pengguna ke database

        Auth::login($user);

        // Redirect ke halaman setelah pendaftaran
        return redirect('/')->with('success', 'Pendaftaran berhasil.');
    }

    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email_user', 'password');

        if (Auth::attempt($credentials)) {
            // Pengguna berhasil login
            return redirect()->intended('/');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->route('login')->with('error', 'Email atau kata sandi salah.');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        $request->session()->invalidate(); // Invalidasi sesi

        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect ke halaman utama atau halaman login
    }
}
