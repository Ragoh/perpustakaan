{{-- 
    Daftar Buku (CRUD - Index)
    Tabel daftar buku dengan pagination dan aksi
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
    
    $books = [
        ['id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'category' => 'Fiksi', 'stock' => 5, 'status' => 'active'],
        ['id' => 2, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'category' => 'Sejarah', 'stock' => 3, 'status' => 'active'],
        ['id' => 3, 'title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'category' => 'Self-Help', 'stock' => 0, 'status' => 'inactive'],
        ['id' => 4, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Pengembangan Diri', 'stock' => 2, 'status' => 'active'],
        ['id' => 5, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'category' => 'Sains', 'stock' => 4, 'status' => 'active'],
    ];
@endphp

@section('page-title', 'Manajemen Buku')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Manajemen Buku</span>
    </div>
@endsection

@section('content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Daftar Buku</h2>
            <p class="text-secondary-600">Kelola koleksi buku perpustakaan</p>
        </div>
        <a href="/petugas/books/create" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/30">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Buku
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Cari judul, penulis, atau ISBN..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <select class="px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                <option>Semua Kategori</option>
                <option>Fiksi</option>
                <option>Non-Fiksi</option>
                <option>Sains</option>
                <option>Sejarah</option>
            </select>
            <select class="px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                <option>Semua Status</option>
                <option>Tersedia</option>
                <option>Habis</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <x-data-table :headers="['Buku', 'Kategori', 'Stok', 'Status', 'Aksi']">
        @foreach($books as $book)
            <tr class="hover:bg-secondary-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-16 rounded-lg bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center flex-shrink-0">
                            <span class="text-xl">📚</span>
                        </div>
                        <div>
                            <p class="font-semibold text-secondary-900">{{ $book['title'] }}</p>
                            <p class="text-sm text-secondary-500">{{ $book['author'] }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <x-badge type="primary" size="sm">{{ $book['category'] }}</x-badge>
                </td>
                <td class="px-6 py-4">
                    <span class="font-semibold {{ $book['stock'] > 0 ? 'text-secondary-900' : 'text-error' }}">
                        {{ $book['stock'] }}
                    </span>
                    <span class="text-secondary-500 text-sm">eksemplar</span>
                </td>
                <td class="px-6 py-4">
                    @if($book['status'] === 'active')
                        <x-badge type="success" size="sm">Aktif</x-badge>
                    @else
                        <x-badge type="error" size="sm">Nonaktif</x-badge>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="/petugas/books/{{ $book['id'] }}/edit" class="p-2 text-secondary-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <button class="p-2 text-secondary-400 hover:text-error hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

        <x-slot name="pagination">
            <div class="flex items-center justify-between">
                <p class="text-sm text-secondary-600">
                    Menampilkan <span class="font-semibold">1-5</span> dari <span class="font-semibold">234</span> buku
                </p>
                <nav class="flex items-center gap-1">
                    <button class="px-3 py-1.5 rounded-lg text-secondary-500 hover:bg-secondary-100 transition disabled:opacity-50" disabled>
                        Sebelumnya
                    </button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary-600 text-white font-medium">1</button>
                    <button class="px-3 py-1.5 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">2</button>
                    <button class="px-3 py-1.5 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">3</button>
                    <button class="px-3 py-1.5 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">
                        Selanjutnya
                    </button>
                </nav>
            </div>
        </x-slot>
    </x-data-table>
@endsection
