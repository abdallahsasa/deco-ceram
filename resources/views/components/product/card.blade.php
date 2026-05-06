@props(['product'])

<div class="group reveal reveal-up">
    <a href="{{ route('products.show', ['locale' => app()->getLocale(), 'brand' => $product->collection->brand->slug, 'collection' => $product->collection->slug, 'product' => $product->slug]) }}"
        class="block space-y-6">
        <!-- Image Container -->
        <div class="relative aspect-[3/4] overflow-hidden bg-brand-stone">
            <img src="{{ $product['images'][0] ?? '/images/placeholder.jpg' }}" alt="{{ $product['name'] }}"
                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
            
            <!-- Overlay on Hover -->
            <div class="absolute inset-0 bg-brand-charcoal/0 group-hover:bg-brand-charcoal/10 transition-colors duration-500"></div>
            
            <!-- Label Tag -->
            <div class="absolute top-4 left-4">
                <span class="text-[9px] uppercase tracking-[0.2em] bg-white/90 backdrop-blur-sm px-3 py-1.5 font-bold shadow-sm">
                    {{ $product->category->name ?? $product['category'] }}
                </span>
            </div>
        </div>

        <!-- Content -->
        <div class="space-y-3">
            <div class="space-y-1">
                <h3 class="text-xl font-serif group-hover:text-brand-sand transition-colors duration-300 leading-tight">
                    {{ $product['name'] }}
                </h3>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] uppercase tracking-widest text-brand-charcoal/40 font-medium">
                        {{ $product['finish'] }}
                    </span>
                    <span class="w-1 h-1 bg-brand-stone rounded-full"></span>
                    <span class="text-[10px] uppercase tracking-widest text-brand-charcoal/40 font-medium">
                        {{ $product['size'] }}
                    </span>
                </div>
            </div>
            
            <div class="pt-2">
                <span class="inline-block text-[10px] uppercase tracking-[0.3em] font-bold border-b border-brand-stone pb-1 group-hover:border-brand-sand transition-colors">
                    View Details
                </span>
            </div>
        </div>
    </a>
</div>