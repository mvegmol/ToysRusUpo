@extends('layouts.app')

@section('content')
    <div class="mx-4 mt-3">
        @include('partials.messages')

        @component('components.card')
            @slot('header')
                <x-header :title="'Products in Category: ' . $category->name">
                    @slot('controls')
                        <x-back-button route="categories.index" :routeParams="['page' => session('categories_last_page', 1), 'clear_search' => true]">&larr; Back</x-back-button>
                    @endslot
                </x-header>
            @endslot

            <div class="flex flex-wrap py-2">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <x-add-button :route="'categories.add-product-form'" :routeParams="['category' => $category->id]" entityName="Product" />
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <x-search-form :actionRoute="'search.productsInCategory'" :searchQuery="$search ?? ''" :categoryId="$category->id" />
                </div>
            </div>

            <x-entity-table :entities="$products" :headers="['Name', 'Description', 'Price ($)', 'Stock', 'Min age']" :fields="['name', 'description', 'price', 'stock', 'min_age']" actionsRoute="categories" entityName="Product"
                emptyMessage="No Products Found!" :showCategoryProductActions="true" :category="$category" />

            @slot('footer')
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endslot
        @endcomponent
    </div>
@endsection
