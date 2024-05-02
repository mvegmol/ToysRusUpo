@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            @component('components.card')
                @slot('header')
                    <x-header :title="'Address Information'">
                        @slot('controls')
                            <x-back-button route="addresses.index">&larr; Back</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <x-entity-details :details="[
                    ['label' => 'Direction', 'value' => $address->direction],
                    ['label' => 'City', 'value' => $address->city],
                    ['label' => 'Province', 'value' => $address->province],
                    ['label' => 'Zip Code', 'value' => $address->zip_code],
                    ['label' => 'Country', 'value' => $address->country],
                    ['label' => 'User id', 'value' => $address->user_id],
                ]" />
            @endcomponent
        </div>
    </div>
@endsection
