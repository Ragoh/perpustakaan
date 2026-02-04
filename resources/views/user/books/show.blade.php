{{-- 
    Detail Buku
    Menampilkan informasi lengkap buku dengan cover, deskripsi, rating, dan ulasan
--}}
@extends('layouts.app')

@section('title', 'Laskar Pelangi - PerpusKu')

@php
    // Data dummy buku
    $book = [
        'id' => 1,
        'title' => 'Laskar Pelangi',
        'author' => 'Andrea Hirata',
        'publisher' => 'Bentang Pustaka',
        'year' => 2005,
        'isbn' => '978-979-073-381-2',
        'pages' => 534,
        'language' => 'Indonesia',
        'category' => 'Fiksi',
        'rating' => 4.8,
        'totalReviews' => 256,
        'available' => true,
        'stock' => 3,
        'description' => 'Laskar Pelangi adalah novel pertama karya Andrea Hirata yang diterbitkan oleh Bentang Pustaka pada tahun 2005. Novel ini bercerita tentang kehidupan 10 anak dari keluarga miskin yang bersekolah di sebuah sekolah Muhammadiyah di Belitung yang penuh dengan keterbatasan. Meski demikian, mereka memiliki semangat belajar yang tinggi dan tidak pernah menyerah dalam mengejar mimpi. Novel ini telah diterjemahkan ke dalam berbagai bahasa dan diadaptasi menjadi film layar lebar pada tahun 2008.',
    ];

    $reviews = [
        [
            'user' => 'Dewi Sartika',
            'rating' => 5,
            'date' => '20 Jan 2024',
            'comment' => 'Novel yang sangat menginspirasi! Ceritanya menyentuh hati dan memberikan banyak pelajaran hidup tentang semangat dan keberanian.'
        ],
        [
            'user' => 'Ahmad Rizal',
            'rating' => 4,
            'date' => '15 Jan 2024',
            'comment' => 'Bagus sekali, penggambaran karakter dan setting sangat detail. Recommended untuk semua kalangan.'
        ],
        [
            'user' => 'Linda Permata',
            'rating' => 5,
            'date' => '10 Jan 2024',
            'comment' => 'Buku wajib baca! Saya sampai menangis membaca bagian-bagian tertentu. Andrea Hirata memang penulis yang luar biasa.'
        ],
    ];

    $relatedBooks = [
        ['id' => 7, 'title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'category' => 'Fiksi', 'rating' => 4.7, 'available' => true],
        ['id' => 11, 'title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'category' => 'Fiksi', 'rating' => 4.6, 'available' => true],
        ['id' => 12, 'title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'category' => 'Fiksi', 'rating' => 4.3, 'available' => true],
        ['id' => 6, 'title' => 'Pulang', 'author' => 'Tere Liye', 'category' => 'Fiksi', 'rating' => 4.5, 'available' => false],
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
                <a href="/books" class="text-secondary-500 hover:text-primary-600 transition">Katalog</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-secondary-900 font-medium">{{ $book['title'] }}</span>
            </nav>
        </div>
    </section>

    {{-- Book Detail --}}
    <section class="py-10 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-secondary-200 overflow-hidden">
                <div class="grid lg:grid-cols-3 gap-8 p-6 lg:p-10">
                    {{-- Book Cover --}}
                    <div class="lg:col-span-1">
                        <div class="aspect-[3/4] bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center sticky top-6">
                            <div class="text-center">
                                <span class="text-9xl">📚</span>
                                <p class="text-primary-600 mt-4 font-medium">Cover Buku</p>
                            </div>
                        </div>
                    </div>

                    {{-- Book Info --}}
                    <div class="lg:col-span-2">
                        {{-- Category & Status --}}
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <x-badge type="primary">{{ $book['category'] }}</x-badge>
                            @if($book['available'])
                                <x-badge type="success">Tersedia ({{ $book['stock'] }} eksemplar)</x-badge>
                            @else
                                <x-badge type="error">Tidak Tersedia</x-badge>
                            @endif
                        </div>

                        {{-- Title & Author --}}
                        <h1 class="text-3xl lg:text-4xl font-bold text-secondary-900 mb-2">{{ $book['title'] }}</h1>
                        <p class="text-lg text-secondary-600 mb-4">oleh <span class="text-primary-600 font-medium">{{ $book['author'] }}</span></p>

                        {{-- Rating --}}
                        <div class="flex items-center gap-3 mb-6">
                            <x-rating :value="$book['rating']" size="lg" />
                            <span class="text-secondary-500">({{ $book['totalReviews'] }} ulasan)</span>
                        </div>

                        {{-- Description --}}
                        <div class="mb-8">
                            <h3 class="font-semibold text-secondary-900 mb-2">Sinopsis</h3>
                            <p class="text-secondary-600 leading-relaxed">{{ $book['description'] }}</p>
                        </div>

                        {{-- Book Details --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">Penerbit</p>
                                <p class="text-secondary-900 font-medium">{{ $book['publisher'] }}</p>
                            </div>
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">Tahun Terbit</p>
                                <p class="text-secondary-900 font-medium">{{ $book['year'] }}</p>
                            </div>
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">Halaman</p>
                                <p class="text-secondary-900 font-medium">{{ $book['pages'] }}</p>
                            </div>
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">ISBN</p>
                                <p class="text-secondary-900 font-medium text-sm">{{ $book['isbn'] }}</p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-wrap gap-4">
                            @if($book['available'])
                                <a href="/loans/create?book_id={{ $book['id'] }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Pinjam Buku Ini
                                </a>
                            @else
                                <button disabled class="inline-flex items-center gap-2 px-6 py-3 bg-secondary-300 text-secondary-500 font-semibold rounded-xl cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Tidak Tersedia
                                </button>
                            @endif
                            <button class="inline-flex items-center gap-2 px-6 py-3 border-2 border-secondary-300 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-50 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Reviews Section --}}
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <h2 class="text-2xl font-bold text-secondary-900">Ulasan Pembaca</h2>
                <a href="/reviews/create?book_id={{ $book['id'] }}" class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition mt-4 md:mt-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tulis Ulasan
                </a>
            </div>

            <div class="space-y-6">
                @foreach($reviews as $review)
                    <div class="bg-secondary-50 rounded-2xl p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                {{ strtoupper(substr($review['user'], 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                                    <h4 class="font-semibold text-secondary-900">{{ $review['user'] }}</h4>
                                    <span class="text-sm text-secondary-500">{{ $review['date'] }}</span>
                                </div>
                                <x-rating :value="$review['rating']" size="sm" :showValue="false" class="mb-3" />
                                <p class="text-secondary-600">{{ $review['comment'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <button class="px-6 py-3 border-2 border-secondary-300 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-50 transition">
                    Lihat Semua Ulasan
                </button>
            </div>
        </div>
    </section>

    {{-- Related Books --}}
    <section class="py-10 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-secondary-900 mb-6">Buku Serupa</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedBooks as $relatedBook)
                    <x-book-card 
                        :id="$relatedBook['id']"
                        :title="$relatedBook['title']"
                        :author="$relatedBook['author']"
                        :category="$relatedBook['category']"
                        :rating="$relatedBook['rating']"
                        :available="$relatedBook['available']"
                    />
                @endforeach
            </div>
        </div>
    </section>
@endsection
