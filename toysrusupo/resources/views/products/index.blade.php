@extends('layouts.app')

@section('content')
    <div class="mx-4 mt-16">
        @include('partials.messages')

        @component('components.card')
            @slot('header')
                <x-header :title="'Product List'">
                    @slot('controls')
                        <x-back-button route="welcome.index">&larr; @lang("messages.back")</x-back-button>
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

            <x-entity-table :entities="$products" :headers="['Name', 'Description', 'Price (€)', 'Stock', 'Min age', 'Categories']" :fields="['name', 'description', 'price', 'stock', 'min_age', 'category_names']" actionsRoute="products" entityName="Product"
                emptyMessage="No Products Found!" />

            @slot('footer')
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endslot
        @endcomponent

        <a href="{{ route('products.moreLike') }}" class="text-xl font-bold text-red-600 hover:text-red-800 flex items-center">
            <span class="mr-1">@lang("messages.most_liked")</span>
            <span class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF0000" class="w-6 h-6 inline-block">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </span>
        </a>

    </div>
@endsection
