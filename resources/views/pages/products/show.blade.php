@extends('layouts.app')

@section('title', $product->name . ' - ' . $collection->name . ' | Deco & Ceram')

@section('content')
    <section class="pt-32 pb-24">
        <div class="container mx-auto px-6">
            <!-- Breadcrumb -->
            <nav class="flex mb-12 text-xs uppercase tracking-widest text-brand-charcoal/40" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('products', app()->getLocale()) }}"
                            class="hover:text-brand-sand transition-colors">{{ __('messages.products.breadcrumb_products') }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('products.brand', ['locale' => app()->getLocale(), 'brand' => $brand->slug]) }}"
                            class="hover:text-brand-sand transition-colors">{{ $brand->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('products.collection', ['locale' => app()->getLocale(), 'brand' => $brand->slug, 'collection' => $collection->slug]) }}"
                            class="hover:text-brand-sand transition-colors">{{ $collection->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-brand-charcoal font-medium">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="space-y-24">
                <!-- 1. Hero Gallery Section -->
                <div class="space-y-8 reveal reveal-up">
                    <div class="aspect-[21/9] bg-brand-stone overflow-hidden shadow-2xl">
                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    @if(count($product->gallery_urls) > 1)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach(array_slice($product->gallery_urls, 1) as $image)
                                <div class="aspect-[4/3] bg-brand-stone overflow-hidden cursor-pointer hover:opacity-80 transition-opacity">
                                    <img src="{{ $image }}" alt="{{ $product->name }} view" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- 2. Product Information & Description -->
                <div class="max-w-4xl mx-auto text-center space-y-12 reveal reveal-up">
                    <div class="space-y-6">
                        <div class="flex items-center justify-center gap-4">
                            <span class="text-xs uppercase tracking-[0.3em] text-brand-sand font-black">{{ $brand->name }}</span>
                            <span class="w-1.5 h-1.5 bg-brand-stone rounded-full"></span>
                            <span class="text-xs uppercase tracking-[0.3em] text-brand-charcoal/40 font-medium">{{ $collection->name }}</span>
                        </div>
                        <h1 class="text-5xl md:text-7xl font-serif leading-tight">{{ $product->name }}</h1>
                        <p class="text-brand-charcoal/60 text-xl font-light leading-relaxed max-w-2xl mx-auto italic">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Technical Quick Specs Bar -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 border-y border-brand-stone py-10">
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">{{ __('messages.products.attributes.material') }}</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->material }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">{{ __('messages.products.attributes.look') }}</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->look }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">{{ __('messages.products.attributes.finish') }}</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->finish }}</span>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[10px] uppercase tracking-[0.2em] text-brand-charcoal/40 block font-bold">{{ __('messages.products.attributes.thickness') }}</span>
                            <span class="text-sm font-medium tracking-tight">{{ $product->thickness }}</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Formats & Specifications Grid -->
                @if($product->variants->isNotEmpty())
                    <div class="space-y-12 reveal reveal-up">
                        <div class="text-center space-y-2">
                            <h2 class="text-3xl font-serif">{{ __('messages.products.formats_packaging') }}</h2>
                            <p class="text-[10px] uppercase tracking-[0.3em] text-brand-charcoal/40">{{ __('messages.products.technical_specs_per_size') }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                            @foreach($product->variants as $variant)
                                <div x-data="{ 
                                    meters: '', 
                                    added: false,
                                    variantSize: '{{ $variant->sizeModel?->name ?? $variant->size }}',
                                    get pcsPerBox() {
                                        let sizeModelPcs = {{ $variant->sizeModel?->pcs_per_box ?? 0 }};
                                        if (sizeModelPcs > 0) return sizeModelPcs;
                                        let match = this.variantSize.match(/(\d+)\s*pcs?/i);
                                        return match ? parseInt(match[1]) : 1;
                                    },
                                    get sqmPerPiece() {
                                        let sizeModelSqm = {{ $variant->sizeModel?->sqm_per_box ?? 0 }};
                                        if (sizeModelSqm > 0 && this.pcsPerBox > 0) {
                                            return sizeModelSqm / this.pcsPerBox;
                                        }
                                        return window.parseSqmFromName(this.variantSize) || 1;
                                    },
                                    get effectiveSqmPerBox() {
                                        let sizeModelSqm = {{ $variant->sizeModel?->sqm_per_box ?? 0 }};
                                        if (sizeModelSqm > 0) return sizeModelSqm;
                                        return this.sqmPerPiece * this.pcsPerBox;
                                    },
                                    get boxes() {
                                        if (!this.meters || this.meters <= 0) return 0;
                                        return Math.ceil(parseFloat(this.meters) / this.effectiveSqmPerBox);
                                    },
                                    get pieces() {
                                        return this.boxes * this.pcsPerBox;
                                    }
                                }" class="bg-white border border-brand-stone p-8 space-y-6 hover:shadow-xl transition-all duration-500 group flex flex-col justify-between">
                                    <div class="space-y-6">
                                        <!-- Header -->
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-start">
                                                <span class="text-[10px] font-mono text-brand-charcoal/30 uppercase tracking-tighter">{{ $variant->sku ?? 'No SKU' }}</span>
                                                <span class="text-[9px] uppercase tracking-widest text-brand-sand font-black px-2 py-1 bg-brand-sand/5">{{ $variant->finish }}</span>
                                            </div>
                                            <h5 class="text-2xl font-serif group-hover:text-brand-sand transition-colors">{{ $variant->sizeModel?->name ?? $variant->size }}</h5>
                                        </div>

                                        <!-- Specs Grid -->
                                        <div class="grid grid-cols-2 gap-8 pt-6 border-t border-brand-stone/40">
                                            <!-- Box -->
                                            <div class="space-y-4">
                                                <h6 class="text-[9px] uppercase tracking-[0.3em] font-black text-brand-charcoal/30">{{ __('messages.products.box_packaging') }}</h6>
                                                <div class="space-y-2">
                                                    <div class="flex justify-between text-xs">
                                                        <span class="text-brand-charcoal/40">{{ __('messages.products.pcs') }}</span>
                                                        <span class="font-bold tracking-tighter">{{ $variant->sizeModel?->pcs_per_box ?? '-' }}</span>
                                                    </div>
                                                    <div class="flex justify-between text-xs">
                                                        <span class="text-brand-charcoal/40">{{ __('messages.products.surface') }}</span>
                                                        <span class="font-bold tracking-tighter">{{ number_format($variant->sizeModel?->sqm_per_box ?? 0, 2) }} m²</span>
                                                    </div>
                                                    <div class="flex justify-between text-xs">
                                                        <span class="text-brand-charcoal/40">{{ __('messages.products.weight') }}</span>
                                                        <span class="font-bold tracking-tighter">~{{ $variant->sizeModel?->kg_per_box ?? '-' }} kg</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pallet -->
                                            <div class="space-y-4">
                                                <h6 class="text-[9px] uppercase tracking-[0.3em] font-black text-brand-charcoal/30">{{ __('messages.products.pallet_packaging') }}</h6>
                                                <div class="space-y-2">
                                                    <div class="flex justify-between text-xs">
                                                        <span class="text-brand-charcoal/40">{{ __('messages.products.boxes') }}</span>
                                                        <span class="font-bold tracking-tighter">{{ $variant->sizeModel?->boxes_per_pallet ?? '-' }}</span>
                                                    </div>
                                                    <div class="flex justify-between text-xs">
                                                        <span class="text-brand-charcoal/40">{{ __('messages.products.surface') }}</span>
                                                        <span class="font-bold tracking-tighter">{{ number_format($variant->sizeModel?->sqm_per_pallet ?? 0, 2) }} m²</span>
                                                    </div>
                                                    <div class="flex justify-between text-xs">
                                                        <span class="text-brand-charcoal/40">{{ __('messages.products.weight') }}</span>
                                                        <span class="font-bold tracking-tighter">~{{ $variant->sizeModel?->kg_per_pallet ?? '-' }} kg</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add to Quote section for this variant -->
                                    <div class="pt-6 border-t border-brand-stone/40 space-y-4">
                                        <div class="space-y-2">
                                            <label class="text-[10px] uppercase tracking-widest font-bold text-brand-charcoal/60">{{ __('messages.quote.meters') ?? 'Meters (m²)' }}</label>
                                            <input type="number" step="any" min="0.01" x-model="meters" 
                                                placeholder="e.g. 10" 
                                                class="w-full bg-[#FAFAFA] border border-brand-stone/60 px-4 py-2 text-sm focus:ring-1 focus:ring-black focus:border-black transition-all">
                                        </div>
                                        
                                        <div class="text-[11px] text-brand-charcoal/60 uppercase tracking-wider flex justify-between" x-show="pieces > 0">
                                            <span>{{ __('messages.products.pcs') }}: <strong class="text-black" x-text="pieces"></strong></span>
                                            <span x-show="boxes > 0">{{ __('messages.products.boxes') }}: <strong class="text-black" x-text="boxes"></strong></span>
                                        </div>

                                        <button 
                                            @click="
                                                if(!meters || meters <= 0) return;
                                                $store.quoteCart.add({ 
                                                    product_id: '{{ $product->id }}', 
                                                    name: '{{ addslashes($product->name) }}', 
                                                    image: '{{ $product->primary_image_url }}', 
                                                    brand: '{{ addslashes($brand->name) }}',
                                                    variant_name: '{{ addslashes(str_replace(["\r", "\n"], ["", " "], ($variant->sizeModel?->name ?? $variant->size) . " (" . $variant->finish . ")")) }}',
                                                    pcs_per_box: pcsPerBox,
                                                    sqm_per_box: effectiveSqmPerBox,
                                                    boxes: boxes,
                                                    pcs: pieces,
                                                    meters: +(boxes * effectiveSqmPerBox).toFixed(4),
                                                    quantity: pieces
                                                }); 
                                                added = true; 
                                                setTimeout(() => added = false, 2000);
                                                meters = '';
                                            "
                                            :disabled="!meters || meters <= 0"
                                            class="w-full btn-premium py-3 text-center text-xs relative"
                                            :class="added ? 'bg-brand-sand text-white' : ''">
                                            <span x-show="!added">{{ __('messages.products.add_to_quote') ?? 'Add to Quote' }}</span>
                                            <span x-show="added" x-cloak>{{ __('messages.products.added_to_quote') ?? 'Added!' }}</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4. Final Details & Action -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 pt-12 border-t border-brand-stone reveal reveal-up">
                    <!-- Left: Technical Specs Table -->
                    @if(!empty($product->technical_specs))
                        <div class="space-y-8">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">{{ __('messages.products.comprehensive_data') }}</h4>
                            <div class="space-y-0">
                                @foreach($product->technical_specs as $key => $value)
                                    <div class="flex justify-between py-5 border-b border-brand-stone/40">
                                        <span class="text-[10px] uppercase tracking-widest text-brand-charcoal/60">{{ $key }}</span>
                                        <span class="text-sm font-bold tracking-tight">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Right: Downloads & CTA -->
                    <div class="space-y-12">
                        @if(!empty($product->downloads))
                            <div class="space-y-8">
                                <h4 class="text-xs uppercase tracking-[0.2em] font-bold">{{ __('messages.products.resources_downloads') }}</h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($product->downloads as $download)
                                        <a href="{{ $download['url'] }}"
                                            class="flex items-center justify-between p-6 border border-brand-stone hover:bg-brand-stone/10 transition-all group">
                                            <span class="text-[10px] uppercase tracking-widest font-bold">{{ $download['name'] }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" class="w-4 h-4 text-brand-sand group-hover:translate-y-1 transition-transform">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="space-y-6">
                            <h4 class="text-xs uppercase tracking-[0.2em] font-bold">{{ __('messages.products.start_project') }}</h4>
                            @if($product->variants->isEmpty())
                                <div x-data="{
                                    meters: '',
                                    added: false,
                                    variantSize: '{{ $product->size }}',
                                    get sqmPerPiece() {
                                        return window.parseSqmFromName(this.variantSize) || 1;
                                    },
                                    get boxes() {
                                        if (!this.meters || this.meters <= 0) return 0;
                                        return Math.ceil(parseFloat(this.meters) / this.sqmPerPiece);
                                    },
                                    get pieces() {
                                        return this.boxes;
                                    }
                                }" class="space-y-4 bg-brand-stone/10 p-6 border border-brand-stone">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-1">
                                            <label class="text-[10px] uppercase tracking-widest font-bold text-brand-charcoal/60">{{ __('messages.quote.meters') ?? 'Meters (m²)' }}</label>
                                            <input type="number" step="any" min="0.01" x-model="meters" placeholder="e.g. 10" 
                                                class="w-full bg-white border border-brand-stone/60 px-4 py-2 text-sm focus:ring-1 focus:ring-black focus:border-black transition-all">
                                        </div>
                                        <div class="flex flex-col justify-end">
                                            <div class="text-[11px] text-brand-charcoal/60 uppercase tracking-wider pb-2 flex flex-col gap-1" x-show="pieces > 0">
                                                <div>{{ __('messages.products.pcs') }}: <strong class="text-black" x-text="pieces"></strong></div>
                                                <div>{{ __('messages.products.boxes') }}: <strong class="text-black" x-text="boxes"></strong></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <button 
                                            @click="
                                                if(!meters || meters <= 0) return;
                                                $store.quoteCart.add({ 
                                                    product_id: '{{ $product->id }}', 
                                                    name: '{{ addslashes($product->name) }}', 
                                                    image: '{{ $product->primary_image_url }}', 
                                                    brand: '{{ addslashes($brand->name) }}',
                                                    variant_name: '',
                                                    pcs_per_box: 1,
                                                    sqm_per_box: sqmPerPiece,
                                                    boxes: boxes,
                                                    pcs: pieces,
                                                    meters: +(boxes * sqmPerPiece).toFixed(4),
                                                    quantity: pieces
                                                }); 
                                                added = true; 
                                                setTimeout(() => added = false, 2000);
                                                meters = '';
                                            "
                                            :disabled="!meters || meters <= 0"
                                            class="btn-premium flex-1 text-center py-6 relative"
                                            :class="added ? 'bg-brand-sand' : ''">
                                            <span x-show="!added">{{ __('messages.products.add_to_quote') ?? 'Add to Quote' }}</span>
                                            <span x-show="added" x-cloak>{{ __('messages.products.added_to_quote') ?? 'Added!' }}</span>
                                        </button>
                                        <a href="{{ route('contact', ['locale' => app()->getLocale(), 'subject' => 'Sample Request: ' . $product->name]) }}"
                                            class="btn-premium-outline flex-1 text-center py-6">
                                            {{ __('messages.products.order_sample') }}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="space-y-4">
                                    <div class="bg-brand-stone/10 p-6 border border-brand-stone/60 text-center text-xs uppercase tracking-widest text-brand-charcoal/60">
                                        {{ __('messages.products.select_format_notice') ?? 'Please select a format/size above to add to your quote.' }}
                                    </div>
                                    <div class="flex">
                                        <a href="{{ route('contact', ['locale' => app()->getLocale(), 'subject' => 'Sample Request: ' . $product->name]) }}"
                                            class="btn-premium-outline flex-grow text-center py-6">
                                            {{ __('messages.products.order_sample') }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <p class="text-[9px] text-brand-charcoal/40 uppercase tracking-widest text-center mt-4">{{ __('messages.products.response_time') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection