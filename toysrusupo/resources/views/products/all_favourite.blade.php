@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center flex-col pb-8">
        <nav class="text-sm mt-4 mb-10">
            <a href="{{ route('welcome.index') }}" class="text-gray-500 hover:text-primary hover:underline">Home</a>
            <span class="text-gray-500 mx-2">›</span>
            <span class="text-primary">Toys</span>
        </nav>
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-6">Most Liked Products</h1>
            <p class="text-base text-gray-600 leading-relaxed">
                Playing to learn: the importance of toys and play. Toys are essential tools for children's development,
                enhancing learning in all areas. Through play, children develop fine and gross motor skills, personal
                preferences, social abilities, manual skills, coordination, expression, and creativity.
            </p>
        </div>
    </div>

    <div class="w-1/2 border-t border-gray-300 mx-auto my-8"></div>

    <div
        class="w-full max-w-full m-0 mx-auto mb-16 px-3 flex justify-center items-start flex-nowrap whitespace-nowrap text-center">
        <nav class="flex space-x-10 px-4 overflow-x-auto  scrollbar-hide">
            <div class="w-[170px] p-0 mx-[5px] mb-4 text-center border-0 rounded-none overflow-hidden flex-shrink-0 transition-all duration-150 ease-in-out">
                <a href="{{ route('products.favourites') }}"
                    class="text-gray-500 hover:text-primary hover:font-semibold transition-all duration-150 ease-in-out">
                    <span class="text-sm">All</span>
                </a>
            </div>
            @foreach ($categories as $c)
                <div
                    class="min-w-[170px] p-0 mx-[5px] text-center border-0 rounded-none overflow-hidden flex-shrink-0 transition-all duration-150 ease-in-out">
                    <a href="{{ route('products.categoryToysFavourites', $c->id) }}"
                        class="text-gray-500 hover:text-primary hover:font-semibold transition-all duration-150 ease-in-out">
                        <span class="text-sm">{{ $c->name }}</span>
                    </a>
                </div>
            @endforeach

        </nav>
    </div>


    <div class="flex justify-center pb-16 mt-16">
        <div class="w-3/4">
            @if (isset($category))
                <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">{{ $category->name }}</h2>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @forelse ($products as $product)
                    <div>
                        <div
                            class="bg-white shadow-2xl rounded-2xl overflow-hidden group transition transform hover:-translate-y-1 hover:shadow-3xl">
                            <div class="relative">
                                <img src="https://www.toysrus.es/medias/?context=bWFzdGVyfHByb2R1Y3RfaW1hZ2VzfDM3MTA5fGltYWdlL2pwZWd8YUdVeEwyaGtOeTh4TVRjd01ESTFOekE1TlRjeE1BfDE1NzE4NDQ2ZWQ2NDZlYTRlMWI3YTIzMTYyZmQ2OWI0YjEzZjE2MDY4YTAxNzRiMGZjNzdmZTlmODUwY2RmN2M"
                                    alt="product 1" class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                    <a href="{{ route('products_clients.show', $product->id) }}"
                                        class="text-lg w-12 h-12 rounded-full text-white bg-primary flex items-center justify-center hover:bg-tertiary transition"
                                        title="View Product">
                                        <svg xmlns="http://www.w3.org/5000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </a>
                                    @if (in_array($product->id, $favorites))
                                        <form action="{{ route('user.like') }}" method="GET" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit"
                                                class="text-lg w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center hover:bg-tertiary transition"
                                                title="Remove from Wishlist">
                                                <svg xmlns="http://www.w3.org/5000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.like') }}" method="GET" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit"
                                                class="text-lg w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center hover:bg-tertiary transition"
                                                title="Add to Wishlist">
                                                <svg xmlns="http://www.w3.org/5000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path
                                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div
                                class="absolute inset-0 flex items-end justify-center opacity-0 group-hover:opacity-100 transition pb-4">
                                <form action="{{ route('cart.add') }}" method="POST" class="w-full px-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                        class="w-full py-3 text-center bg-primary text-white text-lg rounded-full flex items-center justify-center hover:bg-tertiary transition">
                                        <img src="{{ asset('images/icons/shoppingCart.png') }}" alt="Add to Cart"
                                            class="inline-block mr-1" width="24" height="24"
                                            style="filter: invert(1); position: relative; top: -1px;">
                                        <span class="ml-1">Add to Cart</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex-1">
                                <a href="#" class="hover:underline hover:text-primary">
                                    <h4 class="font-medium text-base mb-1 text-gray-800 hover:text-primary transition">
                                        {{ $product->name }}
                                    </h4>
                                </a>
                                <p class="text-lg text-primary font-semibold">${{ number_format($product->price, 2) }}</p>
                            </div>
                            <div class="mr-4 flex items-center">
                                @if (in_array($product->id, $favorites))
                                    <form action="{{ route('user.like') }}" method="GET" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="text-primary transition" title="Remove from Wishlist"
                                            onclick="this.classList.toggle('text-primary')">
                                            <svg xmlns="http://www.w3.org/5000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('user.like') }}" method="GET" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="text-gray-400 hover:text-primary transition"
                                            title="Add to Wishlist" onclick="this.classList.toggle('text-primary')">
                                            <svg xmlns="http://www.w3.org/5000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                <path
                                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full">
                        <p class="text-gray-700">No se encontraron productos</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-16">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.overflow-x-auto');

            container.addEventListener('wheel', function(e) {
                if (e.deltaY !== 0) {
                    e.preventDefault();
                    container.scrollLeft += e.deltaY *
                        2;
                }
            });
            container.scrollLeft = 0;
        });
    </script>
@endsection
