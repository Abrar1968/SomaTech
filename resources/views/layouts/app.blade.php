<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0D0D0D">
    <meta name="color-scheme" content="dark">

    {{-- SEO Component - SRS NFR-009 --}}
    <x-seo
        :title="$seoTitle ?? null"
        :description="$seoDescription ?? null"
        :image="$seoImage ?? null"
        :type="$seoType ?? 'website'"
    />

    {{-- Preconnect for critical resources --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">

    {{-- Preload critical font --}}
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"></noscript>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Critical inline styles for instant loading --}}
    <style>
        [x-cloak] { display: none !important; }
        .js-loading * { transition: none !important; }
    </style>
</head>
<body class="antialiased js-loading" x-data="{ loaded: false }" x-init="$nextTick(() => { document.body.classList.remove('js-loading'); loaded = true; })">
    {{-- Skip to main content for accessibility --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:px-4 focus:py-2 focus:bg-accent focus:text-white focus:rounded-lg">
        Skip to main content
    </a>

    {{-- Page Loader - SRS 9.2 --}}
    <x-page-loader />

    {{-- Custom Cursor - SRS 6.5.5 --}}
    <x-custom-cursor />

    {{-- Page Transition Overlay --}}
    <div id="page-transition"
         class="fixed inset-0 bg-gradient-to-br from-[var(--color-bg-primary)] via-[var(--color-bg-surface)] to-[var(--color-bg-primary)] z-[60] pointer-events-none"
         x-data="{ show: false }"
         x-show="show"
         x-transition:enter="transition-transform duration-500 ease-out"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition-transform duration-500 ease-in"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="-translate-y-full"
         x-cloak>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-accent to-accent-2 animate-pulse"></div>
        </div>
    </div>

    {{-- Global Navigation - SRS UI-001 --}}
    <x-nav />

    {{-- Main Content with smooth reveal --}}
    <main id="main-content"
          class="min-h-screen"
          :class="loaded ? 'opacity-100' : 'opacity-0'"
          style="transition: opacity 0.3s ease-out;">
        {{ $slot }}
    </main>

    {{-- Global Footer - SRS 9.2 --}}
    <x-footer />

    {{-- Back to top button --}}
    <button
        x-data="{ visible: false }"
        x-init="window.addEventListener('scroll', () => { visible = window.scrollY > 500 })"
        x-show="visible"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-8 right-8 z-50 w-12 h-12 rounded-full bg-gradient-to-r from-accent to-accent-2 text-white shadow-lg shadow-accent/25 hover:shadow-accent/50 hover:scale-110 transition-all duration-300 flex items-center justify-center group"
        aria-label="Back to top"
        x-cloak
    >
        <svg class="w-5 h-5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</body>
</html>
