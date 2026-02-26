<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
     * Form edit user (ganti role & status)
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user role & status
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role' => ['required', 'string', 'in:user,petugas,admin'],
            'is_active' => ['required', 'boolean'],
        ]);

        $user->update([
            'role' => $validated['role'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Role {$user->name} berhasil diubah menjadi {$validated['role']}.");
    }
}
