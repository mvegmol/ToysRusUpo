@extends('layouts.app')

@section('content')
    <div class="flex justify-center min-h-screen">
        <div class="w-full max-w-2xl mx-auto p-6">

            @include('partials.messages')

            @component('components.card')
                @slot('header')
                    <x-header :title="'Add New Product'">
                        @slot('controls')
                            <x-back-button :route="'categories.products'" :routeParams="['category' => $category->id]">&larr; Back</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <x-entity-form :actionUrl="route('categories.add-product', ['category' => $category->id])" :fields="[
                    [
                        'id' => 'id',
                        'type' => 'number',
                        'label' => 'Id Product',
                        'name' => 'id',
                        'old' => 'id',
                        'attributes' => 'min=1',
                    ],
                ]" buttonLabel="Add Product" />
            @endcomponent
        </div>
    </div>
@endsection
