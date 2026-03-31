{{-- Edit User - Status Saja --}}
@extends('layouts.admin')

@php $role = 'admin'; @endphp

@section('page-title', 'Edit User')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/admin" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('admin.users.index') }}" class="text-secondary-500 hover:text-primary-600">Manajemen User</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Edit User</span>
    </div>
@endsection

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Edit User</h2>
            <p class="text-secondary-600">Ubah status akun user</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-secondary-600 hover:text-secondary-800 hover:bg-secondary-100 rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="max-w-2xl">
        {{-- User Info Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-secondary-900">{{ $user->name }}</h3>
                    <p class="text-secondary-500">{{ $user->email }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        @php
                            $roleColors = ['admin' => 'red', 'petugas' => 'blue', 'user' => 'secondary'];
                            $rc = $roleColors[$user->role] ?? 'secondary';
                        @endphp
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-{{ $rc }}-100 text-{{ $rc }}-700 capitalize">{{ $user->role }}</span>
                        <span class="text-sm text-secondary-400">• Terdaftar {{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Form --}}
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
                {{-- Status --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-secondary-700 mb-2">Status Akun</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition
                            {{ $user->is_active ? 'border-green-300 bg-green-50' : 'border-secondary-200 hover:border-secondary-300' }}">
                            <input type="radio" name="is_active" value="1" 
                                   {{ $user->is_active ? 'checked' : '' }}
                                   class="w-4 h-4 text-green-600 border-secondary-300 focus:ring-green-500">
                            <div>
                                <p class="font-semibold {{ $user->is_active ? 'text-green-700' : 'text-secondary-800' }}">Aktif</p>
                                <p class="text-xs text-secondary-500">User dapat login</p>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer transition
                            {{ !$user->is_active ? 'border-amber-300 bg-amber-50' : 'border-secondary-200 hover:border-secondary-300' }}">
                            <input type="radio" name="is_active" value="0" 
                                   {{ !$user->is_active ? 'checked' : '' }}
                                   class="w-4 h-4 text-amber-600 border-secondary-300 focus:ring-amber-500">
                            <div>
                                <p class="font-semibold {{ !$user->is_active ? 'text-amber-700' : 'text-secondary-800' }}">Nonaktif</p>
                                <p class="text-xs text-secondary-500">User tidak dapat login</p>
                            </div>
                        </label>
                    </div>
                    @error('is_active')
                        <p class="text-sm text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex gap-3 pt-4 border-t border-secondary-200">
                    <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 text-secondary-700 font-medium rounded-xl hover:bg-secondary-100 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const name = this.name;
                document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                    const label = r.closest('label');
                    label.className = label.className.replace(/(border-\w+-300|bg-\w+-50)/g, '').trim();
                    if (!r.checked) {
                        label.classList.add('border-secondary-200');
                    }
                });
                
                const label = this.closest('label');
                label.classList.remove('border-secondary-200');
                if (this.value === '1') { label.classList.add('border-green-300', 'bg-green-50'); }
                else { label.classList.add('border-amber-300', 'bg-amber-50'); }
            });
        });
    </script>
    @endpush
@endsection
