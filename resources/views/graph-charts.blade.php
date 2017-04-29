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
                        @foreach ([7,30,90,180,360,1080,1800,3600,7200,14400, 21600, 28800,36000] as $v)
                            <option value="{{ $v }}" @if ($data['params']['period'] == $v) selected="selected"@endif>Last @if ($v <= 30) {{ $v . " days" }} @elseif ($v > 30 && $v <=360)  {{ $v/30 . " months" }} @else  {{ $v/360 . " years" }} @endif</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <select class="form-control" name="filter">
                        @foreach (['Days' =>'day', 'Months' => 'month', 'Years' => 'year'] as $k=>$v)
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
    <div class ="row">
        <div class="col-lg-12">
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
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Earthquakes by Hour (GMT +8)</h3>
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
            labels: {!!   $data['area_chart']['bymonth']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['bymonth']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['bymonth']['aboveLabels'] !!},
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
            labels: {!!   $data['area_chart']['byweekday']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['byweekday']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['byweekday']['aboveLabels'] !!},
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
            labels: {!!   $data['area_chart']['byhour']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['byhour']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['byhour']['aboveLabels'] !!},
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
@endsection