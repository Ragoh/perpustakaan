{{-- 
    Dashboard Admin
    Overview sistem dan statistik global
--}}
@extends('layouts.admin')

@php
    $role = 'admin';
    $userName = 'Admin Demo';
@endphp

@section('page-title', 'Dashboard')

@section('content')
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-secondary-800 to-secondary-900 rounded-2xl p-6 mb-8 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold">Panel Administrator 🔐</h2>
                <p class="text-secondary-300 mt-1">Kelola user, role, dan lihat statistik global sistem.</p>
            </div>
            <div class="flex gap-3">
                <a href="/admin/users" class="px-4 py-2 bg-white text-secondary-800 font-semibold rounded-xl hover:bg-secondary-100 transition shadow">
                    Kelola User
                </a>
            </div>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            title="Total User"
            value="1,234"
            icon="users"
            color="primary"
            :change="5"
            changeLabel="dari bulan lalu"
        />
        <x-stat-card 
            title="User Aktif"
            value="892"
            icon="check"
            color="success"
            :change="12"
            changeLabel="dari bulan lalu"
        />
        <x-stat-card 
            title="Petugas"
            value="15"
            icon="clipboard"
            color="info"
        />
        <x-stat-card 
            title="Total Buku"
            value="5,234"
            icon="book"
            color="warning"
            :change="8"
            changeLabel="dari bulan lalu"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Users --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200 flex items-center justify-between">
                <h3 class="font-semibold text-secondary-900">User Terbaru</h3>
                <a href="/admin/users" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
            </div>
            <div class="divide-y divide-secondary-100">
                @php
                    $recentUsers = [
                        ['name' => 'Ahmad Rizal', 'email' => 'ahmad@email.com', 'role' => 'user', 'date' => '20 Jan 2024'],
                        ['name' => 'Siti Nurhaliza', 'email' => 'siti@email.com', 'role' => 'user', 'date' => '19 Jan 2024'],
                        ['name' => 'Budi Santoso', 'email' => 'budi@email.com', 'role' => 'petugas', 'date' => '18 Jan 2024'],
                        ['name' => 'Dewi Lestari', 'email' => 'dewi@email.com', 'role' => 'user', 'date' => '17 Jan 2024'],
                    ];
                @endphp
                @foreach($recentUsers as $user)
                    <div class="px-6 py-4 hover:bg-secondary-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr($user['name'], 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-secondary-900">{{ $user['name'] }}</p>
                                    <p class="text-sm text-secondary-500">{{ $user['email'] }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <x-badge :type="$user['role'] === 'petugas' ? 'info' : 'default'" size="sm">
                                    {{ ucfirst($user['role']) }}
                                </x-badge>
                                <p class="text-xs text-secondary-400 mt-1">{{ $user['date'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- System Activity --}}
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-secondary-200 flex items-center justify-between">
                <h3 class="font-semibold text-secondary-900">Aktivitas Sistem</h3>
                <a href="/admin/reports" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Laporan</a>
            </div>
            <div class="divide-y divide-secondary-100">
                @php
                    $activities = [
                        ['action' => 'User baru mendaftar', 'user' => 'Ahmad Rizal', 'time' => '5 menit lalu', 'icon' => 'user-plus', 'color' => 'text-green-500'],
                        ['action' => 'Role diubah menjadi petugas', 'user' => 'Budi Santoso', 'time' => '1 jam lalu', 'icon' => 'shield', 'color' => 'text-blue-500'],
                        ['action' => 'Buku baru ditambahkan', 'user' => 'Petugas Demo', 'time' => '2 jam lalu', 'icon' => 'book', 'color' => 'text-purple-500'],
                        ['action' => 'Peminjaman disetujui', 'user' => 'Petugas Demo', 'time' => '3 jam lalu', 'icon' => 'check', 'color' => 'text-green-500'],
                    ];
                @endphp
                @foreach($activities as $activity)
                    <div class="px-6 py-4 hover:bg-secondary-50 transition">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 {{ $activity['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($activity['icon'] === 'user-plus')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    @elseif($activity['icon'] === 'shield')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    @elseif($activity['icon'] === 'book')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    @endif
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-secondary-900">{{ $activity['action'] }}</p>
                                <p class="text-sm text-secondary-500">oleh {{ $activity['user'] }} • {{ $activity['time'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h4 class="font-semibold text-secondary-900 mb-4">Distribusi Role</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Admin</span>
                    <span class="font-semibold text-secondary-900">3</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Petugas</span>
                    <span class="font-semibold text-secondary-900">15</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">User</span>
                    <span class="font-semibold text-secondary-900">1,216</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h4 class="font-semibold text-secondary-900 mb-4">Status Sistem</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Server</span>
                    <x-badge type="success" size="sm">Online</x-badge>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Database</span>
                    <x-badge type="success" size="sm">Terhubung</x-badge>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-secondary-600">Storage</span>
                    <span class="text-sm text-secondary-900">45% terpakai</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 p-6">
            <h4 class="font-semibold text-secondary-900 mb-4">Aksi Cepat</h4>
            <div class="space-y-2">
                <a href="/admin/users" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-secondary-100 transition text-secondary-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Kelola User
                </a>
                <a href="/admin/roles" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-secondary-100 transition text-secondary-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Kelola Role
                </a>
                <a href="/admin/reports" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-secondary-100 transition text-secondary-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Lihat Laporan
                </a>
            </div>
        </div>
    </div>
@endsection
