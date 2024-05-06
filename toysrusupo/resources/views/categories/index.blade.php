@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">

                @include('partials.messages')

                @component('components.card')
                    @slot('header')
                        <x-header :title="'Category List'">
                            @slot('controls')
                                <x-back-button route="welcome.index">&larr; Back</x-back-button>
                            @endslot
                        </x-header>
                    @endslot

                    <div class="row py-2">
                        <div class="col-md-6">
                            <x-add-button route="categories.create" entityName="Category" />
                        </div>
                        <div class="col-md-6">
                            <x-search-form :actionRoute="'search.categories'" :searchQuery="$search ?? ''" />
                        </div>
                    </div>

                    <x-entity-table :entities="$categories" :headers="['Name', 'Description']" :fields="['name', 'description']" actionsRoute="categories"
                        entityName="Category" emptyMessage="No Categories Found!" :showProductsButton="true" />

                    @slot('footer')
                        {{ $categories->links() }}
                    @endslot
                @endcomponent

            </div>
        </div>
    </div>
@endsection
