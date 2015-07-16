@extends('app')

@section('content')

    <div class="container">
        <h1 class="headline text-center">Willkommen bei deiner ReviewEngine</h1>
        <div class="text-center call-to-action">
            <p>
                <a class="btn btn-primary" href="{{ url('/auth/register') }}">jetzt registrieren</a>
                oder
                <a class="btn btn-default" href="{{ url('/auth/login') }}">einloggen</a>
            </p>
        </div>
        <div class="about text-center">
            <img src="{{ asset('/images/inline-commenting.png') }}" />
        </div>
    </div>

@endsection
