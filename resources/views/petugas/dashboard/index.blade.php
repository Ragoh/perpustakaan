{{-- 
    Dashboard Petugas
    Menampilkan statistik dan ringkasan data perpustakaan
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
@endphp

@section('page-title', 'Dashboard')

@section('content')
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-6 mb-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">Selamat Datang, Petugas! 👋</h2>
                <p class="text-primary-100 mt-1">Berikut ringkasan aktivitas perpustakaan hari ini.</p>
            </div>
            <div class="flex gap-3">
                <a href="/petugas/books/create" class="px-4 py-2 bg-white text-primary-600 font-semibold rounded-xl hover:bg-primary-50 transition shadow">
                    + Tambah Buku
                </a>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Total Buku"
            value="5,234"
            icon="book"
            color="primary"
            :change="12"
            changeLabel="dari bulan lalu"
        />
        <x-stat-card 
            title="Peminjaman Aktif"
            value="156"
            icon="clipboard"
            color="info"
            :change="8"
            changeLabel="dari minggu lalu"
        />
        <x-stat-card 
            title="Menunggu Persetujuan"
            value="23"
            icon="clock"
            color="warning"
            :change="-5"
            changeLabel="dari kemarin"
        />
        <x-stat-card 
            title="Dikembalikan Hari Ini"
            value="18"
            icon="check"
            color="success"
            :change="15"
            changeLabel="dari kemarin"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Loan Requests --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200 flex items-center justify-between">
                <h3 class="font-semibold text-secondary-900">Permintaan Peminjaman Terbaru</h3>
                <a href="/petugas/loans" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-secondary-100">
                @php
                    $recentLoans = [
                        ['user' => 'Ahmad Rizal', 'book' => 'Atomic Habits', 'time' => '5 menit lalu'],
                        ['user' => 'Siti Nurhaliza', 'book' => 'Laskar Pelangi', 'time' => '15 menit lalu'],
                        ['user' => 'Budi Santoso', 'book' => 'Sapiens', 'time' => '30 menit lalu'],
                        ['user' => 'Dewi Lestari', 'book' => 'Bumi Manusia', 'time' => '1 jam lalu'],
                    ];
                @endphp
                @foreach($recentLoans as $loan)
                    <div class="px-6 py-4 hover:bg-secondary-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr($loan['user'], 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-secondary-900">{{ $loan['user'] }}</p>
                                    <p class="text-sm text-secondary-500">{{ $loan['book'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-secondary-500">{{ $loan['time'] }}</p>
                                <div class="flex gap-1 mt-1">
                                    <button class="p-1 text-success hover:bg-green-50 rounded transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                    <button class="p-1 text-error hover:bg-red-50 rounded transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Books Low on Stock --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200 flex items-center justify-between">
                <h3 class="font-semibold text-secondary-900">Stok Buku Menipis</h3>
                <a href="/petugas/books" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-secondary-100">
                @php
                    $lowStockBooks = [
                        ['title' => 'Atomic Habits', 'author' => 'James Clear', 'stock' => 1],
                        ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'stock' => 0],
                        ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'stock' => 2],
                        ['title' => 'Thinking Fast and Slow', 'author' => 'Daniel Kahneman', 'stock' => 1],
                    ];
                @endphp
                @foreach($lowStockBooks as $book)
                    <div class="px-6 py-4 hover:bg-secondary-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-12 rounded-lg bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <span class="text-lg">📚</span>
                                </div>
                                <div>
                                    <p class="font-medium text-secondary-900">{{ $book['title'] }}</p>
                                    <p class="text-sm text-secondary-500">{{ $book['author'] }}</p>
                                </div>
                            </div>
                            <x-badge :type="$book['stock'] === 0 ? 'error' : 'warning'" size="sm">
                                Stok: {{ $book['stock'] }}
                            </x-badge>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Quick Chart Section --}}
    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
        <h3 class="font-semibold text-secondary-900 mb-6">Statistik Peminjaman (7 Hari Terakhir)</h3>
        <div class="h-64 flex items-end justify-between gap-4">
            @php
                $chartData = [
                    ['day' => 'Sen', 'value' => 45],
                    ['day' => 'Sel', 'value' => 62],
                    ['day' => 'Rab', 'value' => 38],
                    ['day' => 'Kam', 'value' => 71],
                    ['day' => 'Jum', 'value' => 55],
                    ['day' => 'Sab', 'value' => 29],
                    ['day' => 'Min', 'value' => 18],
                ];
                $maxValue = max(array_column($chartData, 'value'));
            @endphp
            @foreach($chartData as $data)
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-primary-100 rounded-t-lg relative" style="height: {{ ($data['value'] / $maxValue) * 200 }}px">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-600 to-primary-400 rounded-t-lg"></div>
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-sm font-semibold text-secondary-700">
                            {{ $data['value'] }}
                        </div>
                    </div>
                    <span class="text-sm text-secondary-600">{{ $data['day'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection
