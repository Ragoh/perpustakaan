{{-- 
    Dashboard Admin
    Halaman utama panel admin
--}}
@extends('layouts.admin')

@php $role = 'admin'; @endphp

@section('page-title', 'Dashboard')

@section('content')
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-secondary-800 to-secondary-900 rounded-2xl p-6 mb-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">Panel Administrator 🔐</h2>
                <p class="text-secondary-300 mt-1">Kelola user dan lihat laporan sistem.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white text-secondary-800 font-semibold rounded-xl hover:bg-secondary-100 transition shadow">
                    Kelola User
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Access Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4 group-hover:bg-primary-200 transition">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Manajemen User</h3>
            <p class="text-sm text-secondary-500 mt-1">Kelola akun pengguna</p>
        </a>

        <a href="{{ route('admin.petugas.create') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-4 group-hover:bg-blue-200 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Tambah Petugas</h3>
            <p class="text-sm text-secondary-500 mt-1">Buat akun petugas baru</p>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4 group-hover:bg-green-200 transition">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Laporan</h3>
            <p class="text-sm text-secondary-500 mt-1">Lihat data laporan global</p>
        </a>

        <a href="/petugas" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mb-4 group-hover:bg-amber-200 transition">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Panel Petugas</h3>
            <p class="text-sm text-secondary-500 mt-1">Buka dashboard petugas</p>
        </a>
    </div>
@endsection
