{{-- 
    Komponen Card Statistik
    Menampilkan statistik dengan ikon, angka, label, dan persentase perubahan
--}}
@props([
    'title' => 'Statistik',
    'value' => '0',
    'icon' => 'chart',
    'color' => 'primary', // primary, success, warning, error, info
    'change' => null, // positif atau negatif
    'changeLabel' => 'dari bulan lalu',
])

@php
    $colors = [
        'primary' => [
            'bg' => 'bg-primary-100',
            'icon' => 'text-primary-600',
            'ring' => 'ring-primary-200',
        ],
        'success' => [
            'bg' => 'bg-green-100',
            'icon' => 'text-green-600',
            'ring' => 'ring-green-200',
        ],
        'warning' => [
            'bg' => 'bg-amber-100',
            'icon' => 'text-amber-600',
            'ring' => 'ring-amber-200',
        ],
        'error' => [
            'bg' => 'bg-red-100',
            'icon' => 'text-red-600',
            'ring' => 'ring-red-200',
        ],
        'info' => [
            'bg' => 'bg-blue-100',
            'icon' => 'text-blue-600',
            'ring' => 'ring-blue-200',
        ],
    ];

    $colorClass = $colors[$color] ?? $colors['primary'];

    $icons = [
        'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
        'book' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        'clipboard' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
        'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'clock' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
    ];

    $iconPath = $icons[$icon] ?? $icons['chart'];
@endphp

<div class="bg-white rounded-2xl p-6 shadow-sm border border-secondary-100 hover:shadow-md transition-shadow duration-300">
    <div class="flex items-start justify-between">
        <!-- Icon -->
        <div class="{{ $colorClass['bg'] }} p-3 rounded-xl ring-4 {{ $colorClass['ring'] }}">
            <svg class="w-6 h-6 {{ $colorClass['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $iconPath !!}
            </svg>
        </div>

        <!-- Change Indicator -->
        @if($change !== null)
            <div class="flex items-center gap-1 {{ $change >= 0 ? 'text-success' : 'text-error' }}">
                @if($change >= 0)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                @endif
                <span class="text-sm font-semibold">{{ abs($change) }}%</span>
            </div>
        @endif
    </div>

    <!-- Value & Title -->
    <div class="mt-4">
        <h3 class="text-3xl font-bold text-secondary-900">{{ $value }}</h3>
        <p class="text-secondary-500 mt-1">{{ $title }}</p>
    </div>

    @if($change !== null)
        <p class="text-xs text-secondary-400 mt-2">{{ $changeLabel }}</p>
    @endif
</div>
