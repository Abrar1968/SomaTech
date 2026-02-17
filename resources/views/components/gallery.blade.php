@props(['images' => []])

@if(count($images) > 0)
<div class="grid grid-cols-2 md:grid-cols-3 gap-4" x-data>
    @foreach($images as $index => $image)
        <a
            href="{{ $image }}"
            class="glightbox relative aspect-video rounded-lg overflow-hidden group"
            data-gallery="project-gallery"
        >
            <img
                src="{{ $image }}"
                alt="Gallery image {{ $index + 1 }}"
                loading="lazy"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            />
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                </svg>
            </div>
        </a>
    @endforeach
</div>
@endif

@pushOnce('scripts')
<script>
    // GLightbox will be initialized in app.js after the library is loaded
</script>
@endPushOnce
