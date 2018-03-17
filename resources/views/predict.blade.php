@extends('layouts.default')
@section('title', 'Predict')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
        </div>
    </div>
    <form name="" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <label for="period">Data Source Period</label>
                    <select class="form-control" name="period">
                        @foreach ([7,30,90,180,360,1080,1800,3600,7200,14400, 21600, 28800,36000] as $v)
                            <option value="{{ $v }}" @if ($data['params']['period'] == $v) selected="selected"@endif>@if ($v <= 30) {{ $v . " days" }} @elseif ($v > 30 && $v <=360)  {{ $v/30 . " months" }} @else  {{ $v/360 . " years" }} @endif</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <label for="period">Month</label>
                    <select class="form-control" name="month">
                        @foreach (range(1, 12) as $v)
                            <option value="{{ $v }}" @if ($data['params']['month'] == $v) selected="selected"@endif>{{ date('F', mktime(0, 0, 0, $v, 10)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-sm-1">
                <div class="form-group">
                    <label for="period">Day</label>
                    <select class="form-control" name="day">
                        @foreach (range(1, 31) as $v)
                            <option  value="{{ $v }}" @if ($data['params']['day'] == $v) selected="selected"@endif>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-sm-1">
                <div class="form-group">
                    <label for="period">Year</label>
                    <select class="form-control" name="year">
                        @foreach (range(date('Y'), date('Y') + 50) as $v)
                            <option  value="{{ $v }}" @if ($data['params']['year'] == $v) selected="selected"@endif>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-1 col-sm-1">
                <div class="form-group">
                    <label for="period">Hour</label>
                    <select class="form-control" name="hour">
                        @foreach (range(0, 23) as $v)
                            <option  value="{{ $v }}" @if ($data['params']['hour'] == $v) selected="selected"@endif>{{ date('g a', mktime($v, 0, 0, 0, 0)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-sm btn-success" value="Predict" />
    </form>

    @if (isset($data['earthquake']))
        <hr />
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h3>
                    {{ $data['earthquake']->properties->title }}
                    {!! \App\Helpers\Charts\ChartHelper::getMagnitudeLabel($data['earthquake']->properties->mag) !!}
                    <br/>
                    <small>
                        <i class="fa fa-map-marker fa-3" aria-hidden="true"></i>
                        {{ $data['earthquake']->geometry->coordinates[1] }}°N,{{ $data['earthquake']->geometry->coordinates[0] }}°E
                    </small>
                </h3>
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
                            <th>Modified Mercalli Intensity</th>
                            <td>@if (isset($data['earthquake']->properties->mmi)) {{ $data['earthquake']->properties->mmi }} @else 0 @endif</td>
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
                        <th>Total Number of Sample Data</th>
                        <td>
                            {{ $data['params']['sample_count'] }}
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
    @endif
@endsection
