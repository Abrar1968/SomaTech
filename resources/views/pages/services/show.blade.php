<x-layouts.app>
    @php
        $seoTitle = $service->title ?? 'Service';
        $seoDescription = $service->short_description ?? 'Learn more about our professional service offerings.';
    @endphp

    {{-- Breadcrumb --}}
    <div class="pt-32 pb-8">
        <div class="container">
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Services', 'url' => route('services.index')],
                ['label' => $service->title ?? 'Service'],
            ]" />
        </div>
    </div>

    {{-- Page Hero --}}
    <section class="pb-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-gsap="fade-up">
                    @if(isset($service->icon_svg))
                        <div class="w-20 h-20 mb-6 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-2xl flex items-center justify-center">
                            {!! $service->icon_svg !!}
                        </div>
                    @else
                        <div class="w-20 h-20 mb-6 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    @endif

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-4">
                        {{ $service->title ?? 'Service Title' }}
                    </h1>
                    <p class="text-xl text-[var(--color-accent)] mb-6">{{ $service->tagline ?? 'Expert digital solutions' }}</p>
                    <p class="text-lg text-[var(--color-text-muted)] mb-8">
                        {{ $service->short_description ?? 'We provide professional services to help your business succeed in the digital world.' }}
                    </p>
                    <a href="{{ route('contact.index') }}?service={{ $service->slug ?? '' }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                        Request This Service
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="relative" data-gsap="fade-up" data-gsap-delay="0.2">
                    @if(isset($service->featured_image) && $service->featured_image)
                        <img
                            src="{{ Storage::url($service->featured_image) }}"
                            alt="{{ $service->title ?? 'Service' }}"
                            class="w-full rounded-2xl shadow-xl"
                        >
                    @else
                        <div class="aspect-video rounded-2xl bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center">
                            <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Service Content --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2" data-gsap="fade-up">
                    <div class="prose prose-invert prose-lg max-w-none">
                        {!! $service->full_description ?? '<p>Our comprehensive service offering includes everything you need to succeed in the digital landscape. We work closely with you to understand your unique requirements and deliver solutions that exceed expectations.</p>' !!}
                    </div>

                    {{-- Features List --}}
                    @if(isset($service->features) && is_array($service->features))
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold font-display mb-6">What's Included</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($service->features as $feature)
                                    <div class="flex items-start gap-3 p-4 glass rounded-lg">
                                        <svg class="w-6 h-6 text-[var(--color-accent)] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8" data-gsap="fade-up" data-gsap-delay="0.2">
                    {{-- Quick Info Box --}}
                    <div class="glass rounded-2xl p-6 border border-[var(--color-border)]">
                        <h3 class="text-xl font-semibold mb-4">Quick Info</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-[var(--color-text-muted)] text-sm">Timeline</dt>
                                <dd class="font-semibold">{{ $service->timeline ?? '2-4 weeks' }}</dd>
                            </div>
                            <div>
                                <dt class="text-[var(--color-text-muted)] text-sm">Starting From</dt>
                                <dd class="font-semibold gradient-text">{{ $service->price_range ?? 'Contact for Quote' }}</dd>
                            </div>
                            <div>
                                <dt class="text-[var(--color-text-muted)] text-sm">Support</dt>
                                <dd class="font-semibold">{{ $service->support ?? 'Ongoing Maintenance' }}</dd>
                            </div>
                        </dl>
                    </div>

                    {{-- CTA Box --}}
                    <div class="glass rounded-2xl p-6 border border-[var(--color-border)]">
                        <h3 class="text-xl font-semibold mb-3">Interested?</h3>
                        <p class="text-[var(--color-text-muted)] mb-4">Let's discuss how this service can benefit your business.</p>
                        <a href="{{ route('contact.index') }}?service={{ $service->slug ?? '' }}" class="block w-full px-6 py-3 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-lg font-semibold text-center hover:scale-105 transition-transform">
                            Get a Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Projects --}}
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <section class="py-24">
            <div class="container">
                <x-section-heading
                    title="Related <span class='gradient-text'>Projects</span>"
                    subtitle="See how we've helped other clients with similar services"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-24 bg-[var(--color-bg-surface)]">
        <div class="container text-center">
            <h2 class="text-3xl md:text-4xl font-bold font-display mb-6">
                Ready to Get <span class="gradient-text">Started</span>?
            </h2>
            <p class="text-[var(--color-text-muted)] text-lg mb-8 max-w-2xl mx-auto">
                Contact us today for a free consultation and let's bring your project to life.
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
