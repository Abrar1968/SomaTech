@props([])

<a
    {{ $attributes }}
    class="text-2xl font-semibold text-white hover:text-[var(--color-accent)] transition-colors py-2"
>
    {{ $slot }}
</a>
