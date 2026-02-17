@props(['service'])

<div
    class="relative group p-8 glass rounded-2xl border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300 overflow-hidden"
    data-gsap="fade-up-scale"
>
    {{-- Shimmer Effect - SRS 6.5.3 --}}
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-600 pointer-events-none">
        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    </div>

    {{-- Icon --}}
    @if($service->icon)
        <div class="w-16 h-16 mb-6 text-[var(--color-accent)] group-hover:scale-110 transition-transform">
            {!! $service->icon !!}
        </div>
    @else
        <div class="w-16 h-16 mb-6 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>
    @endif

    {{-- Content --}}
    <h3 class="text-2xl font-semibold font-display mb-3">{{ $service->title }}</h3>

    @if($service->tagline)
        <p class="text-[var(--color-accent)] text-sm mb-4">{{ $service->tagline }}</p>
    @endif

    <p class="text-[var(--color-text-muted)] mb-6 line-clamp-3">
        {{ Str::limit(strip_tags($service->description), 150) }}
    </p>

    {{-- CTA --}}
    <a
        href="{{ route('services.show', $service->slug) }}"
        class="inline-flex items-center gap-2 text-[var(--color-accent)] hover:gap-4 transition-all group/link"
    >
        Learn More
        <svg class="w-5 h-5 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </a>
</div>
