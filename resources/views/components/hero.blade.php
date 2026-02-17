@props(['title', 'subtitle', 'ctas' => []])

<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Three.js Canvas Background - SRS FR-001 --}}
    <canvas id="hero-canvas" class="absolute inset-0 z-0"></canvas>

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-linear-to-b from-transparent via-[rgba(13,13,13,0.8)] to-bg-primary z-10"></div>

    {{-- Content --}}
    <div class="container relative z-20 text-center">
        {{-- Animated Headline - SRS 6.5.1 --}}
        <h1
            id="hero-title"
            class="text-[clamp(48px,8vw,96px)] font-display font-bold leading-tight mb-6"
            data-gsap="split-text"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitle --}}
        <p
            class="text-xl md:text-2xl text-text-muted mb-12 max-w-3xl mx-auto"
            data-gsap="fade-up"
            data-gsap-delay="0.4"
        >
            {{ $subtitle }}
        </p>

        {{-- CTAs - SRS FR-001 --}}
        <div
            class="flex flex-col sm:flex-row gap-4 justify-center"
            data-gsap="fade-up"
            data-gsap-delay="0.6"
        >
            @foreach($ctas as $cta)
                <a
                    href="{{ $cta['url'] }}"
                    class="px-8 py-4 {{ $cta['primary'] ?? false ? 'bg-linear-to-r from-accent to-accent-2 text-white' : 'border-2 border-accent text-white hover:bg-accent' }} rounded-full font-semibold hover:scale-105 transition-all magnetic-button"
                >
                    {{ $cta['text'] }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Scroll Indicator - SRS FR-002 --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center animate-bounce cursor-pointer" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
        <span class="text-sm text-text-muted mb-2">Scroll</span>
        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>
