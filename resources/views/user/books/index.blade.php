{{-- Katalog Buku --}}
@extends('layouts.app')
@section('title', 'Katalog Buku - PerpusKu')

@section('content')
    {{-- Header --}}
    <section class="bg-gradient-to-br from-primary-600 to-primary-700 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Katalog Buku</h1>
            <p class="text-primary-100">Temukan buku favoritmu dari koleksi perpustakaan kami</p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-8 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                {{-- Sidebar Filter --}}
                <aside class="lg:w-64 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 sticky top-6">
                        <h3 class="font-semibold text-secondary-900 mb-4">Kategori</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('books.index') }}" class="block px-3 py-2 text-sm font-medium rounded-lg {{ !request('category') ? 'bg-primary-50 text-primary-700' : 'text-secondary-600 hover:bg-secondary-50' }} transition">
                                    Semua Buku
                                </a>
                            </li>
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('books.index', ['category' => $cat->id]) }}" class="flex items-center justify-between px-3 py-2 text-sm rounded-lg {{ request('category') == $cat->id ? 'bg-primary-50 text-primary-700 font-medium' : 'text-secondary-600 hover:bg-secondary-50' }} transition">
                                        <span>{{ $cat->icon }} {{ $cat->name }}</span>
                                        <span class="text-xs text-secondary-400">{{ $cat->books_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>

                {{-- Books Grid --}}
                <div class="flex-1">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse($books as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="group bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="aspect-[3/4] bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center relative overflow-hidden">
                                    @if($book->cover)
                                        <img src="{{ Storage::url($book->cover) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        <span class="text-6xl">📚</span>
                                    @endif
                                    @if(!$book->is_available)
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                            <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">Tidak Tersedia</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-secondary-900 mb-1 line-clamp-2 group-hover:text-primary-600 transition">{{ $book->title }}</h3>
                                    <p class="text-sm text-secondary-500 mb-2">{{ $book->author }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            <span class="text-sm font-medium text-secondary-700">{{ number_format($book->reviews_avg_rating ?? 0, 1) }}</span>
                                        </div>
                                        <x-badge type="primary" size="sm">{{ $book->category->name }}</x-badge>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-full bg-white rounded-2xl p-12 text-center">
                                <span class="text-6xl block mb-4">📚</span>
                                <h3 class="text-lg font-semibold text-secondary-900 mb-2">Belum ada buku</h3>
                                <p class="text-secondary-600">Katalog buku masih kosong</p>
                            </div>
                        @endforelse
                    </div>

                    @if($books->hasPages())
                        <div class="mt-8">{{ $books->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
