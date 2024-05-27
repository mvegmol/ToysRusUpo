@extends('layouts.app')

@section('content')
    <!-- CAROUSEL DE IMÁGENES -->
    <div class="container mx-auto max-w-carousel py-10">
        <div x-data="{ currentSlide: 0, slides: ['/images/slide1.png', '/images/slide2.png', '/images/slide3.png', '/images/slide4.png'] }" class="relative w-full overflow-hidden">
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index" class="w-full h-[600px] flex items-center justify-center">
                    <img :src="slide" class="object-contain h-full w-full">
                </div>
            </template>

            <!-- Navigation -->
            <div class="absolute inset-0 flex items-center justify-between px-0"> <!-- Cambiado de px-4 a px-2 -->
                <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1"
                    class="bg-primary hover:bg-tertiary text-white p-2 rounded-full">‹</button>
                <button @click="currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0"
                    class="bg-primary hover:bg-tertiary text-white p-2 rounded-full">›</button>
            </div>

            <!-- Indicators -->
            <div class="absolute bottom-0 left-0 right-0 flex justify-center p-4">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="currentSlide = index"
                        :class="{ 'bg-primary': currentSlide === index, 'bg-gray-500': currentSlide !== index }"
                        class="w-3 h-3 mx-1 rounded-full"></button>
                </template>
            </div>
        </div>
    </div>


    <!-- CATEGORÍAS FAVORITAS -->
    <div class="container mx-auto py-10">
        <h2 class="text-3xl font-extrabold text-center text-gray-700 mb-8 tracking-wide">Top Selling Categories</h2>
        <div class="flex justify-center mb-10">
            <div class="w-1/4 border-t border-gray-300"></div>
        </div>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('products.categoryToys', ['category' => $category->id]) }}"
                    class="flex items-center justify-center bg-primary hover:bg-tertiary text-white rounded-xl p-4 w-full h-20 transform transition-transform duration-300 hover:scale-105 shadow-lg">
                    <span class="text-lg font-semibold uppercase">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
@endsection
