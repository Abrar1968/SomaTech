@props(['project'])

<div
    class="group relative bg-[var(--color-bg-surface)] rounded-xl overflow-hidden border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300"
    data-tilt
    data-tilt-max="8"
    data-tilt-speed="400"
    data-tilt-glare="true"
    data-tilt-max-glare="0.1"
>
    {{-- Thumbnail - SRS FR-019 --}}
    <div class="relative aspect-video overflow-hidden">
        <img
            src="{{ $project->thumbnail ?? '/images/placeholder-project.jpg' }}"
            alt="{{ $project->title }}"
            loading="lazy"
            width="600"
            height="400"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        />

        {{-- Category Badge - SRS FR-019 --}}
        @if($project->category)
            <div class="absolute top-4 left-4">
                <x-tech-badge :name="$project->category->name" />
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-6">
        <h3 class="text-xl font-semibold mb-2 group-hover:text-[var(--color-accent)] transition-colors">
            {{ $project->title }}
        </h3>
        <p class="text-[var(--color-text-muted)] text-sm mb-4 line-clamp-2">
            {{ $project->short_description }}
        </p>

        {{-- Tech Stack --}}
        @if($project->tech_stack && is_array($project->tech_stack))
            <div class="flex flex-wrap gap-2">
                @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                    <span class="text-xs px-2 py-1 rounded bg-[var(--color-bg-elevated)] text-[var(--color-text-muted)]">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Hover Overlay - SRS FR-005 --}}
    <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-accent)] to-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex items-end justify-center pb-8">
        <a
            href="{{ route('portfolio.show', $project->slug) }}"
            class="text-white font-semibold flex items-center gap-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
        >
            View Case Study
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>
</div>
