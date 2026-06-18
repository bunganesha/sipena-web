<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            session([
                'username' => Auth::user()->username,
                'role' => Auth::user()->role,
            ]);

            $user = Auth::user();

            if ($user->role == 'hrd') {
                return redirect('/dashboard')->with('success', 'Login HRD berhasil');
            }

            if ($user->role == 'manager') {
                return redirect('/dashboard')->with('success', 'Login Manager berhasil');
            }

            if ($user->role == 'spv') {
                return redirect('/dashboard')->with('success', 'Login SPV berhasil');
            }

            if ($user->role == 'pegawai') {
                return redirect('/dashboard')->with('success', 'Login Pegawai berhasil');
            }
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
