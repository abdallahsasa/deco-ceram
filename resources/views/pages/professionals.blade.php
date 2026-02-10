@extends('layouts.app')

@section('title', 'For Professionals | Deco & Ceram')

@section('content')
    <!-- Hero Section -->
    <section class="py-24 bg-brand-charcoal text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-brand-sand/10 transform skew-x-12 translate-x-1/2"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl space-y-8 reveal animate-fade-in">
                <span
                    class="text-xs uppercase tracking-widest text-brand-sand font-bold">{{ __('messages.nav.professionals') }}</span>
                <h1 class="text-4xl md:text-7xl font-serif">{{ __('messages.professionals.hero_title') }}</h1>
                <p class="text-white/60 text-lg md:text-xl font-light leading-relaxed">
                    {{ __('messages.professionals.hero_desc') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="space-y-6 reveal reveal-up">
                    <div class="w-12 h-12 border border-brand-charcoal flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <h3 class="text-xl uppercase tracking-widest">{{ __('messages.professionals.services.sourcing_title') }}
                    </h3>
                    <p class="text-sm text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.services.sourcing_desc') }}</p>
                </div>
                <div class="space-y-6 reveal reveal-up" style="transition-delay: 100ms;">
                    <div class="w-12 h-12 border border-brand-charcoal flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                    <h3 class="text-xl uppercase tracking-widest">
                        {{ __('messages.professionals.services.optimization_title') }}</h3>
                    <p class="text-sm text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.services.optimization_desc') }}</p>
                </div>
                <div class="space-y-6 reveal reveal-up" style="transition-delay: 200ms;">
                    <div class="w-12 h-12 border border-brand-charcoal flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V3.375c0-.621-.504-1.125-1.125-1.125h-1.5a1.125 1.125 0 00-1.125 1.125v1.5m-6 0h6m-9 0h6m-9 0H6.75a1.125 1.125 0 01-1.125-1.125V4.875c0-.621.504-1.125 1.125-1.125h1.5a1.125 1.125 0 011.125 1.125V6.75" />
                        </svg>
                    </div>
                    <h3 class="text-xl uppercase tracking-widest">{{ __('messages.professionals.services.guidance_title') }}
                    </h3>
                    <p class="text-sm text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.services.guidance_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="py-24 bg-brand-stone/20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-4xl font-serif">{{ __('messages.professionals.process.title') }}</h2>
                <p class="text-brand-charcoal/60 uppercase tracking-widest text-xs">
                    {{ __('messages.professionals.process.subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white p-8 space-y-4 reveal reveal-up">
                    <span class="text-brand-sand font-serif text-2xl">01</span>
                    <h4 class="font-bold uppercase tracking-widest text-sm">
                        {{ __('messages.professionals.process.step1_title') }}</h4>
                    <p class="text-xs text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.process.step1_desc') }}</p>
                </div>
                <div class="bg-white p-8 space-y-4 reveal reveal-up" style="transition-delay: 100ms;">
                    <span class="text-brand-sand font-serif text-2xl">02</span>
                    <h4 class="font-bold uppercase tracking-widest text-sm">
                        {{ __('messages.professionals.process.step2_title') }}</h4>
                    <p class="text-xs text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.process.step2_desc') }}</p>
                </div>
                <div class="bg-white p-8 space-y-4 reveal reveal-up" style="transition-delay: 200ms;">
                    <span class="text-brand-sand font-serif text-2xl">03</span>
                    <h4 class="font-bold uppercase tracking-widest text-sm">
                        {{ __('messages.professionals.process.step3_title') }}</h4>
                    <p class="text-xs text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.process.step3_desc') }}</p>
                </div>
                <div class="bg-white p-8 space-y-4 reveal reveal-up" style="transition-delay: 300ms;">
                    <span class="text-brand-sand font-serif text-2xl">04</span>
                    <h4 class="font-bold uppercase tracking-widest text-sm">
                        {{ __('messages.professionals.process.step4_title') }}</h4>
                    <p class="text-xs text-brand-charcoal/60 leading-relaxed">
                        {{ __('messages.professionals.process.step4_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 border-t border-brand-stone">
        <div class="container mx-auto px-6">
            <div
                class="bg-brand-charcoal text-white p-12 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12 reveal reveal-up">
                <div class="space-y-6 max-w-xl">
                    <h2 class="text-3xl md:text-5xl font-serif">{{ __('messages.professionals.cta_title') }}</h2>
                    <p class="text-white/60 text-lg font-light leading-relaxed">
                        {{ __('messages.professionals.cta_desc') }}
                    </p>
                </div>
                <div>
                    <a href="{{ url(app()->getLocale() . '/contact') }}"
                        class="btn-premium !bg-brand-sand !text-brand-charcoal hover:!bg-white">
                        {{ __('messages.cta.send_plans') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection