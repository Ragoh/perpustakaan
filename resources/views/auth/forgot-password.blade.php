@extends('layouts.auth')

@section('title', 'Lupa Password - PerpusKu')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-secondary-200">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-secondary-900">Lupa Password?</h2>
            <p class="text-secondary-600 mt-1">Masukkan email Anda untuk reset password</p>
        </div>

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition"
                       placeholder="nama@email.com">
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg shadow-primary-600/30">
                Kirim Link Reset
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                ← Kembali ke Login
            </a>
        </div>
    </div>
@endsection
