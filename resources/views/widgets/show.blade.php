@extends('app')

@section('content')

    <div class="container">

        <h1 class="headline">Dein Widget <small>ID {{ $widget->id }}</small></h1>

        <p>Kopiere einfach nachfolgenden Code und füge ihn dort in deinen HTML-Code ein, wo das Widget angezeigt werden soll.</p>

        <div class="panel panel-default">

            <div class="panel-body">

        <pre><code class="language-javascript">{{ htmlspecialchars( '<div id="re-review-widget"></div>
<script async src="' . url('/widget/' . $widget->id) . '"></script>') }}</code></pre>

            </div>

        </div>

        <div class="panel panel-primary">

            <div class="panel-heading">

                <h3 class="panel-title">Gesamtauswertung</h3>

            </div>

            <div class="panel-body">

                <ul class="list-group">
                    <li class="list-group-item">Anzahl Views <span class="badge">{{ $widget->getviewCount() }}</span></li>
                    <li class="list-group-item">ø Bewertung <span class="badge">{!! $widget->formatRating($widget->getTotalRating()) !!}</span></li>
                </ul>

            </div>

        </div>

        @include('widgets.stats', ['widget' => $widget])

    </div>

@endsection