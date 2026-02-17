# STEP 2: Frontend Layout & UI Components
## SomaTech Portfolio Website Implementation

> **SRS Reference:** Sections 6, 9 | **Priority:** Critical | **Duration:** 1.5 weeks

---

## Overview

This step implements all frontend layouts, Blade components, Tailwind CSS configuration, and static asset setup. Follows the SRS UI/UX specifications with dark-first design, glassmorphism effects, and responsive grid system.

---

## 2.1 Tailwind CSS Configuration

### SRS Reference: Section 6.2 (Colour Palette), 6.3 (Typography), 6.4 (Spacing)

**File:** `resources/css/app.css`

```css
@import "tailwindcss";

/* SRS Color Tokens - Section 6.2 */
@theme {
  --color-bg-primary: #0D0D0D;
  --color-bg-surface: #111827;
  --color-bg-elevated: #1F2937;
  --color-accent: #6C63FF;
  --color-accent-2: #00D4FF;
  --color-text: #F9FAFB;
  --color-text-muted: #9CA3AF;
  --color-border: #374151;
  --color-success: #10B981;
  --color-error: #EF4444;
  
  /* 8px Base Spacing Unit - SRS 6.4 */
  --spacing-unit: 8px;
  
  /* Typography - SRS 6.3 */
  --font-display: "Plus Jakarta Sans", sans-serif;
  --font-body: "Inter", sans-serif;
  --font-code: "JetBrains Mono", monospace;
}

/* Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background-color: var(--color-bg-primary);
  color: var(--color-text);
  font-family: var(--font-body);
  line-height: 1.7;
  font-size: 16px;
  overflow-x: hidden;
}

/* Reduced Motion Support - SRS NFR-020 */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Custom Cursor Styles - SRS 6.5.5 */
@media (pointer: fine) {
  body {
    cursor: none;
  }
  
  a, button, [role="button"] {
    cursor: none;
  }
}

/* Focus Visible Styles - SRS NFR-016 */
*:focus-visible {
  outline: 2px solid var(--color-accent);
  outline-offset: 3px;
}

/* Glassmorphism Utility Class - SRS 6.1 */
.glass {
  background: rgba(17, 24, 39, 0.7);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Gradient Text Effect */
.gradient-text {
  background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-2) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Container - SRS 6.4 */
.container {
  max-width: 1280px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 24px;
  padding-right: 24px;
}

@media (min-width: 1024px) {
  .container {
    padding-left: 80px;
    padding-right: 80px;
  }
}
```

---

## 2.2 Base Layout

