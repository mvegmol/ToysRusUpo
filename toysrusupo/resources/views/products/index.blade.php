@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3 p-0">
        <div class="col-md-12">

            @include('partials.messages')

            @component('components.card')
                @slot('header')
                    <x-header :title="'Product List'">
                        @slot('controls')
                            <x-back-button route="welcome.index">&larr; Back</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <div class="row py-2">
                    <div class="col-md-6">
                        <x-add-button route="products.create" entityName="Product" />
                    </div>
                    <div class="col-md-6">
                        <x-search-form :actionRoute="'search.products'" :searchQuery="$search ?? ''" />                        
                    </div>
                </div>
                
                <x-entity-table :entities="$products" :headers="['Name', 'Description', 'Price ($)', 'Stock', 'Minimum age']" :fields="['name', 'description', 'price', 'stock', 'min_age']" actionsRoute="products" entityName="Product"
                    emptyMessage="No Products Found!"/>

                @slot('footer')
                    {{ $products->links() }}
                @endslot
            @endcomponent

        </div>
    </div>
@endsection
