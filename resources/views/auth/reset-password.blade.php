@extends('layouts.auth')

@section('title', 'Reset Password - PerpusKu')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-secondary-200">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-secondary-900">Reset Password</h2>
            <p class="text-secondary-600 mt-1">Masukkan password baru Anda</p>
        </div>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div>
                <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', request()->email) }}" required
                       class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition"
                       placeholder="nama@email.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-secondary-700 mb-1">Password Baru</label>
                <div class="relative" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'" name="password" id="password" required
                           class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition pr-12"
                           placeholder="Minimal 8 karakter">
                    <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary-400 hover:text-secondary-600">
                        <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-secondary-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition"
                       placeholder="Ulangi password baru">
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg shadow-primary-600/30">
                Reset Password
            </button>
        </form>
    </div>
@endsection
