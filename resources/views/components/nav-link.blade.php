@props(['active' => false])

<a
    {{ $attributes }}
    class="relative py-2 text-sm font-medium transition-colors {{ $active ? 'text-white' : 'text-[var(--color-text-muted)] hover:text-white' }} group"
>
    {{ $slot }}

    {{-- Active Indicator - SRS UI-004 --}}
    @if($active)
        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)]"></span>
    @else
        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
    @endif
</a>
