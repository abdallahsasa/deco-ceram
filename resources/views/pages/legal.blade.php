@extends('layouts.app')

@section('title', 'Legal Notice | Deco & Ceram')

@section('content')
    <section class="py-24 bg-brand-white">
        <div class="container mx-auto px-6 max-w-3xl">
            <h1 class="text-4xl font-serif mb-12">{{ __('messages.legal.title') }}</h1>

            <div class="prose prose-brand-charcoal space-y-8 text-sm leading-relaxed text-brand-charcoal/80">
                <section class="space-y-4">
                    <h2 class="text-xl font-serif uppercase tracking-widest text-brand-charcoal">
                        {{ __('messages.legal.s1_title') }}</h2>
                    <p>{{ __('messages.legal.s1_desc') }}</p>
                    <p>{{ __('messages.legal.s1_hq') }}</p>
                    <p>Email: contact@deco-ceram.fr</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-serif uppercase tracking-widest text-brand-charcoal">
                        {{ __('messages.legal.s2_title') }}</h2>
                    <p>{{ __('messages.legal.s2_desc') }}</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-serif uppercase tracking-widest text-brand-charcoal">
                        {{ __('messages.legal.s3_title') }}
                    </h2>
                    <p>{{ __('messages.legal.s3_desc') }}</p>
                </section>

                <section class="space-y-4">
                    <h2 class="text-xl font-serif uppercase tracking-widest text-brand-charcoal">
                        {{ __('messages.legal.s4_title') }}
                    </h2>
                    <p>{{ __('messages.legal.s4_desc') }}</p>
                </section>
            </div>
        </div>
    </section>
@endsection