<x-layouts.admin title="Site Settings">
    <div class="space-y-6">
        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold font-display">Site Settings</h1>
            <p class="text-text-muted mt-1">Configure your portfolio website settings</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Logo & Branding --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Logo & Branding
                </h2>

                <div class="grid sm:grid-cols-2 gap-6">
                    {{-- Main Logo --}}
                    <div class="space-y-3">
                        <label class="text-sm font-medium text-text-muted">Site Logo</label>
                        <div class="relative">
                            <div class="w-full h-32 rounded-xl border-2 border-dashed border-white/10 hover:border-accent/50 transition-colors flex items-center justify-center bg-[var(--color-bg-primary)] overflow-hidden group" x-data="{ preview: '{{ isset($settings['site_logo']) ? Storage::url($settings['site_logo']) : '' }}' }">
                                <template x-if="preview">
                                    <div class="relative w-full h-full">
                                        <img :src="preview" alt="Logo preview" class="w-full h-full object-contain p-4">
                                        <button type="button" @click="preview = ''; $refs.logoInput.value = ''" class="absolute top-2 right-2 w-8 h-8 bg-red-500/80 hover:bg-red-500 rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!preview">
                                    <div class="text-center p-4">
                                        <svg class="w-8 h-8 mx-auto text-text-muted mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-sm text-text-muted">Click to upload logo</p>
                                        <p class="text-xs text-text-muted/60 mt-1">PNG, SVG, JPG (max 2MB)</p>
                                    </div>
                                </template>
                                <input
                                    type="file"
                                    name="site_logo"
                                    x-ref="logoInput"
                                    @change="if ($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])"
                                    accept="image/png,image/svg+xml,image/jpeg"
                                    class="absolute inset-0 opacity-0 cursor-pointer"
                                >
                            </div>
                        </div>
                        <p class="text-xs text-text-muted/60">Recommended: 200x50px transparent PNG</p>
                    </div>

                    {{-- Favicon --}}
                    <div class="space-y-3">
                        <label class="text-sm font-medium text-text-muted">Favicon</label>
                        <div class="relative">
                            <div class="w-full h-32 rounded-xl border-2 border-dashed border-white/10 hover:border-accent/50 transition-colors flex items-center justify-center bg-[var(--color-bg-primary)] overflow-hidden" x-data="{ preview: '{{ isset($settings['site_favicon']) ? Storage::url($settings['site_favicon']) : '' }}' }">
                                <template x-if="preview">
                                    <div class="relative w-full h-full flex items-center justify-center">
                                        <img :src="preview" alt="Favicon preview" class="w-16 h-16 object-contain">
                                        <button type="button" @click="preview = ''; $refs.faviconInput.value = ''" class="absolute top-2 right-2 w-8 h-8 bg-red-500/80 hover:bg-red-500 rounded-lg flex items-center justify-center transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!preview">
                                    <div class="text-center p-4">
                                        <svg class="w-8 h-8 mx-auto text-text-muted mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-sm text-text-muted">Click to upload favicon</p>
                                        <p class="text-xs text-text-muted/60 mt-1">ICO, PNG (max 1MB)</p>
                                    </div>
                                </template>
                                <input
                                    type="file"
                                    name="site_favicon"
                                    x-ref="faviconInput"
                                    @change="if ($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])"
                                    accept="image/x-icon,image/png,image/ico"
                                    class="absolute inset-0 opacity-0 cursor-pointer"
                                >
                            </div>
                        </div>
                        <p class="text-xs text-text-muted/60">Recommended: 32x32px or 64x64px ICO/PNG</p>
                    </div>
                </div>

                {{-- Logo for Dark/Light modes --}}
                <div class="pt-4 border-t border-white/5">
                    <div class="grid sm:grid-cols-2 gap-6">
                        {{-- Light Mode Logo --}}
                        <div class="space-y-3">
                            <label class="text-sm font-medium text-text-muted">Logo (Light Background)</label>
                            <div class="relative">
                                <div class="w-full h-24 rounded-xl border-2 border-dashed border-white/10 hover:border-accent/50 transition-colors flex items-center justify-center bg-white overflow-hidden" x-data="{ preview: '{{ isset($settings['site_logo_light']) ? Storage::url($settings['site_logo_light']) : '' }}' }">
                                    <template x-if="preview">
                                        <div class="relative w-full h-full">
                                            <img :src="preview" alt="Light logo preview" class="w-full h-full object-contain p-3">
                                            <button type="button" @click="preview = ''; $refs.logoLightInput.value = ''" class="absolute top-2 right-2 w-6 h-6 bg-red-500/80 hover:bg-red-500 rounded-lg flex items-center justify-center transition-colors">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <template x-if="!preview">
                                        <div class="text-center p-2">
                                            <p class="text-sm text-gray-400">Optional dark variant</p>
                                        </div>
                                    </template>
                                    <input
                                        type="file"
                                        name="site_logo_light"
                                        x-ref="logoLightInput"
                                        @change="if ($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])"
                                        accept="image/png,image/svg+xml,image/jpeg"
                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                    >
                                </div>
                            </div>
                        </div>

                        {{-- OG Image --}}
                        <div class="space-y-3">
                            <label class="text-sm font-medium text-text-muted">Default OG Image</label>
                            <div class="relative">
                                <div class="w-full h-24 rounded-xl border-2 border-dashed border-white/10 hover:border-accent/50 transition-colors flex items-center justify-center bg-[var(--color-bg-primary)] overflow-hidden" x-data="{ preview: '{{ isset($settings['og_image']) ? Storage::url($settings['og_image']) : '' }}' }">
                                    <template x-if="preview">
                                        <div class="relative w-full h-full">
                                            <img :src="preview" alt="OG image preview" class="w-full h-full object-cover">
                                            <button type="button" @click="preview = ''; $refs.ogImageInput.value = ''" class="absolute top-2 right-2 w-6 h-6 bg-red-500/80 hover:bg-red-500 rounded-lg flex items-center justify-center transition-colors">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <template x-if="!preview">
                                        <div class="text-center p-2">
                                            <p class="text-sm text-text-muted">Social share image</p>
                                            <p class="text-xs text-text-muted/60">1200x630px</p>
                                        </div>
                                    </template>
                                    <input
                                        type="file"
                                        name="og_image"
                                        x-ref="ogImageInput"
                                        @change="if ($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])"
                                        accept="image/png,image/jpeg"
                                        class="absolute inset-0 opacity-0 cursor-pointer"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- General Settings --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    General
                </h2>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label for="site_name" class="text-sm font-medium text-text-muted">Site Name</label>
                        <input
                            type="text"
                            name="settings[site_name]"
                            id="site_name"
                            value="{{ $settings['site_name'] ?? 'Somaticx' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="site_tagline" class="text-sm font-medium text-text-muted">Tagline</label>
                        <input
                            type="text"
                            name="settings[site_tagline]"
                            id="site_tagline"
                            value="{{ $settings['site_tagline'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="Creative Developer Portfolio"
                        >
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="site_description" class="text-sm font-medium text-text-muted">Site Description</label>
                    <textarea
                        name="settings[site_description]"
                        id="site_description"
                        rows="3"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                        placeholder="A brief description of your portfolio site..."
                    >{{ $settings['site_description'] ?? '' }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="hero_headline" class="text-sm font-medium text-text-muted">Hero Headline</label>
                    <input
                        type="text"
                        name="settings[hero_headline]"
                        id="hero_headline"
                        value="{{ $settings['hero_headline'] ?? '' }}"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        placeholder="I build digital experiences"
                    >
                </div>

                <div class="space-y-2">
                    <label for="hero_subheadline" class="text-sm font-medium text-text-muted">Hero Subheadline</label>
                    <textarea
                        name="settings[hero_subheadline]"
                        id="hero_subheadline"
                        rows="2"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                        placeholder="Full-stack developer specializing in Laravel and Vue.js"
                    >{{ $settings['hero_subheadline'] ?? '' }}</textarea>
                </div>
            </div>

            {{-- Contact Settings --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Contact Information
                </h2>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label for="contact_email" class="text-sm font-medium text-text-muted">Contact Email</label>
                        <input
                            type="email"
                            name="settings[contact_email]"
                            id="contact_email"
                            value="{{ $settings['contact_email'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="hello@example.com"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="contact_phone" class="text-sm font-medium text-text-muted">Phone</label>
                        <input
                            type="text"
                            name="settings[contact_phone]"
                            id="contact_phone"
                            value="{{ $settings['contact_phone'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="+1 (234) 567-8900"
                        >
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="contact_address" class="text-sm font-medium text-text-muted">Address</label>
                    <textarea
                        name="settings[contact_address]"
                        id="contact_address"
                        rows="2"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                        placeholder="City, Country"
                    >{{ $settings['contact_address'] ?? '' }}</textarea>
                </div>
            </div>

            {{-- Social Links --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    Social Links
                </h2>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label for="social_github" class="text-sm font-medium text-text-muted">GitHub</label>
                        <input
                            type="url"
                            name="settings[social_github]"
                            id="social_github"
                            value="{{ $settings['social_github'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="https://github.com/username"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="social_linkedin" class="text-sm font-medium text-text-muted">LinkedIn</label>
                        <input
                            type="url"
                            name="settings[social_linkedin]"
                            id="social_linkedin"
                            value="{{ $settings['social_linkedin'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="https://linkedin.com/in/username"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="social_twitter" class="text-sm font-medium text-text-muted">Twitter / X</label>
                        <input
                            type="url"
                            name="settings[social_twitter]"
                            id="social_twitter"
                            value="{{ $settings['social_twitter'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="https://twitter.com/username"
                        >
                    </div>

                    <div class="space-y-2">
                        <label for="social_dribbble" class="text-sm font-medium text-text-muted">Dribbble</label>
                        <input
                            type="url"
                            name="settings[social_dribbble]"
                            id="social_dribbble"
                            value="{{ $settings['social_dribbble'] ?? '' }}"
                            class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                            placeholder="https://dribbble.com/username"
                        >
                    </div>
                </div>
            </div>

            {{-- SEO Settings --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    SEO
                </h2>

                <div class="space-y-2">
                    <label for="meta_title" class="text-sm font-medium text-text-muted">Default Meta Title</label>
                    <input
                        type="text"
                        name="settings[meta_title]"
                        id="meta_title"
                        value="{{ $settings['meta_title'] ?? '' }}"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        placeholder="Your Name - Portfolio"
                    >
                </div>

                <div class="space-y-2">
                    <label for="meta_description" class="text-sm font-medium text-text-muted">Default Meta Description</label>
                    <textarea
                        name="settings[meta_description]"
                        id="meta_description"
                        rows="2"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors resize-none"
                        placeholder="A brief meta description for search engines..."
                    >{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>

                <div class="space-y-2">
                    <label for="meta_keywords" class="text-sm font-medium text-text-muted">Meta Keywords</label>
                    <input
                        type="text"
                        name="settings[meta_keywords]"
                        id="meta_keywords"
                        value="{{ $settings['meta_keywords'] ?? '' }}"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        placeholder="developer, portfolio, web development"
                    >
                </div>
            </div>

            {{-- Analytics --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6 space-y-5">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Analytics
                </h2>

                <div class="space-y-2">
                    <label for="google_analytics_id" class="text-sm font-medium text-text-muted">Google Analytics ID</label>
                    <input
                        type="text"
                        name="settings[google_analytics_id]"
                        id="google_analytics_id"
                        value="{{ $settings['google_analytics_id'] ?? '' }}"
                        class="w-full px-4 py-3 bg-[var(--color-bg-primary)] border border-white/10 rounded-xl focus:outline-none focus:border-accent transition-colors"
                        placeholder="G-XXXXXXXXXX"
                    >
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-accent to-accent-2 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-accent/25 transition-all">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>
