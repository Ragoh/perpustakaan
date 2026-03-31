{{-- Form Tambah/Edit Buku --}}
@extends('layouts.admin')
@php $role = 'petugas'; $isEdit = isset($book); @endphp

@section('page-title', $isEdit ? 'Edit Buku' : 'Tambah Buku')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/petugas" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('petugas.books.index') }}" class="text-secondary-500 hover:text-primary-600">Manajemen Buku</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-secondary-900 font-medium">{{ $isEdit ? 'Edit Buku' : 'Tambah Buku' }}</span>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200">
                <h2 class="text-xl font-semibold text-secondary-900">{{ $isEdit ? 'Edit Buku' : 'Tambah Buku Baru' }}</h2>
                <p class="text-secondary-600 text-sm">{{ $isEdit ? 'Perbarui informasi buku' : 'Isi informasi buku yang akan ditambahkan' }}</p>
            </div>

            <form action="{{ $isEdit ? route('petugas.books.update', $book->id) : route('petugas.books.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Cover Upload --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-secondary-700 mb-2">Cover Buku</label>
                        <div class="flex items-start gap-6">
                            <div id="cover-preview" class="w-32 h-44 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center border-2 border-dashed border-primary-300 overflow-hidden">
                                @if($isEdit && $book->cover)
                                    <img src="{{ Storage::url($book->cover) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <span class="text-4xl" id="cover-placeholder">📚</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <label id="cover-dropzone" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-secondary-300 rounded-xl cursor-pointer hover:bg-secondary-50 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="cover-upload-text">
                                        <svg class="w-8 h-8 text-secondary-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        <p class="text-sm text-secondary-500">Klik untuk upload</p>
                                        <p class="text-xs text-secondary-400">PNG, JPG (Maks. 2MB)</p>
                                    </div>
                                    <input type="file" name="cover" id="cover-input" class="hidden" accept="image/*">
                                </label>
                                <p id="cover-filename" class="text-sm text-green-600 mt-2 hidden">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <x-form-input name="title" label="Judul Buku" placeholder="Masukkan judul buku" :value="old('title', $book->title ?? '')" :required="true" />
                    <x-form-input name="author" label="Penulis" placeholder="Masukkan nama penulis" :value="old('author', $book->author ?? '')" :required="true" />
                    <x-form-input name="isbn" label="ISBN" placeholder="978-xxx-xxx-xxx-x" :value="old('isbn', $book->isbn ?? '')" />
                    <x-form-input name="publisher" label="Penerbit" placeholder="Masukkan nama penerbit" :value="old('publisher', $book->publisher ?? '')" />

                    {{-- Category --}}
                    <div class="space-y-1">
                        <label for="category_id" class="block text-sm font-medium text-secondary-700">
                            Kategori <span class="text-error">*</span>
                        </label>
                        <select name="category_id" id="category_id" required class="w-full px-4 py-3 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->icon }} {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-sm text-error">{{ $message }}</p> @enderror
                    </div>

                    <x-form-input type="number" name="year" label="Tahun Terbit" placeholder="2024" :value="old('year', $book->year ?? '')" />
                    <x-form-input type="number" name="pages" label="Jumlah Halaman" placeholder="0" :value="old('pages', $book->pages ?? '')" />
                    <x-form-input type="number" name="stock" label="Jumlah Stok" placeholder="0" :value="old('stock', $book->stock ?? '')" :required="true" />

                    <div class="md:col-span-2">
                        <x-form-input type="textarea" name="description" label="Sinopsis / Deskripsi" placeholder="Tuliskan sinopsis atau deskripsi buku..." :value="old('description', $book->description ?? '')" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $book->is_active ?? true) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-secondary-300 rounded focus:ring-primary-500">
                            <div>
                                <span class="font-medium text-secondary-900">Aktifkan Buku</span>
                                <p class="text-sm text-secondary-500">Buku akan ditampilkan di katalog dan dapat dipinjam</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-secondary-200">
                    <x-button type="submit" variant="primary" size="lg">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Buku' }}
                    </x-button>
                    <a href="{{ route('petugas.books.index') }}" class="px-6 py-3 bg-secondary-100 text-secondary-700 font-semibold rounded-xl hover:bg-secondary-200 transition text-center">Batal</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('cover-input')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Show filename
            const filenameEl = document.getElementById('cover-filename');
            filenameEl.classList.remove('hidden');
            filenameEl.querySelector('span').textContent = file.name;

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('cover-preview');
                const placeholder = document.getElementById('cover-placeholder');
                if (placeholder) placeholder.remove();
                
                // Remove existing img if any
                const existingImg = preview.querySelector('img');
                if (existingImg) existingImg.remove();

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                preview.appendChild(img);

                // Update border style
                preview.classList.remove('border-dashed', 'border-primary-300');
                preview.classList.add('border-solid', 'border-green-400');
            };
            reader.readAsDataURL(file);
        });
    </script>
    @endpush
@endsection
