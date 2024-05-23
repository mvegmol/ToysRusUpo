@extends('layouts.app')

@section('content')
    <div class="flex justify-center min-h-screen">
        <div class="w-full max-w-2xl mx-auto p-6">
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
@endsection
