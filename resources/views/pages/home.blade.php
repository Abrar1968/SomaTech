<x-layouts.app>
    @php
        $seoTitle = null;
        $seoDescription = 'SomaTech specializes in Website Development & Maintenance and App Development. Transform your digital presence with our expert team.';
    @endphp

    {{-- Hero Section - SRS FR-001 --}}
    <x-hero
        title="We Build <span class='gradient-text'>Digital Excellence</span>"
        subtitle="SomaTech transforms your ideas into powerful web and mobile applications that drive business growth."
        :ctas="[
            ['text' => 'View Our Work', 'url' => route('portfolio.index'), 'primary' => true],
            ['text' => 'Start a Project', 'url' => route('contact.index'), 'primary' => false],
        ]"
    />

    {{-- Tech Marquee - SRS FR-003 --}}
    <section class="py-12 border-y border-[var(--color-border)] overflow-hidden">
        <div class="flex animate-marquee whitespace-nowrap">
            @foreach(['Laravel', 'React', 'Vue.js', 'Node.js', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'Swift', 'Kotlin', 'Flutter', 'AWS'] as $tech)
                <span class="mx-8 text-2xl font-semibold text-[var(--color-text-muted)] hover:text-[var(--color-accent)] transition-colors">{{ $tech }}</span>
            @endforeach
            @foreach(['Laravel', 'React', 'Vue.js', 'Node.js', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'Swift', 'Kotlin', 'Flutter', 'AWS'] as $tech)
                <span class="mx-8 text-2xl font-semibold text-[var(--color-text-muted)] hover:text-[var(--color-accent)] transition-colors">{{ $tech }}</span>
            @endforeach
        </div>
    </section>

    {{-- Services Section - SRS FR-004 --}}
    <section class="py-24">
        <div class="container">
            <x-section-heading
                title="Our <span class='gradient-text'>Services</span>"
                subtitle="We specialize in creating digital solutions that help businesses thrive in the modern world."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services ?? [] as $service)
                    <x-service-card :service="$service" />
                @empty
                    {{-- Placeholder cards when no data --}}
                    @foreach([
                        ['title' => 'Website Development', 'tagline' => 'Custom web solutions', 'description' => 'From simple landing pages to complex web applications, we build websites that perform.'],
                        ['title' => 'App Development', 'tagline' => 'Mobile-first approach', 'description' => 'Native and cross-platform mobile apps that deliver exceptional user experiences.'],
                        ['title' => 'Website Maintenance', 'tagline' => 'Keep it running smoothly', 'description' => 'Ongoing support, updates, and optimization to keep your digital presence at its best.'],
                    ] as $placeholder)
                        <div class="relative group p-8 glass rounded-2xl border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300">
                            <div class="w-16 h-16 mb-6 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold font-display mb-3">{{ $placeholder['title'] }}</h3>
                            <p class="text-[var(--color-accent)] text-sm mb-4">{{ $placeholder['tagline'] }}</p>
                            <p class="text-[var(--color-text-muted)] mb-6">{{ $placeholder['description'] }}</p>
                            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-[var(--color-accent)] hover:gap-4 transition-all">
                                Learn More
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Featured Projects Section - SRS FR-005 --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container">
            <x-section-heading
                title="Featured <span class='gradient-text'>Projects</span>"
                subtitle="Explore our latest work and see how we've helped businesses achieve their digital goals."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects ?? [] as $project)
                    <x-project-card :project="$project" />
                @empty
                    {{-- Placeholder when no projects --}}
                    @for($i = 0; $i < 6; $i++)
                        <div class="bg-[var(--color-bg-elevated)] rounded-xl overflow-hidden border border-[var(--color-border)] animate-pulse">
                            <div class="aspect-video bg-[var(--color-border)]"></div>
                            <div class="p-6">
                                <div class="h-6 bg-[var(--color-border)] rounded mb-2 w-3/4"></div>
                                <div class="h-4 bg-[var(--color-border)] rounded w-full"></div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-2 px-8 py-4 border-2 border-[var(--color-accent)] text-white rounded-full font-semibold hover:bg-[var(--color-accent)] transition-colors">
                    View All Projects
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Stats Section - SRS FR-006 --}}
    <section class="py-24">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @forelse($stats ?? [] as $stat)
                    <x-stat-counter :stat="$stat" />
                @empty
                    @foreach([
                        ['value' => 120, 'label' => 'Projects Delivered', 'suffix' => '+'],
                        ['value' => 85, 'label' => 'Happy Clients', 'suffix' => '+'],
                        ['value' => 5, 'label' => 'Years Experience', 'suffix' => '+'],
                        ['value' => 99, 'label' => 'Uptime Guarantee', 'suffix' => '%'],
                    ] as $placeholder)
                        <div class="text-center p-6" x-data="{ count: 0 }" x-intersect.once="
                            const target = {{ $placeholder['value'] }};
                            const duration = 2000;
                            const start = performance.now();
                            const update = (time) => {
                                const progress = Math.min((time - start) / duration, 1);
                                count = Math.floor(progress * target);
                                if (progress < 1) requestAnimationFrame(update);
                            };
                            requestAnimationFrame(update);
                        ">
                            <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2">
                                <span x-text="count">0</span>{{ $placeholder['suffix'] }}
                            </div>
                            <p class="text-[var(--color-text-muted)]">{{ $placeholder['label'] }}</p>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Testimonials Section - SRS FR-007 --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container">
            <x-section-heading
                title="What Our <span class='gradient-text'>Clients Say</span>"
                subtitle="Don't just take our word for it. Here's what our clients have to say about working with us."
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimonials ?? [] as $testimonial)
                    <x-testimonial-card :testimonial="$testimonial" />
                @empty
                    @foreach([
                        ['name' => 'John Smith', 'company' => 'TechCorp', 'role' => 'CEO', 'content' => 'SomaTech delivered an exceptional website that exceeded our expectations. Their attention to detail and technical expertise is unmatched.', 'rating' => 5],
                        ['name' => 'Sarah Johnson', 'company' => 'StartupXYZ', 'role' => 'Founder', 'content' => 'Working with SomaTech was a pleasure from start to finish. They understood our vision and brought it to life perfectly.', 'rating' => 5],
                        ['name' => 'Michael Chen', 'company' => 'InnovateCo', 'role' => 'CTO', 'content' => 'The mobile app SomaTech built for us has been a game-changer. Professional team, excellent communication, and outstanding results.', 'rating' => 5],
                    ] as $placeholder)
                        <div class="bg-[var(--color-bg-primary)] p-8 rounded-2xl border border-[var(--color-border)]">
                            <div class="flex gap-1 mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400 fill-yellow-400" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-[var(--color-text-muted)] mb-6 italic">"{{ $placeholder['content'] }}"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center font-semibold text-white">
                                    {{ strtoupper(substr($placeholder['name'], 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $placeholder['name'] }}</p>
                                    <p class="text-sm text-[var(--color-text-muted)]">{{ $placeholder['role'] }} at {{ $placeholder['company'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24">
        <div class="container">
            <div class="relative glass rounded-3xl p-12 md:p-16 text-center overflow-hidden">
                {{-- Background Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-r from-[var(--color-accent)]/20 to-[var(--color-accent-2)]/20"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold font-display mb-6">
                        Ready to Start Your <span class="gradient-text">Project</span>?
                    </h2>
                    <p class="text-[var(--color-text-muted)] text-lg mb-8 max-w-2xl mx-auto">
                        Let's discuss how we can help bring your vision to life. Get in touch today for a free consultation.
                    </p>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                        Get in Touch
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            animation: marquee 30s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
</x-layouts.app>
