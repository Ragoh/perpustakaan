{{-- Form Pengajuan Peminjaman --}}
@extends('layouts.app')
@section('title', 'Ajukan Peminjaman - PerpusKu')

@section('content')
    <section class="bg-white border-b border-secondary-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm">
                <a href="/" class="text-secondary-500 hover:text-primary-600 transition">Beranda</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('books.show', $book->id) }}" class="text-secondary-500 hover:text-primary-600 transition">{{ $book->title }}</a>
                <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-secondary-900 font-medium">Ajukan Peminjaman</span>
            </nav>
        </div>
    </section>

    <section class="py-10 bg-secondary-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-secondary-200 overflow-hidden">
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white">Ajukan Peminjaman Buku</h1>
                    <p class="text-primary-100 mt-1">Isi form berikut untuk mengajukan peminjaman</p>
                </div>

                {{-- Book Info --}}
                <div class="px-8 py-6 border-b border-secondary-200">
                    <div class="flex items-start gap-4 bg-secondary-50 rounded-xl p-4">
                        <div class="w-16 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" class="w-full h-full object-cover" alt="">
                            @else
                                <span class="text-2xl">📚</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-secondary-900">{{ $book->title }}</h3>
                            <p class="text-secondary-600 text-sm">{{ $book->author }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <x-badge type="primary" size="sm">{{ $book->category->name }}</x-badge>
                                <x-badge type="success" size="sm">Tersedia ({{ $book->available_stock }})</x-badge>
                            </div>
                        </div>
                    </div>
                </div>

                @if(session('error'))
                    <div class="mx-8 mt-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('loans.store') }}" method="POST" class="px-8 py-6 space-y-6">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    {{-- Durasi --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-secondary-700">Durasi Peminjaman <span class="text-error">*</span></label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach([7 => '1 Minggu', 14 => '2 Minggu', 21 => '3 Minggu', 30 => '1 Bulan'] as $days => $label)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="duration" value="{{ $days }}" class="peer sr-only" {{ old('duration', 7) == $days ? 'checked' : '' }}>
                                    <div class="px-4 py-3 rounded-xl border-2 border-secondary-200 text-center peer-checked:border-primary-600 peer-checked:bg-primary-50 transition">
                                        <p class="font-semibold text-secondary-900">{{ $days }} Hari</p>
                                        <p class="text-xs text-secondary-500">{{ $label }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('duration') <p class="text-sm text-error">{{ $message }}</p> @enderror
                    </div>

                    <x-form-input type="textarea" name="notes" label="Catatan (Opsional)" placeholder="Tambahkan catatan jika diperlukan..." :value="old('notes')" />

                    {{-- Terms --}}
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <div>
                                <h4 class="font-medium text-amber-800">Ketentuan Peminjaman</h4>
                                <ul class="mt-2 text-sm text-amber-700 space-y-1">
                                    <li>• Buku harus diambil maksimal 3 hari setelah persetujuan</li>
                                    <li>• Denda keterlambatan Rp 1.000 per hari</li>
                                    <li>• Bawa kartu identitas saat pengambilan buku</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <x-button type="submit" variant="primary" size="lg" class="flex-1">Ajukan Peminjaman</x-button>
                        <a href="{{ route('books.show', $book->id) }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
