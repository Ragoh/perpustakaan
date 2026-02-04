{{-- Laporan Global Admin --}}
@extends('layouts.admin')

@php
    $role = 'admin';
    $userName = 'Admin Demo';
@endphp

@section('page-title', 'Laporan Global')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-secondary-900">Laporan Global Sistem</h2>
        <p class="text-secondary-600">Statistik keseluruhan perpustakaan</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card title="Total User" value="1,234" icon="users" color="primary" :change="5" changeLabel="dari bulan lalu"/>
        <x-stat-card title="Total Buku" value="5,234" icon="book" color="info" :change="8" changeLabel="dari bulan lalu"/>
        <x-stat-card title="Total Peminjaman" value="12,456" icon="clipboard" color="success" :change="15" changeLabel="dari bulan lalu"/>
        <x-stat-card title="Total Review" value="3,456" icon="star" color="warning" :change="12" changeLabel="dari bulan lalu"/>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {{-- User Growth --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h3 class="font-semibold text-secondary-900 mb-6">Pertumbuhan User (6 Bulan)</h3>
            <div class="h-48 flex items-end justify-between gap-3">
                @foreach([850, 920, 980, 1050, 1150, 1234] as $i => $val)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-primary-500 rounded-t" style="height: {{ ($val / 1300) * 180 }}px"></div>
                        <span class="text-xs text-secondary-600">{{ ['Agt', 'Sep', 'Okt', 'Nov', 'Des', 'Jan'][$i] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Loan Stats --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h3 class="font-semibold text-secondary-900 mb-6">Statistik Peminjaman Bulanan</h3>
            <div class="h-48 flex items-end justify-between gap-3">
                @foreach([1200, 1450, 1100, 1680, 1520, 1890] as $i => $val)
                    <div class="flex-1 flex flex-col items-center gap-2">
                        <div class="w-full bg-green-500 rounded-t" style="height: {{ ($val / 2000) * 180 }}px"></div>
                        <span class="text-xs text-secondary-600">{{ ['Agt', 'Sep', 'Okt', 'Nov', 'Des', 'Jan'][$i] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Summary Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-secondary-200">
            <h3 class="font-semibold text-secondary-900">Ringkasan Per Kategori</h3>
        </div>
        <table class="w-full">
            <thead class="bg-secondary-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Jumlah Buku</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Dipinjam</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Rating Avg</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-secondary-100">
                @foreach([
                    ['Fiksi', 1250, 456, 4.6],
                    ['Non-Fiksi', 890, 321, 4.5],
                    ['Sains', 456, 187, 4.7],
                    ['Sejarah', 324, 98, 4.4],
                    ['Self-Help', 567, 234, 4.8]
                ] as $cat)
                    <tr class="hover:bg-secondary-50">
                        <td class="px-6 py-4 font-medium text-secondary-900">{{ $cat[0] }}</td>
                        <td class="px-6 py-4 text-secondary-600">{{ number_format($cat[1]) }}</td>
                        <td class="px-6 py-4 text-secondary-600">{{ number_format($cat[2]) }}</td>
                        <td class="px-6 py-4"><x-rating :value="$cat[3]" size="sm" /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Export --}}
    <div class="mt-6 flex gap-3 justify-end">
        <button class="px-4 py-2 bg-green-600 text-white font-medium rounded-xl hover:bg-green-700 transition">Export Excel</button>
        <button class="px-4 py-2 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition">Export PDF</button>
    </div>
@endsection
