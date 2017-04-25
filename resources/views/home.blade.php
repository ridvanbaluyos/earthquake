@extends('layouts.default')
@section('title', 'Home')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <header class="jumbotron hero-spacer">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Get Notified!</h1>
                    <p>Earthquake Philippines sends SMS and E-mail alerts whenever an earthquake occurs!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter Email" id="email" />
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="track();">Subscribe!</button>
                        </span>
                    </div>
                    <small><em>* No spam, promise!</em></small><br>
                    <small><em>** Message me if you want SMS alerts. Limited slots only.</em></small><br>
                </div>
            </div>
        </header>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <h3>Recent Earthquakes in the Philippines</h3>
    </div>
</div>
<div class="row text-center">
    @foreach ($data['earthquakes']->features as $earthquake)
    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&markers=color:red|{{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&zoom=6&size=400x300&maptype=roadmap&key={{ config('app.google_maps_api_key') }}" alt="">
            <div class="caption">
                <h4>
                    {!! App\Helpers\Charts\ChartHelper::getMagnitudeLabel($earthquake->properties->mag) !!}
                </h4>
                <p>
                    <h4>
                        <i class="fa fa-map-marker"></i> {{ $earthquake->properties->place }}
                    </h4>
                    <small>
                        <i class="fa fa-clock-o"></i>
                        {{ \App\Helpers\DateHelper\DateHelper::convertDate($earthquake->properties->time) }}
                    </small>
                    <br>
                    <small>
                        <i class="fa fa-arrows-v"></i>
                        {{ $earthquake->geometry->coordinates[2] }} km
                    </small>
                    <br>
                    <br>
                    <a href="/earthquakes/{{ $earthquake->id }}" type="button" class="btn btn-xs">more info <i class="fa fa-arrow-circle-o-right"></i></a>
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

        mixpanel.track("Subscribe to Alerts", {
            'email': email,
            'ts': new Date().toJSON(),
            'ts (unix)': new Date().getTime()/1000
        });

        alert('Thank you for participating on this survey!');
    }
</script>
@endsection