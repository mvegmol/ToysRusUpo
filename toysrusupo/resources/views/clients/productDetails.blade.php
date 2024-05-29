@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-start p-8 bg-white border rounded-lg shadow-md m-5">
        <!-- Image Container -->
        <div class="w-full lg:w-1/2 flex justify-center">
            <div class="w-full lg:w-3/4">
                <!-- Dynamic image field using 'image_url' attribute -->
                <img src="{{ asset('images/products/product1.jpg') }}"
                    alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-xl border" />
            </div>

        </div>
        <!-- Description Container -->
        <div class="w-full lg:w-1/2 flex flex-col gap-4">
            <div>
                <!-- Displaying product name and price -->
                <div class="flex items-center">
                    <h1 class="w-3/4 text-3xl font-bold mt-2 text-primary uppercase my-1">{{ $product->name }}</h1>
                    <button
                        class="w-1/4 flex items-center justify-center text-red-600 font-semibold py-3 px-6 rounded-xl transition-transform transform hover:scale-105 ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                            class="bi bi-heart mr-2" viewBox="0 0 16 16">
                            <path
                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                        </svg>
                    </button>
                </div>
                <hr>
                <h2 class="text-secondary text-2xl font-bold mt-2 my-2">Product Detail</h2>
                <p class="text-secondary text-lg mt-2 my-2">{{ $product->description }}</p>
                <hr>
                <h3 class="text-3xl font-semibold text-tertiary my-4">{{ $product->price }} €</h3>
            </div>
            <div class="flex items-center gap-2">
                <!-- Adding a novelty indicator if desired -->
                @if ($product->stock)
                    <span class="bg-green-500 text-white text-sm px-2 py-1 rounded">In Stock</span>
                @else
                    <span class="bg-red-500 text-white text-sm px-2 py-1 rounded">Out of Stock</span>
                @endif
            </div>
            <hr>
            <div class="flex gap-1 ">
                <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"
                        class="w-full bg-primary  flex items-center justify-center text-white font-semibold py-3 px-6 rounded-xl border border-primary transition-transform transform hover:scale-105 mt-4 mr-1">
                        Add to Cart
                    </button>
                </form>

            </div>
            <div class="flex flex-col mt-4 border-t border-gray-300 pt-4">
                <div class="flex justify-between">
                    <!-- Displaying the product's category -->
                    <span class="text-gray-500">Category</span>
                    <span class="text-gray-700 font-semibold">{{ $product->category_names }}</span>
                </div>
                <div class="flex justify-between mt-2">
                    <!-- Displaying the recommended age for the product -->
                    <span class="text-gray-500">Recommended Age</span>
                    <span class="text-gray-700 font-semibold">{{ $product->min_age }}+</span>
                </div>
                <!-- Add more product details here -->
            </div>
        </div>
    </div>
@endsection
