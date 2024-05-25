@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <nav class="text-sm mb-4">
        <a href="#" class="text-gray-500 hover:text-gray-700">My Account</a> 
        <span class="text-gray-500 mx-2">›</span> 
        <span class="text-primary">My Addresses</span>
    </nav>
    <h1 class="text-2xl font-semibold mb-6">My Addresses</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <!-- Add Address -->
        <div class="group border-4 border-dashed border-gray-400 rounded-2xl p-6 flex items-center justify-center cursor-pointer hover:border-gray-600 w-80 h-80">
            <div class="text-center">
                <div class="text-7xl text-gray-400 group-hover:text-gray-600 transition duration-200">+</div>
                <div class="mt-2 text-2xl text-gray-500 group-hover:text-gray-700 transition duration-200">Add Address</div>
            </div>
        </div>
        
        <!-- Existing Address -->
        <div class="border border-gray-300 rounded-2xl p-4 shadow-sm w-80 h-80 flex flex-col">
            <div class="mb-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Default:</span>
                    <span class="text-sm text-black font-semibold">amazon</span>
                </div>
                <div class="relative -mx-4">
                    <hr class="border-t border-gray-300">
                </div>
                <div class="mt-4">
                    <div class="font-semibold text-black">Alejandro Vázquez Rodríguez</div>
                    <div class="text-sm text-gray-700">Ana María Olaria 4</div>
                    <div class="text-sm text-gray-700">Dos Hermanas, Sevilla 41701</div>
                    <div class="text-sm text-gray-700">Spain</div>
                    <div class="text-sm text-gray-700 mt-2">Phone number: 695278725</div>
                    <a href="#" class="text-sm text-primary mt-1 block">Add delivery instructions</a>
                </div>
            </div>
            <div class="mt-auto flex space-x-4 text-sm">
                <a href="#" class="text-primary hover:underline">Edit</a>
                <span class="text-gray-400">|</span>
                <a href="#" class="text-primary hover:underline">Remove</a>
            </div>
        </div>
    </div>
</div>
@endsection
