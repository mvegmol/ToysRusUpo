@extends('layouts.app')

@section('content')
    <div class="mx-4 mt-16">
        @include('partials.messages')

        @component('components.card')
            @slot('header')
                <x-header :title="'Category List'">
                    @slot('controls')
                        <x-back-button route="welcome.index">&larr; Back</x-back-button>
                    @endslot
                </x-header>
            @endslot

            <div class="flex flex-wrap py-2">
                <div class="w-full md:w-1/2 mb-4 md:mb-0">
                    <x-add-button route="categories.create" entityName="Category" />
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <x-search-form :actionRoute="'search.categories'" :searchQuery="$search ?? ''" />
                </div>
            </div>

            <x-entity-table :entities="$categories" :headers="['Name', 'Description']" :fields="['name', 'description']" actionsRoute="categories" entityName="Category"
                emptyMessage="No Categories Found!" :showProductsButton="true" />

            @slot('footer')
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            @endslot
        @endcomponent

    </div>
@endsection
