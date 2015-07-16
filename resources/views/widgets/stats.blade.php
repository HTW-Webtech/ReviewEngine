@foreach ($widget->resources as $resource)

    <div class="panel panel-default">

        <div class="panel-heading">

            <h3 class="panel-title">Einzelstatistik <small>{{ $resource->uri  }}</small></h3>

        </div>

        <div class="panel-body">

            <ul class="list-group">
                <li class="list-group-item">Anzahl Views <span class="badge">{{ $resource->getViewCount() }}</span></li>
                <li class="list-group-item">ø Bewertung <span class="badge">{!! $widget->formatRating($resource->getTotalRating()) !!}</span></li>
            </ul>

            <h5>Alle Bewertungen</h5>

            @if ( $resource->getReviewCount() == 0 )

                <div class="alert alert-warning" role="alert">
                    Leider noch keine Bewertungen vorhanden
                </div>

            @endif

        </div>

        <ul class="list-group">

            @foreach ($resource->reviews as $review)

                <li class="list-group-item">

                    Bewertung #{{ $review->id  }} am {{ $review->published_at->format('d.m.Y') }}

                    mit {!! $widget->formatRating($review->rating) !!}

                    @if ( $review->text )

                        <span class="review-text">{{ $review->text  }}</span>

                    @endif

                </li>

            @endforeach

        </ul>

    </div>

@endforeach