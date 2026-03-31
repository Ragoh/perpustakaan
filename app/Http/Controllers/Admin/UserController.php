<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Daftar semua user
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Form edit user (status saja)
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update status user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        $user->update([
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Status {$user->name} berhasil diperbarui.");
    }

    /**
     * Form tambah petugas
     */
    public function createPetugas()
    {
        return view('admin.petugas.create');
    }

    /**
     * Simpan akun petugas baru
     */
    public function storePetugas(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petugas',
            'is_active' => true,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun petugas {$validated['name']} berhasil dibuat.");
    }
}
