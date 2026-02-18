<x-layouts.admin title="View Team Member">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.team.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold font-display">{{ $teamMember->name }}</h1>
                    <p class="text-text-muted mt-1">{{ $teamMember->role }}</p>
                </div>
            </div>
            <a href="{{ route('admin.team.edit', $teamMember) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Profile Card --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 overflow-hidden">
                    <div class="aspect-[3/1] bg-gradient-to-r from-accent/20 to-accent-2/20 relative">
                        <div class="absolute -bottom-12 left-6">
                            @if($teamMember->photo)
                                <img src="{{ Storage::url($teamMember->photo) }}" alt="{{ $teamMember->name }}" class="w-24 h-24 rounded-2xl object-cover ring-4 ring-[var(--color-bg-surface)]">
                            @else
                                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-accent to-accent-2 flex items-center justify-center ring-4 ring-[var(--color-bg-surface)]">
                                    <span class="text-2xl font-bold text-white">{{ $teamMember->initials }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="pt-16 pb-6 px-6">
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-xl font-semibold">{{ $teamMember->name }}</h2>
                                <p class="text-accent">{{ $teamMember->role }}</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs rounded-full {{ $teamMember->is_active ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-gray-500/10 text-gray-400 border border-gray-500/20' }}">
                                {{ $teamMember->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        @if($teamMember->bio)
                            <p class="text-text-muted mt-4 leading-relaxed">{{ $teamMember->bio }}</p>
                        @endif
                    </div>
                </div>

                {{-- Skills --}}
                @if($teamMember->skills && count($teamMember->skills) > 0)
                    <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                        <h2 class="text-lg font-semibold">Skills</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($teamMember->skills as $skill)
                                <span class="px-3 py-1.5 bg-accent/10 text-accent rounded-lg text-sm border border-accent/20">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Social Links --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Social Links</h2>

                    <div class="space-y-3">
                        @if($teamMember->linkedin_url)
                            <a href="{{ $teamMember->linkedin_url }}" target="_blank" class="flex items-center gap-3 p-3 bg-white/5 rounded-xl hover:bg-white/10 transition-colors group">
                                <div class="w-10 h-10 rounded-lg bg-[#0A66C2]/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#0A66C2]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium">LinkedIn</p>
                                    <p class="text-sm text-text-muted truncate">{{ $teamMember->linkedin_url }}</p>
                                </div>
                                <svg class="w-5 h-5 text-text-muted group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        @endif

                        @if($teamMember->github_url)
                            <a href="{{ $teamMember->github_url }}" target="_blank" class="flex items-center gap-3 p-3 bg-white/5 rounded-xl hover:bg-white/10 transition-colors group">
                                <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium">GitHub</p>
                                    <p class="text-sm text-text-muted truncate">{{ $teamMember->github_url }}</p>
                                </div>
                                <svg class="w-5 h-5 text-text-muted group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        @endif

                        @if(!$teamMember->linkedin_url && !$teamMember->github_url)
                            <p class="text-text-muted text-sm">No social links added.</p>
                        @endif
                    </div>
                </div>

                {{-- Details --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-4">
                    <h2 class="text-lg font-semibold">Details</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-text-muted">Sort Order</span>
                            <span>{{ $teamMember->sort_order }}</span>
                        </div>
                        <div class="flex justify-between py-2 border-b border-white/5">
                            <span class="text-text-muted">Created</span>
                            <span>{{ $teamMember->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-text-muted">Last Updated</span>
                            <span>{{ $teamMember->updated_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
