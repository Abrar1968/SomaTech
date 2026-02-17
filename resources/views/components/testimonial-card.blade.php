@props(['testimonial'])

@php
    $initials = collect(explode(' ', $testimonial->client_name))
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<div class="bg-[var(--color-bg-surface)] p-8 rounded-2xl border border-[var(--color-border)]">
    {{-- Star Rating - SRS FR-007 --}}
    <div class="flex gap-1 mb-4">
        @for($i = 1; $i <= 5; $i++)
            <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
        @endfor
    </div>

    {{-- Content --}}
    <p class="text-[var(--color-text-muted)] mb-6 italic">
        "{{ $testimonial->content }}"
    </p>

    {{-- Client Info --}}
    <div class="flex items-center gap-4">
        @if($testimonial->client_photo)
            <img
                src="{{ $testimonial->client_photo }}"
                alt="{{ $testimonial->client_name }}"
                class="w-12 h-12 rounded-full object-cover"
            />
        @else
            {{-- Initials Avatar Fallback - SRS FR-007 --}}
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center font-semibold text-white">
                {{ $initials }}
            </div>
        @endif

        <div>
            <p class="font-semibold">{{ $testimonial->client_name }}</p>
            @if($testimonial->client_role && $testimonial->client_company)
                <p class="text-sm text-[var(--color-text-muted)]">
                    {{ $testimonial->client_role }} at {{ $testimonial->client_company }}
                </p>
            @elseif($testimonial->client_company)
                <p class="text-sm text-[var(--color-text-muted)]">
                    {{ $testimonial->client_company }}
                </p>
            @endif
        </div>
    </div>
</div>
