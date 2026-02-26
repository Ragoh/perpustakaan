@extends('layouts.auth')

@section('title', 'Daftar - PerpusKu')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-secondary-200">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-secondary-900">Buat Akun Baru</h2>
            <p class="text-secondary-600 mt-1">Daftar untuk mulai meminjam buku</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-secondary-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                       class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition"
                       placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition"
                       placeholder="nama@email.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-secondary-700 mb-1">Password</label>
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
                       placeholder="Ulangi password">
            </div>

            <div class="flex items-start">
                <input type="checkbox" name="terms" id="terms" required
                       class="w-4 h-4 text-primary-600 border-secondary-300 rounded focus:ring-primary-500 mt-0.5">
                <label for="terms" class="ml-2 text-sm text-secondary-600">
                    Saya menyetujui <a href="#" class="text-primary-600 hover:underline">Syarat & Ketentuan</a> serta 
                    <a href="#" class="text-primary-600 hover:underline">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit"
                    class="w-full py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg shadow-primary-600/30">
                Daftar
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-secondary-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('home') }}" class="text-secondary-500 hover:text-secondary-700 text-sm">
            ← Kembali ke Beranda
        </a>
    </div>
@endsection
