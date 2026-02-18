<x-layouts.admin title="Add Testimonial">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.testimonials.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold font-display">Add Testimonial</h1>
                <p class="text-text-muted mt-1">Add a new client testimonial</p>
            </div>
        </div>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6">
            @csrf

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Client Info --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Client Information</h2>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="client_name" class="text-sm font-medium text-text-muted">Client Name *</label>
                            <input
                                type="text"
                                name="client_name"
                                id="client_name"
                                value="{{ old('client_name') }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="John Smith"
                                required
                            >
                            @error('client_name')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="client_role" class="text-sm font-medium text-text-muted">Role / Position</label>
                            <input
                                type="text"
                                name="client_role"
                                id="client_role"
                                value="{{ old('client_role') }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="CEO"
                            >
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="client_company" class="text-sm font-medium text-text-muted">Company</label>
                        <input
                            type="text"
                            name="client_company"
                            id="client_company"
                            value="{{ old('client_company') }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Acme Inc."
                        >
                    </div>
                </div>

                {{-- Testimonial Content --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Testimonial Content</h2>

                    <div class="space-y-2">
                        <label for="content" class="text-sm font-medium text-text-muted">Review Content *</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="5"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                            placeholder="What the client said about your work..."
                            required
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-text-muted">Rating *</label>
                        <div x-data="{ rating: {{ old('rating', 5) }} }" class="flex gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    @click="rating = {{ $i }}"
                                    :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-white/20 hover:text-white/40'"
                                    class="transition-colors"
                                >
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                            <input type="hidden" name="rating" x-model="rating">
                        </div>
                        @error('rating')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Settings --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Settings</h2>

                    <div class="space-y-2">
                        <label for="project_id" class="text-sm font-medium text-text-muted">Related Project</label>
                        <select
                            name="project_id"
                            id="project_id"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        >
                            <option value="">No project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="sort_order" class="text-sm font-medium text-text-muted">Sort Order</label>
                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            min="0"
                        >
                    </div>

                    <div class="flex items-center gap-3">
                        <input
                            type="checkbox"
                            name="is_featured"
                            id="is_featured"
                            value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="w-5 h-5 rounded bg-[var(--color-bg-primary)] border border-white/10 text-accent focus:ring-accent focus:ring-offset-0"
                        >
                        <label for="is_featured" class="text-sm font-medium">Featured Testimonial</label>
                    </div>

                    <button type="submit" class="w-full px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                        Add Testimonial
                    </button>
                </div>

                {{-- Client Photo --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Client Photo</h2>

                    <div
                        x-data="{ preview: null }"
                        class="space-y-3"
                    >
                        <div
                            class="relative aspect-square rounded-xl bg-[var(--color-bg-primary)] border-2 border-dashed border-white/10 hover:border-accent/50 transition-colors flex items-center justify-center overflow-hidden cursor-pointer"
                            @click="$refs.photo.click()"
                        >
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!preview">
                                <div class="text-center p-4">
                                    <svg class="w-8 h-8 mx-auto text-text-muted mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <p class="text-sm text-text-muted">Click to upload</p>
                                </div>
                            </template>
                        </div>
                        <input
                            type="file"
                            name="client_photo"
                            id="client_photo"
                            x-ref="photo"
                            accept="image/*"
                            class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])"
                        >
                        @error('client_photo')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>
