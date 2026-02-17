@props(['title', 'subtitle' => null, 'align' => 'center'])

<div class="mb-12 {{ $align === 'center' ? 'text-center' : 'text-left' }}" data-gsap="fade-up">
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-4">
        {!! $title !!}
    </h2>

    @if($subtitle)
        <p class="text-[var(--color-text-muted)] text-lg max-w-2xl {{ $align === 'center' ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif

    {{-- Decorative Line --}}
    <div class="mt-6 {{ $align === 'center' ? 'mx-auto' : '' }} w-24 h-1 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-full"></div>
</div>
