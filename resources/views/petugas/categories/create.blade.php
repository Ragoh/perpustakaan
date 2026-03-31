{{-- Form Tambah/Edit Kategori --}}
@extends('layouts.admin')
@php $role = 'petugas'; @endphp

@section('page-title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('petugas.categories.index') }}" class="text-secondary-500 hover:text-primary-600">Manajemen Kategori</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-secondary-900 font-medium">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori' }}</span>
    </div>
@endsection

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200">
                <h2 class="text-xl font-semibold text-secondary-900">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h2>
                <p class="text-secondary-600 text-sm">{{ isset($category) ? 'Perbarui informasi kategori' : 'Buat kategori baru untuk pengelompokan buku' }}</p>
            </div>

            <form action="{{ isset($category) ? route('petugas.categories.update', $category->id) : route('petugas.categories.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                @if(isset($category)) @method('PUT') @endif

                <x-form-input 
                    name="name" 
                    label="Nama Kategori"
                    placeholder="Contoh: Fiksi, Sains, Sejarah"
                    :value="old('name', $category->name ?? '')"
                    :required="true"
                />

                <x-form-input 
                    type="textarea" 
                    name="description" 
                    label="Deskripsi"
                    placeholder="Deskripsi singkat tentang kategori ini..."
                    :value="old('description', $category->description ?? '')"
                />

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-secondary-700">Ikon (Opsional)</label>
                    <div class="grid grid-cols-6 gap-3">
                        @foreach(['📚', '📖', '🔬', '🏛️', '💼', '💡', '🎨', '🌍', '💻', '🎭', '🎵', '⚽'] as $icon)
                            <label class="cursor-pointer">
                                <input type="radio" name="icon" value="{{ $icon }}" class="sr-only peer"
                                    {{ old('icon', $category->icon ?? '') === $icon ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border-2 border-secondary-200 text-center text-2xl peer-checked:border-primary-600 peer-checked:bg-primary-50 hover:bg-secondary-50 transition">
                                    {{ $icon }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-secondary-200">
                    <x-button type="submit" variant="primary" size="lg">
                        {{ isset($category) ? 'Simpan Perubahan' : 'Simpan Kategori' }}
                    </x-button>
                    <a href="{{ route('petugas.categories.index') }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
