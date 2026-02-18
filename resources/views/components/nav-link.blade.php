@props(['active' => false])

<a
    {{ $attributes }}
    @class([
        'relative px-4 py-2 text-sm font-medium tracking-wide rounded-full transition-all duration-300 group',
        'text-white bg-white/10' => $active,
        'text-text-muted hover:text-white hover:bg-white/5' => !$active,
    ])
>
    <span class="relative z-10">{{ $slot }}</span>

    {{-- Active/Hover Indicator - SRS UI-004 --}}
    @if($active)
        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-accent"></span>
    @endif
</a>
