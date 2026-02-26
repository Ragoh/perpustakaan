{{-- 
    Manajemen User - Data dari Database
    Daftar user dengan opsi ubah role
--}}
@extends('layouts.admin')

@php $role = 'admin'; @endphp

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

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-secondary-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">Terdaftar</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-secondary-100">
                    @forelse($users as $user)
                        @php $userRole = $user->role; @endphp
                        <tr class="hover:bg-secondary-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-secondary-900">{{ $user->name }}</p>
                                        <p class="text-sm text-secondary-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($userRole === 'admin')
                                    <x-badge type="error" size="sm">Admin</x-badge>
                                @elseif($userRole === 'petugas')
                                    <x-badge type="info" size="sm">Petugas</x-badge>
                                @else
                                    <x-badge type="default" size="sm">User</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <x-badge type="success" size="sm">Aktif</x-badge>
                                @else
                                    <x-badge type="warning" size="sm">Nonaktif</x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-secondary-600">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary-100 text-primary-700 text-sm font-medium rounded-lg hover:bg-primary-200 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-secondary-500">
                                Belum ada user terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-secondary-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
