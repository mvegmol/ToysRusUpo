@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-start min-h-screen bg-gray-100 pt-10">
        <nav class="text-sm mb-4 w-full max-w-lg text-center">
            <a href="{{ route('clients.profile') }}" class="text-gray-500 hover:text-primary hover:underline">My Account</a>
            <span class="text-gray-500 mx-2">›</span>
            <span class="text-primary">@lang("messages.languagesSetting")</span>
        </nav>
        <hr class="my-2 w-1/2 border-t-2 border-gray-200">
        <div class="relative bg-white mt-4 p-12 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-4xl font-semibold mb-8 text-center text-gray-800">@lang("messages.languagesSetting")</h1>
            <p class="mb-10 text-center text-gray-600">@lang("messages.lanMes")</p>
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
                    <a href="{{ url()->previous() }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg mr-4 hover:bg-gray-300 focus:outline-none">@lang("messages.cancel")</a>
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-tertiary focus:outline-none">@lang("messages.guarCam")</button>
                </div>
            </form>
        </div>
    </div>
@endsection
