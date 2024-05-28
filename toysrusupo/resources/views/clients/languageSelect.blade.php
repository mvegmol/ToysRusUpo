@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-center min-h-screen bg-gray-100">
        <div class="relative bg-white mt-10 p-12 rounded-lg shadow-lg w-full md:w-3/4 lg:w-1/2">
            <div class="absolute top-4 right-4">
                <x-back-button route="clients.profile">&larr; Back</x-button-link>
            </div>
            <h1 class="text-4xl font-semibold mb-8 text-center text-gray-800">Configuración de idioma</h1>
            <p class="mb-10 text-center text-gray-600">Selecciona tu idioma preferido para navegar, comprar y recibir comunicaciones.</p>
            <form action="{{ route('lang.switchAle') }}" method="POST">
                @csrf
                @php
                    $currentLocale = Session::get('locale', app()->getLocale());
                @endphp
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio text-indigo-600" name="lang" value="es" {{ $currentLocale == 'es' ? 'checked' : '' }}>
                        <span class="ml-2 text-lg text-gray-700">Español - ES</span>
                    </label>
                </div>
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio text-indigo-600" name="lang" value="en" {{ $currentLocale == 'en' ? 'checked' : '' }}>
                        <span class="ml-2 text-lg text-gray-700">English - EN</span>
                    </label>
                </div>
                <div class="border-t mt-10 pt-8 flex justify-end">
                    <a href="{{ url()->previous() }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg mr-4 hover:bg-gray-300 focus:outline-none">Cancelar</a>
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-tertiary focus:outline-none">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
@endsection
