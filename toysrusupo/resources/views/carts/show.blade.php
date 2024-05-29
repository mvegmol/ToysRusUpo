@extends('layouts.app')

@section('content')
    <div class="h-screen bg-white pt-20">
        <h1 class="mb-10 text-center text-2xl font-bold">@lang("messages.s_cart")</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="rounded-lg md:w-2/3">
                <div id="mensaje"></div>
                @foreach ($productos as $product)
                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                        <img src="{{ asset('images/products/product1.jpg') }}"
                            alt="product-image" class="w-full rounded-lg sm:w-40" />
                        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">


                            <div class="mt-5 sm:mt-0">
                                <h2 class="text-lg font-bold text-gray-900">{{$product->name}}</h2>
                                <p class="mt-1 text-xs text-gray-700">{{$product->description}}</p>
                            </div>
                            <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                <div class="flex items-center border-gray-100 product-container" data-product-id="{{ $product->id }}">
                                    <button class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50 decrement-btn">-</button>
                                    <input class="h-8 w-8 border bg-white text-center text-xs outline-none quantity-input" type="number" value="{{ $product->pivot->quantity }}" min="1" />
                                    <button class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50 increment-btn">+</button>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <p class="text-sm">{{$product->pivot->total_price}} €</p>
                                    <form id="deleteProductForm" action="{{ route('cart.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                        <button  type ='submit'>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $productos->links() }}
            </div>
            <!-- Sub total -->
            <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <div class="mb-2 flex justify-between">
                    <p class="text-gray-700">Subtotal</p>
                    <p class="text-gray-700">{{$carrito->total_price}}€</p>
                </div>
                <div class="flex justify-between">
                    @if ($carrito->total_price >=50)
                        <p class="text-gray-700">@lang("messages.envio")</p>
                        <p class="text-gray-700">@lang("messages.free")</p>
                    @else
                        <p class="text-gray-700">@lang("messages.envio")</p>
                        <p class="text-gray-700">5€</p>
                    @endif
                </div>
                <hr class="my-4" />
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="">
                        @if ($carrito->total_price >=50)
                            <p class="mb-1 text-lg font-bold">{{$carrito->total_price}}€</p>
                            <p class="text-sm text-gray-700">@lang("messages.iva")</p>
                        @else
                            @php
                                $total = $carrito->total_price + 5;
                            @endphp
                            <p class="mb-1 text-lg font-bold">{{$total}}€</p>
                            <p class="text-sm text-gray-700">@lang("messages.iva")</p>
                        @endif
                    </div>
                </div>
                <form method="GET" action="{{ route('cart.checkout') }}">
                    <button type="submit" class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600 bg-primary">
                        @lang("messages.checkout")
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('successMessage');
    const errorMessage = urlParams.get('errorMessage');

    if (successMessage) {
        displayMessage(successMessage, 'success');
    } else if (errorMessage) {
        displayMessage(errorMessage, 'error');
    }

    const incrementButtons = document.querySelectorAll('.increment-btn');
    const decrementButtons = document.querySelectorAll('.decrement-btn');
    const quantityInputs = document.querySelectorAll('.quantity-input');

    incrementButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = button.parentElement.dataset.productId;
            updateCart(productId, 'increment');
        });
    });

    decrementButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = button.parentElement.dataset.productId;
            updateCart(productId, 'decrement');
        });
    });

    quantityInputs.forEach(input => {
        input.addEventListener('change', function () {
            const productId = input.parentElement.dataset.productId;
            updateCart(productId, 'update', input.value);
        });
    });

    function updateCart(productId, action, quantity = null) {
        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('_token', '{{ csrf_token() }}');

        if (action === 'update') {
            formData.append('quantity', quantity);
        }

        fetch('/cart/' + action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            let message = '';
            if (data.success) {
                message = 'Producto añadido al carrito con éxito';
            } else {
                message = 'No hay suficiente cantidad disponible';
            }
            redirectToPageWithMessage(message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function redirectToPageWithMessage(message) {
        const url = new URL(window.location.href);

            url.searchParams.set('error', message);
            window.location.href = url.toString();

        url.searchParams.set('successMessage', message);
        window.location.href = url.toString();

    }

    function displayMessage(message, type) {
        const isNotEnoughQuantity = message === "No hay suficiente cantidad disponible";
        const messageType = isNotEnoughQuantity ? 'error' : type;

        const messageContainer = document.createElement('div');
        messageContainer.classList.add('bg-' + (messageType === 'success' ? 'green' : 'red') + '-100', 'border', 'border-' + (messageType === 'success' ? 'green' : 'red') + '-400', 'text-' + (messageType === 'success' ? 'green' : 'red') + '-700', 'px-4', 'py-3', 'rounded', 'relative', 'mb-4');
        messageContainer.textContent = message;

        var div = document.getElementById("mensaje");
        div.appendChild(messageContainer);

        setTimeout(function() {
            messageContainer.remove();
        }, 2000);
    }
});
</script>
