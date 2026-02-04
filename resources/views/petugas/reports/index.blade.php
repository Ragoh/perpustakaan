{{-- 
    Halaman Laporan Petugas
    Statistik dan laporan peminjaman perpustakaan
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
@endphp

@section('page-title', 'Laporan & Statistik')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Laporan & Statistik</span>
    </div>
@endsection

@section('content')
    {{-- Period Filter --}}
    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <h3 class="font-semibold text-secondary-900">Periode Laporan</h3>
            <div class="flex flex-wrap gap-2">
                <button class="px-4 py-2 bg-primary-600 text-white font-medium rounded-lg">Minggu Ini</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">Bulan Ini</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">3 Bulan</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">Tahun Ini</button>
                <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Custom
                </button>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Total Peminjaman"
            value="1,234"
            icon="clipboard"
            color="primary"
            :change="12"
            changeLabel="dari periode lalu"
        />
        <x-stat-card 
            title="Buku Dikembalikan"
            value="1,089"
            icon="check"
            color="success"
            :change="8"
            changeLabel="dari periode lalu"
        />
        <x-stat-card 
            title="Rata-rata Keterlambatan"
            value="2.3 Hari"
            icon="clock"
            color="warning"
            :change="-15"
            changeLabel="dari periode lalu"
        />
        <x-stat-card 
            title="Buku Terpopuler"
            value="Atomic Habits"
            icon="star"
            color="info"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {{-- Loan Trend Chart --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h3 class="font-semibold text-secondary-900 mb-6">Tren Peminjaman</h3>
            <div class="h-64 flex items-end justify-between gap-2">
                @php
                    $chartData = [
                        ['day' => 'Sen', 'loans' => 45, 'returns' => 38],
                        ['day' => 'Sel', 'loans' => 62, 'returns' => 55],
                        ['day' => 'Rab', 'loans' => 38, 'returns' => 41],
                        ['day' => 'Kam', 'loans' => 71, 'returns' => 65],
                        ['day' => 'Jum', 'loans' => 55, 'returns' => 48],
                        ['day' => 'Sab', 'loans' => 29, 'returns' => 32],
                        ['day' => 'Min', 'loans' => 18, 'returns' => 15],
                    ];
                    $maxValue = 80;
                @endphp
                @foreach($chartData as $data)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full flex gap-1 items-end" style="height: 200px">
                            <div class="flex-1 bg-primary-500 rounded-t" style="height: {{ ($data['loans'] / $maxValue) * 100 }}%"></div>
                            <div class="flex-1 bg-green-500 rounded-t" style="height: {{ ($data['returns'] / $maxValue) * 100 }}%"></div>
                        </div>
                        <span class="text-xs text-secondary-600">{{ $data['day'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center gap-6 mt-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-primary-500 rounded"></div>
                    <span class="text-sm text-secondary-600">Peminjaman</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-green-500 rounded"></div>
                    <span class="text-sm text-secondary-600">Pengembalian</span>
                </div>
            </div>
        </div>

        {{-- Category Distribution --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h3 class="font-semibold text-secondary-900 mb-6">Distribusi Kategori</h3>
            @php
                $categories = [
                    ['name' => 'Fiksi', 'count' => 450, 'percentage' => 35, 'color' => 'bg-primary-500'],
                    ['name' => 'Non-Fiksi', 'count' => 320, 'percentage' => 25, 'color' => 'bg-blue-500'],
                    ['name' => 'Self-Help', 'count' => 256, 'percentage' => 20, 'color' => 'bg-green-500'],
                    ['name' => 'Sains', 'count' => 128, 'percentage' => 10, 'color' => 'bg-amber-500'],
                    ['name' => 'Lainnya', 'count' => 128, 'percentage' => 10, 'color' => 'bg-secondary-400'],
                ];
            @endphp
            <div class="space-y-4">
                @foreach($categories as $cat)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-secondary-700">{{ $cat['name'] }}</span>
                            <span class="text-secondary-500">{{ $cat['count'] }} ({{ $cat['percentage'] }}%)</span>
                        </div>
                        <div class="w-full h-3 bg-secondary-100 rounded-full overflow-hidden">
                            <div class="{{ $cat['color'] }} h-full rounded-full transition-all duration-500" style="width: {{ $cat['percentage'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Top Books Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-secondary-200">
            <h3 class="font-semibold text-secondary-900">10 Buku Terpopuler</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Dipinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Rating</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                    @php
                        $topBooks = [
                            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Self-Help', 'loans' => 156, 'rating' => 4.9],
                            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'category' => 'Fiksi', 'loans' => 142, 'rating' => 4.8],
                            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'category' => 'Sains', 'loans' => 128, 'rating' => 4.7],
                            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'category' => 'Sejarah', 'loans' => 115, 'rating' => 4.9],
                            ['title' => 'Filosofi Teras', 'author' => 'Henry Manampiring', 'category' => 'Self-Help', 'loans' => 98, 'rating' => 4.6],
                        ];
                    @endphp
                    @foreach($topBooks as $index => $book)
                        <tr class="hover:bg-secondary-50 transition">
                            <td class="px-6 py-4 font-semibold text-secondary-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-secondary-900">{{ $book['title'] }}</p>
                                <p class="text-sm text-secondary-500">{{ $book['author'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <x-badge type="primary" size="sm">{{ $book['category'] }}</x-badge>
                            </td>
                            <td class="px-6 py-4 font-semibold text-secondary-900">{{ $book['loans'] }}x</td>
                            <td class="px-6 py-4">
                                <x-rating :value="$book['rating']" size="sm" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Export Buttons --}}
    <div class="mt-6 flex flex-wrap gap-3 justify-end">
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white font-medium rounded-xl hover:bg-green-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export Excel
        </button>
        <button class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export PDF
        </button>
    </div>
@endsection
