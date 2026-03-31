{{-- Form Tambah Petugas --}}
@extends('layouts.admin')
@php $role = 'admin'; @endphp

@section('page-title', 'Tambah Petugas')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/admin" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-secondary-900 font-medium">Tambah Petugas</span>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-secondary-900">Tambah Akun Petugas</h2>
            <p class="text-secondary-600">Buat akun baru untuk petugas perpustakaan</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200 bg-blue-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-blue-900">Akun Petugas</h3>
                        <p class="text-sm text-blue-700">Petugas dapat mengelola buku, kategori, dan peminjaman</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.petugas.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <x-form-input name="name" label="Nama Lengkap" placeholder="Masukkan nama lengkap petugas" :value="old('name')" :required="true" />
                <x-form-input type="email" name="email" label="Email" placeholder="petugas@perpusku.com" :value="old('email')" :required="true" />
                <x-form-input type="password" name="password" label="Password" placeholder="Minimal 8 karakter" :required="true" />
                <x-form-input type="password" name="password_confirmation" label="Konfirmasi Password" placeholder="Ulangi password" :required="true" />

                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-secondary-200">
                    <x-button type="submit" variant="primary" size="lg">Buat Akun Petugas</x-button>
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
