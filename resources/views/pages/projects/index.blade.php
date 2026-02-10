@extends('layouts.app')

@section('title', 'Projects | Deco & Ceram')

@section('content')
    <div class="bg-brand-white py-12 border-b border-brand-stone">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-serif mb-4">{{ __('messages.projects.title') }}</h1>
            <p class="text-brand-charcoal/60 uppercase tracking-widest text-xs">{{ __('messages.projects.sub_title') }}</p>
        </div>
    </div>

    <section class="py-20">
        <div class="container mx-auto px-6">
            <!-- Filter Bar -->
            <div class="flex flex-wrap gap-8 mb-16 border-b border-brand-stone pb-8">
                <a href="#"
                    class="text-xs uppercase tracking-widest font-bold border-b-2 border-brand-charcoal pb-1">{{ __('messages.projects.filters.all') }}</a>
                <a href="#"
                    class="text-xs uppercase tracking-widest text-brand-charcoal/40 border-b-2 border-transparent pb-1 hover:text-brand-charcoal transition-colors">{{ __('messages.projects.filters.residential') }}</a>
                <a href="#"
                    class="text-xs uppercase tracking-widest text-brand-charcoal/40 border-b-2 border-transparent pb-1 hover:text-brand-charcoal transition-colors">{{ __('messages.projects.filters.commercial') }}</a>
                <a href="#"
                    class="text-xs uppercase tracking-widest text-brand-charcoal/40 border-b-2 border-transparent pb-1 hover:text-brand-charcoal transition-colors">{{ __('messages.projects.filters.outdoor') }}</a>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($projects as $project)
                    <x-project.card :project="$project" />
                @endforeach
            </div>
        </div>
    </section>
@endsection