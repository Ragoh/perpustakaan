{{-- 
    Form Edit Kategori
    Form untuk mengedit kategori yang sudah ada
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
    $isEdit = true;
    $category = [
        'id' => 1,
        'name' => 'Fiksi',
        'description' => 'Novel, cerpen, dan karya fiksi lainnya',
        'icon' => '📚',
    ];
@endphp

@section('page-title', 'Edit Kategori')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="/petugas/categories" class="text-secondary-500 hover:text-primary-600">Manajemen Kategori</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Edit Kategori</span>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-secondary-200">
                <h2 class="text-xl font-semibold text-secondary-900">Edit Kategori</h2>
                <p class="text-secondary-600 text-sm">Perbarui informasi kategori "{{ $category['name'] }}"</p>
            </div>

            {{-- Form --}}
            <form action="#" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <x-form-input 
                    name="name" 
                    label="Nama Kategori"
                    :value="$category['name']"
                    :required="true"
                />

                {{-- Description --}}
                <x-form-input 
                    type="textarea" 
                    name="description" 
                    label="Deskripsi"
                    :value="$category['description']"
                />

                {{-- Icon --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-secondary-700">Ikon (Opsional)</label>
                    <div class="grid grid-cols-6 gap-3">
                        @foreach(['📚', '📖', '🔬', '🏛️', '💼', '💡', '🎨', '🌍', '💻', '🎭', '🎵', '⚽'] as $icon)
                            <label class="cursor-pointer">
                                <input type="radio" name="icon" value="{{ $icon }}" {{ ($category['icon'] ?? '') === $icon ? 'checked' : '' }} class="sr-only peer">
                                <div class="p-3 rounded-xl border-2 border-secondary-200 text-center text-2xl peer-checked:border-primary-600 peer-checked:bg-primary-50 hover:bg-secondary-50 transition">
                                    {{ $icon }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-secondary-200">
                    <x-button type="submit" variant="primary" size="lg">
                        Simpan Perubahan
                    </x-button>
                    <a href="/petugas/categories" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">
                        Batal
                    </a>
                    <button type="button" class="px-6 py-3 bg-red-100 text-error font-semibold rounded-xl hover:bg-red-200 transition sm:ml-auto">
                        Hapus Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
