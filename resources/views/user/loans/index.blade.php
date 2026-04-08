{{-- Peminjaman Saya --}}
@extends('layouts.app')
@section('title', 'Peminjaman Saya - PerpusKu')

@section('content')
    <section class="bg-gradient-to-br from-primary-600 to-primary-700 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Peminjaman Saya</h1>
            <p class="text-primary-100">Kelola peminjaman buku Anda</p>
        </div>
    </section>

    @php
        $borrowed = $loans->whereIn('status', ['borrowed'])->count();
        $pending = $loans->where('status', 'pending')->count();
        $overdue = $loans->filter(fn($l) => $l->is_overdue)->count();
        $unpaidFines = $loans->filter(fn($l) => $l->has_unpaid_fine);
        $totalFine = $unpaidFines->sum('fine_amount');
    @endphp

    {{-- Stats --}}
    <section class="py-6 bg-white border-b border-secondary-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-primary-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-primary-600">{{ $borrowed }}</p>
                    <p class="text-sm text-primary-700">Sedang Dipinjam</p>
                </div>
                <div class="bg-amber-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-amber-600">{{ $pending }}</p>
                    <p class="text-sm text-amber-700">Menunggu</p>
                </div>
                <div class="bg-red-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-red-600">{{ $overdue }}</p>
                    <p class="text-sm text-red-700">Terlambat</p>
                </div>
                <div class="bg-green-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $loans->count() }}</p>
                    <p class="text-sm text-green-700">Total Pinjaman</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Unpaid Fine Warning --}}
    @if($totalFine > 0)
        <section class="py-4 bg-red-50 border-b border-red-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3 p-4 bg-red-100 rounded-xl border border-red-200">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    <div>
                        <p class="font-semibold text-red-800">Anda memiliki denda belum dibayar: Rp {{ number_format($totalFine, 0, ',', '.') }}</p>
                        <p class="text-sm text-red-700 mt-1">Silakan kunjungi perpustakaan untuk melakukan pembayaran denda.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(session('success'))
        <section class="py-4 bg-secondary-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </section>
    @endif

    {{-- Loans List --}}
    <section class="py-8 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($loans->count() > 0)
                <div class="space-y-4">
                    @foreach($loans as $loan)
                        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden hover:shadow-md transition">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                                    <div class="w-20 h-28 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                                        @if($loan->book->cover)
                                            <img src="{{ Storage::url($loan->book->cover) }}" class="w-full h-full object-cover" alt="">
                                        @else
                                            <span class="text-3xl">📚</span>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                            <x-badge :type="$loan->status_type">{{ $loan->status_label }}</x-badge>
                                            <span class="text-sm text-secondary-500">#{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-secondary-900 mb-1">{{ $loan->book->title }}</h3>
                                        <p class="text-secondary-600">{{ $loan->book->author }}</p>
                                    </div>

                                    <div class="flex flex-wrap gap-6 lg:gap-8 text-sm">
                                        <div>
                                            <p class="text-secondary-500">Tanggal Pinjam</p>
                                            <p class="font-medium text-secondary-900">{{ $loan->loan_date->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-secondary-500">Batas Kembali</p>
                                            <p class="font-medium {{ $loan->is_overdue ? 'text-error' : 'text-secondary-900' }}">{{ $loan->due_date->format('d M Y') }}</p>
                                        </div>
                                        @if($loan->return_date)
                                            <div>
                                                <p class="text-secondary-500">Tanggal Kembali</p>
                                                <p class="font-medium text-success">{{ $loan->return_date->format('d M Y') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        {{-- Fine info --}}
                                        @if($loan->fine_amount > 0)
                                            <div class="px-3 py-2 rounded-lg {{ $loan->fine_paid ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                                                <p class="text-xs {{ $loan->fine_paid ? 'text-green-600' : 'text-red-600' }}">Denda</p>
                                                <p class="font-bold {{ $loan->fine_paid ? 'text-green-700' : 'text-red-700' }}">{{ $loan->formatted_fine }}</p>
                                                @if($loan->fine_paid)
                                                    <p class="text-xs text-green-600">✓ Lunas</p>
                                                @else
                                                    <p class="text-xs text-red-600">Bayar di perpustakaan</p>
                                                @endif
                                            </div>
                                        @elseif($loan->is_overdue)
                                            <div class="px-3 py-2 rounded-lg bg-red-50 border border-red-200">
                                                <p class="text-xs text-red-600">Est. Denda</p>
                                                <p class="font-bold text-red-700">Rp {{ number_format($loan->calculated_fine, 0, ',', '.') }}</p>
                                                <p class="text-xs text-red-600">{{ $loan->overdue_days }} hari terlambat</p>
                                            </div>
                                        @endif

                                        {{-- Actions --}}
                                        <div class="flex gap-2">
                                            @if(in_array($loan->status, ['approved', 'borrowed', 'returned']))
                                                <a href="{{ route('loans.receipt', $loan->id) }}" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                                                    Bukti
                                                </a>
                                            @endif
                                            @if($loan->status === 'borrowed')
                                                <form action="{{ route('loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                                    @csrf
                                                    <button class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @endif
                                            @if($loan->status === 'returned')
                                                @php
                                                    $hasReview = \App\Models\Review::where('user_id', auth()->id())->where('book_id', $loan->book_id)->exists();
                                                @endphp
                                                @if(!$hasReview)
                                                    <a href="{{ route('reviews.create', $loan->book_id) }}" class="px-4 py-2 border border-primary-600 text-primary-600 text-sm font-medium rounded-lg hover:bg-primary-50 transition">
                                                        Beri Ulasan
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-12 text-center">
                    <span class="text-6xl mb-4 block">📚</span>
                    <h3 class="text-xl font-semibold text-secondary-900 mb-2">Belum ada peminjaman</h3>
                    <p class="text-secondary-600 mb-6">Mulai jelajahi katalog buku dan temukan buku favorit Anda</p>
                    <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">Jelajahi Katalog</a>
                </div>
            @endif
        </div>
    </section>
@endsection
