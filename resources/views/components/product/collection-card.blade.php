@props(['collection'])

<div class="group reveal reveal-up h-full">
    <a href="{{ route('products.collection', ['locale' => app()->getLocale(), 'brand' => $collection->brand->slug, 'collection' => $collection->slug]) }}"
        class="flex flex-col h-full">
        <!-- Image Container with fixed aspect ratio -->
        <div class="relative aspect-[16/10] overflow-hidden bg-brand-stone mb-6 shrink-0">
            <img src="{{ $collection->hero_image_url }}" alt="{{ $collection->name }}"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div
                class="absolute inset-0 bg-brand-charcoal/0 group-hover:bg-brand-charcoal/10 transition-colors duration-500">
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="flex flex-col flex-grow space-y-2">
            <h3 class="text-lg font-serif">{{ $collection->name }}</h3>
            <p class="text-xs text-brand-charcoal/60 line-clamp-2 uppercase tracking-tight">
                {{ $collection->description }}
            </p>
            <div class="mt-auto pt-4">
                <span
                    class="inline-block text-[10px] uppercase tracking-widest border-b border-brand-charcoal/10 pb-1 group-hover:border-brand-charcoal transition-colors">
                    {{ __('messages.products.view_series') }}
                </span>
            </div>
        </div>
    </a>
</div>