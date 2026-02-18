<x-layouts.admin title="Testimonials">
    <div class="space-y-6" x-data="{ deleteModal: false, deleteId: null, deleteName: '' }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-display">Testimonials</h1>
                <p class="text-text-muted mt-1">Manage client testimonials and reviews</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Testimonial
            </a>
        </div>

        {{-- Grid --}}
        <div class="grid md:grid-cols-2 gap-6">
            @forelse($testimonials as $testimonial)
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 relative group {{ !$testimonial->is_featured ? 'opacity-80' : '' }}">
                    {{-- Featured Badge --}}
                    @if($testimonial->is_featured)
                        <div class="absolute top-4 right-4">
                            <span class="px-2 py-1 text-xs bg-amber-500/10 text-amber-400 rounded-lg border border-amber-500/20">Featured</span>
                        </div>
                    @endif

                    {{-- Rating --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-white/10' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Content --}}
                    <blockquote class="text-text-muted leading-relaxed mb-6 line-clamp-4">
                        "{{ $testimonial->content }}"
                    </blockquote>

                    {{-- Client Info --}}
                    <div class="flex items-center gap-4 pt-4 border-t border-white/5">
                        @if($testimonial->client_photo)
                            <img src="{{ Storage::url($testimonial->client_photo) }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-xl object-cover">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent/20 to-accent-2/20 flex items-center justify-center">
                                <span class="text-sm font-bold text-accent">{{ strtoupper(substr($testimonial->client_name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="font-semibold">{{ $testimonial->client_name }}</p>
                            <p class="text-sm text-text-muted">
                                {{ $testimonial->client_role }}
                                @if($testimonial->client_company)
                                    at {{ $testimonial->client_company }}
                                @endif
                            </p>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-2 rounded-lg hover:bg-accent/10 text-text-muted hover:text-accent transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button
                                @click="deleteModal = true; deleteId = {{ $testimonial->id }}; deleteName = '{{ addslashes($testimonial->client_name) }}'"
                                class="p-2 rounded-lg hover:bg-red-500/10 text-text-muted hover:text-red-400 transition-colors"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    @if($testimonial->project)
                        <div class="mt-4 pt-4 border-t border-white/5">
                            <p class="text-xs text-text-muted">
                                Related Project:
                                <a href="{{ route('admin.projects.show', $testimonial->project) }}" class="text-accent hover:text-accent-2">
                                    {{ $testimonial->project->title }}
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <p class="text-text-muted mb-2">No testimonials found</p>
                    <a href="{{ route('admin.testimonials.create') }}" class="text-accent hover:text-accent-2 transition-colors">Add your first testimonial</a>
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
                <h3 class="text-lg font-semibold text-center mb-2">Delete Testimonial</h3>
                <p class="text-text-muted text-center mb-6">Are you sure you want to delete <span x-text="deleteName" class="text-white"></span>'s testimonial? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="deleteModal = false" class="flex-1 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors font-medium">
                        Cancel
                    </button>
                    <form :action="'/admin/testimonials/' + deleteId" method="POST" class="flex-1">
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
