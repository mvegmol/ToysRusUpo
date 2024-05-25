@extends('layouts.app')

@section('content')
<div class="flex justify-center min-h-screen">
    <div class="w-full max-w-2xl mx-auto p-6">
        <nav class="text-sm mb-6">
            <a href="{{ route('clients.profile') }}" class="text-gray-500 hover:text-primary hover:underline">My Account</a> 
            <span class="text-gray-500 mx-2">›</span> 
            <a href="{{ route('addresses.index') }}" class="text-gray-500 hover:text-primary hover:underline">My Addresses</a>
            <span class="text-gray-500 mx-2">›</span>
            <span class="text-primary">New Address</span>
        </nav>

        @component('components.card')
            @slot('header')
                <x-header :title="'Add a new address'">
                    @slot('controls')
                        <x-back-button route="addresses.index">&larr; Back</x-back-button>
                    @endslot
                </x-header>
            @endslot

            <x-entity-form :actionUrl="route('addresses.store')" :fields="[
                [
                    'id' => 'country',
                    'type' => 'select',
                    'label' => 'Country/Region',
                    'name' => 'country',
                    'options' => $countries,
                    'old' => 'country',
                    'placeholder' => 'Select your country'
                ],
                [
                    'id' => 'full_name',
                    'type' => 'text',
                    'label' => 'Full Name',
                    'name' => 'full_name',
                    'old' => 'full_name',
                    'placeholder' => 'Enter your full name'
                ],
                [
                    'id' => 'phone_number',
                    'type' => 'text',
                    'label' => 'Phone Number',
                    'name' => 'phone_number',
                    'old' => 'phone_number',
                    'help' => 'This can be used to assist with delivery',
                    'placeholder' => 'Enter your phone number'
                ],
                [
                    'id' => 'direction',
                    'type' => 'text',
                    'label' => 'Address',
                    'name' => 'direction',
                    'old' => 'direction',
                    'placeholder' => 'Enter your address'
                ],
                [
                    'id' => 'zip_code',
                    'type' => 'text',
                    'label' => 'Postal Code',
                    'name' => 'zip_code',
                    'old' => 'zip_code',
                    'inline' => true,
                    'placeholder' => 'Enter postal code'
                ],
                [
                    'id' => 'city',
                    'type' => 'text',
                    'label' => 'City',
                    'name' => 'city',
                    'old' => 'city',
                    'inline' => true,
                    'placeholder' => 'Enter your city'
                ],
                [
                    'id' => 'province',
                    'type' => 'text',
                    'label' => 'Province',
                    'name' => 'province',
                    'old' => 'province',
                    'placeholder' => 'Enter your province'
                ],                
            ]" buttonLabel="Add Address" />
        @endcomponent
    </div>
</div>
@endsection
