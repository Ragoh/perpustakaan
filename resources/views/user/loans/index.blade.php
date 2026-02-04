{{-- 
    Daftar Peminjaman User
    Menampilkan daftar peminjaman user dengan status
--}}
@extends('layouts.app')

@section('title', 'Peminjaman Saya - PerpusKu')

@php
    $loans = [
        [
            'id' => 1,
            'book_title' => 'Laskar Pelangi',
            'book_author' => 'Andrea Hirata',
            'loan_date' => '15 Jan 2024',
            'due_date' => '29 Jan 2024',
            'return_date' => null,
            'status' => 'borrowed', // pending, approved, borrowed, returned, overdue
        ],
        [
            'id' => 2,
            'book_title' => 'Atomic Habits',
            'book_author' => 'James Clear',
            'loan_date' => '10 Jan 2024',
            'due_date' => '24 Jan 2024',
            'return_date' => null,
            'status' => 'overdue',
        ],
        [
            'id' => 3,
            'book_title' => 'Sapiens',
            'book_author' => 'Yuval Noah Harari',
            'loan_date' => '20 Jan 2024',
            'due_date' => '03 Feb 2024',
            'return_date' => null,
            'status' => 'pending',
        ],
        [
            'id' => 4,
            'book_title' => 'Bumi Manusia',
            'book_author' => 'Pramoedya Ananta Toer',
            'loan_date' => '01 Jan 2024',
            'due_date' => '15 Jan 2024',
            'return_date' => '14 Jan 2024',
            'status' => 'returned',
        ],
        [
            'id' => 5,
            'book_title' => 'Filosofi Teras',
            'book_author' => 'Henry Manampiring',
            'loan_date' => '18 Jan 2024',
            'due_date' => '01 Feb 2024',
            'return_date' => null,
            'status' => 'approved',
        ],
    ];

    $statusLabels = [
        'pending' => ['label' => 'Menunggu Persetujuan', 'type' => 'warning'],
        'approved' => ['label' => 'Disetujui - Silakan Ambil', 'type' => 'info'],
        'borrowed' => ['label' => 'Sedang Dipinjam', 'type' => 'primary'],
        'returned' => ['label' => 'Sudah Dikembalikan', 'type' => 'success'],
        'overdue' => ['label' => 'Terlambat', 'type' => 'error'],
    ];
@endphp

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-br from-primary-600 to-primary-700 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Peminjaman Saya</h1>
            <p class="text-primary-100">Kelola peminjaman buku Anda</p>
        </div>
    </section>

    {{-- Stats Cards --}}
    <section class="py-6 bg-white border-b border-secondary-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-primary-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-primary-600">2</p>
                    <p class="text-sm text-primary-700">Sedang Dipinjam</p>
                </div>
                <div class="bg-amber-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-amber-600">1</p>
                    <p class="text-sm text-amber-700">Menunggu</p>
                </div>
                <div class="bg-red-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-red-600">1</p>
                    <p class="text-sm text-red-700">Terlambat</p>
                </div>
                <div class="bg-green-50 rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-green-600">15</p>
                    <p class="text-sm text-green-700">Total Pinjaman</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-8 bg-secondary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Tabs --}}
            <div class="flex flex-wrap gap-2 mb-6">
                <button class="px-4 py-2 bg-primary-600 text-white font-medium rounded-lg">Semua</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition">Sedang Dipinjam</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition">Menunggu</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition">Selesai</button>
            </div>

            {{-- Loans List --}}
            <div class="space-y-4">
                @foreach($loans as $loan)
                    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                                {{-- Book Cover --}}
                                <div class="w-20 h-28 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <span class="text-3xl">📚</span>
                                </div>

                                {{-- Book Info --}}
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <x-badge :type="$statusLabels[$loan['status']]['type']">
                                            {{ $statusLabels[$loan['status']]['label'] }}
                                        </x-badge>
                                        <span class="text-sm text-secondary-500">#{{ str_pad($loan['id'], 5, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-secondary-900 mb-1">{{ $loan['book_title'] }}</h3>
                                    <p class="text-secondary-600">{{ $loan['book_author'] }}</p>
                                </div>

                                {{-- Dates --}}
                                <div class="flex flex-wrap gap-6 lg:gap-8 text-sm">
                                    <div>
                                        <p class="text-secondary-500">Tanggal Pinjam</p>
                                        <p class="font-medium text-secondary-900">{{ $loan['loan_date'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-secondary-500">Batas Kembali</p>
                                        <p class="font-medium {{ $loan['status'] === 'overdue' ? 'text-error' : 'text-secondary-900' }}">{{ $loan['due_date'] }}</p>
                                    </div>
                                    @if($loan['return_date'])
                                        <div>
                                            <p class="text-secondary-500">Tanggal Kembali</p>
                                            <p class="font-medium text-success">{{ $loan['return_date'] }}</p>
                                        </div>
                                    @endif
                                </div>

                                {{-- Actions --}}
                                <div class="flex gap-2">
                                    @if($loan['status'] === 'approved')
                                        <a href="/loans/{{ $loan['id'] }}/report" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                                            Lihat Laporan
                                        </a>
                                    @elseif($loan['status'] === 'borrowed' || $loan['status'] === 'overdue')
                                        <button class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                                            Ajukan Pengembalian
                                        </button>
                                    @elseif($loan['status'] === 'returned')
                                        <a href="/reviews/create?book_id={{ $loan['id'] }}" class="px-4 py-2 border border-primary-600 text-primary-600 text-sm font-medium rounded-lg hover:bg-primary-50 transition">
                                            Beri Ulasan
                                        </a>
                                    @endif
                                    <button class="p-2 text-secondary-400 hover:text-secondary-600 hover:bg-secondary-100 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            {{-- 
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-12 text-center">
                <span class="text-6xl mb-4 block">📚</span>
                <h3 class="text-xl font-semibold text-secondary-900 mb-2">Belum ada peminjaman</h3>
                <p class="text-secondary-600 mb-6">Mulai jelajahi katalog buku dan temukan buku favorit Anda</p>
                <a href="/books" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">
                    Jelajahi Katalog
                </a>
            </div>
            --}}
        </div>
    </section>
@endsection
