<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email'], // Tambahkan validation rule 'unique'
            'password' => ['required', 'min:7', 'confirmed']
        ]);

        try {
            // Buat user baru
            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
            ]);

            // Login otomatis setelah registrasi
            Auth::login($user);

            return redirect()->route('news.index')->with('success', 'Registration successful!');
        } catch (QueryException $e) {
            // Tangani duplikasi email
            if ($e->getCode() === '23000') { // Code untuk Integrity constraint violation
                return back()->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
            }

            // Tangani error lainnya
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek kredensial login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}