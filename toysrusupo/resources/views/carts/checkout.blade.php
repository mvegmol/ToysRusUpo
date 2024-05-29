@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 mt-4 rounded-lg">
    <h1 class="text-5xl font-extrabold mb-10 text-primary text-center">@lang("messages.checkout")</h1>

    <div class="bg-white p-8 rounded-xl shadow-lg mb-10">
        <h2 class="text-2xl font-semibold mb-6 text-secondary flex items-center">
            @lang("messages.select_a")
        </h2>
        <div class="space-y-6">
            @foreach ($addresses as $address)
                <div class="border p-6 rounded-xl flex items-center hover:bg-gray-50 transition-shadow duration-300 ease-in-out shadow-sm hover:shadow-md">
                    <input type="radio" name="address" id="address{{ $loop->index }}" value="{{ $address->id }}" class="mr-4 text-primary focus:ring-primary">
                    <label for="address{{ $loop->index }}" class="block">
                        <p class="font-semibold text-lg">{{ $address->full_name }}</p>
                        <p class="text-gray-600">{{ $address->direction }}</p>
                        <p class="text-gray-600">{{ $address->city }}, {{ $address->province }}</p>
                        <p class="text-gray-600">{{ $address->country }}</p>
                        <p class="text-gray-600">@lang("messages.phone"): {{ $address->phone_number }}</p>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg mb-10">
        <h2 class="text-2xl font-semibold mb-6 text-secondary flex items-center">
            @lang("your")
        </h2>

        <div class="max-h-64 overflow-y-auto">
            @foreach ($productos as $product)
                <div class="flex justify-between items-center border-b pb-6 mb-6">
                    <div>
                        <p class="font-semibold text-lg">{{ $product->name }}</p>
                        <p class="text-gray-600">@lang("messages.cant"): {{ $product->pivot->quantity }}</p>
                    </div>
                    <div class="text-right mr-4">
                        <p class="font-semibold text-lg">{{ $product->pivot->total_price }} €</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-secondary flex items-center">
            Total
        </h2>
        <div class="flex justify-between items-center mb-6">
            <p class="text-xl font-semibold">@lang("messages.total_amount"):</p>
            @if($carrito->total_price > 50)
                <p class="text-xl font-semibold">{{ $carrito->total_price }} €</p>
            @else
                <p class="text-xl font-semibold">{{ $carrito->total_price + 5 }} €</p>
            @endif
        </div>
        <form method="POST" action="{{ route('order.buy') }}" id="checkoutForm">
            @csrf
            <input type="hidden" name="selected_address_id" id="selectedAddressId">
            <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-lg hover:bg-tertiary transition-transform transform hover:scale-105 duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                @lang("messages.pay")
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addressRadios = document.querySelectorAll('input[name="address"]');
    const hiddenInput = document.getElementById('selectedAddressId');
    addressRadios[0].checked = true;
    hiddenInput.value = addressRadios[0].value;

    addressRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            hiddenInput.value = this.value;
        });
    });
});
</script>
@endsection
