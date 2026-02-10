@props(['project'])

<a href="{{ url(app()->getLocale() . '/projects/' . $project['id']) }}"
    class="group block relative aspect-video overflow-hidden bg-brand-stone reveal reveal-up">
    <img src="{{ $project['images'][0] ?? '/images/placeholder.jpg' }}" alt="{{ $project['name'] }}"
        class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-brand-charcoal/20 group-hover:bg-brand-charcoal/40 transition-colors duration-500">
    </div>

    <!-- Content -->
    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
        <div class="space-y-1">
            <span class="text-xs uppercase tracking-widest text-white/70">{{ $project['type'] }}</span>
            <h3 class="text-2xl font-serif">{{ $project['name'] }}</h3>
            <p
                class="text-sm text-white/80 line-clamp-1 max-w-md opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500">
                {{ $project['summary'] }}
            </p>
        </div>
    </div>

    <!-- Arrow Icon -->
    <div
        class="absolute top-8 right-8 w-10 h-10 border border-white/30 flex items-center justify-center opacity-0 transform translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
        </svg>
    </div>
</a>