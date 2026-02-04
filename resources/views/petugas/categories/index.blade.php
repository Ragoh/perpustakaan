{{-- 
    Daftar Kategori (CRUD - Index)
    Tabel daftar kategori dengan aksi
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
    
    $categories = [
        ['id' => 1, 'name' => 'Fiksi', 'description' => 'Novel, cerpen, dan karya fiksi lainnya', 'book_count' => 1250],
        ['id' => 2, 'name' => 'Non-Fiksi', 'description' => 'Buku berbasis fakta dan pengetahuan', 'book_count' => 890],
        ['id' => 3, 'name' => 'Sains', 'description' => 'Buku tentang ilmu pengetahuan alam', 'book_count' => 456],
        ['id' => 4, 'name' => 'Sejarah', 'description' => 'Buku tentang sejarah dan peradaban', 'book_count' => 324],
        ['id' => 5, 'name' => 'Bisnis', 'description' => 'Buku tentang bisnis dan ekonomi', 'book_count' => 567],
        ['id' => 6, 'name' => 'Self-Help', 'description' => 'Buku pengembangan diri', 'book_count' => 432],
    ];
@endphp

@section('page-title', 'Manajemen Kategori')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Manajemen Kategori</span>
    </div>
@endsection

@section('content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Daftar Kategori</h2>
            <p class="text-secondary-600">Kelola kategori buku perpustakaan</p>
        </div>
        <a href="/petugas/categories/create" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Kategori
        </a>
    </div>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="/petugas/categories/{{ $category['id'] }}/edit" class="p-2 text-secondary-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <button class="p-2 text-secondary-400 hover:text-error hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-secondary-900 mb-1">{{ $category['name'] }}</h3>
                <p class="text-secondary-600 text-sm mb-4 line-clamp-2">{{ $category['description'] }}</p>
                <div class="flex items-center text-sm text-secondary-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    {{ number_format($category['book_count']) }} buku
                </div>
            </div>
        @endforeach
    </div>
@endsection
