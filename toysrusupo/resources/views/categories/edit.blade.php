@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                @component('components.card')
                    @slot('header')
                        <x-header :title="'Edit Category'">
                            @slot('controls')
                                <x-back-button route="categories.index">&larr; Back</x-back-button>
                            @endslot
                        </x-header>
                    @endslot

                    <x-entity-form :actionUrl="route('categories.update', ['category' => $category->id])" :fields="[
                        [
                            'id' => 'name',
                            'type' => 'text',
                            'label' => 'Name',
                            'name' => 'name',
                            'old' => 'name',
                            'value' => $category->name,
                        ],
                    
                        [
                            'id' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'name' => 'description',
                            'old' => 'description',
                            'value' => $category->description,
                        ],
                    ]" :method="'PUT'" buttonLabel="Update Category" />
                @endcomponent
            </div>
        </div>
    </div>
@endsection
