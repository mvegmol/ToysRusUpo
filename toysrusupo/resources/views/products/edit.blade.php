@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            @component('components.card')
                @slot('header')
                    <x-header :title="'Edit Product'">
                        @slot('controls')
                            <x-back-button route="products.index">&larr; Back</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <x-entity-form :actionUrl="route('products.update', ['product' => $product->id])" :fields="[
                    
                    [
                        'id' => 'name', 
                        'type' => 'text', 
                        'label' => 'Name', 
                        'name' => 'name', 
                        'old' => 'name',
                        'value' => $product->name
                    ], 
                    
                    [
                        'id' => 'description', 
                        'type' => 'textarea', 
                        'label' => 'Description', 
                        'name' => 'description', 
                        'old' => 'description',
                        'value' => $product->description
                    ], 

                    [
                        'id' => 'price', 
                        'type' => 'number', 
                        'label' => 'Price ($)', 
                        'name' => 'price', 
                        'old' => 'price',
                        'attributes' => 'step=0.01 min=0 max=999999.99',
                        'value' => $product->price
                    ], 

                    [
                        'id' => 'stock', 
                        'type' => 'number', 
                        'label' => 'Stock', 
                        'name' => 'stock', 
                        'old' => 'stock',
                        'attributes' => 'min=0',
                        'value' => $product->stock
                    ], 

                    [
                        'id' => 'min_age', 
                        'type' => 'number', 
                        'label' => 'Minimum age', 
                        'name' => 'min_age', 
                        'old' => 'min_age',
                        'attributes' => 'min=0',
                        'value' => $product->min_age
                    ], 

                ]" :method="'PUT'" buttonLabel="Update Product" />
            @endcomponent
        </div>
    </div>
@endsection
