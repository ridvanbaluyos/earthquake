@extends('layouts.default')
@section('title', 'Earthquake 101')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
            <p>
                More relevant content and reference about earthquakes will be added soon. I'm still doing research. :D
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Richter Scale<small> <sup><a href="https://en.wikipedia.org/wiki/Richter_magnitude_scale">[1]</a></sup></small></h3>
            <img class="img-responsive" src="/images/richter-scale.gif" title="Richter Scale" />
            <h5>Color Legend: </h5>
            <div class="progress">
                <div class="progress-bar" style="width: 10%; background: #0000ff;">
                    <span>0 ~ 1 Not Felt</span>
                </div>
                <div class="progress-bar" style="width: 10%; background: #0d98ba;">
                    <span>2 ~ 4 Minor </span>
                </div>
                <div class="progress-bar" style="width: 10%; background: #00ff00;">
                    <span>4 ~ 5 Small</span>
                </div>
                <div class="progress-bar" style="width: 10%; background: #ffa500;">
                    <span>5 ~ 6 Moderate</span>
                </div>
                <div class="progress-bar" style="width: 15%; background: #ff69b4;">
                    <span>6 ~ 7 Strong</span>
                </div>
                <div class="progress-bar" style="width: 20%; background: #ff1493;">
                    <span>7 ~ 8 Major</span>
                </div>
                <div class="progress-bar" style="width: 25%; background: #ff0000;">
                    <span>8 ~  Great</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <h3>Earthquake Magnitude Squale (Richter Scale)<small><sup><a href="https://en.wikipedia.org/wiki/Richter_magnitude_scale">[2]</a></sup></small></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Magnitude</th>
                        <th>Description</th>
                        <th>What it feels like</th>
                        <th>Estimated Count Each Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (config('references.intensity_labels.richter') as $range=>$properties)
                        <tr>
                            <td>{{ str_replace(',', ' ~ ', $range) }}</td>
                            <td>
                                {!! App\Helpers\Charts\ChartHelper::getMagnitudeLabel(explode(',', $range)[0]) !!}
                            </td>
                            <td>{{ $properties['description'] }}</td>
                            <td>{{ $properties['count_description'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <h3>Earthquake Magnitude Squale (Modified Mercalli Intensity Scale)<small><sup><a href="https://en.wikipedia.org/wiki/Mercalli_intensity_scale">[3]</a></sup></small></h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Intensity</th>
                    <th>Description</th>
                    <th>What it feels like</th>
                </tr>
                </thead>
                <tbody>
                @foreach (config('references.intensity_labels.mercalli') as $range=>$properties)
                    <tr>
                        <td>{{ $properties['roman_numeral'] }}</td>
                        <td>{!! App\Helpers\Charts\ChartHelper::getMagnitudeLabel(explode(',', $range)[0], 'mercalli') !!}</td>
                        <td>{{ $properties['description'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection