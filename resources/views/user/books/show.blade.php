{{-- Detail Buku --}}
@extends('layouts.app')
@section('title', $book->title . ' - PerpusKu')

@section('content')
    {{-- Breadcrumb --}}
    <section class="bg-white border-b border-secondary-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm">
                <a href="/" class="text-secondary-500 hover:text-primary-600 transition">Beranda</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('books.index') }}" class="text-secondary-500 hover:text-primary-600 transition">Katalog</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-secondary-900 font-medium">{{ $book->title }}</span>
            </nav>
        </div>
    </section>

    {{-- Book Detail --}}
    <section class="py-10 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-secondary-200 overflow-hidden">
                <div class="grid lg:grid-cols-3 gap-8 p-6 lg:p-10">
                    {{-- Cover --}}
                    <div class="lg:col-span-1">
                        <div class="aspect-[3/4] bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center sticky top-6 overflow-hidden">
                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" class="w-full h-full object-cover" alt="">
                            @else
                                <div class="text-center">
                                    <span class="text-9xl">📚</span>
                                    <p class="text-primary-600 mt-4 font-medium">Cover Buku</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="lg:col-span-2">
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <x-badge type="primary">{{ $book->category->name }}</x-badge>
                            @if($book->is_available)
                                <x-badge type="success">Tersedia ({{ $book->available_stock }} eksemplar)</x-badge>
                            @else
                                <x-badge type="error">Tidak Tersedia</x-badge>
                            @endif
                        </div>

                        <h1 class="text-3xl lg:text-4xl font-bold text-secondary-900 mb-2">{{ $book->title }}</h1>
                        <p class="text-lg text-secondary-600 mb-4">oleh <span class="text-primary-600 font-medium">{{ $book->author }}</span></p>

                        {{-- Rating --}}
                        <div class="flex items-center gap-3 mb-6">
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= round($book->reviews_avg_rating ?? 0) ? 'text-amber-400' : 'text-secondary-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <span class="font-semibold text-secondary-900">{{ number_format($book->reviews_avg_rating ?? 0, 1) }}</span>
                            <span class="text-secondary-500">({{ $book->reviews_count }} ulasan)</span>
                        </div>

                        @if($book->description)
                            <div class="mb-8">
                                <h3 class="font-semibold text-secondary-900 mb-2">Sinopsis</h3>
                                <p class="text-secondary-600 leading-relaxed">{{ $book->description }}</p>
                            </div>
                        @endif

                        {{-- Details Grid --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                            @if($book->publisher)
                                <div class="bg-secondary-50 rounded-xl p-4">
                                    <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">Penerbit</p>
                                    <p class="text-secondary-900 font-medium">{{ $book->publisher }}</p>
                                </div>
                            @endif
                            @if($book->year)
                                <div class="bg-secondary-50 rounded-xl p-4">
                                    <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">Tahun</p>
                                    <p class="text-secondary-900 font-medium">{{ $book->year }}</p>
                                </div>
                            @endif
                            @if($book->pages)
                                <div class="bg-secondary-50 rounded-xl p-4">
                                    <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">Halaman</p>
                                    <p class="text-secondary-900 font-medium">{{ $book->pages }}</p>
                                </div>
                            @endif
                            @if($book->isbn)
                                <div class="bg-secondary-50 rounded-xl p-4">
                                    <p class="text-xs text-secondary-500 uppercase tracking-wide mb-1">ISBN</p>
                                    <p class="text-secondary-900 font-medium text-sm">{{ $book->isbn }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-wrap gap-4">
                            @auth
                                @if(auth()->user()->role === 'user')
                                    @if($book->is_available)
                                        <a href="{{ route('loans.create', $book->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/30">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                            Pinjam Buku Ini
                                        </a>
                                    @else
                                        <button disabled class="inline-flex items-center gap-2 px-6 py-3 bg-secondary-300 text-secondary-500 font-semibold rounded-xl cursor-not-allowed">Tidak Tersedia</button>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/30">
                                    Login untuk Meminjam
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Reviews --}}
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <h2 class="text-2xl font-bold text-secondary-900">Ulasan Pembaca</h2>
            </div>

            @if($book->reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($book->reviews as $review)
                        <div class="bg-secondary-50 rounded-2xl p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                                        <h4 class="font-semibold text-secondary-900">{{ $review->user->name }}</h4>
                                        <span class="text-sm text-secondary-500">{{ $review->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1 mb-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-secondary-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                    @if($review->comment)
                                        <p class="text-secondary-600">{{ $review->comment }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-secondary-50 rounded-2xl">
                    <span class="text-4xl block mb-4">💬</span>
                    <p class="text-secondary-600">Belum ada ulasan untuk buku ini.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Related Books --}}
    @if($relatedBooks->count() > 0)
        <section class="py-10 bg-secondary-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-secondary-900 mb-6">Buku Serupa</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($relatedBooks as $related)
                        <a href="{{ route('books.show', $related->id) }}" class="group bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <div class="aspect-[3/4] bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center overflow-hidden">
                                @if($related->cover)
                                    <img src="{{ Storage::url($related->cover) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <span class="text-5xl">📚</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-secondary-900 mb-1 line-clamp-2 group-hover:text-primary-600 transition">{{ $related->title }}</h3>
                                <p class="text-sm text-secondary-500">{{ $related->author }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
