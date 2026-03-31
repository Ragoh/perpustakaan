{{-- 
    Komponen Sidebar untuk dashboard admin/petugas
    Menampilkan menu navigasi berdasarkan role
--}}
@props(['role' => 'petugas'])

@php
    $menuPetugas = [
        [
            'label' => 'Dashboard',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
            'url' => '/petugas',
            'active' => request()->is('petugas') || request()->is('petugas/dashboard*'),
        ],
        [
            'label' => 'Manajemen Buku',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
            'url' => '/petugas/books',
            'active' => request()->is('petugas/books*'),
        ],
        [
            'label' => 'Kategori',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
            'url' => '/petugas/categories',
            'active' => request()->is('petugas/categories*'),
        ],
        [
            'label' => 'Peminjaman',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
            'url' => '/petugas/loans',
            'active' => request()->is('petugas/loans*'),
        ],
        [
            'label' => 'Laporan',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
            'url' => '/petugas/reports',
            'active' => request()->is('petugas/reports*'),
        ],
    ];

    $menuAdmin = [
        [
            'label' => 'Dashboard',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
            'url' => '/admin',
            'active' => request()->is('admin') || request()->is('admin/dashboard*'),
        ],
        [
            'label' => 'Manajemen User',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
            'url' => '/admin/users',
            'active' => request()->is('admin/users*'),
        ],
        [
            'label' => 'Tambah Petugas',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>',
            'url' => '/admin/petugas/create',
            'active' => request()->is('admin/petugas*'),
        ],
        [
            'label' => 'Laporan Global',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
            'url' => '/admin/reports',
            'active' => request()->is('admin/reports*'),
        ],
    ];

    $menu = $role === 'admin' ? $menuAdmin : $menuPetugas;
@endphp

<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-secondary-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 py-5 border-b border-secondary-800">
            <span class="text-3xl">📚</span>
            <div>
                <h1 class="text-xl font-bold">PerpusKu</h1>
                <p class="text-xs text-secondary-400 capitalize">{{ $role }} Panel</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 overflow-y-auto">
            <ul class="space-y-1">
                @foreach($menu as $item)
                    <li>
                        <a href="{{ $item['url'] }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $item['active'] ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-secondary-400 hover:bg-secondary-800 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                            <span class="font-medium">{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Bottom Section -->
        <div class="p-4 border-t border-secondary-800">
            <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-xl text-secondary-400 hover:bg-secondary-800 hover:text-white transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                <span class="font-medium">Kembali ke Website</span>
            </a>
        </div>
    </div>
</aside>
