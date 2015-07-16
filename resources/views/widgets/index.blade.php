@extends('app')

@section('content')

    <div class="container">

        <h1 class="headline">Deine Widgets</h1>

        <div class="list-group">

        @foreach( $widgets as $widget )

            <a href="{{ url( 'dashboard/widget/' . $widget->id ) }}" class="list-group-item">
                Widget <span class="small">{{ $widget->id }}</span>
            </a>

        @endforeach

        </div>

    </div>

@endsection