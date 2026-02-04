{{-- 
    Manajemen User
    Daftar user dengan opsi ubah role
--}}
@extends('layouts.admin')

@php
    $role = 'admin';
    $userName = 'Admin Demo';
    
    $users = [
        ['id' => 1, 'name' => 'Ahmad Rizal', 'email' => 'ahmad@email.com', 'role' => 'user', 'status' => 'active', 'registered' => '20 Jan 2024'],
        ['id' => 2, 'name' => 'Siti Nurhaliza', 'email' => 'siti@email.com', 'role' => 'user', 'status' => 'active', 'registered' => '19 Jan 2024'],
        ['id' => 3, 'name' => 'Budi Santoso', 'email' => 'budi@email.com', 'role' => 'petugas', 'status' => 'active', 'registered' => '18 Jan 2024'],
        ['id' => 4, 'name' => 'Dewi Lestari', 'email' => 'dewi@email.com', 'role' => 'user', 'status' => 'inactive', 'registered' => '17 Jan 2024'],
        ['id' => 5, 'name' => 'Andi Wijaya', 'email' => 'andi@email.com', 'role' => 'admin', 'status' => 'active', 'registered' => '15 Jan 2024'],
    ];
@endphp

@section('page-title', 'Manajemen User')

@section('breadcrumb')
    <div class="flex items-center gap-2 text-sm">
        <a href="/admin" class="text-secondary-500 hover:text-primary-600">Dashboard</a>
        <svg class="w-4 h-4 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-secondary-900 font-medium">Manajemen User</span>
    </div>
@endsection

@section('content')
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-secondary-900">Daftar User</h2>
            <p class="text-secondary-600">Kelola user dan role sistem</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Cari nama atau email..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <select class="px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                <option>Semua Role</option>
                <option>Admin</option>
                <option>Petugas</option>
                <option>User</option>
            </select>
            <select class="px-4 py-2.5 rounded-xl border border-secondary-300 focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Nonaktif</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <x-data-table :headers="['User', 'Role', 'Status', 'Terdaftar', 'Aksi']">
        @foreach($users as $user)
            <tr class="hover:bg-secondary-50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr($user['name'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-secondary-900">{{ $user['name'] }}</p>
                            <p class="text-sm text-secondary-500">{{ $user['email'] }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if($user['role'] === 'admin')
                        <x-badge type="error" size="sm">Admin</x-badge>
                    @elseif($user['role'] === 'petugas')
                        <x-badge type="info" size="sm">Petugas</x-badge>
                    @else
                        <x-badge type="default" size="sm">User</x-badge>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($user['status'] === 'active')
                        <x-badge type="success" size="sm">Aktif</x-badge>
                    @else
                        <x-badge type="warning" size="sm">Nonaktif</x-badge>
                    @endif
                </td>
                <td class="px-6 py-4 text-secondary-600">{{ $user['registered'] }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="/admin/users/{{ $user['id'] }}/edit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-100 text-primary-700 text-sm font-medium rounded-lg hover:bg-primary-200 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        @if($user['role'] !== 'admin')
                            <button class="p-1.5 text-secondary-400 hover:text-error hover:bg-red-50 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach

        <x-slot name="pagination">
            <div class="flex items-center justify-between">
                <p class="text-sm text-secondary-600">
                    Menampilkan <span class="font-semibold">1-5</span> dari <span class="font-semibold">1,234</span> user
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
