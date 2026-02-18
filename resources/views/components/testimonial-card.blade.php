@props(['testimonial', 'index' => 0])

@php
    $initials = collect(explode(' ', $testimonial->client_name))
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<article
    class="testimonial-card group relative p-8 rounded-3xl bg-[var(--color-bg-primary)] border border-white/5 hover:border-accent/20 transition-all duration-500"
    x-data="{ visible: false }"
    x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
>
    {{-- Quote icon --}}
    <div class="absolute top-6 right-6 text-accent/10 group-hover:text-accent/20 transition-colors duration-500">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
    </div>

    {{-- Star Rating - SRS FR-007 --}}
    <div class="flex gap-1 mb-6">
        @for($i = 1; $i <= 5; $i++)
            <svg
                class="w-5 h-5 transition-transform duration-300 {{ $i <= $testimonial->rating ? 'text-yellow-400 fill-yellow-400' : 'text-white/10' }}"
                style="transition-delay: {{ ($i - 1) * 50 }}ms;"
                :class="visible && '{{ $i <= $testimonial->rating ? 'scale-100' : 'scale-75' }}'"
                viewBox="0 0 24 24"
            >
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
        @endfor
    </div>

    {{-- Content --}}
    <blockquote class="text-text-muted mb-8 leading-relaxed text-lg">
        "{{ $testimonial->content }}"
    </blockquote>

    {{-- Divider --}}
    <div class="w-12 h-px bg-gradient-to-r from-accent to-accent-2 mb-6"></div>

    {{-- Client Info --}}
    <div class="flex items-center gap-4">
        {{-- Avatar with glow effect --}}
        <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-full blur-sm opacity-50"></div>
            @if($testimonial->client_photo)
                <img
                    src="{{ $testimonial->client_photo }}"
                    alt="{{ $testimonial->client_name }}"
                    class="relative w-14 h-14 rounded-full object-cover ring-2 ring-accent/30"
                    loading="lazy"
                />
            @else
                {{-- Initials Avatar Fallback - SRS FR-007 --}}
                <div class="relative w-14 h-14 rounded-full bg-gradient-to-br from-accent to-accent-2 flex items-center justify-center text-lg font-bold text-white ring-2 ring-accent/30">
                    {{ $initials }}
                </div>
            @endif
        </div>

        <div>
            <p class="font-semibold text-white mb-0.5">{{ $testimonial->client_name }}</p>
            @if($testimonial->client_role && $testimonial->client_company)
                <p class="text-sm text-text-muted">
                    {{ $testimonial->client_role }}
                    <span class="text-accent">@</span>
                    {{ $testimonial->client_company }}
                </p>
            @elseif($testimonial->client_company)
                <p class="text-sm text-text-muted flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    {{ $testimonial->client_company }}
                </p>
            @endif
        </div>

        {{-- Verified badge --}}
        @if($testimonial->is_featured ?? false)
            <div class="ml-auto">
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium bg-accent/10 text-accent rounded-full">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Verified
                </span>
            </div>
        @endif
    </div>

    {{-- Project attribution (if available) --}}
    @if($testimonial->project)
        <div class="mt-6 pt-6 border-t border-white/5">
            <a href="{{ route('portfolio.show', $testimonial->project->slug) }}" class="inline-flex items-center gap-2 text-sm text-text-muted hover:text-accent transition-colors group/link">
                <span class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                    @if($testimonial->project->thumbnail)
                        <img src="{{ $testimonial->project->thumbnail }}" alt="" class="w-full h-full rounded-lg object-cover">
                    @else
                        <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    @endif
                </span>
                <span>
                    Regarding: <span class="text-white group-hover/link:text-accent transition-colors">{{ $testimonial->project->title }}</span>
                </span>
            </a>
        </div>
    @endif
</article>
