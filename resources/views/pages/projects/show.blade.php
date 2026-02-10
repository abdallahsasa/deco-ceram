@extends('layouts.app')

@section('title', $project['name'] . ' | Deco & Ceram Projects')

@section('content')
    <!-- Project Header -->
    <section class="py-24 bg-brand-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl space-y-4 reveal animate-fade-in">
                <span class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ $project['type'] }}</span>
                <h1 class="text-4xl md:text-7xl font-serif">{{ $project['name'] }}</h1>
                <p class="text-brand-charcoal/40 uppercase tracking-widest text-sm italic">{{ $project['location'] }}</p>
            </div>
        </div>
    </section>

    <!-- Main project image -->
    <section class="reveal animate-fade-in">
        <div class="container mx-auto px-6">
            <div class="aspect-video bg-brand-stone overflow-hidden">
                <img src="{{ $project['images'][0] }}" alt="{{ $project['name'] }}" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Project Details -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <div class="space-y-8 reveal reveal-up">
                    <h2 class="text-3xl font-serif italic">{{ __('messages.projects.detail.scope') }}</h2>
                    <p class="text-lg text-brand-charcoal/80 font-light leading-relaxed">
                        {{ $project['description'] }}
                    </p>
                </div>
                <div class="space-y-12 reveal reveal-up" style="transition-delay: 100ms;">
                    <div class="space-y-6">
                        <h4 class="text-xs font-bold uppercase tracking-widest border-b border-brand-stone pb-2">
                            {{ __('messages.projects.detail.products_used') }}</h4>
                        <ul class="space-y-4">
                            @foreach($project['products_used'] as $productId)
                                <li class="flex items-center gap-4 group">
                                    <div class="w-12 h-12 bg-brand-stone overflow-hidden border border-brand-stone">
                                        <!-- Note: In a real app we'd fetch the product details here -->
                                        <div
                                            class="w-full h-full flex items-center justify-center text-[10px] uppercase font-bold text-brand-charcoal/20">
                                            Item</div>
                                    </div>
                                    <a href="{{ url(app()->getLocale() . '/products/' . $productId) }}"
                                        class="text-sm font-medium hover:text-brand-sand transition-colors border-b border-transparent hover:border-brand-sand">
                                        {{ ucwords(str_replace('-', ' ', $productId)) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Secondary Images Grid -->
    @if(count($project['images']) > 1)
        <section class="pb-24">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($project['images'] as $index => $image)
                        @if($index > 0)
                            <div class="aspect-[4/3] bg-brand-stone overflow-hidden reveal reveal-up">
                                <img src="{{ $image }}" alt="{{ $project['name'] }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-24 border-t border-brand-stone">
        <div class="container mx-auto px-6 text-center space-y-8 reveal reveal-up">
            <h2 class="text-3xl md:text-5xl font-serif">{{ __('messages.projects.detail.inspired') }}</h2>
            <div class="flex justify-center gap-4">
                <a href="{{ url(app()->getLocale() . '/contact') }}" class="btn-premium">
                    {{ __('messages.projects.detail.request_similar') }}
                </a>
                <a href="{{ url(app()->getLocale() . '/projects') }}" class="btn-premium-outline">
                    {{ __('messages.cta.back_to_projects') }}
                </a>
            </div>
        </div>
    </section>
@endsection