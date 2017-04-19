@extends('layouts.default')
@section('header-title', 'History')
@section('title', 'History')
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
    <form name="" action="" method="POST" id="filter_history">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Period</label>
                        <select class="form-control" name="period">
                            @foreach ([1,3,7,14,30] as $v)
                                <option value="{{ $v }}" @if ($data['params']['period'] == $v) selected="selected"@endif>Last @if ($v == 1) 24 hours @else {{ $v . " days" }} @endif</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class='col-sm-2'>
                    <div class="form-group">
                        <label>Min Magnitude</label>
                        <select class="form-control" name="minmagnitude">
                            @foreach (range(0,10) as $v)
                                <option value="{{ $v }}" @if ($data['params']['minmagnitude'] == $v) selected="selected"@endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class='col-sm-2'>
                    <div class="form-group">
                        <label>Max Magnitude</label>
                        <select class="form-control" name="maxmagnitude">
                            @foreach (range(0,10) as $v)
                                <option value="{{ $v }}" @if ($data['params']['maxmagnitude'] == $v) selected="selected"@endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='col-sm-1'>
                    <button type="submit" class="btn btn-lg btn-primary">Filter</button>
                </div>
            </div>
        </div>
    </form>
    <div class="col-lg-12">
        <h2>Last @if ($data['params']['period'] == 1) 24 hours @else {{ $data['params']['period'] . " days" }} @endif</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Timestamp (PST)</th>
                        <th>Magnitude (mb)</th>
                        <th>Location</th>
                        <th>Coordinates</th>
                        <th>Depth (km)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['earthquakes']->features as $earthquake)
                        <tr
                            @if ($earthquake->properties->mag >= 5)
                                class="danger"
                            @elseif ($earthquake->properties->mag < 5 && $earthquake->properties->mag > 4)
                                class=""
                            @endif
                        >
                            <td>
                                <a href="{{ $earthquake->properties->url }}" target="_blank">
                                    {{ date('d M Y H:i:s Z', intval($earthquake->properties->time)/1000) }}
                                </a>
                                @if ($earthquake->properties->mag >= 5)
                                    <i class="fa fa-fw fa-warning" style="color: red;"></i>
                                @endif
                            </td>
                            <td
                            >
                                {{ $earthquake->properties->mag }}
                            </td>
                            <td>
                                <a href="{{ $earthquake->properties->url }}" target="_blank">
                                    {{ $earthquake->properties->place }}
                                </a>
                            </td>
                            <td>
                                <a href="//www.google.com/maps/place//{{ "@" . $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }},8z" target="_blank">
                                    {{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}
                                </a>
                            </td>
                            <td>{{ $earthquake->geometry->coordinates[2] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.row -->
@endsection