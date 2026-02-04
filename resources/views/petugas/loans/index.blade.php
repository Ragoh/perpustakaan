{{-- 
    Manajemen Peminjaman
    Halaman untuk approve/reject peminjaman dan pengembalian
--}}
@extends('layouts.admin')

@php
    $role = 'petugas';
    $userName = 'Petugas Demo';
    
    $loans = [
        [
            'id' => 1,
            'user' => 'Ahmad Rizal',
            'book' => 'Atomic Habits',
            'loan_date' => '20 Jan 2024',
            'due_date' => '03 Feb 2024',
            'status' => 'pending',
            'type' => 'borrow',
        ],
        [
            'id' => 2,
            'user' => 'Siti Nurhaliza',
            'book' => 'Laskar Pelangi',
            'loan_date' => '18 Jan 2024',
            'due_date' => '01 Feb 2024',
            'status' => 'pending',
            'type' => 'borrow',
        ],
        [
            'id' => 3,
            'user' => 'Budi Santoso',
            'book' => 'Sapiens',
            'loan_date' => '15 Jan 2024',
            'due_date' => '29 Jan 2024',
            'status' => 'borrowed',
            'type' => 'return',
        ],
        [
            'id' => 4,
            'user' => 'Dewi Lestari',
            'book' => 'Bumi Manusia',
            'loan_date' => '10 Jan 2024',
            'due_date' => '24 Jan 2024',
            'status' => 'overdue',
            'type' => 'return',
        ],
        [
            'id' => 5,
            'user' => 'Andi Wijaya',
            'book' => 'Filosofi Teras',
            'loan_date' => '22 Jan 2024',
            'due_date' => '05 Feb 2024',
            'status' => 'approved',
            'type' => 'pickup',
        ],
    ];

    $statusLabels = [
        'pending' => ['label' => 'Menunggu', 'type' => 'warning'],
        'approved' => ['label' => 'Disetujui', 'type' => 'info'],
        'borrowed' => ['label' => 'Dipinjam', 'type' => 'primary'],
        'overdue' => ['label' => 'Terlambat', 'type' => 'error'],
        'returned' => ['label' => 'Dikembalikan', 'type' => 'success'],
    ];
@endphp

@section('page-title', 'Manajemen Peminjaman')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Manajemen Peminjaman</span>
    </div>
@endsection

@section('content')
    {{-- Statistics --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-amber-50 rounded-xl p-4 border border-amber-200">
            <p class="text-2xl font-bold text-amber-700">12</p>
            <p class="text-sm text-amber-600">Menunggu Persetujuan</p>
        </div>
        <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
            <p class="text-2xl font-bold text-blue-700">5</p>
            <p class="text-sm text-blue-600">Siap Diambil</p>
        </div>
        <div class="bg-red-50 rounded-xl p-4 border border-red-200">
            <p class="text-2xl font-bold text-red-700">8</p>
            <p class="text-sm text-red-600">Terlambat</p>
        </div>
        <div class="bg-green-50 rounded-xl p-4 border border-green-200">
            <p class="text-2xl font-bold text-green-700">156</p>
            <p class="text-sm text-green-600">Total Aktif</p>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="flex flex-wrap gap-2 mb-6">
        <button class="px-4 py-2 bg-primary-600 text-white font-medium rounded-lg">Semua</button>
        <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">Menunggu Persetujuan</button>
        <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">Siap Diambil</button>
        <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">Dipinjam</button>
        <button class="px-4 py-2 bg-white text-secondary-600 font-medium rounded-lg hover:bg-secondary-100 transition border border-secondary-200">Terlambat</button>
    </div>

    {{-- Table --}}
    <x-data-table :headers="['Peminjam', 'Buku', 'Tanggal Pinjam', 'Batas Kembali', 'Status', 'Aksi']">
        @foreach($loans as $loan)
            <tr class="hover:bg-secondary-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr($loan['user'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-medium text-secondary-900">{{ $loan['user'] }}</p>
                            <p class="text-sm text-secondary-500">#{{ str_pad($loan['id'], 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-secondary-900">{{ $loan['book'] }}</p>
                </td>
                <td class="px-6 py-4 text-secondary-600">{{ $loan['loan_date'] }}</td>
                <td class="px-6 py-4">
                    <span class="{{ $loan['status'] === 'overdue' ? 'text-error font-semibold' : 'text-secondary-600' }}">
                        {{ $loan['due_date'] }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <x-badge :type="$statusLabels[$loan['status']]['type']" size="sm">
                        {{ $statusLabels[$loan['status']]['label'] }}
                    </x-badge>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        @if($loan['status'] === 'pending')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 text-sm font-medium rounded-lg hover:bg-green-200 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Setujui
                            </button>
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Tolak
                            </button>
                        @elseif($loan['status'] === 'approved')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-100 text-primary-700 text-sm font-medium rounded-lg hover:bg-primary-200 transition">
                                Konfirmasi Pengambilan
                            </button>
                        @elseif($loan['status'] === 'borrowed' || $loan['status'] === 'overdue')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 text-sm font-medium rounded-lg hover:bg-green-200 transition">
                                Konfirmasi Pengembalian
                            </button>
                        @endif
                        <button class="p-1.5 text-secondary-400 hover:text-secondary-600 hover:bg-secondary-100 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

        <x-slot name="pagination">
            <div class="flex items-center justify-between">
                <p class="text-sm text-secondary-600">
                    Menampilkan <span class="font-semibold">1-5</span> dari <span class="font-semibold">156</span> peminjaman
                </p>
                <nav class="flex items-center gap-1">
                    <button class="px-3 py-1.5 rounded-lg text-secondary-500 hover:bg-secondary-100 transition disabled:opacity-50" disabled>
                        Sebelumnya
                    </button>
                    <button class="px-3 py-1.5 rounded-lg bg-primary-600 text-white font-medium">1</button>
                    <button class="px-3 py-1.5 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">2</button>
                    <button class="px-3 py-1.5 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">3</button>
                    <button class="px-3 py-1.5 rounded-lg text-secondary-700 hover:bg-secondary-100 transition">
                        Selanjutnya
                    </button>
                </nav>
            </div>
        </x-slot>
    </x-data-table>
@endsection
