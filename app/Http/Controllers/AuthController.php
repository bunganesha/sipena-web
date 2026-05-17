<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $user = DB::table('users')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($user) {

            return redirect('/dashboard');

        } else {

            return back()->with('error', 'Login Gagal');

        }
    }

    public function logout()
    {
        return redirect('/');
    }
}