@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                @component('components.card')
                    @slot('header')
                        <x-header :title="'Product Information'">
                            @slot('controls')
                                <x-back-button route="products.index">&larr; Back</x-back-button>
                            @endslot
                        </x-header>
                    @endslot

                    <x-entity-details :details="[
                        ['label' => 'Name', 'value' => $product->name],
                        ['label' => 'Description', 'value' => $product->description],
                        ['label' => 'Price ($)', 'value' => $product->price],
                        ['label' => 'Stock', 'value' => $product->stock],
                        ['label' => 'Minimum age', 'value' => $product->min_age],
                        ['label' => 'Categories', 'value' => $product->category_names],
                    ]" />
                @endcomponent
            </div>
        </div>
    </div>
@endsection
