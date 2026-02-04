{{-- 
    Form Review Buku
    Form untuk memberikan ulasan dan rating buku
--}}
@extends('layouts.app')

@section('title', 'Tulis Ulasan - PerpusKu')

@php
    $book = [
        'id' => 1,
        'title' => 'Laskar Pelangi',
        'author' => 'Andrea Hirata',
        'category' => 'Fiksi',
    ];
@endphp

@section('content')
    {{-- Breadcrumb --}}
    <section class="bg-white border-b border-secondary-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm">
                <a href="/" class="text-secondary-500 hover:text-primary-600 transition">Beranda</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="/books/{{ $book['id'] }}" class="text-secondary-500 hover:text-primary-600 transition">{{ $book['title'] }}</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-secondary-900 font-medium">Tulis Ulasan</span>
            </nav>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-10 bg-secondary-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-secondary-200 overflow-hidden">
                {{-- Header --}}
                <div class="px-8 py-6 border-b border-secondary-200">
                    <h1 class="text-2xl font-bold text-secondary-900">Tulis Ulasan</h1>
                    <p class="text-secondary-600 mt-1">Bagikan pendapat Anda tentang buku ini</p>
                </div>

                {{-- Book Info --}}
                <div class="px-8 py-6 border-b border-secondary-200 bg-secondary-50">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="text-2xl">📚</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-secondary-900">{{ $book['title'] }}</h3>
                            <p class="text-secondary-600 text-sm">{{ $book['author'] }}</p>
                            <x-badge type="primary" size="sm" class="mt-2">{{ $book['category'] }}</x-badge>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="#" method="POST" class="px-8 py-6 space-y-6">
                    @csrf

                    <input type="hidden" name="book_id" value="{{ $book['id'] }}">

                    {{-- Rating --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-secondary-700">
                            Rating Anda <span class="text-error">*</span>
                        </label>
                        <div x-data="{ rating: 0, hoverRating: 0 }" class="flex items-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button"
                                        @click="rating = {{ $i }}"
                                        @mouseenter="hoverRating = {{ $i }}"
                                        @mouseleave="hoverRating = 0"
                                        class="focus:outline-none transition-transform hover:scale-110">
                                    <svg class="w-10 h-10 transition-colors" 
                                         :class="(hoverRating >= {{ $i }} || (!hoverRating && rating >= {{ $i }})) ? 'text-accent-400' : 'text-secondary-300'"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                            <input type="hidden" name="rating" x-model="rating" required>
                            <span class="text-sm text-secondary-500 ml-2" x-show="rating > 0" x-text="rating + ' dari 5 bintang'"></span>
                        </div>
                        <p class="text-sm text-secondary-500">Klik bintang untuk memberikan rating</p>
                    </div>

                    {{-- Review Title --}}
                    <x-form-input 
                        type="text" 
                        name="title" 
                        label="Judul Ulasan"
                        placeholder="Ringkasan pendapat Anda..."
                        :required="true"
                    />

                    {{-- Review Content --}}
                    <x-form-input 
                        type="textarea" 
                        name="content" 
                        label="Ulasan"
                        placeholder="Ceritakan pengalaman Anda membaca buku ini. Apa yang Anda sukai? Apa yang bisa diperbaiki?"
                        :required="true"
                    />

                    {{-- Recommendation --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-secondary-700">
                            Apakah Anda merekomendasikan buku ini?
                        </label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="recommend" value="yes" checked class="w-4 h-4 text-primary-600 border-secondary-300 focus:ring-primary-500">
                                <span class="text-secondary-700">Ya, saya merekomendasikan</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="recommend" value="no" class="w-4 h-4 text-primary-600 border-secondary-300 focus:ring-primary-500">
                                <span class="text-secondary-700">Tidak</span>
                            </label>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <x-button type="submit" variant="primary" size="lg" class="flex-1">
                            Kirim Ulasan
                        </x-button>
                        <a href="/books/{{ $book['id'] }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
