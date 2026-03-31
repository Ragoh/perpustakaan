{{-- Form Tulis Ulasan --}}
@extends('layouts.app')
@section('title', 'Tulis Ulasan - PerpusKu')

@php
    $book = $book ?? null;
@endphp

@section('content')
    <section class="py-10 bg-secondary-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-sm border border-secondary-200 overflow-hidden">
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white">Tulis Ulasan</h1>
                    <p class="text-primary-100 mt-1">Bagikan pengalaman membaca Anda</p>
                </div>

                @if(session('error'))
                    <div class="mx-8 mt-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('reviews.store') }}" method="POST" class="px-8 py-6 space-y-6">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    {{-- Rating --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-secondary-700">Rating <span class="text-error">*</span></label>
                        <div class="flex gap-2" x-data="{ rating: {{ old('rating', 0) }} }">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only" x-on:click="rating = {{ $i }}">
                                    <svg class="w-10 h-10 transition" :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-secondary-300 hover:text-amber-200'" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </label>
                            @endfor
                        </div>
                        @error('rating') <p class="text-sm text-error">{{ $message }}</p> @enderror
                    </div>

                    <x-form-input type="textarea" name="comment" label="Komentar" placeholder="Tulis pendapat Anda tentang buku ini..." :value="old('comment')" />

                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <x-button type="submit" variant="primary" size="lg">Kirim Ulasan</x-button>
                        <a href="{{ route('books.show', $book->id) }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
