{{-- Manajemen Buku --}}
@extends('layouts.admin')
@php $role = 'petugas'; @endphp

@section('page-title', 'Manajemen Buku')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-secondary-900 font-medium">Manajemen Buku</span>
    </div>
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Daftar Buku</h2>
            <p class="text-secondary-600">Kelola koleksi buku perpustakaan</p>
        </div>
        <a href="{{ route('petugas.books.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                    @forelse($books as $book)
                        <tr class="hover:bg-secondary-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                        @if($book->cover)
                                            <img src="{{ Storage::url($book->cover) }}" class="w-full h-full object-cover rounded-lg" alt="">
                                        @else
                                            <span class="text-xl">📚</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-secondary-900">{{ $book->title }}</p>
                                        <p class="text-sm text-secondary-500">{{ $book->author }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <x-badge type="primary" size="sm">{{ $book->category->name }}</x-badge>
                            </td>
                            <td class="px-6 py-4 font-medium text-secondary-900">{{ $book->stock }}</td>
                            <td class="px-6 py-4">
                                @if($book->is_active)
                                    <x-badge type="success" size="sm">Aktif</x-badge>
                                @else
                                    <x-badge type="warning" size="sm">Nonaktif</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-1">
                                    <a href="{{ route('petugas.books.edit', $book->id) }}" class="p-2 text-secondary-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('petugas.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-secondary-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-12 text-center text-secondary-500">Belum ada buku. <a href="{{ route('petugas.books.create') }}" class="text-primary-600 hover:underline">Tambah buku pertama</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($books->hasPages())
            <div class="px-6 py-4 border-t border-secondary-200">{{ $books->links() }}</div>
        @endif
    </div>
@endsection
