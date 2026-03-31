{{-- Laporan Petugas --}}
@extends('layouts.admin')
@php $role = 'petugas'; @endphp

@section('page-title', 'Laporan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Laporan Perpustakaan</h2>
            <p class="text-secondary-600">Data peminjaman, buku, kategori, dan ulasan</p>
        </div>
        <button onclick="printReport('{{ route('petugas.reports.preview', ['tab' => $tab]) }}')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Laporan
        </button>
    </div>

    {{-- Tabs --}}
    <div class="flex gap-2 mb-6 border-b border-secondary-200">
        <a href="?tab=loans" class="px-4 py-3 font-medium text-sm border-b-2 transition {{ $tab === 'loans' ? 'border-primary-600 text-primary-600' : 'border-transparent text-secondary-500 hover:text-secondary-700' }}">
            📋 Peminjaman & Pengembalian
        </a>
        <a href="?tab=books" class="px-4 py-3 font-medium text-sm border-b-2 transition {{ $tab === 'books' ? 'border-primary-600 text-primary-600' : 'border-transparent text-secondary-500 hover:text-secondary-700' }}">
            📚 Buku & Kategori
        </a>
        <a href="?tab=reviews" class="px-4 py-3 font-medium text-sm border-b-2 transition {{ $tab === 'reviews' ? 'border-primary-600 text-primary-600' : 'border-transparent text-secondary-500 hover:text-secondary-700' }}">
            ⭐ Ulasan
        </a>
    </div>

    {{-- Tab: Peminjaman --}}
    @if($tab === 'loans')
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-secondary-50 text-secondary-600">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">#</th>
                            <th class="px-4 py-3 text-left font-medium">Peminjam</th>
                            <th class="px-4 py-3 text-left font-medium">Buku</th>
                            <th class="px-4 py-3 text-left font-medium">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left font-medium">Batas Kembali</th>
                            <th class="px-4 py-3 text-left font-medium">Tgl Kembali</th>
                            <th class="px-4 py-3 text-left font-medium">Status</th>
                            <th class="px-4 py-3 text-left font-medium">Disetujui Oleh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100">
                        @forelse($loans as $loan)
                            <tr class="hover:bg-secondary-50 transition">
                                <td class="px-4 py-3 text-secondary-500">{{ $loan->id }}</td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-secondary-900">{{ $loan->user->name }}</p>
                                    <p class="text-xs text-secondary-500">{{ $loan->user->email }}</p>
                                </td>
                                <td class="px-4 py-3 text-secondary-700">{{ $loan->book->title ?? '-' }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ $loan->loan_date->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ $loan->due_date->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</td>
                                <td class="px-4 py-3"><x-badge :type="$loan->status_type" size="sm">{{ $loan->status_label }}</x-badge></td>
                                <td class="px-4 py-3 text-secondary-600">{{ $loan->approver->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="px-4 py-8 text-center text-secondary-500">Belum ada data peminjaman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($loans->hasPages())
                <div class="px-4 py-3 border-t border-secondary-200">{{ $loans->appends(['tab' => 'loans'])->links() }}</div>
            @endif
        </div>
    @endif

    {{-- Tab: Buku & Kategori --}}
    @if($tab === 'books')
        {{-- Kategori --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-secondary-200">
                <h3 class="font-semibold text-secondary-900">Data Kategori</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-secondary-50 text-secondary-600">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">#</th>
                            <th class="px-4 py-3 text-left font-medium">Nama Kategori</th>
                            <th class="px-4 py-3 text-left font-medium">Deskripsi</th>
                            <th class="px-4 py-3 text-left font-medium">Jumlah Buku</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100">
                        @forelse($categories as $cat)
                            <tr class="hover:bg-secondary-50 transition">
                                <td class="px-4 py-3 text-secondary-500">{{ $cat->id }}</td>
                                <td class="px-4 py-3 font-medium text-secondary-900">{{ $cat->icon ?? '' }} {{ $cat->name }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ Str::limit($cat->description, 60) }}</td>
                                <td class="px-4 py-3 text-secondary-700">{{ $cat->books_count }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-8 text-center text-secondary-500">Belum ada kategori.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Buku --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200">
                <h3 class="font-semibold text-secondary-900">Data Buku</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-secondary-50 text-secondary-600">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">#</th>
                            <th class="px-4 py-3 text-left font-medium">Judul</th>
                            <th class="px-4 py-3 text-left font-medium">Penulis</th>
                            <th class="px-4 py-3 text-left font-medium">Kategori</th>
                            <th class="px-4 py-3 text-left font-medium">Stok</th>
                            <th class="px-4 py-3 text-left font-medium">Peminjaman</th>
                            <th class="px-4 py-3 text-left font-medium">Rating</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100">
                        @forelse($books as $book)
                            <tr class="hover:bg-secondary-50 transition">
                                <td class="px-4 py-3 text-secondary-500">{{ $book->id }}</td>
                                <td class="px-4 py-3 font-medium text-secondary-900">{{ $book->title }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ $book->author }}</td>
                                <td class="px-4 py-3 text-secondary-600">{{ $book->category->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-secondary-700">{{ $book->stock }}</td>
                                <td class="px-4 py-3 text-secondary-700">{{ $book->loans_count }}</td>
                                <td class="px-4 py-3 text-secondary-700">
                                    @if($book->reviews_avg_rating)
                                        ⭐ {{ number_format($book->reviews_avg_rating, 1) }}
                                    @else
                                        <span class="text-secondary-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-4 py-8 text-center text-secondary-500">Belum ada buku.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($books->hasPages())
                <div class="px-4 py-3 border-t border-secondary-200">{{ $books->appends(['tab' => 'books'])->links() }}</div>
            @endif
        </div>
    @endif

    {{-- Tab: Ulasan --}}
    @if($tab === 'reviews')
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-secondary-50 text-secondary-600">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium">#</th>
                            <th class="px-4 py-3 text-left font-medium">User</th>
                            <th class="px-4 py-3 text-left font-medium">Buku</th>
                            <th class="px-4 py-3 text-left font-medium">Rating</th>
                            <th class="px-4 py-3 text-left font-medium">Komentar</th>
                            <th class="px-4 py-3 text-left font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-secondary-100">
                        @forelse($reviews as $review)
                            <tr class="hover:bg-secondary-50 transition">
                                <td class="px-4 py-3 text-secondary-500">{{ $review->id }}</td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-secondary-900">{{ $review->user->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-secondary-700">{{ $review->book->title ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="text-amber-500">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        @endfor
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-secondary-600 max-w-xs truncate">{{ $review->comment ?? '-' }}</td>
                                <td class="px-4 py-3 text-secondary-500">{{ $review->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-secondary-500">Belum ada ulasan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($reviews->hasPages())
                <div class="px-4 py-3 border-t border-secondary-200">{{ $reviews->appends(['tab' => 'reviews'])->links() }}</div>
            @endif
        </div>
    @endif

    @push('scripts')
    <script>
        function printReport(url) {
            let iframe = document.getElementById('print-iframe');
            if (!iframe) {
                iframe = document.createElement('iframe');
                iframe.id = 'print-iframe';
                iframe.style.display = 'none';
                document.body.appendChild(iframe);
            }
            iframe.src = url;
            iframe.onload = function() {
                iframe.contentWindow.print();
            };
        }
    </script>
    @endpush
@endsection
