{{-- Manajemen Peminjaman - Petugas --}}
@extends('layouts.admin')
@php $role = 'petugas'; @endphp

@section('page-title', 'Manajemen Peminjaman')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-secondary-900 font-medium">Manajemen Peminjaman</span>
    </div>
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Daftar Peminjaman</h2>
            <p class="text-secondary-600">Kelola peminjaman dan pengembalian buku</p>
        </div>
        {{-- Filter --}}
        <div class="flex gap-2">
            <a href="{{ route('petugas.loans.index') }}" class="px-3 py-1.5 text-sm font-medium rounded-lg {{ !request('status') ? 'bg-primary-600 text-white' : 'bg-white text-secondary-600 hover:bg-secondary-100' }} transition">Semua</a>
            <a href="{{ route('petugas.loans.index', ['status' => 'pending']) }}" class="px-3 py-1.5 text-sm font-medium rounded-lg {{ request('status') === 'pending' ? 'bg-amber-500 text-white' : 'bg-white text-secondary-600 hover:bg-secondary-100' }} transition">Menunggu</a>
            <a href="{{ route('petugas.loans.index', ['status' => 'borrowed']) }}" class="px-3 py-1.5 text-sm font-medium rounded-lg {{ request('status') === 'borrowed' ? 'bg-primary-600 text-white' : 'bg-white text-secondary-600 hover:bg-secondary-100' }} transition">Dipinjam</a>
            <a href="{{ route('petugas.loans.index', ['status' => 'returned']) }}" class="px-3 py-1.5 text-sm font-medium rounded-lg {{ request('status') === 'returned' ? 'bg-green-600 text-white' : 'bg-white text-secondary-600 hover:bg-secondary-100' }} transition">Dikembalikan</a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                    @forelse($loans as $loan)
                        <tr class="hover:bg-secondary-50 transition">
                            <td class="px-6 py-4 text-sm text-secondary-500">#{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-secondary-900">{{ $loan->user->name }}</p>
                                <p class="text-sm text-secondary-500">{{ $loan->user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-secondary-900">{{ $loan->book->title }}</p>
                                <p class="text-sm text-secondary-500">{{ $loan->book->author }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <p class="text-secondary-900">{{ $loan->loan_date->format('d M Y') }}</p>
                                <p class="text-secondary-500">s.d {{ $loan->due_date->format('d M Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <x-badge :type="$loan->status_type" size="sm">{{ $loan->status_label }}</x-badge>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @if($loan->status === 'pending')
                                        <form action="{{ route('petugas.loans.approve', $loan->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded-lg hover:bg-green-700 transition">Setujui</button>
                                        </form>
                                        <form action="{{ route('petugas.loans.reject', $loan->id) }}" method="POST" class="inline" onsubmit="event.preventDefault(); let notes = prompt('Alasan penolakan:'); if(notes) { this.querySelector('[name=admin_notes]').value = notes; this.submit(); }">
                                            @csrf
                                            <input type="hidden" name="admin_notes" value="">
                                            <button class="px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition">Tolak</button>
                                        </form>
                                    @elseif($loan->status === 'approved')
                                        <form action="{{ route('petugas.loans.borrowed', $loan->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="px-3 py-1.5 bg-primary-600 text-white text-xs font-medium rounded-lg hover:bg-primary-700 transition">Tandai Diambil</button>
                                        </form>
                                    @elseif($loan->status === 'borrowed')
                                        <span class="text-xs text-secondary-500">Menunggu pengembalian user</span>
                                    @elseif($loan->status === 'return_pending')
                                        <form action="{{ route('petugas.loans.approve-return', $loan->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded-lg hover:bg-green-700 transition">Konfirmasi Kembali</button>
                                        </form>
                                        <form action="{{ route('petugas.loans.reject-return', $loan->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak pengembalian? Status akan kembali ke Dipinjam.')">
                                            @csrf
                                            <button class="px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition">Tolak Kembali</button>
                                        </form>
                                    @elseif($loan->status === 'returned')
                                        <span class="text-sm text-secondary-500">{{ $loan->return_date?->format('d M Y') }}</span>
                                    @elseif($loan->status === 'rejected')
                                        <span class="text-sm text-secondary-500">Ditolak</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-secondary-500">Belum ada data peminjaman.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($loans->hasPages())
            <div class="px-6 py-4 border-t border-secondary-200">{{ $loans->links() }}</div>
        @endif
    </div>
@endsection
