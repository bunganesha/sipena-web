<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =========================
    // TAMPIL DATA USER
    // =========================
    public function index(Request $request)
    {
        // ROLE PERMISSION
        if (session('role') != 'hrd') {
            abort(403);
        }

        // SEARCH
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {

            $query->where('username', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");

        })->latest()->get();

        return view('user.index', compact('users'));
    }


    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        return view('user.create');
    }


    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'password' => $request->password,
            'role' => strtolower($request->role),
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'Data user berhasil ditambahkan');
    }


    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }


    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        $user = User::findOrFail($id);

        $user->update([
            'username' => $request->username,
            'role' => strtolower($request->role),
        ]);

        if ($request->password) {

            $user->password = Hash::make($request->password);

            $user->save();
        }

        return redirect()
            ->route('user.index')
            ->with('success', 'Data user berhasil diupdate');
    }


    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        if (session('role') != 'hrd') {
            abort(403);
        }

        User::destroy($id);

        return redirect()
            ->route('user.index')
            ->with('success', 'Data user berhasil dihapus');
    }
}