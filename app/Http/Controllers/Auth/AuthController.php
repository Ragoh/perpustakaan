<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register user baru
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'is_active' => true,
        ]);

        // Untuk API request, return token
        if ($request->expectsJson()) {
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'message' => 'Registrasi berhasil',
                'user' => $user,
                'token' => $token,
            ], 201);
        }

        // Untuk web request, login dan redirect
        Auth::login($user);
        return redirect()->intended('/');
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah user ada dan password benar
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password tidak valid.'],
            ]);
        }

        // Cek apakah user aktif
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Akun Anda telah dinonaktifkan. Hubungi admin.'],
            ]);
        }

        // Untuk API request, return token
        if ($request->expectsJson()) {
            $token = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token,
            ]);
        }

        // Untuk web request
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Redirect berdasarkan role
        return redirect()->intended($this->getRedirectPath($user));
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        // Untuk API request, revoke token
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout berhasil']);
        }

        // Untuk web request
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Get user info (untuk API)
     */
    public function user(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }

    /**
     * Tentukan redirect path berdasarkan role
     */
    protected function getRedirectPath(User $user): string
    {
        if ($user->role === 'admin') {
            return '/admin';
        }

        if ($user->role === 'petugas') {
            return '/petugas';
        }

        return '/';
    }
}
