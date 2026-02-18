@props(['title', 'subtitle', 'ctas' => []])

<section class="relative min-h-screen flex items-center justify-center overflow-hidden" x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)">
    {{-- Animated Background Canvas --}}
    <canvas id="hero-canvas" class="absolute inset-0 z-0"></canvas>

    {{-- Animated gradient orbs --}}
    <div class="absolute inset-0 z-[1] overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-accent/30 rounded-full blur-[120px] animate-float">
        </div>
        <div class="absolute -bottom-40 -left-40 w-[400px] h-[400px] bg-accent-2/20 rounded-full blur-[100px] animate-float"
            style="animation-delay: -2s;"></div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-accent/10 to-accent-2/10 rounded-full blur-[80px] animate-pulse">
        </div>
    </div>

    {{-- Grid pattern overlay --}}
    <div class="absolute inset-0 z-[2] opacity-[0.03]"
        style="background-image: linear-gradient(var(--color-text) 1px, transparent 1px), linear-gradient(90deg, var(--color-text) 1px, transparent 1px); background-size: 60px 60px;">
    </div>

    {{-- Gradient Overlay --}}
    <div
        class="absolute inset-0 bg-gradient-to-b from-[var(--color-bg-primary)]/50 via-transparent to-[var(--color-bg-primary)] z-[3]">
    </div>

    {{-- Floating particles --}}
    <div class="absolute inset-0 z-[4] pointer-events-none overflow-hidden">
        @for ($i = 0; $i < 20; $i++)
            <div class="absolute w-1 h-1 bg-accent/50 rounded-full animate-float"
                style="
                    left: {{ rand(0, 100) }}%;
                    top: {{ rand(0, 100) }}%;
                    animation-duration: {{ rand(3, 6) }}s;
                    animation-delay: -{{ rand(0, 5) }}s;
                ">
            </div>
        @endfor
    </div>

    {{-- Content --}}
    <div class="container relative z-10 py-20">
        <div class="max-w-6xl mx-auto text-center">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm mb-8 transition-all duration-700"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-accent"></span>
                </span>
                <span class="text-sm text-text-muted">Available for new projects</span>
            </div>

            {{-- Animated Headline --}}
            <h1 id="hero-title"
                class="text-[clamp(2.5rem,7vw,5.5rem)] font-display font-bold leading-[1.1] mb-8 transition-all duration-1000 delay-100"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                {!! $title !!}
            </h1>

            {{-- Subtitle with typing effect --}}
            <p class="text-lg md:text-xl lg:text-2xl text-text-muted mb-12 max-w-3xl mx-auto leading-relaxed transition-all duration-1000 delay-200"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                {{ $subtitle }}
            </p>

            {{-- CTAs --}}
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center transition-all duration-1000 delay-300"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                @foreach ($ctas as $cta)
                    @if ($cta['primary'] ?? false)
                        <a href="{{ $cta['url'] }}"
                            class="group relative px-8 py-4 rounded-full text-white font-semibold overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-accent/25">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative flex items-center gap-2">
                                {{ $cta['text'] }}
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </a>
                    @else
                        <a href="{{ $cta['url'] }}"
                            class="group relative px-8 py-4 rounded-full font-semibold overflow-hidden transition-all duration-300 hover:scale-105">
                            <span
                                class="absolute inset-0 rounded-full border-2 border-white/20 group-hover:border-accent transition-colors duration-300"></span>
                            <span
                                class="absolute inset-0 rounded-full bg-white/0 group-hover:bg-white/5 transition-colors duration-300"></span>
                            <span class="relative flex items-center gap-2 text-white">
                                {{ $cta['text'] }}
                                <svg class="w-5 h-5 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Trust badges --}}
            <div class="mt-12 pt-12 border-t border-white/5 transition-all duration-1000 delay-500"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">
                <p class="text-sm text-text-muted mb-6">Trusted by innovative companies</p>
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12 opacity-50">
                    @foreach (['Google', 'Microsoft', 'Apple', 'Meta', 'Amazon'] as $company)
                        <span
                            class="text-lg font-semibold text-text-muted hover:text-white transition-colors">{{ $company }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center cursor-pointer group"
        onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
        <span
            class="text-[10px] text-text-muted uppercase tracking-[0.2em] mb-2 group-hover:text-accent transition-colors">Scroll</span>
        <div
            class="w-5 h-8 border-2 border-white/10 rounded-full flex justify-center pt-1.5 group-hover:border-accent/30 transition-colors">
            <div class="w-1 h-1.5 bg-accent rounded-full animate-bounce"></div>
        </div>
    </div>

    {{-- Side decorative lines --}}
    <div class="hidden lg:block absolute left-8 top-1/2 -translate-y-1/2 z-10">
        <div class="flex flex-col gap-4">
            @foreach ([1, 2, 3] as $i)
                <div class="w-8 h-px bg-gradient-to-r from-accent/50 to-transparent"></div>
            @endforeach
        </div>
    </div>
    <div class="hidden lg:block absolute right-8 top-1/2 -translate-y-1/2 z-10">
        <div class="flex flex-col gap-4">
            @foreach ([1, 2, 3] as $i)
                <div class="w-8 h-px bg-gradient-to-l from-accent-2/50 to-transparent"></div>
            @endforeach
        </div>
    </div>
</section>
