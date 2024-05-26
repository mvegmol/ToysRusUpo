@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 pl-40"> <!-- Incremento del margen izquierdo -->
        <nav class="text-sm mb-4">
            <a href="{{ route('clients.profile') }}" class="text-gray-500 hover:text-primary hover:underline">My Account</a>
            <span class="text-gray-500 mx-2">›</span>
            <span class="text-primary">My Addresses</span>
        </nav>
        @include('partials.messages')
        <h1 class="text-2xl font-semibold mb-6">My Addresses</h1>
        <div class="flex flex-wrap gap-4"> <!-- Espacio entre recuadros -->
            <!-- Add Address -->
            <a href="{{ route('addresses.create') }}"
                class="group bg-teal-50 border-[3px] border-dashed border-gray-400 rounded-2xl p-6 flex items-center justify-center cursor-pointer hover:border-gray-600 w-80 h-80 mb-4">
                <div class="text-center">
                    <div class="text-7xl text-primary group-hover:text-primary-dark transition duration-200">+</div>
                    <div class="mt-2 text-2xl text-gray-500 group-hover:text-gray-700 transition duration-200">Add Address
                    </div>
                </div>
            </a>

            <!-- Existing Addresses -->
            @foreach ($addresses as $address)
                <div class="bg-teal-50 border border-gray-300 rounded-2xl p-4 shadow-sm w-80 h-80 flex flex-col mb-4">
                    <div class="flex items-center justify-end mb-2">
                        <span class="ml-2 text-sm text-primary font-semibold">{{ $address->label ?? 'ToysRusUpo' }}</span>
                    </div>
                    <div class="relative -mx-4">
                        <hr class="border-t border-gray-300">
                    </div>
                    <div class="mt-4">
                        <div class="font-semibold text-black">{{ $address->full_name }}</div>
                        <div class="text-sm text-gray-700">{{ $address->direction }}</div>
                        <div class="text-sm text-gray-700">{{ $address->city }}, {{ $address->province }}
                            {{ $address->zip_code }}</div>
                        <div class="text-sm text-gray-700">{{ $address->country }}</div>
                        <div class="text-sm text-gray-700">Phone number: {{ $address->phone_number }}</div>
                        <a href="#" class="text-sm text-primary mt-1 block">Add delivery instructions</a>
                    </div>
                    <div class="mt-auto flex space-x-4 text-sm">
                        <a href="{{ route('addresses.edit', $address->id) }}" class="text-primary hover:underline">Edit</a>
                        <span class="text-gray-400">|</span>
                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-primary hover:underline">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
