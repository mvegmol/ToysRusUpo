@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            @component('components.card')
                @slot('header')
                    <x-header :title="'Añadir nueva dirección'">
                        @slot('controls')
                            <x-back-button route="addresses.index">&larr; Volver</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <x-entity-form :actionUrl="route('addresses.store')" :fields="[
                    [
                        'id' => 'direction',
                        'type' => 'text',
                        'label' => 'Dirección',
                        'name' => 'direction',
                        'old' => 'direction',
                    ],
                
                    [
                        'id' => 'city',
                        'type' => 'text',
                        'label' => 'Ciudad',
                        'name' => 'city',
                        'old' => 'city',
                    ],
                
                    [
                        'id' => 'province',
                        'type' => 'text',
                        'label' => 'Provincia',
                        'name' => 'province',
                        'old' => 'province',
                    ],
                
                    [
                        'id' => 'zip_code',
                        'type' => 'text',
                        'label' => 'Código Postal',
                        'name' => 'zip_code',
                        'old' => 'zip_code',
                    ],
                
                    [
                        'id' => 'country',
                        'type' => 'text',
                        'label' => 'País',
                        'name' => 'country',
                        'old' => 'country',
                    ],
                    [
                        'id' => 'user_id',
                        'type' => 'number',
                        'label' => 'Id del Usuario',
                        'name' => 'user_id',
                        'old' => 'user_id',
                    ],
                ]" buttonLabel="Add Adrress" />
            @endcomponent
        </div>
    </div>
@endsection
