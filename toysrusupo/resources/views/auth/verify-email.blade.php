@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 my-6">
        <div class="flex justify-center">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="w-full md:w-2/3 lg:w-1/2">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-200 px-6 py-3 rounded-t-lg font-semibold">
                        {{ __('Email Verification') }}
                    </div>

                    <div class="p-6">
                        <p>You must verify your email address. Please, check your email for a verification link</p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    value="Resend">
                                    {{ __('Resend Email') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
