{{-- 
    Form Tambah Buku
    Form untuk menambah buku baru
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
@endphp

@section('page-title', 'Tambah Buku')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="/petugas/books" class="text-secondary-500 hover:text-primary-600">Manajemen Buku</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Tambah Buku</span>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-secondary-200">
                <h2 class="text-xl font-semibold text-secondary-900">Tambah Buku Baru</h2>
                <p class="text-secondary-600 text-sm">Isi informasi buku yang akan ditambahkan ke perpustakaan</p>
            </div>

            {{-- Form --}}
            <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Cover Upload --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Cover Buku</label>
                        <div class="flex items-start gap-6">
                            <div class="w-32 h-44 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center border-2 border-dashed border-primary-300">
                                <span class="text-4xl">📚</span>
                            </div>
                            <div class="flex-1">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-secondary-300 rounded-xl cursor-pointer hover:bg-secondary-50 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 text-secondary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="text-sm text-secondary-500">Klik untuk upload atau drag and drop</p>
                                        <p class="text-xs text-secondary-400">PNG, JPG (Maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="cover" class="hidden" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Title --}}
                    <x-form-input 
                        name="title" 
                        label="Judul Buku"
                        placeholder="Masukkan judul buku"
                        :required="true"
                    />

                    {{-- Author --}}
                    <x-form-input 
                        name="author" 
                        label="Penulis"
                        placeholder="Masukkan nama penulis"
                        :required="true"
                    />

                    {{-- ISBN --}}
                    <x-form-input 
                        name="isbn" 
                        label="ISBN"
                        placeholder="978-xxx-xxx-xxx-x"
                    />

                    {{-- Publisher --}}
                    <x-form-input 
                        name="publisher" 
                        label="Penerbit"
                        placeholder="Masukkan nama penerbit"
                    />

                    {{-- Category --}}
                    <div class="space-y-1">
                        <label for="category_id" class="block text-sm font-medium text-secondary-700">
                            Kategori <span class="text-error">*</span>
                        </label>
                        <select name="category_id" id="category_id" required
                                class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                            <option value="">Pilih Kategori</option>
                            <option value="1">Fiksi</option>
                            <option value="2">Non-Fiksi</option>
                            <option value="3">Sains</option>
                            <option value="4">Sejarah</option>
                            <option value="5">Bisnis</option>
                            <option value="6">Self-Help</option>
                        </select>
                    </div>

                    {{-- Year --}}
                    <x-form-input 
                        type="number" 
                        name="year" 
                        label="Tahun Terbit"
                        placeholder="2024"
                    />

                    {{-- Pages --}}
                    <x-form-input 
                        type="number" 
                        name="pages" 
                        label="Jumlah Halaman"
                        placeholder="0"
                    />

                    {{-- Stock --}}
                    <x-form-input 
                        type="number" 
                        name="stock" 
                        label="Jumlah Stok"
                        placeholder="0"
                        :required="true"
                    />

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <x-form-input 
                            type="textarea" 
                            name="description" 
                            label="Sinopsis / Deskripsi"
                            placeholder="Tuliskan sinopsis atau deskripsi buku..."
                        />
                    </div>

                    {{-- Status --}}
                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked
                                   class="w-5 h-5 text-primary-600 border-secondary-300 rounded focus:ring-primary-500">
                            <div>
                                <span class="font-medium text-secondary-900">Aktifkan Buku</span>
                                <p class="text-sm text-secondary-500">Buku akan ditampilkan di katalog dan dapat dipinjam</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-secondary-200">
                    <x-button type="submit" variant="primary" size="lg">
                        Simpan Buku
                    </x-button>
                    <a href="/petugas/books" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
