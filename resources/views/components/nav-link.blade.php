@props(['active' => false])

<a
    {{ $attributes }}
    class="relative px-1 py-2 text-sm font-medium tracking-wide transition-colors duration-200 {{ $active ? 'text-white' : 'text-text-muted hover:text-white' }} group"
>
    {{ $slot }}

    {{-- Active Indicator - SRS UI-004 --}}
    @if($active)
        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-linear-to-r from-accent to-accent-2"></span>
    @else
        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-linear-to-r from-accent to-accent-2 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-center"></span>
    @endif
</a>
