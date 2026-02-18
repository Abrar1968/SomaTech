<x-layouts.admin title="Edit Project">
    <div class="space-y-6" x-data="projectForm()">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.projects.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div class="flex-1">
                <h1 class="text-2xl font-bold font-display">Edit Project</h1>
                <p class="text-text-muted mt-1">{{ $project->title }}</p>
            </div>
            <a href="{{ route('portfolio.show', $project->slug) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                View
            </a>
        </div>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6">
            @csrf
            @method('PUT')

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Basic Info --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Basic Information</h2>

                    <div class="space-y-2">
                        <label for="title" class="text-sm font-medium text-text-muted">Project Title *</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $project->title) }}"
                            x-model="title"
                            @input="generateSlug"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Enter project title"
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
                            value="{{ old('slug', $project->slug) }}"
                            x-model="slug"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="project-url-slug"
                            required
                        >
                        @error('slug')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="short_description" class="text-sm font-medium text-text-muted">Short Description *</label>
                        <textarea
                            name="short_description"
                            id="short_description"
                            rows="2"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                            placeholder="Brief project summary (shown in cards)"
                            required
                        >{{ old('short_description', $project->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-sm font-medium text-text-muted">Full Description *</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                            placeholder="Detailed project description"
                            required
                        >{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Project Details --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Project Details</h2>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="client_name" class="text-sm font-medium text-text-muted">Client Name</label>
                            <input
                                type="text"
                                name="client_name"
                                id="client_name"
                                value="{{ old('client_name', $project->client_name) }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="Client or company name"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="category_id" class="text-sm font-medium text-text-muted">Category *</label>
                            <select
                                name="category_id"
                                id="category_id"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                required
                            >
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="project_url" class="text-sm font-medium text-text-muted">Live URL</label>
                            <input
                                type="url"
                                name="project_url"
                                id="project_url"
                                value="{{ old('project_url', $project->project_url) }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="https://example.com"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="github_url" class="text-sm font-medium text-text-muted">GitHub URL</label>
                            <input
                                type="url"
                                name="github_url"
                                id="github_url"
                                value="{{ old('github_url', $project->github_url) }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="https://github.com/..."
                            >
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="start_date" class="text-sm font-medium text-text-muted">Start Date</label>
                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="end_date" class="text-sm font-medium text-text-muted">End Date</label>
                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            >
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-text-muted">Tech Stack</label>
                        <div x-data="{ tags: {{ json_encode(old('tech_stack', $project->tech_stack ?? [])) }}, newTag: '' }" class="space-y-3">
                            <div class="flex flex-wrap gap-2">
                                <template x-for="(tag, index) in tags" :key="index">
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-accent/10 text-accent rounded-lg text-sm">
                                        <span x-text="tag"></span>
                                        <input type="hidden" name="tech_stack[]" :value="tag">
                                        <button type="button" @click="tags.splice(index, 1)" class="hover:text-white transition-colors">
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
                                    x-model="newTag"
                                    @keydown.enter.prevent="if(newTag.trim()) { tags.push(newTag.trim()); newTag = ''; }"
                                    class="flex-1 px-4 py-2.5 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                    placeholder="Add technology (press Enter)"
                                >
                                <button
                                    type="button"
                                    @click="if(newTag.trim()) { tags.push(newTag.trim()); newTag = ''; }"
                                    class="px-4 py-2.5 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors"
                                >
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEO --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">SEO Settings</h2>

                    <div class="space-y-2">
                        <label for="meta_title" class="text-sm font-medium text-text-muted">Meta Title</label>
                        <input
                            type="text"
                            name="meta_title"
                            id="meta_title"
                            value="{{ old('meta_title', $project->meta_title) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Custom SEO title (optional)"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="meta_description" class="text-sm font-medium text-text-muted">Meta Description</label>
                        <textarea
                            name="meta_description"
                            id="meta_description"
                            rows="2"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                            placeholder="Custom SEO description (optional)"
                        >{{ old('meta_description', $project->meta_description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Publish --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Publish</h2>

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-medium text-text-muted">Status *</label>
                        <select
                            name="status"
                            id="status"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        >
                            <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $project->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="featured" {{ old('status', $project->status) === 'featured' ? 'selected' : '' }}>Featured</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="sort_order" class="text-sm font-medium text-text-muted">Sort Order</label>
                        <input
                            type="number"
                            name="sort_order"
                            id="sort_order"
                            value="{{ old('sort_order', $project->sort_order) }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            min="0"
                        >
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                            Update Project
                        </button>
                    </div>
                </div>

                {{-- Thumbnail --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Thumbnail</h2>

                    <div
                        x-data="{ preview: '{{ $project->thumbnail ? Storage::url($project->thumbnail) : '' }}' }"
                        class="space-y-3"
                    >
                        <div
                            class="relative aspect-video rounded-xl bg-[var(--color-bg-primary)] border-2 border-dashed border-white/10 hover:border-accent/50 transition-colors flex items-center justify-center overflow-hidden cursor-pointer"
                            @click="$refs.thumbnail.click()"
                        >
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!preview">
                                <div class="text-center p-4">
                                    <svg class="w-8 h-8 mx-auto text-text-muted mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-text-muted">Click to upload</p>
                                </div>
                            </template>
                        </div>
                        <input
                            type="file"
                            name="thumbnail"
                            id="thumbnail"
                            x-ref="thumbnail"
                            accept="image/*"
                            class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])"
                        >
                        @error('thumbnail')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Gallery --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Gallery</h2>

                    <div x-data="{
                        previews: {{ json_encode(collect($project->gallery ?? [])->map(fn($img) => Storage::url($img))->toArray()) }},
                        existingImages: {{ json_encode($project->gallery ?? []) }}
                    }" class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <template x-for="(preview, index) in previews" :key="index">
                                <div class="relative aspect-video rounded-lg overflow-hidden group">
                                    <img :src="preview" class="w-full h-full object-cover">
                                    <input type="hidden" name="existing_gallery[]" :value="existingImages[index] || ''">
                                    <button
                                        type="button"
                                        @click="previews.splice(index, 1); existingImages.splice(index, 1)"
                                        class="absolute top-2 right-2 p-1.5 bg-black/60 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button
                            type="button"
                            @click="$refs.gallery.click()"
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 border-dashed rounded-xl hover:bg-white/10 hover:border-accent/50 transition-all text-text-muted hover:text-white"
                        >
                            + Add Images
                        </button>
                        <input
                            type="file"
                            name="gallery[]"
                            x-ref="gallery"
                            accept="image/*"
                            multiple
                            class="hidden"
                            @change="Array.from($event.target.files).forEach(file => { previews.push(URL.createObjectURL(file)); existingImages.push(''); })"
                        >
                    </div>
                </div>

                {{-- Danger Zone --}}
                <div class="bg-red-500/5 rounded-2xl border border-red-500/10 p-6 space-y-4">
                    <h2 class="text-lg font-semibold text-red-400">Danger Zone</h2>
                    <p class="text-sm text-text-muted">Once deleted, this project will be moved to trash.</p>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="w-full px-4 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl hover:bg-red-500/20 transition-colors font-medium">
                            Delete Project
                        </button>
                    </form>
                </div>
            </div>
        </form>
    </div>

    <script>
        function projectForm() {
            return {
                title: '{{ old('title', $project->title) }}',
                slug: '{{ old('slug', $project->slug) }}',
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
