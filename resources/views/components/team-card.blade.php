@props(['member', 'index' => 0])

@php
    $initials = collect(explode(' ', $member->name))
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<div 
    class="team-card-container perspective-1000 group"
    x-data="{ flipped: false, visible: false }"
    x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
    @click="flipped = !flipped"
>
    <div 
        class="team-card relative w-full aspect-[3/4] transition-transform duration-700 preserve-3d cursor-pointer"
        :class="flipped && 'rotate-y-180'"
    >
        {{-- Front Face --}}
        <div class="team-card-front absolute inset-0 backface-hidden rounded-3xl overflow-hidden border border-white/5">
            {{-- Photo or gradient background --}}
            @if($member->photo)
                <div class="relative w-full h-full">
                    <img
                        src="{{ $member->photo }}"
                        alt="{{ $member->name }}"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy"
                    />
                    {{-- Gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-[var(--color-bg-primary)]/50 to-transparent"></div>
                </div>
            @else
                <div class="relative w-full h-full bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                    {{-- Grid pattern --}}
                    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                    <span class="text-7xl font-bold font-display gradient-text">{{ $initials }}</span>
                    {{-- Gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent"></div>
                </div>
            @endif

            {{-- Content overlay at bottom --}}
            <div class="absolute bottom-0 left-0 right-0 p-6">
                {{-- Blur backdrop --}}
                <div class="absolute inset-0 backdrop-blur-sm bg-[var(--color-bg-primary)]/60 -z-10"></div>
                
                <h3 class="text-xl font-bold font-display mb-1 text-white">{{ $member->name }}</h3>
                <p class="text-accent text-sm font-medium mb-4">{{ $member->role }}</p>

                {{-- Quick social links --}}
                <div class="flex items-center justify-between">
                    <div class="flex gap-3">
                        @if($member->linkedin_url)
                            <a 
                                href="{{ $member->linkedin_url }}" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-9 h-9 rounded-full bg-white/10 hover:bg-accent/30 flex items-center justify-center text-white hover:text-accent transition-all duration-300"
                                aria-label="LinkedIn profile"
                                @click.stop
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        @endif

                        @if($member->github_url)
                            <a 
                                href="{{ $member->github_url }}" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-9 h-9 rounded-full bg-white/10 hover:bg-accent/30 flex items-center justify-center text-white hover:text-accent transition-all duration-300"
                                aria-label="GitHub profile"
                                @click.stop
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                    
                    {{-- Tap to flip hint --}}
                    <span class="text-xs text-text-muted flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <span class="hidden sm:inline">Tap for bio</span>
                    </span>
                </div>
            </div>

            {{-- Decorative ring on hover --}}
            <div class="absolute inset-2 rounded-2xl border border-accent/0 group-hover:border-accent/30 transition-all duration-500"></div>
        </div>

        {{-- Back Face - SRS FR-011 --}}
        <div class="team-card-back absolute inset-0 backface-hidden rotate-y-180 rounded-3xl overflow-hidden">
            {{-- Background gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-accent via-accent/90 to-accent-2"></div>
            
            {{-- Grid pattern overlay --}}
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.5) 1px, transparent 0); background-size: 20px 20px;"></div>

            {{-- Content --}}
            <div class="relative h-full p-6 flex flex-col">
                {{-- Header --}}
                <div class="mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-xl font-bold text-white mb-4">
                        {{ $initials }}
                    </div>
                    <h3 class="text-2xl font-bold font-display text-white mb-1">{{ $member->name }}</h3>
                    <p class="text-white/80 text-sm font-medium">{{ $member->role }}</p>
                </div>

                {{-- Bio --}}
                <p class="text-sm text-white/90 leading-relaxed mb-6 flex-grow line-clamp-4">
                    {{ $member->bio ?? 'Passionate ' . $member->role . ' at Somaticx, dedicated to creating exceptional digital experiences and helping businesses succeed online.' }}
                </p>

                {{-- Skills --}}
                @if($member->skills && is_array($member->skills))
                    <div class="mb-6">
                        <p class="text-xs text-white/60 uppercase tracking-wider mb-2">Expertise</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(array_slice($member->skills, 0, 4) as $skill)
                                <span class="text-xs px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white border border-white/10">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Social Links & Connect button --}}
                <div class="flex items-center justify-between pt-4 border-t border-white/20">
                    <div class="flex gap-3">
                        @if($member->linkedin_url)
                            <a 
                                href="{{ $member->linkedin_url }}" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all duration-300 hover:scale-110"
                                aria-label="LinkedIn profile"
                                @click.stop
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        @endif

                        @if($member->github_url)
                            <a 
                                href="{{ $member->github_url }}" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all duration-300 hover:scale-110"
                                aria-label="GitHub profile"
                                @click.stop
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                    
                    {{-- Tap to flip back hint --}}
                    <span class="text-xs text-white/60 flex items-center gap-1.5">
                        <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                        Tap to flip
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
