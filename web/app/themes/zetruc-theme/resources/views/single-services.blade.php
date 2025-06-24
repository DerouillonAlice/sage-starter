@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<section class="py-20 bg-gray-900 text-white">
  <div class="container mx-auto px-6 max-w-7xl">
    <div class="text-center">
      <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ get_the_title() }}</h1>
      @if (get_field('services_desc'))
        <div class="text-xl leading-relaxed max-w-3xl mx-auto">
          {!! get_field('services_desc') !!}
        </div>
      @endif
    </div>
  </div>
</section>

{{-- Contenu principal --}}
<section class="py-16 bg-white">
  <div class="container mx-auto px-6 max-w-4xl">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
      
      {{-- Image du service --}}
      @if (get_field('services_icon'))
        <div class="lg:col-span-1">
          <div class="bg-gray-50 rounded-2xl p-8 text-center">
            <img src="{{ get_field('services_icon') }}" alt="{{ get_the_title() }}" class="w-24 h-24 mx-auto mb-4 object-contain">
            <h3 class="text-lg font-semibold text-gray-800">{{ get_the_title() }}</h3>
          </div>
        </div>
      @endif

      {{-- Contenu détaillé --}}
      <div class="lg:col-span-2">
        @if (has_post_thumbnail())
          <img src="{{ get_the_post_thumbnail_url('large') }}" alt="{{ get_the_title() }}" class="w-full rounded-xl mb-8 shadow-lg">
        @endif

        <div class="prose prose-lg max-w-none">
          @php(the_content())
        </div>

        {{-- Bouton d'action --}}
        @if (get_field('services_link') && get_field('services_link_text'))
          <div class="mt-8">
            <a href="{{ get_field('services_link') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
              <span class="mr-2">{{ get_field('services_link_text') }}</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
              </svg>
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>


@endsection