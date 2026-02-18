<x-layouts.admin title="Edit Service">
    <div class="space-y-6" x-data="serviceForm()">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.services.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div class="flex-1">
                <h1 class="text-2xl font-bold font-display">Edit Service</h1>
                <p class="text-text-muted mt-1">{{ $service->title }}</p>
            </div>
            <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                View
            </a>
        </div>

        <form action="{{ route('admin.services.update', $service) }}" method="POST" class="grid lg:grid-cols-3 gap-6">
            @csrf
            @method('PUT')

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Basic Info --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Basic Information</h2>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="title" class="text-sm font-medium text-text-muted">Service Title *</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title', $service->title) }}"
                                x-model="title"
                                @input="generateSlug"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="Web Development"
                                required
                            >
                            @error('title')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="slug" class="text-sm font-medium text-text-muted">URL Slug *</label>
                            <input
                                type="text"
                                name="slug"
                                id="slug"
                                value="{{ old('slug', $service->slug) }}"
                                x-model="slug"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="web-development"
                                required
                            >
                            @error('slug')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="tagline" class="text-sm font-medium text-text-muted">Tagline</label>
                        <input
                            type="text"
                            name="tagline"
                            id="tagline"
                            value="{{ old('tagline', $service->tagline) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Build modern, scalable web applications"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-text-muted">Description *</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                            placeholder="Detailed description of the service..."
                            required
                        >{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Features --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Features</h2>

                    <div x-data="{ features: {{ json_encode(old('features', $service->features ?? [])) }}, newFeature: '' }" class="space-y-3">
                        <div class="space-y-2">
                            <template x-for="(feature, index) in features" :key="index">
                                <div class="flex items-center gap-2 p-3 bg-white/5 rounded-xl">
                                    <svg class="w-5 h-5 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="flex-1" x-text="feature"></span>
                                    <input type="hidden" name="features[]" :value="feature">
                                    <button type="button" @click="features.splice(index, 1)" class="p-1 hover:text-red-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                x-model="newFeature"
                                @keydown.enter.prevent="if(newFeature.trim()) { features.push(newFeature.trim()); newFeature = ''; }"
                                class="flex-1 px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="Add a feature (press Enter)"
                            >
                            <button
                                type="button"
                                @click="if(newFeature.trim()) { features.push(newFeature.trim()); newFeature = ''; }"
                                class="px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors"
                            >
                                Add
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Technologies --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Technologies</h2>

                    <div x-data="{ techs: {{ json_encode(old('technologies', $service->technologies ?? [])) }}, newTech: '' }" class="space-y-3">
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(tech, index) in techs" :key="index">
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-accent/10 text-accent rounded-lg text-sm">
                                    <span x-text="tech"></span>
                                    <input type="hidden" name="technologies[]" :value="tech">
                                    <button type="button" @click="techs.splice(index, 1)" class="hover:text-white transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </span>
                            </template>
                        </div>
                        <div class="flex gap-2">
                            <input
                                type="text"
                                x-model="newTech"
                                @keydown.enter.prevent="if(newTech.trim()) { techs.push(newTech.trim()); newTech = ''; }"
                                class="flex-1 px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="Add technology (press Enter)"
                            >
                            <button
                                type="button"
                                @click="if(newTech.trim()) { techs.push(newTech.trim()); newTech = ''; }"
                                class="px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors"
                            >
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Settings --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Settings</h2>

                    <div class="space-y-2">
                        <label for="icon" class="text-sm font-medium text-text-muted">Icon (emoji)</label>
                        <input
                            type="text"
                            name="icon"
                            id="icon"
                            value="{{ old('icon', $service->icon) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors text-2xl text-center"
                            placeholder="🚀"
                        >
                        <p class="text-xs text-text-muted">Use an emoji as the service icon</p>
                    </div>

                    <div class="space-y-2">
                        <label for="sort_order" class="text-sm font-medium text-text-muted">Sort Order</label>
                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            value="{{ old('sort_order', $service->sort_order) }}"
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
                            {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}
                            class="w-5 h-5 rounded bg-[var(--color-bg-primary)] border border-white/10 text-accent focus:ring-accent focus:ring-offset-0"
                        >
                        <label for="is_featured" class="text-sm font-medium">Featured Service</label>
                    </div>

                    <button type="submit" class="w-full px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                        Update Service
                    </button>
                </div>

                {{-- Danger Zone --}}
                <div class="bg-red-500/5 rounded-2xl border border-red-500/10 p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-red-400">Danger Zone</h2>
                    <p class="text-sm text-text-muted">Permanently delete this service.</p>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="w-full px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                            Delete Service
                        </button>
                    </form>
                </div>
            </div>
        </form>
    </div>

    <script>
        function serviceForm() {
            return {
                title: '{{ old('title', $service->title) }}',
                slug: '{{ old('slug', $service->slug) }}',
                generateSlug() {
                    this.slug = this.title
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim();
                }
            }
        }
    </script>
</x-layouts.admin>
