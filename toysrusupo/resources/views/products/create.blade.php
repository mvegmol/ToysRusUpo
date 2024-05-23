@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-2xl mx-auto p-6">
            @component('components.card')
                @slot('header')
                    <x-header :title="'Add New Product'">
                        @slot('controls')
                            <x-back-button route="products.index">&larr; Back</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <x-entity-form :actionUrl="route('products.store')" :fields="[
                    [
                        'id' => 'name',
                        'type' => 'text',
                        'label' => 'Name',
                        'name' => 'name',
                        'old' => 'name',
                    ],
                    [
                        'id' => 'description',
                        'type' => 'textarea',
                        'label' => 'Description',
                        'name' => 'description',
                        'old' => 'description',
                    ],
                    [
                        'id' => 'price',
                        'type' => 'number',
                        'label' => 'Price ($)',
                        'name' => 'price',
                        'old' => 'price',
                        'attributes' => 'step=0.01 min=0 max=999999.99',
                    ],
                    [
                        'id' => 'stock',
                        'type' => 'number',
                        'label' => 'Stock',
                        'name' => 'stock',
                        'old' => 'stock',
                        'attributes' => 'min=0',
                    ],
                    [
                        'id' => 'min_age',
                        'type' => 'number',
                        'label' => 'Minimum age',
                        'name' => 'min_age',
                        'old' => 'min_age',
                        'attributes' => 'min=0',
                    ],
                    [
                        'id' => 'categories',
                        'type' => 'select',
                        'label' => 'Categories',
                        'name' => 'categories[]',
                        'old' => 'categories',
                        'options' => $categories,
                        'multiple' => true,
                    ],
                ]" buttonLabel="Add Product" />
            @endcomponent
        </div>
    </div>
@endsection
