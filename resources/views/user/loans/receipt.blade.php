{{-- Bukti Peminjaman --}}
@extends('layouts.app')
@section('title', 'Bukti Peminjaman - PerpusKu')

@section('content')
    <section class="py-10 bg-secondary-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-secondary-200 overflow-hidden" id="receipt">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6 text-center">
                    <h1 class="text-2xl font-bold text-white">📚 PerpusKu</h1>
                    <p class="text-primary-100 mt-1">Bukti {{ $loan->status === 'returned' ? 'Pengembalian' : 'Peminjaman' }} Buku</p>
                </div>

                <div class="px-8 py-6">
                    {{-- ID & Status --}}
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-dashed border-secondary-300">
                        <div>
                            <p class="text-sm text-secondary-500">No. Peminjaman</p>
                            <p class="text-xl font-bold text-secondary-900">#{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <x-badge :type="$loan->status_type" size="lg">{{ $loan->status_label }}</x-badge>
                    </div>

                    {{-- Peminjam --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-secondary-500 uppercase tracking-wide mb-3">Data Peminjam</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-secondary-500">Nama</p>
                                <p class="font-medium text-secondary-900">{{ $loan->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-secondary-500">Email</p>
                                <p class="font-medium text-secondary-900">{{ $loan->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Buku --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-secondary-500 uppercase tracking-wide mb-3">Data Buku</h3>
                        <div class="flex items-start gap-4 bg-secondary-50 rounded-xl p-4">
                            <div class="w-16 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if($loan->book->cover)
                                    <img src="{{ Storage::url($loan->book->cover) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <span class="text-2xl">📚</span>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-semibold text-secondary-900">{{ $loan->book->title }}</h4>
                                <p class="text-secondary-600 text-sm">{{ $loan->book->author }}</p>
                                <p class="text-secondary-500 text-sm">{{ $loan->book->category->name }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-secondary-500 uppercase tracking-wide mb-3">Detail Peminjaman</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 mb-1">Tanggal Pinjam</p>
                                <p class="font-semibold text-secondary-900">{{ $loan->loan_date->format('d M Y') }}</p>
                            </div>
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 mb-1">Batas Kembali</p>
                                <p class="font-semibold text-secondary-900">{{ $loan->due_date->format('d M Y') }}</p>
                            </div>
                            <div class="bg-secondary-50 rounded-xl p-4">
                                <p class="text-xs text-secondary-500 mb-1">Durasi</p>
                                <p class="font-semibold text-secondary-900">{{ $loan->duration }} Hari</p>
                            </div>
                            @if($loan->return_date)
                                <div class="bg-green-50 rounded-xl p-4">
                                    <p class="text-xs text-green-600 mb-1">Tanggal Kembali</p>
                                    <p class="font-semibold text-green-700">{{ $loan->return_date->format('d M Y') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($loan->approver)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-secondary-500 uppercase tracking-wide mb-3">Disetujui Oleh</h3>
                            <p class="font-medium text-secondary-900">{{ $loan->approver->name }}</p>
                        </div>
                    @endif

                    @if($loan->notes)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-secondary-500 uppercase tracking-wide mb-3">Catatan</h3>
                            <p class="text-secondary-700">{{ $loan->notes }}</p>
                        </div>
                    @endif

                    {{-- Footer --}}
                    <div class="pt-4 border-t border-dashed border-secondary-300 text-center text-sm text-secondary-500">
                        <p>Dicetak pada {{ now()->format('d M Y H:i') }}</p>
                        <p class="mt-1">PerpusKu — Sistem Perpustakaan Online</p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 mt-6 justify-center">
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak Bukti
                </button>
                <a href="{{ route('loans.index') }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition">
                    Kembali
                </a>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        @media print {
            body * { visibility: hidden; }
            #receipt, #receipt * { visibility: visible; }
            #receipt { position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>
    @endpush
@endsection
