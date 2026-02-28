@extends('layouts.app')

@section('title', $brand->name . ' | Deco & Ceram')

@section('content')
    <!-- Brand Hero -->
    <section class="relative h-[60vh] overflow-hidden bg-brand-charcoal">
        <img src="{{ $brand->hero_image ?? '/images/placeholder.jpg' }}" alt="{{ $brand->name }}"
            class="w-full h-full object-cover opacity-60 animate-fade-in">
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6 text-center md:text-left">
                <div class="max-w-2xl space-y-6 reveal reveal-up">
                    <div class="bg-white p-6 inline-block mb-4 backdrop-blur-sm bg-opacity-90">
                        <img src="{{ $brand->logo }}" alt="{{ $brand->name }} Logo" class="h-16 w-auto object-contain">
                    </div>
                    <h1 class="text-white text-5xl md:text-7xl font-serif">{{ $brand->name }}</h1>
                    @if($brand->official_distributor)
                        <span class="inline-block text-brand-sand uppercase tracking-[0.3em] text-xs font-bold">Official
                            Distributor</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Description -->
    <section class="py-24 bg-white border-b border-brand-stone">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center space-y-8 reveal reveal-up">
                <p class="text-2xl font-serif leading-relaxed text-brand-charcoal italic">
                    "{{ $brand->description }}"
                </p>
            </div>
        </div>
    </section>

    <!-- Brand Collections -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="mb-16 text-center reveal reveal-up">
                <span class="text-xs uppercase tracking-widest text-brand-sand font-bold">Series & Collections</span>
                <h2 class="text-4xl md:text-5xl font-serif mt-2">The {{ $brand->name }} <span
                        class="italic">Experience</span></h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($brand->collections as $collection)
                    <x-product.collection-card :collection="$collection" />
                @endforeach
            </div>
        </div>
    </section>
@endsection