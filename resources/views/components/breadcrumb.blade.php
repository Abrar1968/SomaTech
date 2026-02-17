@props(['items' => []])

@php
    $crumbs = $items;
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($crumbs)->map(function ($crumb, $index) {
            return [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['label'],
                'item' => $crumb['url'] ?? null,
            ];
        })->toArray(),
    ];
@endphp

@if(count($crumbs) > 0)
<nav aria-label="Breadcrumb" class="mb-8">
    <ol class="flex items-center flex-wrap gap-2 text-sm text-[var(--color-text-muted)]">
        @foreach($crumbs as $index => $crumb)
            <li class="flex items-center">
                @if($loop->last)
                    <span class="text-white font-medium" aria-current="page">{{ $crumb['label'] }}</span>
                @else
                    <a href="{{ $crumb['url'] }}" class="hover:text-white transition-colors">
                        {{ $crumb['label'] }}
                    </a>
                    <svg class="w-4 h-4 mx-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

{{-- Structured Data - JSON-LD --}}
<script type="application/ld+json">
    {!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
