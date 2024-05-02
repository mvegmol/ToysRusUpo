@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                @component('components.card')
                    @slot('header')
                        <x-header :title="'Add New Category'">
                            @slot('controls')
                                <x-back-button route="categories.index">&larr; Back</x-back-button>
                            @endslot
                        </x-header>
                    @endslot

                    <x-entity-form :actionUrl="route('categories.store')" :fields="[
                        [
                            'id' => 'name',
                            'type' => 'text',
                            'label' => 'Name',
                            'name' => 'name',
                            'old' => 'name',
                        ],
                    
                        [
                            'id' => 'description',
                            'type' => 'textarea',
                            'label' => 'Description',
                            'name' => 'description',
                            'old' => 'description',
                        ],
                    ]" buttonLabel="Add Category" />
                @endcomponent
            </div>
        </div>
    </div>
@endsection
