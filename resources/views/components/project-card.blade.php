@props(['project', 'featured' => false])

<article
    class="project-card group relative rounded-2xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5 hover:border-accent/30 transition-all duration-500"
    x-data="{ hovered: false }"
    @mouseenter="hovered = true"
    @mouseleave="hovered = false"
>
    {{-- Glow effect on hover --}}
    <div
        class="absolute -inset-px rounded-2xl bg-gradient-to-r from-accent/20 to-accent-2/20 opacity-0 blur-sm transition-opacity duration-500 -z-10"
        :class="hovered && 'opacity-100'"
    ></div>

    {{-- Thumbnail - SRS FR-019 --}}
    <div class="relative aspect-[16/10] overflow-hidden">
        {{-- Image with zoom effect --}}
        <img
            src="{{ $project->thumbnail ?? '/images/placeholder-project.jpg' }}"
            alt="{{ $project->title }}"
            loading="lazy"
            width="600"
            height="375"
            class="w-full h-full object-cover transition-transform duration-700 ease-out"
            :class="hovered && 'scale-110'"
        />

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent"></div>

        {{-- Top gradient for badge visibility --}}
        <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-black/50 to-transparent"></div>

        {{-- Category Badge - SRS FR-019 --}}
        @if($project->category)
            <div class="absolute top-4 left-4 z-10">
                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full bg-white/10 backdrop-blur-md text-white border border-white/10">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent mr-2 animate-pulse"></span>
                    {{ $project->category->name }}
                </span>
            </div>
        @endif

        {{-- Featured badge --}}
        @if($featured)
            <div class="absolute top-4 right-4 z-10">
                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full bg-gradient-to-r from-accent to-accent-2 text-white">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Featured
                </span>
            </div>
        @endif

        {{-- Hover overlay with action --}}
        <div
            class="absolute inset-0 flex items-center justify-center bg-gradient-to-t from-accent/90 via-accent/70 to-transparent transition-all duration-500"
            :class="hovered ? 'opacity-100' : 'opacity-0'"
        >
            <a
                href="{{ route('portfolio.show', $project->slug) }}"
                class="group/btn inline-flex items-center gap-3 px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 text-white font-semibold transition-all duration-300 hover:bg-white/20 hover:scale-105"
                :class="hovered ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
                style="transition-delay: 100ms;"
            >
                <span>View Case Study</span>
                <span class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20 group-hover/btn:bg-white/30 transition-colors">
                    <svg class="w-4 h-4 transform group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </span>
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-6">
        {{-- Project title with hover effect --}}
        <h3 class="text-xl font-bold font-display mb-3 transition-colors duration-300 line-clamp-1" :class="hovered && 'text-accent'">
            <a href="{{ route('portfolio.show', $project->slug) }}" class="hover:text-accent transition-colors">
                {{ $project->title }}
            </a>
        </h3>

        {{-- Description --}}
        <p class="text-text-muted text-sm leading-relaxed mb-5 line-clamp-2">
            {{ $project->short_description }}
        </p>

        {{-- Tech Stack --}}
        @if($project->tech_stack && is_array($project->tech_stack))
            <div class="flex flex-wrap gap-2">
                @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                    <span class="inline-flex items-center text-xs px-2.5 py-1 rounded-md bg-white/5 text-text-muted border border-white/5 transition-colors duration-300 hover:border-accent/30 hover:text-accent">
                        {{ $tech }}
                    </span>
                @endforeach
                @if(count($project->tech_stack) > 4)
                    <span class="inline-flex items-center text-xs px-2.5 py-1 rounded-md bg-accent/10 text-accent">
                        +{{ count($project->tech_stack) - 4 }}
                    </span>
                @endif
            </div>
        @endif

        {{-- Project meta info --}}
        <div class="flex items-center justify-between mt-5 pt-5 border-t border-white/5">
            @if($project->completed_at)
                <span class="text-xs text-text-muted flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ $project->completed_at->format('M Y') }}
                </span>
            @endif

            <a
                href="{{ route('portfolio.show', $project->slug) }}"
                class="inline-flex items-center gap-1.5 text-xs font-medium text-accent hover:text-accent-2 transition-colors group/link"
            >
                <span>Details</span>
                <svg class="w-3.5 h-3.5 transform group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</article>
