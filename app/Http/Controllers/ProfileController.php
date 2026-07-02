<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // ============================
    // HALAMAN PROFILE
    // ============================

    public function index()
    {
        $user = User::with('pegawai')
            ->findOrFail(Auth::id());

        return view('profile.index', compact('user'));
    }

    // ============================
    // UPDATE PASSWORD
    // ============================

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with(
                'error',
                'Password lama tidak sesuai.'
            );
        }

        $user->password = Hash::make($request->password_baru);

        $user->save();

        return back()->with(
            'success',
            'Password berhasil diperbarui.'
        );
    }
}
