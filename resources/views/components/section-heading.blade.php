@props(['title', 'subtitle' => null, 'badge' => null, 'align' => 'center'])

<div class="mb-16 {{ $align === 'center' ? 'text-center' : 'text-left' }}" x-data="{ visible: false }"
    x-intersect.once.threshold.10="visible = true">
    {{-- Badge/Eyebrow text --}}
    @if ($badge)
        <div class="inline-flex items-center gap-2 px-4 py-2 mb-6 rounded-full bg-accent/10 border border-accent/20 transition-all duration-700"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
            <span class="text-sm font-medium text-accent">{{ $badge }}</span>
        </div>
    @else
        {{-- Decorative top line --}}
        <div class="flex items-center gap-4 mb-6 {{ $align === 'center' ? 'justify-center' : '' }} transition-all duration-700"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="w-12 h-px bg-gradient-to-r from-transparent to-accent"></span>
            <span class="w-2 h-2 rounded-full bg-accent"></span>
            <span class="w-12 h-px bg-gradient-to-l from-transparent to-accent"></span>
        </div>
    @endif

    {{-- Main Title --}}
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-6 leading-tight transition-all duration-700 delay-100"
        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
        {!! $title !!}
    </h2>

    {{-- Subtitle --}}
    @if ($subtitle)
        <p class="text-text-muted text-lg md:text-xl max-w-3xl leading-relaxed {{ $align === 'center' ? 'mx-auto' : '' }} transition-all duration-700 delay-200"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            {{ $subtitle }}
        </p>
    @endif

    {{-- Animated underline --}}
    <div class="mt-8 {{ $align === 'center' ? 'mx-auto' : '' }} overflow-hidden transition-all duration-700 delay-300"
        :class="visible ? 'opacity-100' : 'opacity-0'">
        <div class="h-1 bg-gradient-to-r from-accent via-accent-2 to-accent rounded-full transition-all duration-1000 delay-500"
            :class="visible ? 'w-24' : 'w-0'"></div>
    </div>
</div>
