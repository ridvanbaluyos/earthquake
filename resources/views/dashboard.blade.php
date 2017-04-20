@extends('layouts.default')
@section('title', 'Your friendly earthquake barker')
@section('header-title', 'Dashboard')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @yield('header-title') <small></small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-tachometer"></i> @yield('header-title')
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    {{--<div class="col-lg-12">--}}
        {{--<div class="jumbotron">--}}
            {{--<h1>Hello there!</h1>--}}
            {{--<p>This dashboard is still under construction. There's not much content yet but it will be populated soon with fancy graphs, numerics, references, etc. </p>--}}
            {{--<p>For the meantime, you might want to check the <a href="/earthquake-history">past earthquakes.</a></p>--}}
            {{--<a href="//thecatapi.com"><img src="//thecatapi.com/api/images/get?format=src&type=gif"></a>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
<div class ="row">
    <div class="col-lg-12 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Earthquake Count (Last 360 days)</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form name="earthquake_count" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-lg-2 col-sm-1">
                            <div class="form-group">
                                <select class="form-control" name="period">
                                    @foreach ([7,30,90,180,360,1080,1800,3600,7200] as $v)
                                        <option value="{{ $v }}" @if ($data['params']['period'] == $v) selected="selected"@endif>Last @if ($v <= 30) {{ $v . " days" }} @elseif ($v > 30 && $v <=360)  {{ $v/30 . " months" }} @else  {{ $v/360 . " years" }} @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-1">
                            <div class="form-group">
                                <select class="form-control" name="chart">
                                    @foreach (['line', 'bar'] as $v)
                                        <option value="{{ $v }}" @if ($data['params']['chart'] == $v) selected="selected"@endif>{{ ucfirst($v) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-1">
                            <div class="form-group">
                                <select class="form-control" name="filter">
                                    @foreach (['days', 'months', 'years'] as $v)
                                        <option value="{{ $v }}" @if ($data['params']['filter'] == $v) selected="selected"@endif>{{ ucfirst($v) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-1">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <canvas id="myChart" width="10" height="10"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js-page-specific')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        ctx.canvas.width = 600;
        ctx.canvas.height = 100;
        var myChart = new Chart(ctx, {
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

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
@endsection