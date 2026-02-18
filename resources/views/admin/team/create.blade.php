<x-layouts.admin title="Add Team Member">
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.team.index') }}" class="p-2 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold font-display">Add Team Member</h1>
                <p class="text-text-muted mt-1">Add a new team member to your website</p>
            </div>
        </div>

        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6">
            @csrf

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Basic Info --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Basic Information</h2>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-text-muted">Full Name *</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="John Doe"
                                required
                            >
                            @error('name')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="role" class="text-sm font-medium text-text-muted">Role / Position *</label>
                            <input
                                type="text"
                                name="role"
                                id="role"
                                value="{{ old('role') }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="Full Stack Developer"
                                required
                            >
                            @error('role')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="bio" class="text-sm font-medium text-text-muted">Bio</label>
                        <textarea
                            name="bio"
                            id="bio"
                            rows="4"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                            placeholder="Brief bio or description..."
                        >{{ old('bio') }}</textarea>
                        @error('bio')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Social Links --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Social Links</h2>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label for="linkedin_url" class="text-sm font-medium text-text-muted">LinkedIn URL</label>
                            <input
                                type="url"
                                name="linkedin_url"
                                id="linkedin_url"
                                value="{{ old('linkedin_url') }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="https://linkedin.com/in/..."
                            >
                            @error('linkedin_url')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="github_url" class="text-sm font-medium text-text-muted">GitHub URL</label>
                            <input
                                type="url"
                                name="github_url"
                                id="github_url"
                                value="{{ old('github_url') }}"
                                class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                                placeholder="https://github.com/..."
                            >
                            @error('github_url')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Skills --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Skills</h2>

                    <div x-data="{ tags: [], newTag: '' }" class="space-y-3">
                        <div class="flex flex-wrap gap-2">
                            <template x-for="(tag, index) in tags" :key="index">
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-accent/10 text-accent rounded-lg text-sm">
                                    <span x-text="tag"></span>
                                    <input type="hidden" name="skills[]" :value="tag">
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
                                placeholder="Add skill (press Enter)"
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

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Publish --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Settings</h2>

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
                            name="is_active"
                            id="is_active"
                            value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 rounded bg-[var(--color-bg-primary)] border border-white/10 text-accent focus:ring-accent focus:ring-offset-0"
                        >
                        <label for="is_active" class="text-sm font-medium">Active</label>
                    </div>

                    <button type="submit" class="w-full px-5 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                        Add Team Member
                    </button>
                </div>

                {{-- Photo --}}
                <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                    <h2 class="text-lg font-semibold">Photo</h2>

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
                            name="photo"
                            id="photo"
                            x-ref="photo"
                            accept="image/*"
                            class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])"
                        >
                        @error('photo')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>
