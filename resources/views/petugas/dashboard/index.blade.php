{{-- 
    Dashboard Petugas
    Halaman utama panel petugas
--}}
@extends('layouts.admin')

@php $role = 'petugas'; @endphp

@section('page-title', 'Dashboard')

@section('content')
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-6 mb-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                <p class="text-primary-100 mt-1">Kelola buku, kategori, dan peminjaman perpustakaan.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('petugas.books.create') }}" class="px-4 py-2 bg-white text-primary-600 font-semibold rounded-xl hover:bg-primary-50 transition shadow">
                    + Tambah Buku
                </a>
            </div>
        </div>
    </div>

    {{-- Quick Access Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('petugas.books.index') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4 group-hover:bg-primary-200 transition">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Manajemen Buku</h3>
            <p class="text-sm text-secondary-500 mt-1">Kelola koleksi buku perpustakaan</p>
        </a>

        <a href="{{ route('petugas.categories.index') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mb-4 group-hover:bg-amber-200 transition">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Kategori</h3>
            <p class="text-sm text-secondary-500 mt-1">Kelola kategori buku</p>
        </a>

        <a href="{{ route('petugas.loans.index') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-4 group-hover:bg-blue-200 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Peminjaman</h3>
            <p class="text-sm text-secondary-500 mt-1">Kelola peminjaman & pengembalian</p>
        </a>

        <a href="{{ route('petugas.reports.index') }}" class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-4 group-hover:bg-green-200 transition">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="font-semibold text-secondary-900 group-hover:text-primary-600 transition">Laporan</h3>
            <p class="text-sm text-secondary-500 mt-1">Lihat data laporan perpustakaan</p>
        </a>
    </div>
@endsection
