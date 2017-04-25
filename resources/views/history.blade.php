@extends('layouts.default')
@section('title', 'Historical List of Earthquakes in the Philippines')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3>@yield('title')</h3>
    </div>
</div>

<div class="row">
    <form name="earthquake_count" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-lg-2 col-sm-1">
            <div class="form-group">
                <select class="form-control" name="period">
                    @foreach ([1,7,14,30,60,90] as $v)
                        <option value="{{ $v }}" @if ($data['params']['period'] == $v) selected="selected"@endif>Last @if ($v <= 30) {{ $v . " days" }} @elseif ($v > 30 && $v <=360)  {{ $v/30 . " months" }} @else  {{ $v/360 . " years" }} @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-1">
            <div class="form-group">
                <select class="form-control" name="minmagnitude">
                    @foreach (range(0,10) as $v)
                        <option value="{{ $v }}" @if ($data['params']['minmagnitude'] == $v) selected="selected"@endif>{{ $v }} mag</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class='col-sm-2'>
            <div class="form-group">
                <select class="form-control" name="maxmagnitude">
                    @foreach (range(0,10) as $v)
                        <option value="{{ $v }}" @if ($data['params']['maxmagnitude'] == $v) selected="selected"@endif>{{ $v }} mag</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-1">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success">Filter</button>
            </div>
        </div>
    </form>
</div>

<div class="row text-center">
    @foreach ($data['earthquakes']->features as $earthquake)
        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&markers=color:red|{{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&zoom=6&size=800x500&maptype=roadmap&key={{ config('app.google_maps_api_key') }}" alt="">
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