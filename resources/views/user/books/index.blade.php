{{-- 
    Daftar Buku
    Menampilkan semua buku dengan filter dan search
--}}
@extends('layouts.app')

@section('title', 'Katalog Buku - PerpusKu')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-primary-600 to-primary-700 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Katalog Buku</h1>
            <p class="text-primary-100">Temukan buku favorit Anda dari ribuan koleksi kami</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-8 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Sidebar Filter --}}
                <aside class="lg:w-64 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 sticky top-4">
                        <h3 class="font-semibold text-secondary-900 mb-4">Filter</h3>

                        {{-- Search --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Cari Buku</label>
                            <div class="relative">
                                <input type="text" placeholder="Judul atau penulis..." 
                                       class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Category Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Kategori</label>
                            <div class="space-y-2">
                                @foreach(['Semua', 'Fiksi', 'Non-Fiksi', 'Sains', 'Sejarah', 'Bisnis', 'Self-Help'] as $cat)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="category" value="{{ $cat }}" {{ $cat === 'Semua' ? 'checked' : '' }}
                                               class="w-4 h-4 text-primary-600 border-secondary-300 focus:ring-primary-500">
                                        <span class="text-secondary-700">{{ $cat }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Availability Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Ketersediaan</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="available" checked
                                           class="w-4 h-4 text-primary-600 border-secondary-300 rounded focus:ring-primary-500">
                                    <span class="text-secondary-700">Tersedia</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="borrowed"
                                           class="w-4 h-4 text-primary-600 border-secondary-300 rounded focus:ring-primary-500">
                                    <span class="text-secondary-700">Sedang Dipinjam</span>
                                </label>
                            </div>
                        </div>

                        {{-- Rating Filter --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-secondary-700 mb-2">Rating Minimum</label>
                            <select class="w-full px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                                <option value="">Semua Rating</option>
                                <option value="4">4+ Bintang</option>
                                <option value="3">3+ Bintang</option>
                                <option value="2">2+ Bintang</option>
                            </select>
                        </div>

                        <button class="w-full py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">
                            Terapkan Filter
                        </button>
                    </div>
                </aside>

                {{-- Books Grid --}}
                <div class="flex-1">
                    {{-- Sort & View Toggle --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <p class="text-secondary-600">
                            Menampilkan <span class="font-semibold text-secondary-900">1-12</span> dari 
                            <span class="font-semibold text-secondary-900">150</span> buku
                        </p>
                        <div class="flex items-center gap-3">
                            <label class="text-sm text-secondary-600">Urutkan:</label>
                            <select class="px-4 py-2 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition text-sm">
                                <option>Terbaru</option>
                                <option>Terpopuler</option>
                                <option>Rating Tertinggi</option>
                                <option>A-Z</option>
                            </select>
                        </div>
                    </div>

                    {{-- Books --}}
                    @php
                        $books = [
                            ['id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'category' => 'Fiksi', 'rating' => 4.8, 'available' => true],
                            ['id' => 2, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'category' => 'Sejarah', 'rating' => 4.9, 'available' => true],
                            ['id' => 3, 'title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'category' => 'Self-Help', 'rating' => 4.7, 'available' => false],
                            ['id' => 4, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Pengembangan Diri', 'rating' => 4.9, 'available' => true],
                            ['id' => 5, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'category' => 'Sains', 'rating' => 4.6, 'available' => true],
                            ['id' => 6, 'title' => 'Pulang', 'author' => 'Tere Liye', 'category' => 'Fiksi', 'rating' => 4.5, 'available' => false],
                            ['id' => 7, 'title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'category' => 'Fiksi', 'rating' => 4.7, 'available' => true],
                            ['id' => 8, 'title' => 'The Psychology of Money', 'author' => 'Morgan Housel', 'category' => 'Bisnis', 'rating' => 4.8, 'available' => true],
                            ['id' => 9, 'title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'category' => 'Bisnis', 'rating' => 4.5, 'available' => true],
                            ['id' => 10, 'title' => 'Thinking Fast and Slow', 'author' => 'Daniel Kahneman', 'category' => 'Sains', 'rating' => 4.4, 'available' => false],
                            ['id' => 11, 'title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'category' => 'Fiksi', 'rating' => 4.6, 'available' => true],
                            ['id' => 12, 'title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'category' => 'Fiksi', 'rating' => 4.3, 'available' => true],
                        ];
                    @endphp

                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($books as $book)
                            <x-book-card 
                                :id="$book['id']"
                                :title="$book['title']"
                                :author="$book['author']"
                                :category="$book['category']"
                                :rating="$book['rating']"
                                :available="$book['available']"
                            />
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-10 flex justify-center">
                        <nav class="flex items-center gap-1">
                            <button class="px-3 py-2 rounded-lg text-secondary-500 hover:bg-secondary-100 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button class="px-4 py-2 rounded-lg bg-primary-600 text-white font-medium">1</button>
                            <button class="px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">2</button>
                            <button class="px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">3</button>
                            <span class="px-3 py-2 text-secondary-400">...</span>
                            <button class="px-4 py-2 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">13</button>
                            <button class="px-3 py-2 rounded-lg text-secondary-500 hover:bg-secondary-100 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
