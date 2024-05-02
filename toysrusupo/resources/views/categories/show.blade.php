@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                @component('components.card')
                    @slot('header')
                        <x-header :title="'Category Information'">
                            @slot('controls')
                                <x-back-button route="categories.index">&larr; Back</x-back-button>
                            @endslot
                        </x-header>
                    @endslot

                    <x-entity-details :details="[
                        ['label' => 'Name', 'value' => $category->name],
                        ['label' => 'Description', 'value' => $category->description],
                    ]" />
                @endcomponent
            </div>
        </div>
    </div>
@endsection
