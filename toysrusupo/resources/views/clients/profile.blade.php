@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 flex flex-col items-center">
        @include('partials.messages')

        <h1 class="text-3xl font-bold mb-6 mt-0">@lang("messages.wel"), {{ $client_name }}</h1>
        <div class="w-full border-t border-gray-300 mb-12"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- My Data -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-lightSecondary shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-lightSecondary-hover hover:cursor-pointer">
                <a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}"
                    class="w-full h-full flex flex-col items-center justify-center">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-secondary hover:bg-secondary-hover absolute -top-6">
                        <img src="{{ asset('images/icons/pencil.png') }}" alt="My Data" class="w-12 h-12">
                    </div>

                    <div class="mt-0">
                        <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">@lang("messages.data")</h3>
                        <p class="text-sm text-gray-600">@lang("messages.data_inf")</p>
                    </div>
                </a>
            </div>
            <!-- Orders -->

            @if (Auth::user()->role != 'admin')
                <div
                    class="relative w-full md:w-96 h-64 p-6 bg-lightSecondary shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-lightSecondary-hover hover:cursor-pointer">
                    <a href="{{ route('orders.index') }}" class="w-full h-full flex flex-col items-center justify-center">
                        <div
                            class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-secondary hover:bg-secondary-hover absolute -top-6">
                            <img src="{{ asset('images/icons/orders.png') }}" alt="Orders" class="w-12 h-12">
                        </div>

                        <div class="mt-0">
                            <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">@lang("messages.orders")</h3>
                            <p class="text-sm text-gray-600">@lang("messages.order_inf")</p>
                        </div>
                    </a>
                </div>
                <!-- Addresses -->
                <div
                    class="relative w-full md:w-96 h-64 p-6 bg-lightSecondary shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-lightSecondary-hover hover:cursor-pointer">
                    <a href="{{ route('addresses.index') }}"
                        class="w-full h-full flex flex-col items-center justify-center">
                        <div
                            class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-secondary hover:bg-secondary-hover absolute -top-6">
                            <img src="{{ asset('images/icons/address.png') }}" alt="Addresses" class="w-12 h-12">
                        </div>

                        <div class="mt-0">
                            <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">@lang("messages.address")</h3>
                            <p class="text-sm text-gray-600">@lang("messages.address_inf")</p>
                        </div>
                    </a>
                </div>
                <!-- Favorites -->

                <div
                    class="relative w-full md:w-96 h-64 p-6 bg-lightSecondary shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-lightSecondary-hover hover:cursor-pointer">
                    <a href="{{ route('products.favourite') }}"
                        class="w-full h-full flex flex-col items-center justify-center">
                        <div
                            class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-secondary hover:bg-secondary-hover absolute -top-6">
                            <img src="{{ asset('images/icons/favorites.png') }}" alt="Favorites" class="w-12 h-12">
                        </div>

                        <div class="mt-0">
                            <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">@lang("messages.favourite")</h3>
                            <p class="text-sm text-gray-600">@lang("messages.favourite_inf")</p>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Languages -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-lightSecondary shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-lightSecondary-hover hover:cursor-pointer">
                <a href="{{ route('lang.select') }}" class="w-full h-full flex flex-col items-center justify-center">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-secondary hover:bg-secondary-hover absolute -top-6">
                        <img src="{{ asset('images/icons/globe.png') }}" alt="Language" class="w-12 h-12">
                    </div>
                    <div class="mt-0">
                        <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">@lang("messages.language")</h3>
                        <p class="text-sm text-gray-600">@lang("messages.lang_sel")</p>
                    </div>
                </a>
            </div>


            <!-- Logout -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-lightSecondary shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-lightSecondary-hover hover:cursor-pointer">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="w-full h-full flex flex-col items-center justify-center">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-secondary hover:bg-secondary-hover absolute -top-6">
                        <img src="{{ asset('images/icons/logout.png') }}" alt="Logout" class="w-12 h-12">
                    </div>

                    <div class="mt-0">
                        <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">@lang("messages.Logout")</h3>
                        <p class="text-sm text-gray-600">@lang("messages.log_inf")</p></p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
