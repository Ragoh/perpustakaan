{{-- 
    Komponen Button
    Button dengan berbagai variant dan ukuran
--}}
@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, success, outline, ghost
    'size' => 'md', // sm, md, lg
    'disabled' => false,
    'loading' => false,
    'icon' => null,
    'iconPosition' => 'left', // left, right
])

@php
    $variants = [
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500/50 shadow-lg shadow-primary-600/30',
        'secondary' => 'bg-secondary-600 text-white hover:bg-secondary-700 focus:ring-secondary-500/50',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500/50',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500/50',
        'warning' => 'bg-amber-500 text-white hover:bg-amber-600 focus:ring-amber-500/50',
        'outline' => 'border-2 border-primary-600 text-primary-600 hover:bg-primary-50 focus:ring-primary-500/50',
        'ghost' => 'text-secondary-600 hover:bg-secondary-100 focus:ring-secondary-500/50',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm gap-1.5',
        'md' => 'px-4 py-2.5 text-sm gap-2',
        'lg' => 'px-6 py-3 text-base gap-2',
    ];

    $variantClass = $variants[$variant] ?? $variants['primary'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<button 
    type="{{ $type }}"
    {{ $disabled || $loading ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => "inline-flex items-center justify-center font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 $variantClass $sizeClass" . (($disabled || $loading) ? ' opacity-50 cursor-not-allowed' : '')]) }}
>
    @if($loading)
        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @elseif($icon && $iconPosition === 'left')
        {!! $icon !!}
    @endif

    {{ $slot }}

    @if($icon && $iconPosition === 'right' && !$loading)
        {!! $icon !!}
    @endif
</button>
