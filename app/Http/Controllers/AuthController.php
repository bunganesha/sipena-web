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
                'user_id'  => Auth::id(),
                'username' => Auth::user()->username,
                'role'     => Auth::user()->role,
            ]);

            $user = Auth::user();

            switch ($user->role) {

                case 'hrd':
                    return redirect('/dashboard')
                        ->with('success', 'Login HRD berhasil');

                case 'manager':
                    return redirect('/dashboard')
                        ->with('success', 'Login Manager berhasil');

                case 'spv':
                    return redirect('/dashboard')
                        ->with('success', 'Login SPV berhasil');

                case 'pegawai':
                    return redirect('/dashboard')
                        ->with('success', 'Login Pegawai berhasil');

                default:
                    Auth::logout();

                    return back()->with(
                        'error',
                        'Role tidak dikenali.'
                    );
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
