@extends('layouts.app')

@section('title', $brand->name . ' | Deco & Ceram')

@section('content')


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
                <span class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ __('messages.products.series_collections') }}</span>
                <h2 class="text-4xl md:text-5xl font-serif mt-2">{{ __('messages.products.series') }} {{ $brand->name }} <span
                        class="italic">{{ __('messages.products.experience') }}</span></h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($brand->collections as $collection)
                    <x-product.collection-card :collection="$collection" />
                @endforeach
            </div>
        </div>
    </section>
@endsection