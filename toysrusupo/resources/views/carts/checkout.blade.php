@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-gray-100 mt-4 rounded-lg">
    <h1 class="text-5xl font-extrabold mb-10 text-primary text-center">Checkout</h1>

    <!-- Customer Addresses -->
    <div class="bg-white p-8 rounded-xl shadow-lg mb-10">
        <h2 class="text-2xl font-semibold mb-6 text-secondary flex items-center">
            Select a Shipping Address
        </h2>
        <div class="space-y-6">
            <!-- Loop through customer addresses -->
            <!-- Example address -->
            <div class="border p-6 rounded-xl flex items-center hover:bg-gray-50 transition-shadow duration-300 ease-in-out shadow-sm hover:shadow-md">
                <input type="radio" name="address" id="address1" class="mr-4 text-primary focus:ring-primary">
                <label for="address1" class="block">
                    <p class="font-semibold text-lg">John Doe</p>
                    <p class="text-gray-600">123 Main Street</p>
                    <p class="text-gray-600">City, State, ZIP</p>
                    <p class="text-gray-600">Country</p>
                </label>
            </div>
            <!-- Repeat for other addresses -->
        </div>
    </div>

    <!-- Product Details -->
    <div class="bg-white p-8 rounded-xl shadow-lg mb-10">
        <h2 class="text-2xl font-semibold mb-6 text-secondary flex items-center">
            Your Order
        </h2>
        <!-- Loop through products in the cart -->
        <!-- Example product -->
        @foreach ($productos as $product )
            <div class="flex justify-between items-center border-b pb-6 mb-6">
                <div>
                    <p class="font-semibold text-lg">{{$product->name}}</p>
                    <p class="text-gray-600">Quantity: {{$product->pivot->quantity}}</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-lg">{{$product->pivot->total_price}} €</p>
                </div>
            </div>

        @endforeach

        <!-- Repeat for other products -->
    </div>

    <!-- Total Amount -->
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-secondary flex items-center">
            Total
        </h2>
        <div class="flex justify-between items-center mb-6">
            <p class="text-xl font-semibold">Total Amount:</p>
            @if($carrito->total_price>50)
                <p class="text-xl font-semibold">{{$carrito->total_price}} €</p>
            @else
                <p class="text-xl font-semibold">{{$carrito->total_price +5}} €</p>
            @endif
        </div>
        <form method="POST" action="{{ route('order.buy') }}">
            @csrf
            <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-lg hover:bg-tertiary transition-transform transform hover:scale-105 duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                Proceed to Payment
            </button>
        </form>
    </div>
</div>
@endsection
