@props(['active' => false])

<a
    {{ $attributes }}
    @class([
        'group flex items-center justify-between py-4 px-4 text-lg font-medium rounded-xl transition-all duration-300',
        'text-white bg-gradient-to-r from-accent/20 to-accent-2/10 border-l-2 border-accent' => $active,
        'text-text-muted hover:text-white hover:bg-white/5 border-l-2 border-transparent hover:border-accent/50' => !$active,
    ])
>
    <span>{{ $slot }}</span>
    <svg class="w-5 h-5 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 {{ $active ? 'opacity-100 translate-x-0 text-accent' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
</a>
