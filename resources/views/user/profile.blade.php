{{-- Profil Saya --}}
@extends('layouts.app')
@section('title', 'Profil Saya - PerpusKu')

@section('content')
    <section class="bg-gradient-to-br from-primary-600 to-primary-700 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-white mb-2">Profil Saya</h1>
            <p class="text-primary-100">Kelola informasi akun Anda</p>
        </div>
    </section>

    <section class="py-8 bg-secondary-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Profile Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden mb-6">
                <div class="p-6 flex flex-col sm:flex-row items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-3xl font-bold flex-shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="text-center sm:text-left">
                        <h2 class="text-xl font-bold text-secondary-900">{{ $user->name }}</h2>
                        <p class="text-secondary-500">{{ $user->email }}</p>
                        <div class="flex flex-wrap justify-center sm:justify-start gap-2 mt-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'petugas' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-secondary-100 text-secondary-600">
                                Bergabung {{ $user->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            @if($user->role === 'user')
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-secondary-200">
                    <p class="text-2xl font-bold text-primary-600">{{ $stats['total_loans'] }}</p>
                    <p class="text-xs text-secondary-500 mt-1">Total Pinjaman</p>
                </div>
                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-secondary-200">
                    <p class="text-2xl font-bold text-blue-600">{{ $stats['active_loans'] }}</p>
                    <p class="text-xs text-secondary-500 mt-1">Aktif</p>
                </div>
                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-secondary-200">
                    <p class="text-2xl font-bold text-green-600">{{ $stats['returned'] }}</p>
                    <p class="text-xs text-secondary-500 mt-1">Dikembalikan</p>
                </div>
                <div class="bg-white rounded-xl p-4 text-center shadow-sm border border-secondary-200">
                    <p class="text-2xl font-bold {{ $stats['unpaid_fines'] > 0 ? 'text-red-600' : 'text-green-600' }}">
                        Rp {{ number_format($stats['unpaid_fines'], 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-secondary-500 mt-1">Denda Belum Bayar</p>
                </div>
            </div>
            @endif

            {{-- Edit Profile --}}
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-secondary-200">
                    <h3 class="font-semibold text-secondary-900">Edit Profil</h3>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                        @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-secondary-200">
                    <h3 class="font-semibold text-secondary-900">Ubah Password</h3>
                </div>
                <form action="{{ route('profile.password') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-1">Password Saat Ini</label>
                        <input type="password" name="current_password" 
                               class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                        @error('current_password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-1">Password Baru</label>
                        <input type="password" name="password" 
                               class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                        @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-secondary-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-secondary-800 text-white font-semibold rounded-xl hover:bg-secondary-900 transition">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
