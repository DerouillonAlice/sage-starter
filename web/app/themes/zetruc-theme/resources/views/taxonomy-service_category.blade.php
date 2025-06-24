@extends('layouts.app')

@section('content')
{{-- Header Section --}}
<section class="py-20 bg-gray-900 text-white">
  <div class="container mx-auto px-6 max-w-7xl text-center">
    <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ single_term_title('', false) }}</h1>
    
    @if (term_description())
      <div class="text-xl max-w-3xl mx-auto leading-relaxed">
        {!! term_description() !!}
      </div>
    @endif
  </div>
</section>

{{-- Services Grid --}}
<section class="py-16 bg-white">
  <div class="container mx-auto px-6 max-w-7xl">
    
    @php
      $services = new WP_Query([
        'post_type' => 'services',
        'posts_per_page' => -1,
        'tax_query' => [
          [
            'taxonomy' => 'service_category',
            'field'    => 'slug',
            'terms'    => get_queried_object()->slug,
          ],
        ],
      ]);
    @endphp

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @while ($services->have_posts()) @php $services->the_post() @endphp
          
          <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
            
            {{-- Icône --}}
            @if (get_field('services_icon'))
              <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 text-center">
                <img src="{{ get_field('services_icon') }}" alt="{{ get_the_title() }}" class="w-20 h-20 mx-auto object-contain">
              </div>
            @endif

            {{-- Contenu --}}
            <div class="p-6">
              <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">
                {{ get_the_title() }}
              </h3>

              {{-- Description --}}
              @if (get_field('services_desc'))
                <div class="text-gray-600 mb-6 line-clamp-4">
                  {!! wp_trim_words(get_field('services_desc'), 20) !!}
                </div>
              @endif

              {{-- Actions --}}
              <div class="flex flex-col space-y-3">
                <a href="{{ get_permalink() }}" class="w-full text-center px-6 py-3 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                  En savoir plus
                </a>
                
                @if (get_field('services_link') && get_field('services_link_text'))
                  <a href="{{ get_field('services_link') }}" class="w-full text-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    {{ get_field('services_link_text') }}
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endwhile
      </div>

    
</section>


@endsection