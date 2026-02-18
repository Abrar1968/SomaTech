<x-layouts.admin title="View Testimonial">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.testimonials.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold font-display">Testimonial Details</h1>
                    <p class="text-text-muted mt-1">From {{ $testimonial->client_name }}</p>
                </div>
            </div>
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Testimonial Card --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-8">
                    {{-- Rating --}}
                    <div class="flex gap-1 mb-6">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-6 h-6 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-white/10' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                        <span class="ml-2 text-text-muted">{{ $testimonial->rating }}/5</span>
                    </div>

                    {{-- Quote --}}
                    <div class="relative">
                        <svg class="absolute -top-2 -left-2 w-8 h-8 text-accent/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <blockquote class="text-lg leading-relaxed text-text-muted pl-8">
                            "{{ $testimonial->content }}"
                        </blockquote>
                    </div>

                    {{-- Client Info --}}
                    <div class="flex items-center gap-4 mt-8 pt-6 border-t border-white/5">
                        @if($testimonial->client_photo)
                            <img src="{{ Storage::url($testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" class="w-16 h-16 rounded-xl object-cover">
                        @else
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-accent to-accent-2 flex items-center justify-center">
                                <span class="text-xl font-bold text-white">{{ strtoupper(substr($testimonial->client_name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-lg">{{ $testimonial->client_name }}</p>
                            <p class="text-text-muted">
                                {{ $testimonial->client_role }}
                                @if($testimonial->client_company)
                                    at {{ $testimonial->client_company }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Related Project --}}
                @if($testimonial->project)
                    <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                        <h2 class="text-lg font-semibold mb-4">Related Project</h2>
                        <a href="{{ route('admin.projects.show', $testimonial->project) }}" class="flex items-center gap-4 p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-colors">
                            @if($testimonial->project->thumbnail)
                                <img src="{{ Storage::url($testimonial->project->thumbnail) }}" alt="{{ $testimonial->project->title }}" class="w-16 h-16 rounded-lg object-cover">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <p class="font-semibold">{{ $testimonial->project->title }}</p>
                                <p class="text-sm text-text-muted">{{ $testimonial->project->category->name ?? 'No category' }}</p>
                            </div>
                            <svg class="w-5 h-5 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Status --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Status</h2>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between py-3 border-b border-white/5">
                            <span class="text-text-muted">Featured</span>
                            <span class="px-2.5 py-1 text-xs rounded-full {{ $testimonial->is_featured ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : 'bg-gray-500/10 text-gray-400 border border-gray-500/20' }}">
                                {{ $testimonial->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-white/5">
                            <span class="text-text-muted">Sort Order</span>
                            <span>{{ $testimonial->sort_order }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-white/5">
                            <span class="text-text-muted">Rating</span>
                            <span>{{ $testimonial->rating }} stars</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-white/5">
                            <span class="text-text-muted">Created</span>
                            <span>{{ $testimonial->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between py-3">
                            <span class="text-text-muted">Last Updated</span>
                            <span>{{ $testimonial->updated_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
