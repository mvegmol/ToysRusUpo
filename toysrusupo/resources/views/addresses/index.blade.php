@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3 p-0">
        <div class="col-md-12">

            @include('partials.messages')

            @component('components.card')
                @slot('header')
                    <x-header :title="'Address List'">
                        @slot('controls')
                            <x-back-button route="welcome.index">&larr; Volver</x-back-button>
                        @endslot
                    </x-header>
                @endslot

                <div class="row py-2">
                    <div class="col-md-6">
                        <x-add-button route="addresses.create" entityName="Address" />
                    </div>
                    {{-- <div class="col-md-6">
                        <x-search-form :actionRoute="'search.products'" :searchQuery="$search ?? ''" />
                    </div> --}}
                </div>

                <x-entity-table :entities="$addresses" :headers="['Dirección', 'Ciudad', 'Provincia', 'Código Postal', 'País', 'Id del Usuario']" :fields="['direction', 'city', 'province', 'zip_code', 'country', 'user_id']" actionsRoute="addresses"
                    entityName="Address" emptyMessage="No Addresses Found!" />

                @slot('footer')
                    {{ $addresses->links() }}
                @endslot
            @endcomponent

        </div>
    </div>
@endsection
