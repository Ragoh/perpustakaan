{{-- 
    Komponen Form Input
    Input field dengan label, error message, dan styling konsisten
--}}
@props([
    'type' => 'text',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'error' => null,
    'helper' => null,
])

<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-secondary-700">
            {{ $label }}
            @if($required)
                <span class="text-error">*</span>
            @endif
        </label>
    @endif

    @if($type === 'textarea')
        <textarea 
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-xl border transition-all duration-200 focus:outline-none focus:ring-2 ' . ($error ? 'border-error focus:ring-error/20 focus:border-error' : 'border-secondary-300 focus:ring-primary-500/20 focus:border-primary-500') . ($disabled ? ' bg-secondary-100 cursor-not-allowed' : '')]) }}
            rows="4"
        >{{ $value }}</textarea>
    @elseif($type === 'select')
        <select 
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-xl border transition-all duration-200 focus:outline-none focus:ring-2 ' . ($error ? 'border-error focus:ring-error/20 focus:border-error' : 'border-secondary-300 focus:ring-primary-500/20 focus:border-primary-500') . ($disabled ? ' bg-secondary-100 cursor-not-allowed' : '')]) }}
        >
            {{ $slot }}
        </select>
    @else
        <input 
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-xl border transition-all duration-200 focus:outline-none focus:ring-2 ' . ($error ? 'border-error focus:ring-error/20 focus:border-error' : 'border-secondary-300 focus:ring-primary-500/20 focus:border-primary-500') . ($disabled ? ' bg-secondary-100 cursor-not-allowed' : '')]) }}
        />
    @endif

    @if($error)
        <p class="text-sm text-error flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ $error }}
        </p>
    @elseif($helper)
        <p class="text-sm text-secondary-500">{{ $helper }}</p>
    @endif
</div>
