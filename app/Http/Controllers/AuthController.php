<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =========================
    // HALAMAN LOGIN
    // =========================
    public function login()
    {
        return view('auth.login');
    }


    // =========================
    // PROSES LOGIN
    // =========================
    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        // LOGIN BERHASIL
        if ($user && $request->password == $user->password) {

            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => strtolower($user->role)
            ]);

            return redirect('/dashboard');
        }

        // LOGIN GAGAL
        return back()->with(
            'error',
            'Username atau password salah'
        );
    }


    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();

        return redirect('/');
    }
}