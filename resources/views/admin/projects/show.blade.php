<x-layouts.admin title="View Project">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.projects.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold font-display">{{ $project->title }}</h1>
                    <div class="flex items-center gap-3 mt-1">
                        @php
                            $statusStyles = [
                                'draft' => 'bg-gray-500/10 text-gray-400 border-gray-500/20',
                                'published' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                'featured' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                            ];
                        @endphp
                        <span class="px-2.5 py-1 text-xs rounded-full border {{ $statusStyles[$project->status] ?? $statusStyles['draft'] }}">
                            {{ ucfirst($project->status) }}
                        </span>
                        <span class="text-text-muted text-sm">Created {{ $project->created_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('portfolio.show', $project->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View Live
                </a>
                <a href="{{ route('admin.projects.edit', $project) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Thumbnail --}}
                @if($project->thumbnail)
                    <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 overflow-hidden">
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->title }}" class="w-full aspect-video object-cover">
                    </div>
                @endif

                {{-- Description --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Description</h2>
                    <p class="text-text-muted leading-relaxed">{{ $project->short_description }}</p>
                    <div class="prose prose-invert max-w-none text-text-muted">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                {{-- Gallery --}}
                @if($project->gallery && count($project->gallery) > 0)
                    <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                        <h2 class="text-lg font-semibold">Gallery</h2>
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach($project->gallery as $image)
                                <a href="{{ Storage::url($image) }}" target="_blank" class="block aspect-video rounded-xl overflow-hidden hover:ring-2 hover:ring-accent transition-all">
                                    <img src="{{ Storage::url($image) }}" alt="Gallery image" class="w-full h-full object-cover">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Tech Stack --}}
                @if($project->tech_stack && count($project->tech_stack) > 0)
                    <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                        <h2 class="text-lg font-semibold">Technologies Used</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tech_stack as $tech)
                                <span class="px-3 py-1.5 bg-accent/10 text-accent rounded-lg text-sm border border-accent/20">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Project Info --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Project Details</h2>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b border-white/5">
                            <span class="text-text-muted">Category</span>
                            <span class="px-2.5 py-1 text-xs rounded-full bg-white/5">{{ $project->category->name ?? 'Uncategorized' }}</span>
                        </div>

                        @if($project->client_name)
                            <div class="flex items-center justify-between py-3 border-b border-white/5">
                                <span class="text-text-muted">Client</span>
                                <span>{{ $project->client_name }}</span>
                            </div>
                        @endif

                        @if($project->start_date || $project->end_date)
                            <div class="flex items-center justify-between py-3 border-b border-white/5">
                                <span class="text-text-muted">Duration</span>
                                <span>
                                    {{ $project->start_date?->format('M Y') ?? '?' }}
                                    -
                                    {{ $project->end_date?->format('M Y') ?? 'Present' }}
                                </span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between py-3 border-b border-white/5">
                            <span class="text-text-muted">Sort Order</span>
                            <span>{{ $project->sort_order }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3">
                            <span class="text-text-muted">Last Updated</span>
                            <span>{{ $project->updated_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Links --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Links</h2>

                    <div class="space-y-3">
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="flex items-center gap-3 px-4 py-3 bg-white/5 rounded-xl hover:bg-white/10 transition-colors group">
                                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium">Live Website</p>
                                    <p class="text-sm text-text-muted truncate">{{ $project->project_url }}</p>
                                </div>
                                <svg class="w-5 h-5 text-text-muted group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        @endif

                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-3 px-4 py-3 bg-white/5 rounded-xl hover:bg-white/10 transition-colors group">
                                <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium">GitHub Repository</p>
                                    <p class="text-sm text-text-muted truncate">{{ $project->github_url }}</p>
                                </div>
                                <svg class="w-5 h-5 text-text-muted group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        @endif

                        @if(!$project->project_url && !$project->github_url)
                            <p class="text-text-muted text-sm">No external links added.</p>
                        @endif
                    </div>
                </div>

                {{-- SEO --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">SEO</h2>

                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-text-muted mb-1">Meta Title</p>
                            <p>{{ $project->meta_title ?: 'Using default' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-text-muted mb-1">Meta Description</p>
                            <p class="text-sm">{{ $project->meta_description ?: 'Using default' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
