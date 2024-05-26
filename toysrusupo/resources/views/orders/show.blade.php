@extends('layouts.app')

@section('content')
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto rounded-md">
        <div class="flex justify-start item-start space-y-2 flex-col">
            <h1 class="text-3xl lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Order #{{ $order->id }}
            </h1>
            <p class="text-base font-medium leading-6 text-gray-600">{{ $order->created_at }}</p>
        </div>
        <div
            class="mt-10 flex flex-col xl:flex-row justify-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0 rounded-md">
            <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                    <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">Customer’s Cart</p>
                    <div class="overflow-y-auto max-h-96 pr-4">
                        @foreach ($products as $product)
                            <div
                                class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                                <div class="pb-4 md:pb-8 w-full md:w-40">
                                    <img class="w-full hidden md:block" src="{{ $product->image_url }}"
                                        alt="{{ $product->name }}" />
                                    <img class="w-full md:hidden" src="https://i.ibb.co/L039qbN/Rectangle-10.png"
                                        alt="{{ $product->name }}" />
                                </div>
                                <div
                                    class="border-b rounded-md border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                    <div class="w-full flex flex-col justify-start items-start space-y-8">
                                        <div class="flex justify-between w-full">
                                            <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800">
                                                {{ $product->name }}</h3>

                                            <p class="text-base flex-col xl:text-lg leading-5">Price: ${{ $product->price }}
                                            </p>
                                            <p class="text-base flex-col xl:text-lg leading-6">Quantity:
                                                {{ $product->pivot->quantity }}</p>

                                        </div>
                                        <!-- Aquí agregamos la categoría justo debajo del nombre -->
                                        <div class="text-base xl:text-lg leading-6">
                                            Category: {{ $product->category_names }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>

                </div>

                <div
                    class="flex justify-center flex-col md:flex-row  items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                    <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Summary</h3>
                        <div
                            class="flex justify-center items-center w-full space-y-4 flex-col rounded-md border-gray-200 border-b pb-4">
                            <div class="flex justify-between w-full">
                                <p class="text-base leading-4 text-gray-800">Subtotal</p>
                                <p class="text-base leading-4 text-gray-600">${{ $subtotal }}</p>
                            </div>

                            <div class="flex justify-between items-center w-full">
                                <p class="text-base leading-4 text-gray-800">Shipping</p>
                                <p class="text-base leading-4 text-gray-600">{{ $shipping }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base font-semibold leading-4 text-gray-800">Total</p>
                            <p class="text-base font-semibold leading-4 text-gray-600">${{ $order->total_price }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 space-y-6">
                        <h3 class="text-xl font-semibold leading-5 text-gray-800">Shipping</h3>
                        <div class="flex justify-between items-start w-full">
                            <div class="flex justify-center items-center space-x-4">
                                <div class="w-8 h-8">
                                    <img class="w-full h-full" alt="logo" src="https://i.ibb.co/L8KSdNQ/image-3.png" />
                                </div>
                                <div class="flex flex-col justify-start items-center">
                                    <p class="text-lg leading-6 font-semibold text-gray-800">MRW<br /><span
                                            class="font-normal uppercase">{{ $order->status }}</span></p>
                                </div>
                            </div>
                            <p class="text-lg font-semibold leading-6 text-gray-800">{{ $shipping }}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div
                class="bg-gray-50 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                <h3 class="text-xl font-semibold leading-5 text-gray-800">Customer</h3>
                <div
                    class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                    <div class="flex flex-col justify-start items-start flex-shrink-0">
                        <div
                            class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 rounded-md border-b border-gray-200">

                            <div class="flex justify-start items-start flex-col space-y-2">
                                <p class="text-base font-semibold leading-4 text-left text-gray-800">{{ $user->name }}
                                </p>
                                <p class="text-sm leading-5 text-gray-600">{{ $previousOrdersCount }} Previous Orders</p>
                            </div>
                        </div>

                        <div
                            class="flex justify-center text-gray-800 md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1.svg"
                                alt="email">
                            <p class="cursor-pointer text-sm leading-5 ">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex justify-between xl:h-full items-stretch w-full flex-col mt-6 md:mt-0">
                        <div
                            class="flex justify-center md:justify-start xl:flex-col flex-col md:space-x-6 lg:space-x-8 xl:space-x-0 space-y-4 xl:space-y-12 md:space-y-0 md:flex-row items-center md:items-start">
                            <div
                                class="flex justify-center md:justify-start items-center md:items-start flex-col space-y-4 xl:mt-8">
                                <p class="text-base font-semibold leading-4 text-center md:text-left text-gray-800">
                                    Shipping Address</p>
                                <p class="w-48 lg:w-full text-center md:text-left text-sm leading-5 text-gray-600">
                                    {{ $order->address }}</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
