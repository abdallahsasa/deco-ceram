@extends('layouts.app')

@section('title', $collection->name . ' - ' . $brand->name . ' | Deco & Ceram')

@section('content')
    <!-- Collection Header -->
    <section class="pt-32 pb-16 bg-brand-stone/30">
        <div class="container mx-auto px-6">
            <nav class="flex mb-8 text-xs uppercase tracking-widest text-brand-charcoal/40" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('products', app()->getLocale()) }}" class="hover:text-brand-sand transition-colors">{{ __('messages.products.breadcrumb_products') }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('products.brand', ['locale' => app()->getLocale(), 'brand' => $brand->slug]) }}" class="hover:text-brand-sand transition-colors">{{ $brand->name }}</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-brand-charcoal">{{ $collection->name }}</li>
                </ol>
            </nav>

            <div class="max-w-4xl space-y-4 reveal reveal-up">
                <h1 class="text-4xl md:text-6xl font-serif">{{ __('messages.products.series') }}: {{ $collection->name }}</h1>
                <p class="text-brand-charcoal/60 text-lg font-light leading-relaxed">
                    {{ $collection->description }}
                </p>
            </div>
        </div>
    </section>

    <!-- Catalog Section -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <!-- Product Grid -->
            <div class="space-y-12">
                <div class="flex justify-between items-center text-xs uppercase tracking-widest text-brand-charcoal/40 border-b border-brand-stone pb-8">
                    <span>{{ __('messages.products.showing_items', ['count' => $products->count()]) }}</span>
                </div>

                @if($products->isEmpty())
                    <div class="py-24 text-center space-y-4 reveal reveal-up">
                        <p class="text-lg font-serif">{{ __('messages.products.no_products_found') }}</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-12 gap-y-20">
                        @foreach($products as $product)
                            <x-product.card :product="$product" />
                        @endforeach
                    </div>

                    <div class="pt-24 border-t border-brand-stone/40">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
