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
                    <select class="form-control" name="chart">
                        @foreach (['line', 'bar'] as $v)
                            <option value="{{ $v }}" @if ($data['params']['chart'] == $v) selected="selected"@endif>{{ ucfirst($v) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-sm-1">
                <div class="form-group">
                    <select class="form-control" name="filter">
                        @foreach (['days', 'months', 'years'] as $v)
                            <option value="{{ $v }}" @if ($data['params']['filter'] == $v) selected="selected"@endif>{{ ucfirst($v) }}</option>
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
        <div class="col-lg-6 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Earthquake Count</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-1">
                            <canvas id="earthquake_count_chart"></canvas>
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
    var ctx = document.getElementById('earthquake_count_chart').getContext('2d');
    var earthquakeCountChart = new Chart(ctx, {
        type: '{{  $data['params']['chart'] }}',
        data: {
            labels: {!!   $data['area_chart']['labels'] !!},
            datasets: [{
                label: '< 5.0mb',
                data: {!!   $data['area_chart']['belowLabels'] !!},
                backgroundColor: "#00ff00"
            }, {
                label: '>= 5.0mb',
                data: {!!   $data['area_chart']['aboveLabels'] !!},
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