@extends('layouts.app')

@section('title', __('messages.quote.thank_you_title') ?? 'Thank You')

@section('content')
    <div class="bg-brand-white min-h-screen pt-32 pb-24">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-brand-stone/20 text-center">

                <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-10 h-10 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl font-serif text-brand-charcoal mb-4">
                    {{ __('messages.quote.thank_you_title') ?? 'Thank You!' }}
                </h1>

                <p class="text-lg text-brand-charcoal/70 mb-10">
                    {{ __('messages.quote.thank_you_message') ?? 'Our team will contact you soon.' }}
                </p>

                <div class="text-left bg-[#FCFCFC] rounded-2xl border border-[#EBEBEB] p-6 md:p-8">
                    <h2 class="text-xl font-bold text-black mb-6">
                        {{ __('messages.quote.order_summary') ?? 'Order Summary' }}
                    </h2>

                    <div class="space-y-4">
                        @foreach($quote->items as $item)
                            <div class="flex items-center gap-4 py-4 border-b border-[#EBEBEB] last:border-0">
                                <div
                                    class="w-16 h-16 bg-[#F0F0F0] rounded-xl overflow-hidden shrink-0 flex items-center justify-center p-2">
                                    <img src="{{ ($item->product->primary_image_url ?? 'images/placeholder.webp') }}"
                                        alt="{{ $item->product->name ?? 'Product' }}"
                                        class="max-w-full max-h-full object-contain mix-blend-multiply">
                                </div>
                                <div class="flex-grow">
                                    <h3 class="font-bold text-brand-charcoal">{{ $item->product->name ?? 'Unknown Product' }}</h3>
                                    @if($item->variant_name)
                                        <p class="text-xs text-brand-sand font-medium mt-0.5">{{ $item->variant_name }}</p>
                                    @endif
                                    <p class="text-xs text-brand-charcoal/60 mt-1">
                                        @if($item->meters > 0)
                                            {{ number_format($item->meters, 2) }} m² ({{ $item->quantity }} pcs)
                                        @else
                                            {{ $item->quantity }} pcs
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('home', app()->getLocale()) }}"
                        class="inline-block px-5 py-4 bg-black text-white text-[10px] uppercase tracking-[0.3em] font-bold rounded-full transition-all duration-500 hover:bg-gray-800">
                        {{ __('messages.quote.back_to_home') ?? 'Back to Home' }}
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection