@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            @component('components.card')
                @slot('header')
                    <x-header :title="'Edit Address'">
                        @slot('controls')
                            <x-back-button route="addresses.index">&larr; Volver</x-back-button>
                        @endslot
                    </x-header>
                @endslot
                'direction', 'city', 'province', 'zip_code', 'country', 'user_id'
                <x-entity-form :actionUrl="route('addresses.update', ['address' => $address->id])" :fields="[
                    [
                        'id' => 'direction',
                        'type' => 'text',
                        'label' => 'Dirección',
                        'name' => 'direction',
                        'old' => 'direction',
                        'value' => $address->direction,
                    ],
                
                    [
                        'id' => 'city',
                        'type' => 'text',
                        'label' => 'Ciudad',
                        'name' => 'city',
                        'old' => 'city',
                        'value' => $address->city,
                    ],
                
                    [
                        'id' => 'province',
                        'type' => 'text',
                        'label' => 'Provincia',
                        'name' => 'province',
                        'old' => 'province',
                        'value' => $address->province,
                    ],
                
                    [
                        'id' => 'zip_code',
                        'type' => 'text',
                        'label' => 'Código Postal',
                        'name' => 'zip_code',
                        'old' => 'zip_code',
                        'value' => $address->zip_code,
                    ],
                
                    [
                        'id' => 'country',
                        'type' => 'text',
                        'label' => 'País',
                        'name' => 'country',
                        'old' => 'country',
                
                        'value' => $address->country,
                    ],
                    [
                        'id' => 'user_id',
                        'type' => 'number',
                        'label' => 'User id',
                        'name' => 'user_id',
                        'old' => 'user_id',
                
                        'value' => $address->user_id,
                    ],
                ]" :method="'PUT'" buttonLabel="Update Address" />
            @endcomponent
        </div>
    </div>
@endsection
