@props(['service', 'index' => 0])

<article
    class="service-card group relative p-8 rounded-3xl bg-gradient-to-b from-white/5 to-transparent border border-white/5 hover:border-accent/30 overflow-hidden transition-all duration-500"
    x-data="{ visible: false, hovered: false }"
    x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
    @mouseenter="hovered = true"
    @mouseleave="hovered = false"
    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
>
    {{-- Glow effect on hover --}}
    <div 
        class="absolute inset-0 rounded-3xl bg-gradient-to-br from-accent/10 via-transparent to-accent-2/10 opacity-0 blur-xl transition-opacity duration-500 -z-10"
        :class="hovered && 'opacity-100'"
    ></div>

    {{-- Shimmer Effect - SRS 6.5.3 --}}
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none overflow-hidden rounded-3xl">
        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out bg-gradient-to-r from-transparent via-white/5 to-transparent"></div>
    </div>

    {{-- Decorative corner accent --}}
    <div class="absolute top-0 right-0 w-32 h-32 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
        <div class="absolute top-4 right-4 w-16 h-16 border-t-2 border-r-2 border-accent/30 rounded-tr-2xl"></div>
    </div>

    {{-- Icon --}}
    <div class="relative w-16 h-16 mb-8">
        @if($service->icon)
            {{-- Custom SVG icon from database --}}
            <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
            <div class="absolute inset-0 bg-[var(--color-bg-surface)] rounded-2xl flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-500">
                <div class="w-7 h-7">{!! $service->icon !!}</div>
            </div>
        @else
            {{-- Default icon --}}
            <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
            <div class="absolute inset-0 bg-[var(--color-bg-surface)] rounded-2xl flex items-center justify-center">
                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="relative">
        <h3 class="text-2xl font-bold font-display mb-2 group-hover:text-accent transition-colors duration-300">
            <a href="{{ route('services.show', $service->slug) }}" class="hover:text-accent">
                {{ $service->title }}
            </a>
        </h3>

        @if($service->tagline)
            <p class="text-accent/70 text-sm font-medium mb-4">{{ $service->tagline }}</p>
        @endif

        <p class="text-text-muted leading-relaxed mb-8 line-clamp-3">
            {{ Str::limit(strip_tags($service->description), 150) }}
        </p>

        {{-- Features list (if available) --}}
        @if(isset($service->features) && is_array($service->features) && count($service->features) > 0)
            <ul class="space-y-2 mb-8">
                @foreach(array_slice($service->features, 0, 3) as $feature)
                    <li class="flex items-center gap-2 text-sm text-text-muted">
                        <svg class="w-4 h-4 text-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- CTA --}}
        <a
            href="{{ route('services.show', $service->slug) }}"
            class="inline-flex items-center gap-2 text-white font-medium group/link"
        >
            <span class="relative">
                Learn More
                <span class="absolute bottom-0 left-0 w-0 h-px bg-accent group-hover/link:w-full transition-all duration-300"></span>
            </span>
            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/5 group-hover/link:bg-accent/20 transition-colors duration-300">
                <svg class="w-4 h-4 text-accent transform group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </span>
        </a>
    </div>

    {{-- Service number indicator --}}
    @if($index >= 0)
        <div class="absolute bottom-4 right-4 text-6xl font-bold text-white/[0.02] font-display pointer-events-none select-none">
            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
        </div>
    @endif
</article>
