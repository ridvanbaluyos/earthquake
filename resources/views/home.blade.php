@extends('layouts.default')
@section('title', 'Home')
@section('content')
<header class="jumbotron hero-spacer">
    <h1>A Warm Kitty Welcome!</h1>
    <p>
        Cat ipsum dolor sit amet, howl uncontrollably for no reason. Pee in the shoe spread kitty litter all over house.
        Lies down sleep on dog bed, force dog to sleep on floor so gnaw the corn cob, asdflkjaertvlkjasntvkjn (sits on
        keyboard) pushes butt to face curl into a furry donut meow. Run outside as soon as door open.
    </p>
    <p><a class="btn btn-primary btn-large">Call to action!</a>
    </p>
</header>
<hr>
<div class="row">
    <div class="col-lg-12">
        <h3>Latest Earthquakes in the Philippines</h3>
    </div>
</div>

<div class="row text-center">
    @foreach ($data['earthquakes']->features as $earthquake)
    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&markers=color:red|{{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&zoom=6&size=400x300&maptype=roadmap&key={{ config('app.google_maps_api_key') }}" alt="">
            <div class="caption">
                <h3>
                    @if ($earthquake->properties->mag >= 5)
                        <span class="label label-danger">{{ $earthquake->properties->mag }}</span>
                    @elseif ($earthquake->properties->mag < 5 && $earthquake->properties->mag > 4)
                        <span class="label label-info">{{  $earthquake->properties->mag }}</span>
                    @endif
                </h3>
                <p>
                    <small>
                        <i class="fa fa-map-marker"></i> {{ $earthquake->properties->place }}
                    </small>
                    <br>
                    <small>
                        <i class="fa fa-calendar"></i>
                        {{ date('d M Y H:i:s', intval($earthquake->properties->time)/1000) }}
                    </small>
                    <br>
                    <small>
                        {{ $earthquake->geometry->coordinates[2] }} km
                    </small>
                    <br>
                    <button type="button" class="btn btn-xs btn-link">more info</button>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection