@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 flex flex-col items-center">
        <h1 class="text-3xl font-bold mb-6 mt-0">Hola, {{ $cliente_name }}</h1>
        <div class="w-full border-t border-gray-300 mb-12"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Mis datos -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-[#B2DFDB] shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-[#A9D6D2] hover:cursor-pointer">
                <div class="absolute -top-6">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-[#E0F7FA] hover:bg-[#D0EFF5]">
                        <img src="{{ asset('images/icons/pencil.png') }}" alt="Mis datos" class="w-12 h-12">
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">Mis datos</h3>
                    <p class="text-sm text-gray-600">Editar la información personal, como nombre, correo electrónico y
                        teléfono.</p>
                </div>
            </div>
            <!-- Pedidos -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-[#B2DFDB] shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-[#A9D6D2] hover:cursor-pointer">
                <div class="absolute -top-6">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-[#E0F7FA] hover:bg-[#D0EFF5]">
                        <img src="{{ asset('images/icons/orders.png') }}" alt="Pedidos" class="w-12 h-12">
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">Pedidos</h3>
                    <p class="text-sm text-gray-600">Rastrear, devolver, cancelar un pedido y ver historial de compras.</p>
                </div>
            </div>
            <!-- Direcciones -->
            <a href="{{ route('clients.addresses') }}"
                class="relative w-full md:w-96 h-64 p-6 bg-[#B2DFDB] shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-[#A9D6D2] hover:cursor-pointer no-underline text-inherit">
                <div class="absolute -top-6">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-[#E0F7FA] hover:bg-[#D0EFF5]">
                        <img src="{{ asset('images/icons/address.png') }}" alt="Direcciones" class="w-12 h-12">
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">Direcciones</h3>
                    <p class="text-sm text-gray-600">Añadir, editar o eliminar direcciones de envío.</p>
                </div>
            </a>
            <!-- Favoritos -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-[#B2DFDB] shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-[#A9D6D2] hover:cursor-pointer">
                <div class="absolute -top-6">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-[#E0F7FA] hover:bg-[#D0EFF5]">
                        <img src="{{ asset('images/icons/favorites.png') }}" alt="Favoritos" class="w-12 h-12">
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">Favoritos</h3>
                    <p class="text-sm text-gray-600">Ver, añadir o eliminar productos de tu lista de favoritos.</p>
                </div>
            </div>
            <!-- Pagos -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-[#B2DFDB] shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-[#A9D6D2] hover:cursor-pointer">
                <div class="absolute -top-6">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-[#E0F7FA] hover:bg-[#D0EFF5]">
                        <img src="{{ asset('images/icons/payments.png') }}" alt="Pagos" class="w-12 h-12">
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">Pagos</h3>
                    <p class="text-sm text-gray-600">Administrar métodos de pago y ver transacciones.</p>
                </div>
            </div>
            <!-- Cerrar sesión -->
            <div
                class="relative w-full md:w-96 h-64 p-6 bg-[#B2DFDB] shadow-md rounded-2xl flex flex-col items-center text-center border-2 border-gray-300 hover:bg-[#A9D6D2] hover:cursor-pointer">
                <div class="absolute -top-6">
                    <div
                        class="w-20 h-20 rounded-full border-2 border-gray-300 shadow-md flex items-center justify-center bg-[#E0F7FA] hover:bg-[#D0EFF5]">
                        <img src="{{ asset('images/icons/logout.png') }}" alt="Cerrar sesión" class="w-12 h-12">
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-xl font-bold mb-2 font-serif text-gray-700">Cerrar sesión</h3>
                    <p class="text-sm text-gray-600">Cerrar la sesión de tu cuenta en todos los dispositivos.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
