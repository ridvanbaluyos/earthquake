@extends('layouts.default')
@section('title', 'Graphs and Charts of Earthquakes in the Philippines')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
        </div>
    </div>
    <div class="row">
        <form name="earthquake_count" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <select class="form-control" name="period">
                        @foreach ([7,30,90,180,360,1080,1800,3600,7200] as $v)
                            <option value="{{ $v }}" @if ($data['params']['period'] == $v) selected="selected"@endif>Last @if ($v <= 30) {{ $v . " days" }} @elseif ($v > 30 && $v <=360)  {{ $v/30 . " months" }} @else  {{ $v/360 . " years" }} @endif</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <select class="form-control" name="filter">
                        @foreach (['Days' =>'days', 'Months' => 'months', 'Years' => 'years'] as $k=>$v)
                            <option value="{{ $v }}" @if ($data['params']['filter'] == $v) selected="selected"@endif>{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <select class="form-control" name="type">
                        @foreach (['Line Chart' =>'line', 'Bar Graph' => 'bar'] as $k=>$v)
                            <option value="{{ $v }}" @if ($data['params']['filter'] == $v) selected="selected"@endif>{{ ucfirst($k) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-success">Filter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p class="text-left">
                <small>Note: querying 5 years and up might cause lag in the heat and circle maps.</small>
            </p>
        </div>
    </div>
    <div class ="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-line-chart"></i> Earthquake Count</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <canvas id="earthquake_count_graph"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Earthquakes by Month</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <canvas id="earthquake_count_by_month"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Earthquakes by Weekday</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <canvas id="earthquake_count_by_weekday"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Earthquakes by Hour</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <canvas id="earthquake_count_by_hour"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-thermometer-half"></i> Heatmap</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <div id="heatmap_canvas" style="width: 100%; height: 600px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-genderless"></i> Circlemap</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <div id="circlemap_canvas" style="width: 100%; height: 600px;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-page-specific')
<script>
    //Charts
    var graphX = document.getElementById('earthquake_count_graph').getContext('2d');
    var graph = new Chart(graphX, {
        type: '{!! $data['params']['type'] !!}',
        data: {
            labels: {!!   $data['area_chart']['graph']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['graph']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['graph']['aboveLabels'] !!},
                backgroundColor: "#ff0000"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            },
            fullWidth: true
        }
    });

    var byMonthX = document.getElementById('earthquake_count_by_month').getContext('2d');
    var byMonth = new Chart(byMonthX, {
        type: '{!! $data['params']['type'] !!}',
        data: {
            labels: {!!   $data['area_chart']['month']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['month']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['month']['aboveLabels'] !!},
                backgroundColor: "#ff0000"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            },
            fullWidth: true
        }
    });

    var byWeekdayX = document.getElementById('earthquake_count_by_weekday').getContext('2d');
    var byWeekday = new Chart(byWeekdayX, {
        type: '{!! $data['params']['type'] !!}',
        data: {
            labels: {!!   $data['area_chart']['weekday']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['weekday']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['weekday']['aboveLabels'] !!},
                backgroundColor: "#ff0000"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            },
            fullWidth: true
        }
    });

    var byHourX = document.getElementById('earthquake_count_by_hour').getContext('2d');
    var byHour = new Chart(byHourX, {
        type: '{!! $data['params']['type'] !!}',
        data: {
            labels: {!!   $data['area_chart']['hour']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['hour']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['hour']['aboveLabels'] !!},
                backgroundColor: "#ff0000"
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            },
            fullWidth: true
        }
    });
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=visualization&callback=initMap">
</script>

<script>
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
        generateHeatmap(earthquakeData);
        generateCircleMap(earthquakeData);
    }

    function generateCircleMap(results)
    {
        map = new google.maps.Map(document.getElementById('circlemap_canvas'), {
            zoom: 5,
            center: {lat: 12.501920, lng: 122.279620}, // philippines
            mapTypeId: 'terrain',
            streetViewControl: false,
            mapTypeControl: false,
            rotateControl: false,
            styles: invertStyles
        });

        map.data.setStyle(function(feature) {
            var magnitude = feature.getProperty('mag');

            if (magnitude < 2.0) {
                // not felt - blue
                color = "#0000ff";
            } else if (magnitude > 2.0 && magnitude <= 4.0) {
                // minor - blue green
                color = "#0d98ba";
            } else if (magnitude > 4.0 && magnitude <= 5.0) {
                // small - green
                color = "#00ff00";
            } else if (magnitude > 5.0 && magnitude <= 6.0) {
                // moderate - orange
                color = "#ffa500";
            } else if (magnitude > 6.0 && magnitude <= 7.0) {
                // strong
                color = "#ff69b4";
            } else if (magnitude > 7.0 && magnitude <= 8.0) {
                // major
                color = "#ff1493";
            } else if (magnitude > 8.0) {
                // great
                color = "#ff0000";
            } else {
                color = '';
            }

            return {
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    fillColor: color,
                    fillOpacity: .5,
                    scale: Math.pow(2, magnitude) / 4,
                    strokeColor: 'white',
                    strokeWeight: .1
                }
            };
        });

        map.data.addGeoJson(results);
    }

    function generateHeatmap(results)
    {
        map = new google.maps.Map(document.getElementById('heatmap_canvas'), {
            zoom: 5,
            center: {lat: 12.501920, lng: 122.279620}, // philippines
            mapTypeId: 'terrain',
            streetViewControl: false,
            mapTypeControl: false,
            rotateControl: false,
            styles: invertStyles
        });

        var heatmapData = [];
        for (var i = 0; i < results.features.length; i++) {
            var coords = results.features[i].geometry.coordinates;
            var latLng = new google.maps.LatLng(coords[1], coords[0]);
            heatmapData.push(latLng);
        }
        var heatmap = new google.maps.visualization.HeatmapLayer({
            data: heatmapData,
            dissipating: false,
            map: map,
        });
        heatmap.set('radius', 0.2);
    }

    var invertStyles = [
        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
        {
            featureType: 'administrative.locality',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
        },
        {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
        },
        {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#263c3f'}]
        },
        {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#6b9a76'}]
        },
        {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#38414e'}]
        },
        {
            featureType: 'road',
            elementType: 'geometry.stroke',
            stylers: [{color: '#212a37'}]
        },
        {
            featureType: 'road',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9ca5b3'}]
        },
        {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#746855'}]
        },
        {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#1f2835'}]
        },
        {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#f3d19c'}]
        },
        {
            featureType: 'transit',
            elementType: 'geometry',
            stylers: [{color: '#2f3948'}]
        },
        {
            featureType: 'transit.station',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
        },
        {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#17263c'}]
        },
        {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#515c6d'}]
        },
        {
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#17263c'}]
        }
    ];
</script>
@endsection