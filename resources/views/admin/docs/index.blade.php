<x-layouts.admin title="Documentation">
    <div class="space-y-8">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold font-display">Documentation</h1>
                <p class="text-text-muted mt-1">Guides and tutorials for managing your portfolio</p>
            </div>
            <span class="px-3 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-medium">
                v1.0
            </span>
        </div>

        {{-- Quick Start --}}
        <div class="bg-gradient-to-br from-accent/10 to-accent-2/10 rounded-2xl border border-accent/20 p-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-accent/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-2">Quick Start Guide</h2>
                    <p class="text-text-muted text-sm mb-4">Get your portfolio up and running in minutes:</p>
                    <ol class="space-y-2 text-sm">
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-accent/20 text-accent text-xs flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                            <span>Add your <a href="{{ route('admin.projects.create') }}" class="text-accent hover:text-accent-2">projects</a> to showcase your work</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-accent/20 text-accent text-xs flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                            <span>Configure your <a href="{{ route('admin.services.index') }}" class="text-accent hover:text-accent-2">services</a> to tell visitors what you offer</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-accent/20 text-accent text-xs flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                            <span>Update <a href="{{ route('admin.settings.index') }}" class="text-accent hover:text-accent-2">site settings</a> with your contact information</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 rounded-full bg-accent/20 text-accent text-xs flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
                            <span>Add <a href="{{ route('admin.testimonials.create') }}" class="text-accent hover:text-accent-2">testimonials</a> from satisfied clients</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Documentation Sections --}}
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Projects --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Projects</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Projects are the core of your portfolio. Each project can include:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Title, description, and client name
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Featured image and gallery
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Tech stack and links
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            SEO meta title and description
                        </li>
                    </ul>
                    <p class="pt-2"><strong>Tip:</strong> Mark projects as "Featured" to highlight them on your homepage.</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Projects
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            {{-- Services --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Services</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Services define what you offer to clients:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Service title and tagline
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Detailed description
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            List of features included
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Technologies used
                        </li>
                    </ul>
                    <p class="pt-2"><strong>Tip:</strong> Use an emoji as the service icon (e.g., 🚀, 💻, 🎨).</p>
                </div>
                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Services
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            {{-- Team --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Team</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Add team members to showcase your team:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Name, role, and bio
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Profile photo
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Social links (GitHub, LinkedIn)
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Skills/expertise tags
                        </li>
                    </ul>
                    <p class="pt-2"><strong>Tip:</strong> Set members as "Inactive" to hide them temporarily.</p>
                </div>
                <a href="{{ route('admin.team.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Team
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            {{-- Testimonials --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Testimonials</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Collect and display client feedback:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Client name, company, and role
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Testimonial content
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Star rating (1-5)
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Link to related project
                        </li>
                    </ul>
                    <p class="pt-2"><strong>Tip:</strong> Feature your best testimonials on the homepage.</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Testimonials
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            {{-- Skills --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Skills</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Showcase your technical expertise:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Skill name and category
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Proficiency level (0-100%)
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Icon (emoji)
                        </li>
                    </ul>
                    <p class="pt-2"><strong>Categories:</strong> Frontend, Backend, Database, DevOps, Tools, Design</p>
                </div>
                <a href="{{ route('admin.skills.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Skills
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            {{-- Stats --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Stats</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Display impressive numbers:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Label (e.g., "Projects Completed")
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Numeric value
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Prefix (e.g., "$") and suffix (e.g., "+", "%")
                        </li>
                    </ul>
                    <p class="pt-2"><strong>Examples:</strong> "150+ Projects", "$2M+ Revenue", "99% Satisfaction"</p>
                </div>
                <a href="{{ route('admin.stats.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Stats
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Settings & Inquiries --}}
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Site Settings --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gray-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Site Settings</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Configure your portfolio website:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li><strong>General:</strong> Site name, tagline, hero text</li>
                        <li><strong>Contact:</strong> Email, phone, address</li>
                        <li><strong>Social:</strong> GitHub, LinkedIn, Twitter, Dribbble</li>
                        <li><strong>SEO:</strong> Meta title, description, keywords</li>
                        <li><strong>Analytics:</strong> Google Analytics ID</li>
                    </ul>
                </div>
                <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Settings
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            {{-- Inquiries --}}
            <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold">Managing Inquiries</h3>
                </div>
                <div class="space-y-3 text-sm text-text-muted">
                    <p>Handle contact form submissions:</p>
                    <ul class="space-y-1.5 ml-4">
                        <li><strong>View:</strong> See all incoming messages</li>
                        <li><strong>Status:</strong> Unread, Read, Replied</li>
                        <li><strong>Actions:</strong> Mark as read, reply via email</li>
                        <li><strong>Filter:</strong> Sort by status or date</li>
                    </ul>
                    <p class="pt-2"><strong>Note:</strong> New inquiries appear in the dashboard and sidebar badge.</p>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-accent hover:text-accent-2 transition-colors">
                    Go to Inquiries
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Keyboard Shortcuts --}}
        <div class="bg-[var(--color-bg-surface)] rounded-2xl border border-white/5 p-6">
            <h3 class="text-lg font-semibold mb-4">Keyboard Shortcuts</h3>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div class="flex items-center gap-3">
                    <kbd class="px-2 py-1 bg-white/5 rounded border border-white/10 font-mono text-xs">Ctrl + /</kbd>
                    <span class="text-text-muted">Search</span>
                </div>
                <div class="flex items-center gap-3">
                    <kbd class="px-2 py-1 bg-white/5 rounded border border-white/10 font-mono text-xs">Ctrl + N</kbd>
                    <span class="text-text-muted">New Project</span>
                </div>
                <div class="flex items-center gap-3">
                    <kbd class="px-2 py-1 bg-white/5 rounded border border-white/10 font-mono text-xs">Ctrl + S</kbd>
                    <span class="text-text-muted">Save</span>
                </div>
                <div class="flex items-center gap-3">
                    <kbd class="px-2 py-1 bg-white/5 rounded border border-white/10 font-mono text-xs">Esc</kbd>
                    <span class="text-text-muted">Close modal</span>
                </div>
            </div>
        </div>

        {{-- Support --}}
        <div class="bg-gradient-to-r from-accent/5 to-accent-2/5 rounded-2xl border border-white/5 p-6 text-center">
            <h3 class="text-lg font-semibold mb-2">Need More Help?</h3>
            <p class="text-text-muted text-sm mb-4">Check out the full SRS documentation or contact support.</p>
            <div class="flex justify-center gap-4">
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-lg hover:bg-white/10 transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View Site
                </a>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-accent text-white rounded-lg hover:bg-accent/90 transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
