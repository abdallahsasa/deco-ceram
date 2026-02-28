@extends('layouts.app')

@section('title', 'Contact Us | Deco & Ceram')

@section('content')
    <div class="bg-brand-white py-12 border-b border-brand-stone">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-serif mb-4">{{ __('messages.contact.title') }}</h1>
            <p class="text-brand-charcoal/60 uppercase tracking-widest text-xs">{{ __('messages.contact.subtitle') }}</p>
        </div>
    </div>

    <section class="py-20 lg:py-32">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20">
                <!-- Info -->
                <div class="space-y-12 reveal animate-fade-in">
                    <div class="space-y-6">
                        <h2 class="text-3xl font-serif">{{ __('messages.contact.get_in_touch') }}</h2>
                        <p class="text-lg text-brand-charcoal/60 font-light leading-relaxed">
                            {{ __('messages.contact.desc') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-brand-sand">
                                {{ __('messages.contact.office') }}
                            </h4>
                            <p class="text-sm text-brand-charcoal/80 leading-relaxed">
                                123 Avenue des Champs-Élysées<br>
                                75008 Paris, France
                            </p>
                        </div>
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-brand-sand">
                                {{ __('messages.contact.inquiries') }}
                            </h4>
                            <p class="text-sm text-brand-charcoal/80">
                                <a href="mailto:info@deco-ceram.com"
                                    class="hover:text-brand-sand transition-colors">info@deco-ceram.com</a><br>
                                <a href="tel:+33684130952" class="hover:text-brand-sand transition-colors">+33 6 84 13 09
                                    52</a>
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-brand-sand">
                            {{ __('messages.contact.response') }}
                        </h4>
                        <a href="https://wa.me/33684130952"
                            class="inline-flex items-center gap-4 p-6 bg-brand-stone/20 border border-brand-stone hover:bg-brand-stone/40 transition-all group w-full max-w-sm">
                            <div class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.067 2.877 1.215 3.076.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </div>
                            <div class="text-start">
                                <span
                                    class="block text-xs uppercase tracking-widest font-bold">{{ __('messages.contact.whatsapp_support') }}</span>
                                <span
                                    class="block text-[10px] text-brand-charcoal/40 uppercase">{{ __('messages.contact.whatsapp_timing') }}</span>
                            </div>
                        </a>
                    </div>

                    <!-- Map Placeholder -->
                    <div
                        class="aspect-video bg-brand-stone grayscale border border-brand-stone flex items-center justify-center opacity-60">
                        <span
                            class="text-xs uppercase tracking-widest italic">{{ __('messages.contact.map_placeholder') }}</span>
                    </div>
                </div>

                <!-- Form -->
                <div class="bg-white p-8 md:p-12 quiet-shadow reveal reveal-up">
                    <form action="#" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] uppercase tracking-[0.2em] font-bold">{{ __('messages.contact.form.name') }}</label>
                                <input type="text" placeholder="John Doe"
                                    class="w-full bg-transparent border-0 border-b border-brand-stone py-2 focus:ring-0 focus:border-brand-sand transition-all text-sm">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] uppercase tracking-[0.2em] font-bold">{{ __('messages.contact.form.company') }}</label>
                                <input type="text" placeholder="Architects & Co"
                                    class="w-full bg-transparent border-0 border-b border-brand-stone py-2 focus:ring-0 focus:border-brand-sand transition-all text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] uppercase tracking-[0.2em] font-bold">{{ __('messages.contact.form.email') }}</label>
                                <input type="email" placeholder="john@example.com"
                                    class="w-full bg-transparent border-0 border-b border-brand-stone py-2 focus:ring-0 focus:border-brand-sand transition-all text-sm">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] uppercase tracking-[0.2em] font-bold">{{ __('messages.contact.form.phone') }}</label>
                                <input type="tel" placeholder="+33 6 84 13 09 52"
                                    class="w-full bg-transparent border-0 border-b border-brand-stone py-2 focus:ring-0 focus:border-brand-sand transition-all text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[10px] uppercase tracking-[0.2em] font-bold">{{ __('messages.contact.form.project_type') }}</label>
                            <select
                                class="w-full bg-transparent border-0 border-b border-brand-stone py-2 focus:ring-0 focus:border-brand-sand transition-all text-sm uppercase tracking-tighter cursor-pointer">
                                <option>{{ __('messages.contact.form.types.villa') }}</option>
                                <option>{{ __('messages.contact.form.types.commercial') }}</option>
                                <option>{{ __('messages.contact.form.types.hospitality') }}</option>
                                <option>{{ __('messages.contact.form.types.outdoor') }}</option>
                                <option>{{ __('messages.contact.form.types.other') }}</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[10px] uppercase tracking-[0.2em] font-bold">{{ __('messages.contact.form.message') }}</label>
                            <textarea rows="4" placeholder="..."
                                class="w-full bg-transparent border-0 border-b border-brand-stone py-2 focus:ring-0 focus:border-brand-sand transition-all text-sm resize-none"></textarea>
                        </div>

                        <div class="pt-4">
                            <button type="button" class="btn-premium w-full">{{ __('messages.cta.send_inquiry') }}</button>
                            <p class="text-[10px] text-brand-charcoal/40 mt-4 text-center">
                                {{ __('messages.contact.form.privacy_note') }}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection