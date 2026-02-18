<x-layouts.admin title="Team Members">
    <div class="space-y-6" x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-display">Team Members</h1>
                <p class="text-text-muted mt-1">Manage your team members</p>
            </div>
            <a href="{{ route('admin.team.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Member
            </a>
        </div>

        {{-- Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($members as $member)
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 overflow-hidden group {{ !$member->is_active ? 'opacity-60' : '' }}">
                    {{-- Photo --}}
                    <div class="aspect-[4/3] bg-gradient-to-br from-accent/10 to-accent-2/10 relative">
                        @if($member->photo)
                            <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="text-4xl font-bold text-accent/50">{{ $member->initials }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.team.edit', $member) }}" class="p-2 rounded-lg bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <button
                                    @click="deleteModal = true; deleteId = {{ $member->id }}; deleteName = '{{ addslashes($member->name) }}'"
                                    class="p-2 rounded-lg bg-red-500/20 backdrop-blur-sm hover:bg-red-500/30 transition-colors text-red-300"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @if(!$member->is_active)
                            <div class="absolute top-3 right-3">
                                <span class="px-2 py-1 text-xs bg-gray-500/80 rounded-lg">Inactive</span>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-5">
                        <h3 class="font-semibold text-lg">{{ $member->name }}</h3>
                        <p class="text-accent text-sm">{{ $member->role }}</p>

                        @if($member->bio)
                            <p class="text-text-muted text-sm mt-3 line-clamp-2">{{ $member->bio }}</p>
                        @endif

                        {{-- Social Links --}}
                        <div class="flex items-center gap-3 mt-4 pt-4 border-t border-white/5">
                            @if($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 transition-colors text-text-muted hover:text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($member->github_url)
                                <a href="{{ $member->github_url }}" target="_blank" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 transition-colors text-text-muted hover:text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path>
                                    </svg>
                                </a>
                            @endif
                            <span class="text-xs text-text-muted ml-auto">Order: {{ $member->sort_order }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="text-text-muted mb-2">No team members found</p>
                    <a href="{{ route('admin.team.create') }}" class="text-accent hover:text-accent-2 transition-colors">Add your first team member</a>
                </div>
            @endforelse
        </div>

        {{-- Delete Modal --}}
        <div
            x-show="deleteModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            x-cloak
        >
            <div
                @click.outside="deleteModal = false"
                x-show="deleteModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 max-w-md w-full"
            >
                <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-center mb-2">Delete Team Member</h3>
                <p class="text-text-muted text-center mb-6">Are you sure you want to delete "<span x-text="deleteName" class="text-white"></span>"? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="deleteModal = false" class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors font-medium">
                        Cancel
                    </button>
                    <form :action="'/admin/team/' + deleteId" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
