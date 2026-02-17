<x-layouts.app>
    @php
        $seoTitle = $project->title ?? 'Project Case Study';
        $seoDescription = $project->excerpt ?? 'Explore this project case study to see how Somaticx delivered exceptional results.';
    @endphp

    {{-- Breadcrumb --}}
    <div class="pt-32 pb-8">
        <div class="container">
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Portfolio', 'url' => route('portfolio.index')],
                ['label' => $project->title ?? 'Project'],
            ]" />
        </div>
    </div>

    {{-- Hero Image --}}
    <section class="pb-16">
        <div class="container">
            <div class="relative overflow-hidden rounded-2xl">
                @if(isset($project->featured_image) && $project->featured_image)
                    <img
                        src="{{ Storage::url($project->featured_image) }}"
                        alt="{{ $project->title ?? 'Project' }}"
                        class="w-full aspect-video object-cover"
                    >
                @else
                    <div class="w-full aspect-video bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Project Info --}}
    <section class="pb-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2" data-gsap="fade-up">
                    <h1 class="text-4xl md:text-5xl font-bold font-display mb-6">
                        {{ $project->title ?? 'Project Title' }}
                    </h1>
                    <p class="text-xl text-[var(--color-text-muted)]">
                        {{ $project->excerpt ?? 'A comprehensive case study showcasing our design and development process.' }}
                    </p>
                </div>

                <div class="space-y-6" data-gsap="fade-up" data-gsap-delay="0.2">
                    @if(isset($project->client_name))
                        <div>
                            <h3 class="text-[var(--color-text-muted)] text-sm mb-1">Client</h3>
                            <p class="font-semibold">{{ $project->client_name }}</p>
                        </div>
                    @endif

                    @if(isset($project->service))
                        <div>
                            <h3 class="text-[var(--color-text-muted)] text-sm mb-1">Service</h3>
                            <p class="font-semibold">{{ $project->service->title }}</p>
                        </div>
                    @endif

                    @if(isset($project->completed_at))
                        <div>
                            <h3 class="text-[var(--color-text-muted)] text-sm mb-1">Completed</h3>
                            <p class="font-semibold">{{ $project->completed_at->format('F Y') }}</p>
                        </div>
                    @endif

                    @if(isset($project->live_url) && $project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-lg font-semibold hover:scale-105 transition-transform">
                            View Live Site
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Tech Stack --}}
    @if(isset($project->technologies) && count($project->technologies) > 0)
        <section class="pb-16">
            <div class="container">
                <h2 class="text-2xl font-bold font-display mb-6">Technologies Used</h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($project->technologies as $tech)
                        <x-tech-badge :technology="$tech" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Case Study Content --}}
    <section class="py-16 bg-[var(--color-bg-surface)]">
        <div class="container">
            <div class="max-w-4xl mx-auto prose prose-invert prose-lg">
                @if(isset($project->case_study))
                    {!! $project->case_study !!}
                @else
                    <h2>The Challenge</h2>
                    <p>The client approached us with a need to modernize their digital presence and improve user engagement. Their existing platform was outdated, difficult to maintain, and didn't reflect their brand identity.</p>

                    <h2>Our Solution</h2>
                    <p>We designed and developed a completely new platform from the ground up, focusing on user experience, performance, and scalability. Our approach included comprehensive user research, iterative design, and agile development practices.</p>

                    <h2>The Results</h2>
                    <p>The new platform exceeded all expectations, resulting in improved user engagement, reduced bounce rates, and increased conversions. The client was thrilled with the outcome and continues to work with us on ongoing improvements.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Project Gallery --}}
    @if(isset($project->gallery_images) && is_array($project->gallery_images) && count($project->gallery_images) > 0)
        <section class="py-24">
            <div class="container">
                <x-section-heading
                    title="Project <span class='gradient-text'>Gallery</span>"
                    subtitle="Visual highlights from this project"
                />

                <x-gallery :images="$project->gallery_images" />
            </div>
        </section>
    @endif

    {{-- Results / Metrics --}}
    @if(isset($project->metrics) && is_array($project->metrics) && count($project->metrics) > 0)
        <section class="py-24 bg-[var(--color-bg-surface)]">
            <div class="container">
                <x-section-heading
                    title="Project <span class='gradient-text'>Results</span>"
                    subtitle="The impact we made"
                />

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($project->metrics as $metric)
                        <div class="text-center" data-gsap="fade-up">
                            <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">{{ $metric['value'] }}</div>
                            <p class="text-[var(--color-text-muted)]">{{ $metric['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Testimonial - SRS FR-007 --}}
    @if(isset($project->testimonial) && $project->testimonial)
        <section class="py-24">
            <div class="container">
                <div class="max-w-3xl mx-auto text-center">
                    <svg class="w-12 h-12 text-[var(--color-accent)] mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <x-testimonial-card :testimonial="$project->testimonial" />
                </div>
            </div>
        </section>
    @endif

    {{-- Related Projects --}}
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <section class="py-24 bg-[var(--color-bg-surface)]">
            <div class="container">
                <x-section-heading
                    title="Related <span class='gradient-text'>Projects</span>"
                    subtitle="More work you might like"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $relatedProject)
                        <x-project-card :project="$relatedProject" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA Section --}}
    <section class="py-24">
        <div class="container text-center">
            <h2 class="text-3xl md:text-4xl font-bold font-display mb-6">
                Let's Create Something <span class="gradient-text">Amazing</span>
            </h2>
            <p class="text-[var(--color-text-muted)] text-lg mb-8 max-w-2xl mx-auto">
                Inspired by what you see? Let's discuss how we can help bring your project to life.
            </p>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform">
                Start Your Project
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>
</x-layouts.app>
