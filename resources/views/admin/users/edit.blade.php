{{-- 
    Form Edit User
    Form untuk mengubah role user
--}}
@extends('layouts.admin')

@php
    $role = 'admin';
    $userName = 'Admin Demo';
    
    $user = [
        'id' => 1,
        'name' => 'Ahmad Rizal',
        'email' => 'ahmad@email.com',
        'role' => 'user',
        'status' => 'active',
        'registered' => '20 Jan 2024',
        'last_login' => '25 Jan 2024 14:30',
        'total_loans' => 15,
    ];
@endphp

@section('page-title', 'Edit User')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/admin" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="/admin/users" class="text-secondary-500 hover:text-primary-600">Manajemen User</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Edit User</span>
    </div>
@endsection

@section('content')
    <div class="max-w-3xl">
        {{-- User Info Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-secondary-200 bg-secondary-50">
                <h3 class="font-semibold text-secondary-900">Informasi User</h3>
            </div>
            <div class="p-6">
                <div class="flex items-start gap-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr($user['name'], 0, 1)) }}
                    </div>
                    <div class="flex-1 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-secondary-500">Nama</p>
                            <p class="font-medium text-secondary-900">{{ $user['name'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500">Email</p>
                            <p class="font-medium text-secondary-900">{{ $user['email'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500">Terdaftar</p>
                            <p class="font-medium text-secondary-900">{{ $user['registered'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500">Login Terakhir</p>
                            <p class="font-medium text-secondary-900">{{ $user['last_login'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-secondary-500">Total Peminjaman</p>
                            <p class="font-medium text-secondary-900">{{ $user['total_loans'] }} buku</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200">
                <h3 class="font-semibold text-secondary-900">Pengaturan Akun</h3>
            </div>
            <form action="#" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Role --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-secondary-700">Role</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="user" {{ $user['role'] === 'user' ? 'checked' : '' }} class="peer sr-only">
                            <div class="px-4 py-4 rounded-xl border-2 border-secondary-200 text-center peer-checked:border-primary-600 peer-checked:bg-primary-50 transition">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-secondary-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-secondary-900">User</p>
                                <p class="text-xs text-secondary-500">Dapat meminjam buku</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="petugas" {{ $user['role'] === 'petugas' ? 'checked' : '' }} class="peer sr-only">
                            <div class="px-4 py-4 rounded-xl border-2 border-secondary-200 text-center peer-checked:border-primary-600 peer-checked:bg-primary-50 transition">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-secondary-900">Petugas</p>
                                <p class="text-xs text-secondary-500">Dapat mengelola buku</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="admin" {{ $user['role'] === 'admin' ? 'checked' : '' }} class="peer sr-only">
                            <div class="px-4 py-4 rounded-xl border-2 border-secondary-200 text-center peer-checked:border-primary-600 peer-checked:bg-primary-50 transition">
                                <div class="w-12 h-12 mx-auto mb-2 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-secondary-900">Admin</p>
                                <p class="text-xs text-secondary-500">Akses penuh sistem</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Status --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-secondary-700">Status Akun</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="active" {{ $user['status'] === 'active' ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-secondary-300 focus:ring-primary-500">
                            <span class="text-secondary-700">Aktif</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="inactive" {{ $user['status'] === 'inactive' ? 'checked' : '' }}
                                   class="w-4 h-4 text-primary-600 border-secondary-300 focus:ring-primary-500">
                            <span class="text-secondary-700">Nonaktif</span>
                        </label>
                    </div>
                </div>

                {{-- Warning --}}
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <h4 class="font-medium text-amber-800">Perhatian</h4>
                            <p class="text-sm text-amber-700 mt-1">Mengubah role user akan mempengaruhi akses mereka ke sistem. Pastikan perubahan ini sesuai dengan kebutuhan.</p>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-secondary-200">
                    <x-button type="submit" variant="primary" size="lg">
                        Simpan Perubahan
                    </x-button>
                    <a href="/admin/users" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
