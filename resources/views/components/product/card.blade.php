@props(['product'])

<div class="group reveal reveal-up p-2 h-full">
    <a href="{{ route('products.show', ['locale' => app()->getLocale(), 'brand' => $product->collection->brand->slug, 'collection' => $product->collection->slug, 'product' => $product->slug]) }}"
        class="flex flex-col h-full space-y-6">
        <!-- Image Container -->
        <div class="relative w-full aspect-[3/4] overflow-hidden bg-brand-stone shrink-0">
            <img src="{{ $product->primary_image_url }}" alt="{{ $product['name'] }}"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">

            <!-- Overlay on Hover -->
            <div
                class="absolute inset-0 bg-brand-charcoal/0 group-hover:bg-brand-charcoal/10 transition-colors duration-500">
            </div>

            <!-- Label Tag -->
            <div class="absolute top-4 left-4">
                <span
                    class="text-[9px] uppercase tracking-[0.2em] bg-white/90 backdrop-blur-sm px-3 py-1.5 font-bold shadow-sm">
                    {{ $product->category->name ?? $product['category'] }}
                </span>
            </div>

            <!-- Quick Add to Quote -->
            <div class="absolute top-4 right-4 z-10" @click.prevent>
                <button x-data="{ added: false }"
                    @click="$store.quoteCart.add({ product_id: '{{ $product->id }}', name: '{{ addslashes($product['name']) }}', image: '{{ $product->primary_image_url }}', brand: '{{ addslashes($product->collection->brand->name ?? '') }}' }); added = true; setTimeout(() => added = false, 2000)"
                    class="bg-white/90 hover:bg-brand-sand hover:text-white backdrop-blur-sm p-2 rounded-full shadow-sm transition-colors"
                    :class="added ? 'bg-brand-sand text-white' : 'text-brand-charcoal'"
                    title="{{ __('messages.products.add_to_quote') ?? 'Add to Quote' }}">
                    <svg x-show="!added" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <svg x-show="added" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div class="flex flex-col flex-grow space-y-3">
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

            <div class="mt-auto pt-2">
                <span
                    class="inline-block text-[10px] uppercase tracking-[0.3em] font-bold border-b border-brand-stone pb-1 group-hover:border-brand-sand transition-colors">
                    {{ __('messages.products.view_details') }}
                </span>
            </div>
        </div>
    </a>
</div>