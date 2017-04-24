@extends('layouts.default')
@section('title', $data['earthquake']->properties->title)
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <a href="/earthquakes" class="btn btn-default btn"><i class="fa fa-chevron-left fa-3" aria-hidden="true"></i> Back</a>
            <h3>@yield('title')</h3>
            <small>{{ $data['earthquake']->geometry->coordinates[1] }}°N,{{ $data['earthquake']->geometry->coordinates[0] }}°E</small>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div id="map" style="width: 100%; height: 300px;"></div>
            <br/>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-default">
                <table class="table table-striped">
                    <tr>
                        <th scope="row">Magnitude</th>
                        <td>{{ $data['earthquake']->properties->mag }}</td>
                    </tr>
                    <tr>
                        <th>Felt</th>
                        <td>
                            @if (isset($data['earthquake']->properties->felt)) {{ $data['earthquake']->properties->felt }} @else 0 @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Community Determined Intensity</th>
                        <td>@if (isset($data['earthquake']->properties->cdi)) {{ $data['earthquake']->properties->cdi }} @else 0 @endif</td>
                    </tr>
                    <tr>
                        <th>Modified Mercalli Intensity</th>
                        <td>@if (isset($data['earthquake']->properties->mmi)) {{ $data['earthquake']->properties->mmi }} @else 0 @endif</td>
                    </tr>
                    <tr>
                        <th>Significance</th>
                        <td>@if (isset($data['earthquake']->properties->sig)) {{ $data['earthquake']->properties->sig }} @else 0 @endif</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($data['earthquake']->properties->status == 'reviewed')
                                <span class="label label-success">Reviewed</span>
                            @elseif ($data['earthquake']->properties->status == 'automatic')
                                <span class="label label-warning">Automatic</span>
                            @else
                                <span class="label label-success">No Record</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Pager Alert</th>
                        <td>
                            @if ($data['earthquake']->properties->alert == 'green')
                                <span class="label label-success">Green</span>
                            @elseif ($data['earthquake']->properties->alert == 'yellow')
                                <span class="label label-warning">Yellow</span>
                            @elseif ($data['earthquake']->properties->alert == 'orange')
                                <span class="label label-warning">Orange</span>
                            @elseif ($data['earthquake']->properties->alert == 'red')
                                <span class="label label-danger">Red</span>
                            @else
                                <span class="label label-default">No Record</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tsunami Alert</th>
                        <td>
                            @if (empty($data['earthquake']->properties->tsunami))
                                <span class="label label-success">No</span>
                            @else
                                <span class="label label-danger">Yes</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
@endsection

@section('js-page-specific')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&callback=initMap">
    </script>
    <script type="text/javascript">
        // Google Maps
        // TODO: rewrite and optimize these JS shiznits.
        var map;
        var earthquakeData = $.parseJSON($.ajax({
            type: 'get',
            url: '{!! $data['url'] !!}',
            dataType: 'json',
            data: [],
            async: false
        }).responseText);

        function initMap()
        {
            generateCircleMap(earthquakeData);
        }


        function generateCircleMap(results)
        {
            var latitude = parseFloat(results.geometry.coordinates[1]);
            var longitude = parseFloat(results.geometry.coordinates[0]);

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: {lat: latitude, lng: longitude}, // philippines
                mapTypeId: 'terrain',
                streetViewControl: false,
                mapTypeControl: false,
                rotateControl: false
            });

            map.data.setStyle(function(feature) {
                var magnitude = feature.getProperty('mag');
                return {
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: 'red',
                        fillOpacity: .2,
                        scale: Math.pow(2, magnitude) / 1.5,
                        strokeColor: 'white',
                        strokeWeight: 1
                    }
                };
            });

            map.data.addGeoJson(results);
        }
    </script>

@endsection
