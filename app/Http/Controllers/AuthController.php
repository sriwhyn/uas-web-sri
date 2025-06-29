<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;                         // ➜ Tambahkan agar IDE kenal kelas User

class AuthController extends Controller
{
    /**
     * Form login.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login manual.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var User|null $loggedUser */
            $loggedUser = Auth::user();      // IDE tahu $loggedUser bertipe User|null

            // Redirect berdasarkan role
            if ($loggedUser?->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
