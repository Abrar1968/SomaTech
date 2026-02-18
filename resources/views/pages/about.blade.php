<x-layouts.app>
    @php
        $seoTitle = 'About Us';
        $seoDescription = 'Learn about Somaticx - our mission, values, and the talented team behind our web and app development services.';
    @endphp

    {{-- Page Hero - SRS FR-009 --}}
    <section class="relative pt-40 pb-24 overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 right-0 w-[500px] h-[500px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-accent-2/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="container relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8">
                        <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                        <span class="text-sm font-medium text-text-muted">About Somaticx</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6 leading-tight">
                        We Are <span class="gradient-text">Somaticx</span>
                    </h1>
                    <p class="text-xl text-text-muted mb-8 leading-relaxed">
                        A passionate team of developers, designers, and digital strategists dedicated to transforming businesses through innovative technology solutions.
                    </p>

                    {{-- CTAs --}}
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contact.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Work With Us</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('portfolio.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-accent/50 hover:bg-accent/10 transition-all duration-300">
                            View Our Work
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Stats card --}}
                <div
                    class="relative"
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); transition-delay: 200ms;"
                >
                    <div class="relative aspect-square rounded-3xl overflow-hidden">
                        {{-- Background gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-accent via-accent/90 to-accent-2"></div>

                        {{-- Grid pattern --}}
                        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.5) 1px, transparent 0); background-size: 24px 24px;"></div>

                        {{-- Content --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-white text-center">
                            <div class="text-8xl md:text-9xl font-bold font-display mb-4" x-data="{ count: 0 }" x-intersect.once="const target = 5; const duration = 2000; const start = performance.now(); const update = (time) => { const progress = Math.min((time - start) / duration, 1); count = Math.floor(progress * target); if (progress < 1) requestAnimationFrame(update); }; requestAnimationFrame(update);">
                                <span x-text="count">0</span>+
                            </div>
                            <div class="text-xl md:text-2xl font-medium opacity-90">Years of Excellence</div>
                            <p class="mt-4 text-white/70 max-w-xs">Delivering exceptional digital experiences since 2019</p>
                        </div>
                    </div>

                    {{-- Floating badges --}}
                    <div class="absolute -top-4 -right-4 px-4 py-2 bg-[var(--color-bg-surface)] rounded-xl border border-white/10 shadow-xl">
                        <div class="text-2xl font-bold gradient-text">120+</div>
                        <div class="text-xs text-text-muted">Projects</div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 px-4 py-2 bg-[var(--color-bg-surface)] rounded-xl border border-white/10 shadow-xl">
                        <div class="text-2xl font-bold gradient-text">85+</div>
                        <div class="text-xs text-text-muted">Happy Clients</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Story Section --}}
    <section class="py-24 border-t border-white/5">
        <div class="container">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block px-4 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-medium mb-6">Our Story</span>
                <h2 class="text-3xl md:text-4xl font-bold font-display mb-8">
                    Building the <span class="gradient-text">Future</span> of Digital
                </h2>
                <p class="text-lg text-text-muted leading-relaxed mb-8">
                    Founded in 2019, Somaticx emerged from a simple belief: that every business deserves access to world-class digital solutions. What started as a small team of passionate developers has grown into a full-service digital agency, serving clients across industries and around the globe.
                </p>
                <p class="text-lg text-text-muted leading-relaxed">
                    Today, we combine cutting-edge technology with creative design to deliver solutions that don't just meet expectations — they exceed them. Our commitment to quality, innovation, and client success has made us a trusted partner for businesses seeking digital transformation.
                </p>
            </div>
        </div>
    </section>

    {{-- Our Values - SRS FR-012 --}}
    <section class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <x-section-heading
                badge="Core Values"
                title="What <span class='gradient-text'>Drives Us</span>"
                subtitle="The principles that guide everything we do"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'title' => 'Innovation', 'description' => 'We embrace new technologies and creative solutions to solve complex problems.', 'color' => 'accent'],
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Quality', 'description' => 'Every line of code, every pixel, every interaction is crafted with care and precision.', 'color' => 'accent-2'],
                    ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'title' => 'Collaboration', 'description' => 'We work closely with our clients as partners, not just service providers.', 'color' => 'accent'],
                    ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'title' => 'Results', 'description' => 'We focus on delivering measurable outcomes that drive real business growth.', 'color' => 'accent-2'],
                ] as $index => $value)
                    <div
                        class="value-card group relative text-center p-8 rounded-3xl bg-[var(--color-bg-primary)] border border-white/5 hover:border-{{ $value['color'] }}/30 transition-all duration-500"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        {{-- Glow --}}
                        <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-{{ $value['color'] }}/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        {{-- Icon --}}
                        <div class="relative w-16 h-16 mx-auto mb-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-accent to-accent-2 rounded-2xl rotate-6 group-hover:rotate-12 transition-transform duration-500"></div>
                            <div class="absolute inset-0 bg-[var(--color-bg-surface)] rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $value['icon'] }}"></path>
                                </svg>
                            </div>
                        </div>

                        <h3 class="relative text-xl font-bold font-display mb-3 group-hover:text-accent transition-colors">{{ $value['title'] }}</h3>
                        <p class="relative text-text-muted leading-relaxed">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Team Section - SRS FR-011 --}}
    <section class="py-24">
        <div class="container">
            <x-section-heading
                badge="The Team"
                title="Meet Our <span class='gradient-text'>Experts</span>"
                subtitle="The talented individuals who make it all happen"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($team ?? [] as $index => $member)
                    <x-team-card :member="$member" :index="$index" />
                @empty
                    @foreach([
                        ['name' => 'Alex Morgan', 'role' => 'Lead Developer', 'skills' => ['Laravel', 'Vue.js', 'AWS'], 'bio' => 'With over 8 years of experience in full-stack development, Alex leads our technical team with expertise in scalable architectures.'],
                        ['name' => 'Jamie Chen', 'role' => 'UI/UX Designer', 'skills' => ['Figma', 'Tailwind', 'Motion'], 'bio' => 'Jamie brings designs to life with a keen eye for detail and a deep understanding of user-centered design principles.'],
                        ['name' => 'Sam Wilson', 'role' => 'Mobile Developer', 'skills' => ['Flutter', 'Swift', 'Kotlin'], 'bio' => 'Sam specializes in cross-platform mobile development, creating seamless experiences across iOS and Android.'],
                        ['name' => 'Taylor Reed', 'role' => 'Project Manager', 'skills' => ['Agile', 'Scrum', 'Strategy'], 'bio' => 'Taylor ensures our projects run smoothly, keeping teams aligned and clients informed every step of the way.'],
                    ] as $index => $placeholder)
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
                                {{-- Front --}}
                                <div class="team-card-front absolute inset-0 backface-hidden rounded-3xl overflow-hidden border border-white/5">
                                    <div class="relative w-full h-full bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                        <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 24px 24px;"></div>
                                        <span class="text-7xl font-bold font-display gradient-text">{{ strtoupper(substr($placeholder['name'], 0, 1)) }}</span>
                                        <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-bg-primary)] via-transparent to-transparent"></div>
                                    </div>
                                    <div class="absolute bottom-0 left-0 right-0 p-6">
                                        <div class="absolute inset-0 backdrop-blur-sm bg-[var(--color-bg-primary)]/60 -z-10"></div>
                                        <h3 class="text-xl font-bold font-display mb-1 text-white">{{ $placeholder['name'] }}</h3>
                                        <p class="text-accent text-sm font-medium mb-3">{{ $placeholder['role'] }}</p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex gap-2">
                                                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white/60 hover:bg-accent/30 hover:text-accent transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                                </span>
                                                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white/60 hover:bg-accent/30 hover:text-accent transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                                </span>
                                            </div>
                                            <span class="text-xs text-text-muted">Tap for bio</span>
                                        </div>
                                    </div>
                                    <div class="absolute inset-2 rounded-2xl border border-accent/0 group-hover:border-accent/30 transition-all duration-500"></div>
                                </div>

                                {{-- Back --}}
                                <div class="team-card-back absolute inset-0 backface-hidden rotate-y-180 rounded-3xl overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-br from-accent via-accent/90 to-accent-2"></div>
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.5) 1px, transparent 0); background-size: 20px 20px;"></div>
                                    <div class="relative h-full p-6 flex flex-col">
                                        <div class="mb-4">
                                            <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-lg font-bold text-white mb-4">
                                                {{ strtoupper(substr($placeholder['name'], 0, 1)) }}
                                            </div>
                                            <h3 class="text-xl font-bold font-display text-white mb-1">{{ $placeholder['name'] }}</h3>
                                            <p class="text-white/80 text-sm font-medium">{{ $placeholder['role'] }}</p>
                                        </div>
                                        <p class="text-sm text-white/90 leading-relaxed mb-auto">{{ $placeholder['bio'] }}</p>
                                        <div class="mt-4">
                                            <p class="text-xs text-white/60 uppercase tracking-wider mb-2">Expertise</p>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($placeholder['skills'] as $skill)
                                                    <span class="text-xs px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white border border-white/10">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Workflow Section --}}
    <section class="py-24 bg-[var(--color-bg-surface)] relative overflow-hidden">
        <div class="container">
            <x-section-heading
                badge="Our Process"
                title="How We <span class='gradient-text'>Work</span>"
                subtitle="A proven methodology that delivers results"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['step' => '01', 'title' => 'Discovery', 'description' => 'We dive deep into your business goals, target audience, and requirements.'],
                    ['step' => '02', 'title' => 'Strategy', 'description' => 'We craft a tailored plan that aligns with your objectives and timeline.'],
                    ['step' => '03', 'title' => 'Execution', 'description' => 'Our team brings the vision to life with agile development practices.'],
                    ['step' => '04', 'title' => 'Launch & Support', 'description' => 'We deploy your solution and provide ongoing support for success.'],
                ] as $index => $step)
                    <div
                        class="relative"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 150 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        {{-- Connector line (not on last item) --}}
                        @if($index < 3)
                            <div class="hidden lg:block absolute top-10 left-1/2 w-full h-px bg-gradient-to-r from-accent/50 to-transparent"></div>
                        @endif

                        <div class="relative text-center p-6">
                            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center border border-white/10">
                                <span class="text-3xl font-bold gradient-text">{{ $step['step'] }}</span>
                            </div>
                            <h3 class="text-xl font-bold font-display mb-3">{{ $step['title'] }}</h3>
                            <p class="text-text-muted">{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24">
        <div class="container">
            <div
                class="relative rounded-[2.5rem] overflow-hidden"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                {{-- Background --}}
                <div class="absolute inset-0 bg-gradient-to-r from-accent/20 to-accent-2/20"></div>
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 32px 32px;"></div>
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-accent/30 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-accent-2/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

                {{-- Content --}}
                <div class="relative z-10 p-12 md:p-20 text-center">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-6">
                        Join Us on Our <span class="gradient-text">Journey</span>
                    </h2>
                    <p class="text-text-muted text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                        We're always looking for talented individuals to join our team. If you're passionate about technology and innovation, we'd love to hear from you.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Get in Touch</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('services.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-white/40 transition-colors">
                            View Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
