@extends('layouts.app')

@section('title', 'About Us | Deco & Ceram')

@section('content')
    <!-- Brand Story Hero -->
    <section class="py-24 md:py-32 bg-brand-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center space-y-8 reveal animate-fade-in">
                <span class="text-xs uppercase tracking-[0.3em] text-brand-sand font-bold">{{ __('messages.about.hero_badge') }}</span>
                <h1 class="text-4xl md:text-7xl font-serif leading-tight text-brand-charcoal">{{ __('messages.about.hero_title') }}</h1>
            </div>
        </div>
    </section>

    <!-- Large Image Section -->
    <section class="reveal animate-fade-in">
        <div class="container mx-auto px-6">
            <div class="aspect-[21/9] bg-brand-stone overflow-hidden">
                <img src="/images/hero/luxury_interior.png" alt="Craftsmanship" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Story Text -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <div class="space-y-6 reveal reveal-up">
                    <h2 class="text-3xl font-serif">{{ __('messages.about.philosophy_title') }}</h2>
                    <p class="text-lg text-brand-charcoal/80 font-light leading-relaxed">
                        {{ __('messages.about.philosophy_desc') }}
                    </p>
                </div>
                <div class="space-y-8 text-brand-charcoal/60 leading-relaxed reveal reveal-up"
                    style="transition-delay: 100ms;">
                    <p>
                        {{ __('messages.about.story_p1') }}
                    </p>
                    <p>
                        {{ __('messages.about.story_p2') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Philisophy Cards -->
    <section class="pb-24">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-12 border border-brand-stone space-y-6 reveal reveal-up">
                    <h4 class="font-bold uppercase tracking-widest text-xs">{{ __('messages.about.exclusivity') }}</h4>
                    <p class="text-sm text-brand-charcoal/60 leading-relaxed">{{ __('messages.about.exclusivity_desc') }}</p>
                </div>
                <div class="p-12 border border-brand-stone space-y-6 reveal reveal-up" style="transition-delay: 100ms;">
                    <h4 class="font-bold uppercase tracking-widest text-xs">{{ __('messages.about.precision') }}</h4>
                    <p class="text-sm text-brand-charcoal/60 leading-relaxed">{{ __('messages.about.precision_desc') }}</p>
                </div>
                <div class="p-12 border border-brand-stone space-y-6 reveal reveal-up" style="transition-delay: 200ms;">
                    <h4 class="font-bold uppercase tracking-widest text-xs">{{ __('messages.about.legacy') }}</h4>
                    <p class="text-sm text-brand-charcoal/60 leading-relaxed">{{ __('messages.about.legacy_desc') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection