{{-- 
    Komponen Card Buku
    Menampilkan informasi buku dalam format card dengan cover, judul, penulis, dan rating
--}}
@props([
    'id' => 1,
    'title' => 'Judul Buku',
    'author' => 'Nama Penulis',
    'cover' => null,
    'category' => 'Kategori',
    'rating' => 4.5,
    'available' => true,
])

<div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-secondary-100">
    <!-- Cover Image -->
    <div class="relative aspect-[3/4] overflow-hidden bg-gradient-to-br from-primary-100 to-primary-200">
        @if($cover)
            <img src="{{ $cover }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        @endif
        
        <!-- Category Badge -->
        <div class="absolute top-3 left-3">
            <span class="px-3 py-1 text-xs font-semibold bg-white/90 backdrop-blur-sm text-primary-700 rounded-full shadow-sm">
                {{ $category }}
            </span>
        </div>

        <!-- Availability Badge -->
        <div class="absolute top-3 right-3">
            @if($available)
                <span class="px-3 py-1 text-xs font-semibold bg-success/90 backdrop-blur-sm text-white rounded-full shadow-sm">
                    Tersedia
                </span>
            @else
                <span class="px-3 py-1 text-xs font-semibold bg-error/90 backdrop-blur-sm text-white rounded-full shadow-sm">
                    Dipinjam
                </span>
            @endif
        </div>

        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
            <a href="/books/{{ $id }}" class="px-4 py-2 bg-white text-primary-600 font-semibold rounded-lg shadow-lg hover:bg-primary-50 transition">
                Lihat Detail
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="p-4">
        <!-- Title -->
        <h3 class="font-semibold text-secondary-800 line-clamp-2 mb-1 group-hover:text-primary-600 transition">
            <a href="/books/{{ $id }}">{{ $title }}</a>
        </h3>

        <!-- Author -->
        <p class="text-sm text-secondary-500 mb-3">{{ $author }}</p>

        <!-- Rating -->
        <div class="flex items-center gap-1">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= floor($rating))
                    <svg class="w-4 h-4 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @elseif($i - $rating < 1 && $i - $rating > 0)
                    <svg class="w-4 h-4 text-accent-400" fill="currentColor" viewBox="0 0 20 20">
                        <defs>
                            <linearGradient id="half-{{ $id }}-{{ $i }}">
                                <stop offset="50%" stop-color="currentColor"/>
                                <stop offset="50%" stop-color="#E5E7EB"/>
                            </linearGradient>
                        </defs>
                        <path fill="url(#half-{{ $id }}-{{ $i }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @else
                    <svg class="w-4 h-4 text-secondary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endif
            @endfor
            <span class="text-sm text-secondary-500 ml-1">{{ number_format($rating, 1) }}</span>
        </div>
    </div>
</div>
