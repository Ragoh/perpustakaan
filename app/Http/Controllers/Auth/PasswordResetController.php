<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordResetController extends Controller
{
    /**
     * Kirim link reset password ke email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($request->expectsJson()) {
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'message' => 'Link reset password telah dikirim ke email Anda.',
                ]);
            }
            return response()->json([
                'message' => 'Gagal mengirim link reset password.',
                'error' => __($status),
            ], 400);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Reset password dengan token
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($request->expectsJson()) {
            if ($status === Password::PASSWORD_RESET) {
                return response()->json([
                    'message' => 'Password berhasil direset.',
                ]);
            }
            return response()->json([
                'message' => 'Gagal reset password.',
                'error' => __($status),
            ], 400);
        }

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
