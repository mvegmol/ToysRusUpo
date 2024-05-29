@extends('layouts.app')

@section('content')
    <!-- CAROUSEL DE IMÁGENES -->
    <div class="container mx-auto max-w-carousel py-10">
        <div x-data="{ currentSlide: 0, slides: ['/images/slide1.png', '/images/slide2.png', '/images/slide3.png', '/images/slide4.png'] }" class="relative w-full overflow-hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index" class="w-full h-[600px] flex items-center justify-center">
                    <img :src="slide" class="object-contain h-full w-full">
                </div>
            </template>

            <div class="absolute inset-0 flex items-center justify-between px-0"> <!-- Cambiado de px-4 a px-2 -->
                <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1"
                    class="bg-primary hover:bg-tertiary text-white p-2 rounded-full">‹</button>
                <button @click="currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0"
                    class="bg-primary hover:bg-tertiary text-white p-2 rounded-full">›</button>
            </div>

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
    <div class="container mx-auto mt-10 py-10">
        <h2 class="text-3xl font-extrabold text-center text-gray-700 mb-8 tracking-wide">@lang("messages.topCategories")</h2>
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

    <!-- PRODUCTOS RECOMENDADOS -->
    <div class="container mx-auto mt-20 py-8 w-4/5 max-w-full">
        <h2 class="text-3xl font-extrabold text-center text-gray-700 mb-8 tracking-wide">@lang("messages.topToys")</h2>
        <div class="flex justify-center mb-10">
            <div class="w-1/4 border-t border-gray-300"></div>
        </div>
        <div x-data="{
            currentIndex: 0,
            products: {{ json_encode($products) }}
        }" class="relative w-full max-w-full mx-auto bg-secondary p-6 rounded-3xl shadow-lg">

            <button @click="currentIndex = (currentIndex - 1 + products.length) % products.length"
                    class="absolute -left-16 top-1/2 transform -translate-y-1/2 text-primary z-10 hover:text-tertiary transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>

            <div class="flex overflow-hidden">
                <!-- Debug: Print products in the console -->
                <template x-init="console.log(products)">
                    <!-- Ensure that Alpine.js is receiving the products array correctly -->
                </template>

                <template x-for="(product, index) in [...products, ...products].slice(currentIndex, currentIndex + 4)" :key="product.id">
                    <div class="w-1/4 px-4">
                        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden group transition transform hover:-translate-y-1 hover:shadow-3xl">
                            <div class="relative">
                                <img src="https://www.toysrus.es/medias/?context=bWFzdGVyfHByb2R1Y3RfaW1hZ2VzfDM3MTA5fGltYWdlL2pwZWd8YUdVeEwyaGtOeTh4TVRjd01ESTFOekE1TlRjeE1BfDE1NzE4NDQ2ZWQ2NDZlYTRlMWI3YTIzMTYyZmQ2OWI0YjEzZjE2MDY4YTAxNzRiMGZjNzdmZTlmODUwY2RmN2M" alt="product image" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                    <a :href="'/products_clients/' + product.id" class="text-lg w-12 h-12 rounded-full text-white bg-primary flex items-center justify-center hover:bg-tertiary transition" title="View Product">
                                        <svg xmlns="http://www.w3.org/5000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </a>
                                    <form :action="'{{ route('user.like') }}'" method="GET" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" :value="product.id">
                                        <button type="submit" class="text-lg w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center hover:bg-tertiary transition" :title="product.isFavorite ? 'Remove from Wishlist' : 'Add to Wishlist'">
                                            <template x-if="product.isFavorite">
                                                <svg xmlns="http://www.w3.org/5000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                                </svg>
                                            </template>
                                            <template x-if="!product.isFavorite">
                                                <svg xmlns="http://www.w3.org/5000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg>
                                            </template>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="absolute inset-0 flex items-end justify-center opacity-0 group-hover:opacity-100 transition pb-4">
                                <form :action="'{{ route('cart.add') }}'" method="POST" class="w-full px-4">
                                    @csrf
                                    <input type="hidden" name="product_id" :value="product.id">
                                    <button type="submit" class="w-full py-3 text-center bg-primary text-white text-lg rounded-full flex items-center justify-center hover:bg-tertiary transition">
                                        <img src="{{ asset('images/icons/shoppingCart.png') }}" alt="Add to Cart" class="inline-block mr-1" width="24" height="24" style="filter: invert(1); position: relative; top: -1px;">
                                        <span class="ml-1">@lang("messages.addCart")</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex-1">
                                <a :href="'/products_clients/' + product.id" class="hover:underline hover:text-primary">
                                    <h4 class="font-medium text-base mb-1 text-gray-800 hover:text-primary transition" x-text="product.name"></h4>
                                </a>
                                <p class="text-lg text-primary font-semibold" x-text=" product.price.toFixed(2)+'€'"></p>
                            </div>
                            <div class="mr-4 flex items-center">
                                <form :action="'{{ route('user.like') }}'" method="GET" class="inline">
                                    @csrf
                                    <input type="hidden" name="product_id" :value="product.id">
                                    <button type="submit" class="text-primary transition" title="Remove from Wishlist" onclick="this.classList.toggle('text-primary')">
                                        <template x-if="product.isFavorite">
                                            <svg xmlns="http://www.w3.org/5000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                            </svg>
                                        </template>
                                        <template x-if="!product.isFavorite">
                                            <svg xmlns="http://www.w3.org/5000/svg" width="24" height="24" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                            </svg>
                                        </template>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <button @click="currentIndex = (currentIndex + 1) % products.length"
                    class="absolute -right-16 top-1/2 transform -translate-y-1/2 text-primary z-10 hover:text-tertiary transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>







@endsection
