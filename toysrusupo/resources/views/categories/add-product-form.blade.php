@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">

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
    </div>
@endsection
