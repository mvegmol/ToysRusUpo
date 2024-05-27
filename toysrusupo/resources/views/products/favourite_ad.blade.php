@extends('layouts.app')

@section('content')
    <div class="mx-4 mt-3">
        @include('partials.messages')

        @component('components.card')
            @slot('header')
                <x-header :title="'Most Liked Products'">
                    @slot('controls')
                        <x-back-button route="welcome.index">&larr; Back</x-back-button>
                    @endslot
                </x-header>
            @endslot

            <div class="flex flex-wrap py-2">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <x-add-button route="products.create" entityName="Product" />
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <x-search-form :actionRoute="'search.products'" :searchQuery="$search ?? ''" />
                </div>
            </div>

            <x-entity-table :entities="$products" :headers="['Name', 'Description', 'Price ($)', 'Stock', 'Min age', 'Categories','Total Favourites']" :fields="['name', 'description', 'price', 'stock', 'min_age', 'category_names','total_favorites']" actionsRoute="products" entityName="Product"
                emptyMessage="No Products Found!" />

            @slot('footer')
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endslot
        @endcomponent

    </div>

@endsection