### Main Application Layout
**File:** `resources/views/layouts/app.blade.php`
**SRS Reference:** Section 9.1

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Component - SRS NFR-009 --}}
    <x-seo 
        :title="$seoTitle ?? null"
        :description="$seoDescription ?? null"
        :image="$seoImage ?? null"
        :type="$seoType ?? 'website'"
    />
    
    {{-- Preconnect for fonts - SRS 6.3 --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    {{-- Page Loader - SRS 9.2 --}}
    <x-page-loader />
    
    {{-- Custom Cursor - SRS 6.5.5 --}}
    <x-custom-cursor />
    
    {{-- Page Transition Curtain - SRS 6.5.4 --}}
    <div id="page-transition" class="fixed inset-0 bg-[var(--color-bg-primary)] z-50 pointer-events-none translate-y-full"></div>
    
    {{-- Global Navigation - SRS UI-001 --}}
    <x-nav />
    
    {{-- Main Content --}}
    <main id="main-content">
        {{ $slot }}
    </main>
    
    {{-- Global Footer - SRS 9.2 --}}
    <x-footer />
</body>
</html>
```

### Admin Layout
**File:** `resources/views/layouts/admin.blade.php`
**SRS Reference:** Section 9.1

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow"> {{-- SRS CONST-007 --}}
    
    <title>{{ $title ?? 'Dashboard' }} - SomaTech Admin</title>
    
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
</head>
<body class="bg-[var(--color-bg-surface)]">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-[var(--color-bg-primary)] border-r border-[var(--color-border)]">
            <x-admin.sidebar />
        </aside>
        
        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Top Bar --}}
            <header class="h-16 bg-[var(--color-bg-surface)] border-b border-[var(--color-border)] flex items-center justify-between px-6">
                <h1 class="text-xl font-semibold">{{ $title ?? 'Dashboard' }}</h1>
                <x-admin.user-menu />
            </header>
            
            {{-- Content Area --}}
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
```

---

## 2.3 Blade Components

### Component 1: Navigation
**File:** `resources/views/components/nav.blade.php`
**SRS Reference:** UI-001, UI-002, UI-003, UI-004

```blade
@props(['transparent' => false])

<nav 
    x-data="{ 
        mobileOpen: false, 
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 80;
            });
        }
    }"
    :class="scrolled ? 'bg-[rgba(13,13,13,0.95)]' : 'bg-[rgba(13,13,13,0.7)]'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 glass"
    role="navigation"
    aria-label="Main navigation"
>
    <div class="container">
        <div class="flex items-center justify-between h-20">
            {{-- Logo - SRS UI-002 --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                <div class="w-10 h-10 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-white font-bold text-xl">S</span>
                </div>
                <span class="text-xl font-bold font-display">SomaTech</span>
            </a>
            
            {{-- Desktop Navigation - SRS UI-002 --}}
            <div class="hidden lg:flex items-center space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')">About</x-nav-link>
                <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">Services</x-nav-link>
                <x-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">Portfolio</x-nav-link>
                <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.*')">Contact</x-nav-link>
                
                {{-- Hire Us CTA - SRS UI-002 --}}
                <a 
                    href="{{ route('contact.index') }}" 
                    class="px-6 py-2 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-full text-white font-medium hover:scale-105 transition-transform"
                >
                    Hire Us
                </a>
            </div>
            
            {{-- Mobile Hamburger - SRS UI-003 --}}
            <button 
                @click="mobileOpen = !mobileOpen"
                class="lg:hidden p-2"
                :aria-expanded="mobileOpen"
                aria-controls="mobile-menu"
                aria-label="Toggle navigation menu"
            >
                <div class="w-6 h-5 flex flex-col justify-between">
                    <span :class="mobileOpen && 'rotate-45 translate-y-2'" class="block h-0.5 w-full bg-white transition-all"></span>
                    <span :class="mobileOpen && 'opacity-0'" class="block h-0.5 w-full bg-white transition-all"></span>
                    <span :class="mobileOpen && '-rotate-45 -translate-y-2'" class="block h-0.5 w-full bg-white transition-all"></span>
                </div>
            </button>
        </div>
    </div>
    
    {{-- Mobile Menu Overlay - SRS UI-003 --}}
    <div 
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden fixed inset-0 top-20 bg-[var(--color-bg-primary)] z-40"
        id="mobile-menu"
    >
        <div class="flex flex-col space-y-4 p-6">
            <x-mobile-nav-link :href="route('home')">Home</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('about')">About</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('services.index')">Services</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('portfolio.index')">Portfolio</x-mobile-nav-link>
            <x-mobile-nav-link :href="route('contact.index')">Contact</x-mobile-nav-link>
        </div>
    </div>
</nav>
```

### Component 2: Nav Link
**File:** `resources/views/components/nav-link.blade.php`
**SRS Reference:** UI-004

```blade
@props(['active' => false])

<a 
    {{ $attributes }}
    class="relative py-2 text-sm font-medium transition-colors {{ $active ? 'text-white' : 'text-[var(--color-text-muted)] hover:text-white' }} group"
>
    {{ $slot }}
    
    {{-- Active Indicator - SRS UI-004 --}}
    @if($active)
        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)]"></span>
    @else
        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
    @endif
</a>
```

### Component 3: Hero Section
**File:** `resources/views/components/hero.blade.php`
**SRS Reference:** FR-001, FR-002, 6.5.1

```blade
@props(['title', 'subtitle', 'ctas' => []])

<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Three.js Canvas Background - SRS FR-001 --}}
    <canvas id="hero-canvas" class="absolute inset-0 z-0"></canvas>
    
    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[rgba(13,13,13,0.8)] to-[var(--color-bg-primary)] z-10"></div>
    
    {{-- Content --}}
    <div class="container relative z-20 text-center">
        {{-- Animated Headline - SRS 6.5.1 --}}
        <h1 
            id="hero-title"
            class="text-[clamp(48px,8vw,96px)] font-display font-bold leading-tight mb-6"
            data-gsap="split-text"
        >
            {!! $title !!}
        </h1>
        
        {{-- Subtitle --}}
        <p 
            class="text-xl md:text-2xl text-[var(--color-text-muted)] mb-12 max-w-3xl mx-auto"
            data-gsap="fade-up"
            data-gsap-delay="0.4"
        >
            {{ $subtitle }}
        </p>
        
        {{-- CTAs - SRS FR-001 --}}
        <div 
            class="flex flex-col sm:flex-row gap-4 justify-center"
            data-gsap="fade-up"
            data-gsap-delay="0.6"
        >
            @foreach($ctas as $cta)
                <a 
                    href="{{ $cta['url'] }}" 
                    class="px-8 py-4 {{ $cta['primary'] ?? false ? 'bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white' : 'border-2 border-[var(--color-accent)] text-white' }} rounded-full font-semibold hover:scale-105 transition-transform magnetic-button"
                >
                    {{ $cta['text'] }}
                </a>
            @endforeach
        </div>
    </div>
    
    {{-- Scroll Indicator - SRS FR-002 --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center animate-bounce cursor-pointer" onclick="window.scrollTo({top: window.innerHeight, behavior: 'smooth'})">
        <span class="text-sm text-[var(--color-text-muted)] mb-2">Scroll</span>
        <svg class="w-6 h-6 text-[var(--color-accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>
```

### Component 4: Project Card
**File:** `resources/views/components/project-card.blade.php`
**SRS Reference:** FR-005, FR-019, 6.5.3

```blade
@props(['project'])

<div 
    class="group relative bg-[var(--color-bg-surface)] rounded-xl overflow-hidden border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300"
    data-tilt
    data-tilt-max="8"
    data-tilt-speed="400"
    data-tilt-glare="true"
    data-tilt-max-glare="0.1"
>
    {{-- Thumbnail - SRS FR-019 --}}
    <div class="relative aspect-video overflow-hidden">
        <img 
            src="{{ $project->thumbnail }}" 
            alt="{{ $project->title }}"
            loading="lazy"
            width="600"
            height="400"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        />
        
        {{-- Category Badge - SRS FR-019 --}}
        <div class="absolute top-4 left-4">
            <x-tech-badge :name="$project->category->name" />
        </div>
    </div>
    
    {{-- Content --}}
    <div class="p-6">
        <h3 class="text-xl font-semibold mb-2 group-hover:text-[var(--color-accent)] transition-colors">
            {{ $project->title }}
        </h3>
        <p class="text-[var(--color-text-muted)] text-sm mb-4 line-clamp-2">
            {{ $project->short_description }}
        </p>
        
        {{-- Tech Stack --}}
        @if($project->tech_stack)
            <div class="flex flex-wrap gap-2">
                @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                    <span class="text-xs px-2 py-1 rounded bg-[var(--color-bg-elevated)] text-[var(--color-text-muted)]">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
    
    {{-- Hover Overlay - SRS FR-005 --}}
    <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-accent)] to-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex items-end justify-center pb-8">
        <a 
            href="{{ route('portfolio.show', $project->slug) }}" 
            class="text-white font-semibold flex items-center gap-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
        >
            View Case Study
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>
</div>
```

### Component 5: Service Card
**File:** `resources/views/components/service-card.blade.php`
**SRS Reference:** FR-004

```blade
@props(['service'])

<div 
    class="relative group p-8 glass rounded-2xl border border-[var(--color-border)] hover:border-[var(--color-accent)] transition-all duration-300 overflow-hidden"
    data-gsap="fade-up-scale"
>
    {{-- Shimmer Effect - SRS 6.5.3 --}}
    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-600 pointer-events-none">
        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    </div>
    
    {{-- Icon --}}
    @if($service->icon)
        <div class="w-16 h-16 mb-6 text-[var(--color-accent)] group-hover:scale-110 transition-transform">
            {!! $service->icon !!}
        </div>
    @endif
    
    {{-- Content --}}
    <h3 class="text-2xl font-semibold font-display mb-3">{{ $service->title }}</h3>
    
    @if($service->tagline)
        <p class="text-[var(--color-accent)] text-sm mb-4">{{ $service->tagline }}</p>
    @endif
    
    <p class="text-[var(--color-text-muted)] mb-6 line-clamp-3">
        {{ Str::limit(strip_tags($service->description), 150) }}
    </p>
    
    {{-- CTA --}}
    <a 
        href="{{ route('services.show', $service->slug) }}" 
        class="inline-flex items-center gap-2 text-[var(--color-accent)] hover:gap-4 transition-all group/link"
    >
        Learn More
        <svg class="w-5 h-5 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </a>
</div>
```

### Component 6: Stat Counter
**File:** `resources/views/components/stat-counter.blade.php`
**SRS Reference:** FR-006, 6.5.2

```blade
@props(['stat'])

<div 
    class="text-center p-6"
    x-data="{ 
        count: 0,
        target: {{ $stat->value }},
        init() {
            this.$nextTick(() => {
                // Will be triggered by GSAP ScrollTrigger
            });
        }
    }"
    data-gsap="counter"
    data-target="{{ $stat->value }}"
>
    @if($stat->icon)
        <div class="w-12 h-12 mx-auto mb-4 text-[var(--color-accent)]">
            {!! $stat->icon !!}
        </div>
    @endif
    
    <div class="text-4xl md:text-5xl font-bold font-display gradient-text mb-2">
        <span class="counter-value">{{ $stat->prefix }}0{{ $stat->suffix }}</span>
    </div>
    
    <p class="text-[var(--color-text-muted)]">{{ $stat->label }}</p>
</div>
```

### Component 7: Testimonial Card
**File:** `resources/views/components/testimonial-card.blade.php`
**SRS Reference:** FR-007

```blade
@props(['testimonial'])

<div class="bg-[var(--color-bg-surface)] p-8 rounded-2xl border border-[var(--color-border)]">
    {{-- Star Rating - SRS FR-007 --}}
    <div class="flex gap-1 mb-4">
        @for($i = 1; $i <= 5; $i++)
            <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
        @endfor
    </div>
    
    {{-- Content --}}
    <p class="text-[var(--color-text-muted)] mb-6 italic">
        "{{ $testimonial->content }}"
    </p>
    
    {{-- Client Info --}}
    <div class="flex items-center gap-4">
        @if($testimonial->client_photo)
            <img 
                src="{{ $testimonial->client_photo }}" 
                alt="{{ $testimonial->client_name }}"
                class="w-12 h-12 rounded-full object-cover"
            />
        @else
            {{-- Initials Avatar Fallback - SRS FR-007 --}}
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center font-semibold">
                {{ $testimonial->client_initials }}
            </div>
        @endif
        
        <div>
            <p class="font-semibold">{{ $testimonial->client_name }}</p>
            @if($testimonial->client_role && $testimonial->client_company)
                <p class="text-sm text-[var(--color-text-muted)]">
                    {{ $testimonial->client_role }} at {{ $testimonial->client_company }}
                </p>
            @endif
        </div>
    </div>
</div>
```

### Component 8: Team Card
**File:** `resources/views/components/team-card.blade.php`
**SRS Reference:** FR-011, 6.5.3

```blade
@props(['member'])

<div class="team-card-container perspective-1000">
    <div class="team-card relative w-full aspect-[3/4] transition-transform duration-600 preserve-3d">
        {{-- Front Face --}}
        <div class="team-card-front absolute inset-0 backface-hidden bg-[var(--color-bg-surface)] rounded-2xl border border-[var(--color-border)] overflow-hidden">
            @if($member->photo)
                <img 
                    src="{{ $member->photo }}" 
                    alt="{{ $member->name }}"
                    class="w-full h-3/4 object-cover"
                />
            @else
                <div class="w-full h-3/4 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] flex items-center justify-center text-6xl font-bold">
                    {{ $member->initials }}
                </div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-1">{{ $member->name }}</h3>
                <p class="text-[var(--color-accent)] text-sm">{{ $member->role }}</p>
            </div>
        </div>
        
        {{-- Back Face - SRS FR-011 --}}
        <div class="team-card-back absolute inset-0 backface-hidden rotate-y-180 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-semibold mb-3">{{ $member->name }}</h3>
                <p class="text-sm mb-4 line-clamp-4">
                    {{ $member->bio ?? 'Expert ' . $member->role . ' at SomaTech' }}
                </p>
                
                @if($member->skills)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($member->skills, 0, 4) as $skill)
                            <span class="text-xs px-2 py-1 rounded bg-white/20">{{ $skill }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
            
            {{-- Social Links --}}
            <div class="flex gap-4">
                @if($member->linkedin_url)
                    <a href="{{ $member->linkedin_url }}" target="_blank" class="hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                @endif
                
                @if($member->github_url)
                    <a href="{{ $member->github_url }}" target="_blank" class="hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.perspective-1000 {
    perspective: 1000px;
}

.preserve-3d {
    transform-style: preserve-3d;
}

.backface-hidden {
    backface-visibility: hidden;
}

.rotate-y-180 {
    transform: rotateY(180deg);
}

.team-card-container:hover .team-card {
    transform: rotateY(180deg);
}
</style>
```

### Component 9: Contact Form
**File:** `resources/views/components/contact-form.blade.php`
**SRS Reference:** FR-022, FR-023, FR-024

```blade
<div x-data="contactForm()">
    {{-- Form State --}}
    <form 
        @submit.prevent="submitForm"
        x-show="!success"
        class="space-y-6"
    >
        @csrf
        
        {{-- Name Field --}}
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Full Name *</label>
            <input 
                type="text"
                id="name"
                x-model="form.name"
                @blur="validateField('name')"
                :class="errors.name ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                required
            />
            <p 
                x-show="errors.name" 
                x-text="errors.name"
                class="mt-2 text-sm text-[var(--color-error)] overflow-hidden transition-all"
                :class="errors.name ? 'max-h-20' : 'max-h-0'"
                role="alert"
            ></p>
        </div>
        
        {{-- Email Field --}}
        <div>
            <label for="email" class="block text-sm font-medium mb-2">Email Address *</label>
            <input 
                type="email"
                id="email"
                x-model="form.email"
                @blur="validateField('email')"
                :class="errors.email ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                required
            />
            <p 
                x-show="errors.email" 
                x-text="errors.email"
                class="mt-2 text-sm text-[var(--color-error)] overflow-hidden transition-all"
                :class="errors.email ? 'max-h-20' : 'max-h-0'"
                role="alert"
            ></p>
        </div>
        
        {{-- Phone Field (Optional) --}}
        <div>
            <label for="phone" class="block text-sm font-medium mb-2">Phone Number</label>
            <input 
                type="tel"
                id="phone"
                x-model="form.phone"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
            />
        </div>
        
        {{-- Company Field (Optional) --}}
        <div>
            <label for="company" class="block text-sm font-medium mb-2">Company Name</label>
            <input 
                type="text"
                id="company"
                x-model="form.company"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
            />
        </div>
        
        {{-- Service Interest (Required) - SRS FR-022 --}}
        <div>
            <label for="service_interest" class="block text-sm font-medium mb-2">Service of Interest *</label>
            <select 
                id="service_interest"
                x-model="form.service_interest"
                @blur="validateField('service_interest')"
                :class="errors.service_interest ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
                required
            >
                <option value="">Select a service</option>
                @foreach($services as $service)
                    <option value="{{ $service->title }}">{{ $service->title }}</option>
                @endforeach
            </select>
            <p 
                x-show="errors.service_interest" 
                x-text="errors.service_interest"
                class="mt-2 text-sm text-[var(--color-error)]"
                role="alert"
            ></p>
        </div>
        
        {{-- Budget Range (Optional) --}}
        <div>
            <label for="budget_range" class="block text-sm font-medium mb-2">Budget Range</label>
            <select 
                id="budget_range"
                x-model="form.budget_range"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border border-[var(--color-border)] rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors"
            >
                <option value="">Prefer not to say</option>
                <option value="< $5,000">< $5,000</option>
                <option value="$5,000 - $10,000">$5,000 - $10,000</option>
                <option value="$10,000 - $25,000">$10,000 - $25,000</option>
                <option value="$25,000 - $50,000">$25,000 - $50,000</option>
                <option value="$50,000+">$50,000+</option>
            </select>
        </div>
        
        {{-- Message Field - SRS FR-022 (min 20 chars) --}}
        <div>
            <label for="message" class="block text-sm font-medium mb-2">Project Details *</label>
            <textarea 
                id="message"
                x-model="form.message"
                @blur="validateField('message')"
                @input="updateCharCount"
                :class="errors.message ? 'border-[var(--color-error)]' : 'border-[var(--color-border)]'"
                class="w-full px-4 py-3 bg-[var(--color-bg-surface)] border rounded-lg focus:outline-none focus:border-[var(--color-accent)] transition-colors resize-none"
                rows="5"
                required
            ></textarea>
            <div class="flex justify-between mt-2">
                <p 
                    x-show="errors.message" 
                    x-text="errors.message"
                    class="text-sm text-[var(--color-error)]"
                    role="alert"
                ></p>
                <p 
                    class="text-sm ml-auto"
                    :class="charCount < 20 ? 'text-[var(--color-error)]' : 'text-[var(--color-text-muted)]'"
                >
                    <span x-text="charCount"></span> / 20 characters minimum
                </p>
            </div>
        </div>
        
        {{-- Submit Button --}}
        <button 
            type="submit"
            :disabled="loading"
            class="w-full px-8 py-4 bg-gradient-to-r from-[var(--color-accent)] to-[var(--color-accent-2)] text-white rounded-full font-semibold hover:scale-105 transition-transform disabled:opacity-50 disabled:cursor-not-allowed"
        >
            <span x-show="!loading">Send Message</span>
            <span x-show="loading" class="flex items-center justify-center gap-2">
                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sending...
            </span>
        </button>
    </form>
    
    {{-- Success State - SRS FR-024 --}}
    <div 
        x-show="success"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="text-center py-12"
    >
        {{-- Success Icon --}}
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[var(--color-success)]/20 flex items-center justify-center">
            <svg class="w-10 h-10 text-[var(--color-success)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h3 class="text-2xl font-semibold mb-3">Thank you<span x-show="form.name">, <span x-text="form.name"></span></span>!</h3>
        <p class="text-[var(--color-text-muted)] mb-6">We've received your message and will get back to you within 24 hours.</p>
        
        <button 
            @click="reset"
            class="text-[var(--color-accent)] hover:underline"
        >
            Send another message
        </button>
    </div>
</div>

<script>
function contactForm() {
    return {
        form: {
            name: '',
            email: '',
            phone: '',
            company: '',
            service_interest: '',
            budget_range: '',
            message: ''
        },
        errors: {},
        loading: false,
        success: false,
        charCount: 0,
        
        validateField(field) {
            this.errors[field] = '';
            
            if (field === 'name' && !this.form.name) {
                this.errors.name = 'Please tell us your name.';
            }
            
            if (field === 'email') {
                if (!this.form.email) {
                    this.errors.email = 'We need your email to get back to you.';
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                    this.errors.email = 'Please provide a valid email address.';
                }
            }
            
            if (field === 'service_interest' && !this.form.service_interest) {
                this.errors.service_interest = 'Please select a service you\'re interested in.';
            }
            
            if (field === 'message') {
                if (!this.form.message) {
                    this.errors.message = 'Please share some details about your project.';
                } else if (this.form.message.length < 20) {
                    this.errors.message = 'Please provide at least 20 characters in your message.';
                }
            }
        },
        
        updateCharCount() {
            this.charCount = this.form.message.length;
        },
        
        async submitForm() {
            // Validate all required fields
            this.validateField('name');
            this.validateField('email');
            this.validateField('service_interest');
            this.validateField('message');
            
            // Check if there are any errors
            if (Object.values(this.errors).some(error => error !== '')) {
                return;
            }
            
            this.loading = true;
            
            try {
                const response = await fetch('{{ route("contact.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.form)
                });
                
                if (response.ok) {
                    this.success = true;
                } else {
                    const data = await response.json();
                    if (data.errors) {
                        this.errors = data.errors;
                    }
                }
            } catch (error) {
                console.error('Form submission error:', error);
                alert('An error occurred. Please try again.');
            } finally {
                this.loading = false;
            }
        },
        
        reset() {
            this.form = {
                name: '',
                email: '',
                phone: '',
                company: '',
                service_interest: '',
                budget_range: '',
                message: ''
            };
            this.errors = {};
            this.success = false;
            this.charCount = 0;
        }
    };
}
</script>
```

### Component 10: SEO Component
**File:** `resources/views/components/seo.blade.php`
**SRS Reference:** NFR-009, NFR-010, NFR-011

```blade
@props(['title' => null, 'description' => null, 'image' => null, 'type' => 'website'])

@php
$seoService = app(\App\Services\SeoService::class);
$meta = $seoService->generateMeta([
    'title' => $title,
    'description' => $description,
    'image' => $image,
    'type' => $type,
]);
@endphp

<title>{{ $meta['title'] }}</title>
<meta name="description" content="{{ $meta['description'] }}">
<link rel="canonical" href="{{ $meta['canonical'] }}">

{{-- Open Graph - SRS NFR-011 --}}
<meta property="og:title" content="{{ $meta['og']['title'] }}">
<meta property="og:description" content="{{ $meta['og']['description'] }}">
<meta property="og:image" content="{{ $meta['og']['image'] }}">
<meta property="og:url" content="{{ $meta['og']['url'] }}">
<meta property="og:type" content="{{ $meta['og']['type'] }}">

{{-- Twitter Card - SRS NFR-011 --}}
<meta name="twitter:card" content="{{ $meta['twitter']['card'] }}">
<meta name="twitter:title" content="{{ $meta['twitter']['title'] }}">
<meta name="twitter:description" content="{{ $meta['twitter']['description'] }}">
<meta name="twitter:image" content="{{ $meta['twitter']['image'] }}">

{{-- Security Headers - SRS SEC-001 --}}
<meta http-equiv="X-Frame-Options" content="DENY">
<meta http-equiv="X-Content-Type-Options" content="nosniff">
<meta name="referrer" content="strict-origin-when-cross-origin">
```

### Component 11: Custom Cursor
**File:** `resources/views/components/custom-cursor.blade.php`
**SRS Reference:** 6.5.5

```blade
<div 
    x-data="customCursor()"
    x-init="init()"
    class="hidden lg:block"
    style="pointer-events: none;"
>
    {{-- Inner Dot --}}
    <div 
        id="cursor-dot"
        class="fixed w-2.5 h-2.5 rounded-full bg-[var(--color-accent)] z-[9999]"
        :style="`transform: translate(${dotX}px, ${dotY}px)`"
    ></div>
    
    {{-- Outer Ring --}}
    <div 
        id="cursor-ring"
        class="fixed w-10 h-10 rounded-full border-2 border-[var(--color-accent)] z-[9999] transition-all duration-300"
        :style="`transform: translate(${ringX}px, ${ringY}px)`"
        :class="{ 'w-16 h-16 bg-[var(--color-accent)]': hovering }"
    >
        <span 
            x-show="hovering && hoverText"
            x-text="hoverText"
            class="absolute inset-0 flex items-center justify-center text-white text-xs font-semibold"
        ></span>
    </div>
</div>

<script>
function customCursor() {
    return {
        dotX: 0,
        dotY: 0,
        ringX: 0,
        ringY: 0,
        hovering: false,
        hoverText: '',
        
        init() {
            // Only on desktop with fine pointer
            if (window.matchMedia('(pointer: fine)').matches) {
                let mouseX = 0;
                let mouseY = 0;
                
                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                    
                    // Dot follows immediately
                    this.dotX = mouseX - 5;
                    this.dotY = mouseY - 5;
                });
                
                // Ring follows with lag using GSAP quickTo (will implement in Step 3)
                const updateRing = () => {
                    this.ringX += (mouseX - 20 - this.ringX) * 0.1;
                    this.ringY += (mouseY - 20 - this.ringY) * 0.1;
                    requestAnimationFrame(updateRing);
                };
                updateRing();
                
                // Hover detection
                document.addEventListener('mouseover', (e) => {
                    const target = e.target;
                    if (target.matches('a, button, [role="button"]')) {
                        this.hovering = true;
                        this.hoverText = '';
                    } else if (target.matches('img')) {
                        this.hovering = true;
                        this.hoverText = 'View';
                    }
                });
                
                document.addEventListener('mouseout', (e) => {
                    if (e.target.matches('a, button, [role="button"], img')) {
                        this.hovering = false;
                        this.hoverText = '';
                    }
                });
            }
        }
    };
}
</script>
```

### Component 12: Footer
**File:** `resources/views/components/footer.blade.php`
**SRS Reference:** 9.2

```blade
<footer class="bg-[var(--color-bg-surface)] border-t border-[var(--color-border)] mt-32">
    <div class="container py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            {{-- Brand Column --}}
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-[var(--color-accent)] to-[var(--color-accent-2)] rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">S</span>
                    </div>
                    <span class="text-xl font-bold font-display">SomaTech</span>
                </div>
                <p class="text-[var(--color-text-muted)] text-sm mb-6">
                    Transforming ideas into digital excellence through innovative web and app development.
                </p>
                
                {{-- Social Links --}}
                <div class="flex gap-4">
                    <a href="#" class="text-[var(--color-text-muted)] hover:text-[var(--color-accent)] transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-label="LinkedIn">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-[var(--color-text-muted)] hover:text-[var(--color-accent)] transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-label="GitHub">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            {{-- Navigation Links --}}
            <div>
                <h4 class="font-semibold mb-4">Navigation</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-[var(--color-text-muted)] hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-[var(--color-text-muted)] hover:text-white transition-colors">About</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-[var(--color-text-muted)] hover:text-white transition-colors">Services</a></li>
                    <li><a href="{{ route('portfolio.index') }}" class="text-[var(--color-text-muted)] hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-[var(--color-text-muted)] hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            
            {{-- Services --}}
            <div>
                <h4 class="font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-[var(--color-text-muted)] hover:text-white transition-colors">Website Development</a></li>
                    <li><a href="#" class="text-[var(--color-text-muted)] hover:text-white transition-colors">App Development</a></li>
                    <li><a href="#" class="text-[var(--color-text-muted)] hover:text-white transition-colors">Website Maintenance</a></li>
                </ul>
            </div>
            
            {{-- Contact Info --}}
            <div>
                <h4 class="font-semibold mb-4">Get in Touch</h4>
                <ul class="space-y-2 text-sm">
                    <li class="text-[var(--color-text-muted)]">
                        <a href="mailto:hello@somatech.com" class="hover:text-white transition-colors">hello@somatech.com</a>
                    </li>
                    <li class="text-[var(--color-text-muted)]">
                        +1-555-SOMATECH
                    </li>
                </ul>
            </div>
        </div>
        
        {{-- Copyright --}}
        <div class="pt-8 border-t border-[var(--color-border)] text-center text-sm text-[var(--color-text-muted)]">
            <p>&copy; {{ date('Y') }} SomaTech. All rights reserved.</p>
        </div>
    </div>
</footer>
```

---

## 2.4 JavaScript Setup

**File:** `resources/js/app.js`

```javascript
import Alpine from 'alpinejs';
import './animations/hero';
import './animations/scroll';
import './animations/cursor';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Detect reduced motion preference - SRS NFR-020
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
window.REDUCED_MOTION = prefersReducedMotion;

// Page Loader
window.addEventListener('DOMContentLoaded', () => {
    const loader = document.querySelector('[data-page-loader]');
    if (loader) {
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 300);
        }, 500);
    }
});

// Install dependencies for Step 3:
// npm install gsap three.js vanilla-tilt.js swiper glightbox
```

---

## ✅ Step 2 Completion Checklist

- [ ] Tailwind CSS v4 fully configured with SRS color palette
- [ ] Main app layout with SEO, fonts, and structure
- [ ] Admin panel layout with sidebar
- [ ] Navigation component with mobile menu
- [ ] Hero component with Three.js canvas placeholder
- [ ] Project card with hover overlay
- [ ] Service card with glassmorphism
- [ ] Stat counter component
- [ ] Testimonial card with star rating
- [ ] Team flip card with 3D transform
- [ ] Contact form with Alpine.js validation
- [ ] SEO component with meta tags
- [ ] Custom cursor component
- [ ] Footer with social links
- [ ] All components cross-referenced with SRS requirements

---

**Next Step:** [STEP_03_CONTROLLERS_INTEGRATION.md](./STEP_03_CONTROLLERS_INTEGRATION.md) - Controllers, GSAP animations, testing, and final integration
