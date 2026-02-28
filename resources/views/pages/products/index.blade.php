@extends('layouts.app')

@section('title', 'Collections | Deco & Ceram')

@section('content')
    <!-- Hero/Header -->
    <section class="pt-32 pb-16 bg-brand-stone/30">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl space-y-4 reveal reveal-up">
                <span class="text-xs uppercase tracking-widest text-brand-sand font-bold">Catalog</span>
                <h1 class="text-5xl md:text-6xl font-serif">Explore our <span class="italic">Collections</span></h1>
                <p class="text-brand-charcoal/60 text-lg font-light leading-relaxed">
                    Discover premium surfaces from the world's leading manufacturers, curated for architectural excellence.
                </p>
            </div>
        </div>
    </section>

    <!-- Browse by Brand -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="mb-12 reveal reveal-up">
                <h2 class="text-3xl font-serif">Browse by Brand</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($brands as $brand)
                    <x-product.brand-card :brand="$brand" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Browse by Category -->
    <section class="py-24 bg-brand-stone/10 section-divider">
        <div class="container mx-auto px-6">
            <div class="mb-12 reveal reveal-up">
                <h2 class="text-3xl font-serif">Browse by Category</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ url(app()->getLocale() . '/products?category=' . $category['id']) }}"
                        class="group relative aspect-[3/4] overflow-hidden bg-brand-stone reveal reveal-up">
                        <img src="{{ $category['image'] ?? '/images/placeholder.jpg' }}" alt="{{ $category['name'] }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-brand-charcoal/20 group-hover:bg-brand-charcoal/40 transition-colors">
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-white text-xl md:text-2xl font-serif text-center px-4">
                                {{ $category['name'] }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Collections -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-12 gap-4">
                <div class="reveal reveal-up">
                    <h2 class="text-3xl font-serif">Featured Collections</h2>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredCollections as $collection)
                    <x-product.collection-card :collection="$collection" />
                @endforeach
            </div>
        </div>
    </section>
@endsection