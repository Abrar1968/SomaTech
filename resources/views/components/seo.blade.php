@props(['title' => null, 'description' => null, 'image' => null, 'type' => 'website'])

@php
    $siteName = config('app.name', 'Somaticx');
    $siteUrl = config('app.url');

    $pageTitle = $title ? "{$title} | {$siteName}" : "{$siteName} | Web & App Development";
    $pageDescription = $description ?? 'Somaticx specializes in Website Development & Maintenance and App Development. Transform your digital presence with our expert team.';
    $pageImage = $image ?? asset('images/og-default.jpg');
    $canonicalUrl = url()->current();
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph - SRS NFR-011 --}}
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:image" content="{{ $pageImage }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="en_US">

{{-- Twitter Card - SRS NFR-011 --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $pageImage }}">

{{-- Additional Meta --}}
<meta name="robots" content="index, follow">
<meta name="author" content="{{ $siteName }}">
<meta name="theme-color" content="#6C63FF">

{{-- Favicon --}}
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

{{-- JSON-LD Schema - SRS NFR-012 --}}
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Organization",
    "name": "{{ $siteName }}",
    "url": "{{ $siteUrl }}",
    "logo": "{{ asset('images/logo.png') }}",
    "description": "{{ $pageDescription }}",
    "sameAs": [
        "https://linkedin.com/company/somaticx",
        "https://github.com/somaticx"
    ],
    "contactPoint": {
        "@@type": "ContactPoint",
        "email": "hello@somaticx.com",
        "contactType": "customer service"
    }
}
</script>

@if($type === 'website' && request()->routeIs('home'))
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "WebSite",
    "name": "{{ $siteName }}",
    "url": "{{ $siteUrl }}",
    "potentialAction": {
        "@@type": "SearchAction",
        "target": "{{ $siteUrl }}/portfolio?q={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
@endif
