{{-- Manajemen Kategori --}}
@extends('layouts.admin')
@php $role = 'petugas'; @endphp

@section('page-title', 'Manajemen Kategori')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-secondary-900 font-medium">Manajemen Kategori</span>
    </div>
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Daftar Kategori</h2>
            <p class="text-secondary-600">Kelola kategori buku perpustakaan</p>
        </div>
        <a href="{{ route('petugas.categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($categories as $category)
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">{{ $category->icon ?? '📁' }}</span>
                        <div>
                            <h3 class="font-semibold text-secondary-900">{{ $category->name }}</h3>
                            <p class="text-sm text-secondary-500">{{ $category->books_count }} buku</p>
                        </div>
                    </div>
                    <div class="flex gap-1">
                        <a href="{{ route('petugas.categories.edit', $category->id) }}" class="p-2 text-secondary-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('petugas.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 text-secondary-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @if($category->description)
                    <p class="text-sm text-secondary-600 line-clamp-2">{{ $category->description }}</p>
                @endif
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl shadow-sm border border-secondary-200 p-12 text-center">
                <span class="text-5xl mb-4 block">📁</span>
                <h3 class="text-lg font-semibold text-secondary-900 mb-2">Belum ada kategori</h3>
                <p class="text-secondary-600 mb-4">Tambahkan kategori pertama untuk mulai mengorganisir buku</p>
                <a href="{{ route('petugas.categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">Tambah Kategori</a>
            </div>
        @endforelse
    </div>
@endsection
