@extends('app')

@section('content')

    <div class="container">

        <h1 class="headline text-center">Willkommen, {{ Auth::user()->name }}</h1>

        <div class="row">

            <div class="col-md-6 col-md-offset-3 new-widget">

                {!! Form::open(array('url' => 'dashboard/widget/add')) !!}

                    <div class="form-group widget-type-choose">
                        <label>1. Widget-Typ wählen</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" value="rate" checked>
                                Bewertung mit Icons
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" value="feedback">
                                Bewertung per Feedback
                            </label>
                        </div>
                    </div>
                    <div class="form-group widget-subtype-choose hide">
                        <label>2. Bewertungs-Icons wählen</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="rating_icon" value="icons" checked>
                                <i class="fa fa-star"></i>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="rating_icon" value="faces">
                                <i class="fa fa-thumbs-o-up"></i>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Widget erstellen</button>

                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection
