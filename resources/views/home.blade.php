@extends('layouts.default')
@section('title', 'Home')
@section('content')
<header class="jumbotron hero-spacer">
    <h1>Get Notified!</h1>
    <p>
        Earthquake Philippines sends SMS and E-mail alerts whenever an earthquake occurs!
    </p>

    <div class="input-group" style="width:30%;">
        <input type="text" class="form-control" placeholder="Enter Email" id="email" />
        <span class="input-group-btn">
            <button class="btn btn-success" type="button" onclick="track();">Subscribe!</button>
        </span>
    </div>
    <small><em>* No spam, promise!</em></small><br>
    <small><em>** Message me if you want SMS alerts. Limited slots only.</em></small><br>
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
                        <span class="label label-danger"><i class="fa fa-flash"></i> {{ $earthquake->properties->mag }}</span>
                    @elseif ($earthquake->properties->mag < 5 && $earthquake->properties->mag > 4)
                        <span class="label label-info"><i class="fa fa-flash"></i> {{  $earthquake->properties->mag }}</span>
                    @endif
                </h3>
                <p>
                    <small>
                        <i class="fa fa-map-marker"></i> {{ $earthquake->properties->place }}
                    </small>
                    <br>
                    <small>
                        <i class="fa fa-calendar"></i>
                        {{ \App\Helpers\DateHelper\DateHelper::convertDate($earthquake->properties->time) }}
                    </small>
                    <br>
                    <small>
                        {{ $earthquake->geometry->coordinates[2] }} km
                    </small>
                    <br>
                    <a href="/earthquakes/{{ $earthquake->id }}" class="btn btn-xs btn-link">more info</a>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('js-page-specific')
<script type="text/javascript">
    function track()
    {
        var email = $('#email').val();
        ga('send', 'event', 'Email', 'input', email);
        ga('send', 'event', 'Subscribe', 'click', 'Subscribe Button');
        alert('Thank you for participating on this survey!');
    }
</script>
@endsection