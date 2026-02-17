@props([])

<a
    {{ $attributes }}
    class="text-2xl font-semibold text-white hover:text-accent transition-colors py-2"
>
    {{ $slot }}
</a>
