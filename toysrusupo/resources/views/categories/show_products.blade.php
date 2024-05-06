@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">

                @include('partials.messages')

                @component('components.card')
                    @slot('header')
                        <x-header :title="'Products in Category: ' . $category->name">
                            @slot('controls')
                                <x-back-button route="categories.index" :routeParams="['page' => session('categories_last_page', 1), 'clear_search' => true]">&larr; Back</x-back-button>
                            @endslot
                        </x-header>
                    @endslot

                    <div class="row py-2">
                        <div class="col-md-6">
                            <x-add-button :route="'categories.add-product-form'" :routeParams="['category' => $category->id]" entityName="Product" />
                        </div>
                        <div class="col-md-6">
                            <x-search-form :actionRoute="'search.productsInCategory'" :searchQuery="$search ?? ''" :categoryId="$category->id" />
                        </div>
                    </div>

                    <x-entity-table :entities="$products" :headers="['Name', 'Description', 'Price ($)', 'Stock', 'Min age']" :fields="['name', 'description', 'price', 'stock', 'min_age']" actionsRoute="categories"
                        entityName="Product" emptyMessage="No Products Found!" :showCategoryProductActions="true" :category="$category" />

                    @slot('footer')
                        {{ $products->links() }}
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
