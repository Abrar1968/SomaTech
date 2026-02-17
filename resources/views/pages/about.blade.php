<x-layouts.app>
    @php
        $seoTitle = 'About Us';
        $seoDescription = 'Learn about Somaticx - our mission, values, and the talented team behind our web and app development services.';
    @endphp

    {{-- Page Hero - SRS FR-009 --}}
    <section class="pt-32 pb-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-gsap="fade-up">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6">
                        We Are <span class="gradient-text">Somaticx</span>
                    </h1>
                    <p class="text-xl text-[var(--color-text-muted)] mb-8">
                        A passionate team of developers, designers, and digital strategists dedicated to transforming businesses through innovative technology solutions.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact.index') }}" class="px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                            Work With Us
                        </a>
                        <a href="{{ route('portfolio.index') }}" class="px-8 py-4 border-2 border-[var(--color-accent)] text-white rounded-full font-semibold hover:bg-[var(--color-accent)] transition-colors">
                            View Our Work
                        </a>
                    </div>
                </div>
                <div class="relative" data-gsap="fade-up" data-gsap-delay="0.2">
                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center">
                        <div class="text-center text-white">
                            <div class="text-8xl font-bold mb-4">5+</div>
                            <div class="text-xl">Years of Excellence</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Values - SRS FR-012 --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container">
            <x-section-heading
                title="Our <span class='gradient-text'>Values</span>"
                subtitle="The principles that guide everything we do"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'title' => 'Innovation', 'description' => 'We embrace new technologies and creative solutions to solve complex problems.'],
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Quality', 'description' => 'Every line of code, every pixel, every interaction is crafted with care and precision.'],
                    ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'title' => 'Collaboration', 'description' => 'We work closely with our clients as partners, not just service providers.'],
                    ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'title' => 'Results', 'description' => 'We focus on delivering measurable outcomes that drive real business growth.'],
                ] as $value)
                    <div class="text-center p-8 glass rounded-2xl border border-[var(--color-border)]" data-gsap="fade-up">
                        <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">{{ $value['title'] }}</h3>
                        <p class="text-[var(--color-text-muted)]">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Team Section - SRS FR-011 --}}
    <section class="py-24">
        <div class="container">
            <x-section-heading
                title="Meet Our <span class='gradient-text'>Team</span>"
                subtitle="The talented individuals who make it all happen"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($team ?? [] as $member)
                    <x-team-card :member="$member" />
                @empty
                    @foreach([
                        ['name' => 'Alex Morgan', 'role' => 'Lead Developer', 'skills' => ['Laravel', 'Vue.js', 'AWS']],
                        ['name' => 'Jamie Chen', 'role' => 'UI/UX Designer', 'skills' => ['Figma', 'Tailwind', 'Motion']],
                        ['name' => 'Sam Wilson', 'role' => 'Mobile Developer', 'skills' => ['Flutter', 'Swift', 'Kotlin']],
                        ['name' => 'Taylor Reed', 'role' => 'Project Manager', 'skills' => ['Agile', 'Scrum', 'Strategy']],
                    ] as $placeholder)
                        <div class="team-card-container perspective-1000">
                            <div class="team-card relative w-full aspect-[3/4] transition-transform duration-600 preserve-3d">
                                <div class="team-card-front absolute inset-0 backface-hidden bg-[var(--color-bg-surface)] rounded-2xl border border-[var(--color-border)] overflow-hidden">
                                    <div class="w-full h-3/4 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center text-6xl font-bold text-white">
                                        {{ strtoupper(substr($placeholder['name'], 0, 1)) }}
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold mb-1">{{ $placeholder['name'] }}</h3>
                                        <p class="text-[var(--color-accent)] text-sm">{{ $placeholder['role'] }}</p>
                                    </div>
                                </div>
                                <div class="team-card-back absolute inset-0 backface-hidden rotate-y-180 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-2xl p-6 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-xl font-semibold mb-3 text-white">{{ $placeholder['name'] }}</h3>
                                        <p class="text-sm mb-4 text-white/90">Expert {{ $placeholder['role'] }} at Somaticx with years of experience delivering exceptional results.</p>
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($placeholder['skills'] as $skill)
                                                <span class="text-xs px-2 py-1 rounded bg-white/20 text-white">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex gap-4 text-white">
                                        <a href="#" class="hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                        </a>
                                        <a href="#" class="hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container text-center">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-6">
                Join Us on Our <span class="gradient-text">Journey</span>
            </h2>
            <p class="text-[var(--color-text-muted)] text-lg mb-8 max-w-2xl mx-auto">
                We're always looking for talented individuals to join our team. If you're passionate about technology and innovation, we'd love to hear from you.
            </p>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                Get in Touch
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>
</x-layouts.app>
