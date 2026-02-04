{{-- 
    Komponen Badge
    Menampilkan badge status dengan berbagai warna
--}}
@props([
    'type' => 'default', // default, success, warning, error, info, pending
    'size' => 'md', // sm, md, lg
])

@php
    $types = [
        'default' => 'bg-secondary-100 text-secondary-700',
        'success' => 'bg-green-100 text-green-700',
        'warning' => 'bg-amber-100 text-amber-700',
        'error' => 'bg-red-100 text-red-700',
        'info' => 'bg-blue-100 text-blue-700',
        'pending' => 'bg-yellow-100 text-yellow-700',
        'primary' => 'bg-primary-100 text-primary-700',
    ];

    $sizes = [
        'sm' => 'px-2 py-0.5 text-xs',
        'md' => 'px-2.5 py-1 text-sm',
        'lg' => 'px-3 py-1.5 text-base',
    ];

    $typeClass = $types[$type] ?? $types['default'];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center font-medium rounded-full $typeClass $sizeClass"]) }}>
    {{ $slot }}
</span>
