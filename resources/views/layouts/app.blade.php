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
