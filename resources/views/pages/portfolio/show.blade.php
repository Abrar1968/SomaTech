<x-layouts.app>
    @php
        $seoTitle = $project->title ?? 'Project Case Study';
        $seoDescription = $project->excerpt ?? 'Explore this project case study to see how Somaticx delivered exceptional results.';
    @endphp

    {{-- Hero Section --}}
    <section class="relative pt-40 pb-24 overflow-hidden">
        {{-- Background elements --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-accent-2/10 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.03) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="container relative">
            {{-- Breadcrumb --}}
            <x-breadcrumb :items="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Portfolio', 'url' => route('portfolio.index')],
                ['label' => $project->title ?? 'Project'],
            ]" />

            {{-- Hero Image --}}
            <div 
                class="mt-12 relative rounded-3xl overflow-hidden border border-white/10"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                @if(isset($project->featured_image) && $project->featured_image)
                    <img
                        src="{{ Storage::url($project->featured_image) }}"
                        alt="{{ $project->title ?? 'Project' }}"
                        class="w-full aspect-video object-cover"
                    >
                @else
                    <div class="w-full aspect-video bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                        <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 24px 24px;"></div>
                        <svg class="w-32 h-32 text-accent/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                
                {{-- Featured badge --}}
                @if(isset($project->is_featured) && $project->is_featured)
                    <div class="absolute top-6 left-6">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-accent/90 text-white text-sm font-semibold backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Featured
                        </span>
                    </div>
                @endif
                
                {{-- Category badge --}}
                @if(isset($project->category))
                    <div class="absolute top-6 right-6">
                        <span class="px-4 py-2 rounded-full bg-black/50 text-white text-sm font-medium backdrop-blur-sm border border-white/10">
                            {{ $project->category->name }}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Project Info --}}
    <section class="py-24">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                {{-- Main Content --}}
                <div 
                    class="lg:col-span-2"
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold font-display mb-6 leading-tight">
                        {{ $project->title ?? 'Project Title' }}
                    </h1>
                    <p class="text-xl text-text-muted leading-relaxed">
                        {{ $project->excerpt ?? 'A comprehensive case study showcasing our design and development process.' }}
                    </p>

                    {{-- Tech Stack --}}
                    @if(isset($project->technologies) && count($project->technologies) > 0)
                        <div class="mt-10">
                            <h3 class="text-sm font-semibold text-text-muted uppercase tracking-wider mb-4">Technologies Used</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($project->technologies as $tech)
                                    <x-tech-badge :technology="$tech" size="md" />
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-10">
                            <h3 class="text-sm font-semibold text-text-muted uppercase tracking-wider mb-4">Technologies Used</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach(['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Redis'] as $tech)
                                    <span class="px-4 py-2 rounded-xl text-sm font-medium bg-white/5 border border-white/10 text-white/80">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div 
                    class="space-y-8"
                    x-data="{ visible: false }"
                    x-intersect.once="setTimeout(() => visible = true, 200)"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    <div class="relative rounded-3xl overflow-hidden bg-[var(--color-bg-elevated)] border border-white/5">
                        <div class="h-2 bg-gradient-to-r from-accent to-accent-2"></div>
                        <div class="p-8 space-y-6">
                            @if(isset($project->client_name))
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-text-muted text-sm">Client</h3>
                                        <p class="font-semibold text-lg">{{ $project->client_name }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(isset($project->service) && $project->service)
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-text-muted text-sm">Service</h3>
                                        <p class="font-semibold text-lg">{{ $project->service->title }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(isset($project->completed_at))
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-text-muted text-sm">Completed</h3>
                                        <p class="font-semibold text-lg">{{ $project->completed_at->format('F Y') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(isset($project->live_url) && $project->live_url)
                                <div class="pt-4 border-t border-white/10">
                                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="group flex items-center justify-center gap-2 w-full py-4 rounded-xl font-semibold text-white bg-gradient-to-r from-accent to-accent-2 hover:shadow-lg hover:shadow-accent/25 transition-all duration-300">
                                        View Live Site
                                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Case Study Content --}}
    <section class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
        <div class="container">
            <div 
                class="max-w-4xl mx-auto"
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
            >
                <div class="prose prose-invert prose-lg max-w-none prose-p:text-text-muted prose-headings:font-display prose-h2:text-3xl prose-h2:mt-16 prose-h2:mb-6 prose-h3:text-2xl">
                    @if(isset($project->case_study))
                        {!! $project->case_study !!}
                    @else
                        <h2>The Challenge</h2>
                        <p>The client approached us with a need to modernize their digital presence and improve user engagement. Their existing platform was outdated, difficult to maintain, and didn't reflect their brand identity.</p>

                        <h2>Our Solution</h2>
                        <p>We designed and developed a completely new platform from the ground up, focusing on user experience, performance, and scalability. Our approach included comprehensive user research, iterative design, and agile development practices.</p>

                        <ul>
                            <li>Conducted in-depth user research and competitive analysis</li>
                            <li>Created a modern, responsive design system</li>
                            <li>Built a scalable backend architecture</li>
                            <li>Implemented robust testing and quality assurance</li>
                            <li>Deployed with CI/CD pipelines for continuous improvement</li>
                        </ul>

                        <h2>The Results</h2>
                        <p>The new platform exceeded all expectations, resulting in improved user engagement, reduced bounce rates, and increased conversions. The client was thrilled with the outcome and continues to work with us on ongoing improvements.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Results / Metrics --}}
    @php
        $metrics = $project->metrics ?? [
            ['value' => '+150%', 'label' => 'Traffic Increase'],
            ['value' => '3x', 'label' => 'Conversion Rate'],
            ['value' => '-40%', 'label' => 'Bounce Rate'],
            ['value' => '99.9%', 'label' => 'Uptime'],
        ];
    @endphp
    <section class="py-24">
        <div class="container">
            <x-section-heading
                badge="Impact"
                title="Project <span class='gradient-text'>Results</span>"
                subtitle="The measurable impact of our work"
            />

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($metrics as $index => $metric)
                    <div 
                        class="relative text-center p-8 rounded-3xl bg-[var(--color-bg-elevated)] border border-white/5 group hover:border-accent/20 transition-colors"
                        x-data="{ visible: false }"
                        x-intersect.once="setTimeout(() => visible = true, {{ $index * 100 }})"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);"
                    >
                        <div class="text-4xl md:text-5xl font-bold gradient-text mb-3">{{ $metric['value'] }}</div>
                        <p class="text-text-muted">{{ $metric['label'] }}</p>
                        
                        {{-- Decorative element --}}
                        <div class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-accent/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Project Gallery --}}
    @if(isset($project->gallery_images) && is_array($project->gallery_images) && count($project->gallery_images) > 0)
        <section class="py-24 bg-gradient-to-b from-[var(--color-bg-primary)] to-[var(--color-bg-surface)]">
            <div class="container">
                <x-section-heading
                    badge="Showcase"
                    title="Project <span class='gradient-text'>Gallery</span>"
                    subtitle="Visual highlights from this project"
                />

                <x-gallery :images="$project->gallery_images" />
            </div>
        </section>
    @endif

    {{-- Testimonial - SRS FR-007 --}}
    @if(isset($project->testimonial) && $project->testimonial)
        <section class="py-24">
            <div class="container">
                <div 
                    class="max-w-4xl mx-auto relative"
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                    style="transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);"
                >
                    {{-- Decorative quotes --}}
                    <div class="absolute -top-8 -left-4 text-accent/20">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    
                    <div class="relative p-12 rounded-3xl bg-[var(--color-bg-elevated)] border border-white/5">
                        <x-testimonial-card :testimonial="$project->testimonial" />
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Related Projects --}}
    @if(isset($relatedProjects) && $relatedProjects->count() > 0)
        <section class="py-24 bg-gradient-to-b from-[var(--color-bg-surface)] to-[var(--color-bg-primary)]">
            <div class="container">
                <x-section-heading
                    badge="More Work"
                    title="Related <span class='gradient-text'>Projects</span>"
                    subtitle="Explore more projects you might like"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $index => $relatedProject)
                        <x-project-card :project="$relatedProject" :index="$index" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                        Let's Create Something <span class="gradient-text">Amazing</span>
                    </h2>
                    <p class="text-text-muted text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                        Inspired by what you see? Let's discuss how we can help bring your project to life.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact.index') }}" class="group relative inline-flex items-center justify-center gap-2 px-8 py-4 overflow-hidden rounded-full font-semibold text-white transition-all duration-300">
                            <span class="absolute inset-0 bg-gradient-to-r from-accent to-accent-2"></span>
                            <span class="absolute inset-0 bg-gradient-to-r from-accent-2 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                            <span class="relative">Start Your Project</span>
                            <svg class="relative w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('portfolio.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full font-semibold text-white border-2 border-white/20 hover:border-white/40 transition-colors">
                            View More Work
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
