@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-2xl mx-auto p-6">
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
@endsection
