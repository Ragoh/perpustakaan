{{-- Manajemen Role --}}
@extends('layouts.admin')

@php
    $role = 'admin';
    $userName = 'Admin Demo';
    $roles = [
        ['id' => 1, 'name' => 'Admin', 'description' => 'Akses penuh ke seluruh sistem', 'user_count' => 3, 'color' => 'red'],
        ['id' => 2, 'name' => 'Petugas', 'description' => 'Mengelola buku dan peminjaman', 'user_count' => 15, 'color' => 'blue'],
        ['id' => 3, 'name' => 'User', 'description' => 'Dapat meminjam buku dan review', 'user_count' => 1216, 'color' => 'gray'],
    ];
@endphp

@section('page-title', 'Manajemen Role')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-secondary-900">Daftar Role</h2>
        <p class="text-secondary-600">Kelola role dan hak akses sistem</p>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
        <p class="text-sm text-blue-700">Role sistem bersifat tetap. Anda dapat mengubah hak akses masing-masing role.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($roles as $roleItem)
            <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center {{ $roleItem['color'] === 'red' ? 'bg-red-100' : ($roleItem['color'] === 'blue' ? 'bg-blue-100' : 'bg-secondary-100') }}">
                        <svg class="w-6 h-6 {{ $roleItem['color'] === 'red' ? 'text-red-600' : ($roleItem['color'] === 'blue' ? 'text-blue-600' : 'text-secondary-600') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <span class="text-sm text-secondary-500">{{ $roleItem['user_count'] }} user</span>
                </div>
                <h3 class="text-xl font-semibold text-secondary-900 mb-1">{{ $roleItem['name'] }}</h3>
                <p class="text-secondary-600 text-sm">{{ $roleItem['description'] }}</p>
            </div>
        @endforeach
    </div>
@endsection
