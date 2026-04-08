{{-- 
    Landing Page User
    Menampilkan hero section dan daftar buku populer
--}}
@extends('layouts.app')

@section('title', 'Beranda - PerpusKu')

@section('content')
    {{-- Hero Section --}}
    <section class="relative min-h-[600px] bg-gradient-to-br from-primary-700 via-primary-600 to-primary-800 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <!-- Floating Books Decoration -->
        <div class="absolute top-20 right-10 text-8xl opacity-20 transform rotate-12 hidden lg:block">📚</div>
        <div class="absolute bottom-20 left-10 text-6xl opacity-20 transform -rotate-12 hidden lg:block">📖</div>
        <div class="absolute top-40 left-1/4 text-5xl opacity-15 hidden lg:block">📕</div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Temukan Dunia
                        <span class="block text-primary-200">Dalam Setiap Halaman</span>
                    </h1>
                    <p class="text-lg md:text-xl text-primary-100 mb-8 max-w-lg">
                        Jelajahi koleksi buku terbaik dan lakukan peminjaman secara online. 
                        Ambil buku favorit Anda di perpustakaan dengan mudah.
                    </p>

                    <!-- Search Bar -->
                    <form action="/books" method="GET" class="flex gap-3 max-w-lg">
                        <div class="flex-1 relative">
                            <input type="text" name="search" placeholder="Cari judul buku, penulis, atau kategori..." 
                                   class="w-full px-5 py-4 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent">
                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <button type="submit" class="px-6 py-4 bg-white text-primary-600 font-semibold rounded-xl hover:bg-primary-50 transition shadow-lg">
                            Cari
                        </button>
                    </form>

                    <!-- Stats (Data Asli) -->
                    <div class="flex gap-8 mt-10">
                        <div>
                            <p class="text-3xl font-bold">{{ number_format($totalBooks) }}</p>
                            <p class="text-primary-200 text-sm">Koleksi Buku</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">{{ number_format($totalMembers) }}</p>
                            <p class="text-primary-200 text-sm">Anggota Aktif</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">{{ number_format($totalCategories) }}</p>
                            <p class="text-primary-200 text-sm">Kategori</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Image/Illustration -->
                <div class="hidden lg:flex justify-center">
                    <div class="relative">
                        <!-- Book Stack Illustration -->
                        <div class="w-80 h-96 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 flex items-center justify-center">
                            <div class="text-center">
                                <span class="text-9xl">📚</span>
                                <p class="text-white/80 mt-4 font-medium">Mulai Petualangan Literasi Anda</p>
                            </div>
                        </div>
                        <!-- Decorative Elements -->
                        <div class="absolute -top-6 -right-6 w-20 h-20 bg-accent-400 rounded-2xl flex items-center justify-center text-3xl shadow-lg">
                            ⭐
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-primary-400 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                            📖
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100V50C240 83.3333 480 100 720 100C960 100 1200 83.3333 1440 50V100H0Z" fill="#f8fafc"/>
            </svg>
        </div>
    </section>

    {{-- Popular Books Section --}}
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-secondary-900 mb-2">Buku Populer</h2>
                    <p class="text-secondary-600">Buku yang paling banyak dipinjam</p>
                </div>
                <a href="/books" class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition mt-4 md:mt-0">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            <!-- Books Grid (Data Asli) -->
            @if($popularBooks->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($popularBooks as $book)
                        <x-book-card 
                            :id="$book->id"
                            :title="$book->title"
                            :author="$book->author"
                            :cover="$book->cover ? Storage::url($book->cover) : null"
                            :category="$book->category->name ?? 'Umum'"
                            :rating="$book->reviews_avg_rating ?? 0"
                            :available="$book->is_available"
                        />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-12 text-center">
                    <span class="text-6xl mb-4 block">📚</span>
                    <h3 class="text-xl font-semibold text-secondary-900 mb-2">Belum ada buku</h3>
                    <p class="text-secondary-600">Buku akan ditampilkan di sini setelah ditambahkan oleh petugas</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-secondary-900 mb-2">Jelajahi Kategori</h2>
                <p class="text-secondary-600">Temukan buku berdasarkan kategori favorit Anda</p>
            </div>

            @if($categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach($categories as $i => $category)
                        <a href="/books?category={{ urlencode($category->name) }}" 
                           class="group bg-gradient-to-br {{ $gradients[$i % count($gradients)] }} rounded-2xl p-6 text-white text-center hover:scale-105 transition-transform duration-300 shadow-lg">
                            <span class="text-4xl block mb-3">{{ $category->icon ?? '📚' }}</span>
                            <h3 class="font-semibold mb-1">{{ $category->name }}</h3>
                            <p class="text-sm text-white/80">{{ number_format($category->books_count) }} Buku</p>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-secondary-500">Belum ada kategori yang tersedia</p>
                </div>
            @endif
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-16 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-secondary-900 mb-2">Cara Meminjam Buku</h2>
                <p class="text-secondary-600">Proses peminjaman yang mudah dan cepat</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-secondary-100 relative">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        1
                    </div>
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">
                        🔍
                    </div>
                    <h3 class="font-semibold text-lg text-secondary-900 mb-2">Cari & Pilih Buku</h3>
                    <p class="text-secondary-600 text-sm">Jelajahi katalog kami dan temukan buku yang Anda inginkan</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-secondary-100 relative">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        2
                    </div>
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">
                        📝
                    </div>
                    <h3 class="font-semibold text-lg text-secondary-900 mb-2">Ajukan Peminjaman</h3>
                    <p class="text-secondary-600 text-sm">Isi form peminjaman dan tunggu persetujuan dari petugas</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm border border-secondary-100 relative">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        3
                    </div>
                    <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">
                        📖
                    </div>
                    <h3 class="font-semibold text-lg text-secondary-900 mb-2">Ambil di Perpustakaan</h3>
                    <p class="text-secondary-600 text-sm">Tunjukkan laporan peminjaman Anda dan ambil buku di perpustakaan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Siap Memulai Petualangan Membaca?
            </h2>
            <p class="text-primary-100 text-lg mb-8 max-w-2xl mx-auto">
                Bergabung dengan pembaca lainnya dan nikmati akses ke koleksi buku terlengkap
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/books" class="px-8 py-4 bg-white text-primary-600 font-semibold rounded-xl hover:bg-primary-50 transition shadow-lg">
                    Jelajahi Katalog
                </a>
                @guest
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-400 transition border-2 border-primary-400">
                        Daftar Sekarang
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
