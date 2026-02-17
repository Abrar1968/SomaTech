@props(['name', 'icon' => null])

<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[var(--color-accent)]/20 text-[var(--color-accent)] text-xs font-medium">
    @if($icon)
        {!! $icon !!}
    @endif
    {{ $name }}
</span>
