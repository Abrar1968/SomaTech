<x-layouts.app>
    @php
        $seoTitle = 'Our Services';
        $seoDescription = 'Explore SomaTech\'s professional web development, app development, and website maintenance services designed to help your business succeed.';
    @endphp

    {{-- Breadcrumb --}}
    <div class="pt-32 pb-8">
        <div class="container">
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Services'],
            ]" />
        </div>
    </div>

    {{-- Page Hero --}}
    <section class="pb-16">
        <div class="container">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6">
                    Our <span class="gradient-text">Services</span>
                </h1>
                <p class="text-xl text-[var(--color-text-muted)]">
                    We offer a comprehensive range of digital services to help businesses establish a strong online presence and achieve their goals.
                </p>
            </div>
        </div>
    </section>

    {{-- Services Grid - SRS FR-004 --}}
    <section class="pb-24">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse($services ?? [] as $service)
                    <div class="group relative glass rounded-2xl overflow-hidden border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300" data-gsap="fade-up">
                        {{-- Service Image --}}
                        @if($service->featured_image)
                            <div class="aspect-video overflow-hidden">
                                <img
                                    src="{{ Storage::url($service->featured_image) }}"
                                    alt="{{ $service->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                >
                            </div>
                        @else
                            <div class="aspect-video bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        @endif

                        {{-- Service Content --}}
                        <div class="p-8">
                            <h2 class="text-2xl font-bold font-display mb-2 group-hover:gradient-text transition-colors">
                                {{ $service->title }}
                            </h2>
                            <p class="text-[var(--color-accent)] text-sm mb-4">{{ $service->tagline }}</p>
                            <p class="text-[var(--color-text-muted)] mb-6 line-clamp-3">{{ $service->short_description }}</p>

                            <a href="{{ route('services.show', $service) }}" class="inline-flex items-center gap-2 text-[var(--color-accent)] font-semibold hover:gap-4 transition-all">
                                Learn More
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    {{-- Placeholder services when no data --}}
                    @foreach([
                        ['title' => 'Website Development', 'tagline' => 'Custom web solutions tailored to your needs', 'description' => 'From simple landing pages to complex web applications, we build responsive, performant websites using modern technologies like Laravel, Vue.js, and React.'],
                        ['title' => 'Mobile App Development', 'tagline' => 'Native and cross-platform mobile apps', 'description' => 'We create beautiful, high-performance mobile applications for iOS and Android using Flutter, Swift, and Kotlin.'],
                        ['title' => 'E-Commerce Solutions', 'tagline' => 'Online stores that convert', 'description' => 'Build your online store with our e-commerce solutions. We specialize in custom shopping experiences, payment integrations, and inventory management.'],
                        ['title' => 'Website Maintenance', 'tagline' => 'Keep your site running smoothly', 'description' => 'Our maintenance plans include regular updates, security patches, performance optimization, and 24/7 monitoring to ensure your website runs smoothly.'],
                    ] as $i => $placeholder)
                        <div class="group relative glass rounded-2xl overflow-hidden border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300" data-gsap="fade-up">
                            <div class="aspect-video bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="p-8">
                                <h2 class="text-2xl font-bold font-display mb-2 group-hover:gradient-text transition-colors">
                                    {{ $placeholder['title'] }}
                                </h2>
                                <p class="text-[var(--color-accent)] text-sm mb-4">{{ $placeholder['tagline'] }}</p>
                                <p class="text-[var(--color-text-muted)] mb-6">{{ $placeholder['description'] }}</p>
                                <a href="#" class="inline-flex items-center gap-2 text-[var(--color-accent)] font-semibold hover:gap-4 transition-all">
                                    Learn More
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    {{-- Process Section --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container">
            <x-section-heading
                title="Our <span class='gradient-text'>Process</span>"
                subtitle="How we deliver exceptional results"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['step' => '01', 'title' => 'Discovery', 'description' => 'We start by understanding your goals, target audience, and requirements through in-depth consultations.'],
                    ['step' => '02', 'title' => 'Design', 'description' => 'Our designers create stunning visuals and intuitive user experiences tailored to your brand.'],
                    ['step' => '03', 'title' => 'Development', 'description' => 'Our developers bring the designs to life using modern technologies and best practices.'],
                    ['step' => '04', 'title' => 'Launch', 'description' => 'We deploy your project and provide ongoing support to ensure continued success.'],
                ] as $process)
                    <div class="relative p-8 glass rounded-2xl border border-[var(--color-border)]" data-gsap="fade-up">
                        <div class="text-5xl font-bold gradient-text mb-4">{{ $process['step'] }}</div>
                        <h3 class="text-xl font-semibold mb-3">{{ $process['title'] }}</h3>
                        <p class="text-[var(--color-text-muted)]">{{ $process['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24">
        <div class="container text-center">
            <h2 class="text-3xl md:text-4xl font-bold font-display mb-6">
                Ready to Get <span class="gradient-text">Started</span>?
            </h2>
            <p class="text-[var(--color-text-muted)] text-lg mb-8 max-w-2xl mx-auto">
                Let's discuss your project and see how we can help you achieve your goals.
            </p>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                Contact Us
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>
</x-layouts.app>
