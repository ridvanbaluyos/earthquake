@extends('layouts.default')
@section('header-title', 'Earthquake History')
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
    <div class="col-lg-12">
        <h2>History</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Magnitude</th>
                        <th>Location</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Depth</th>
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
                                {{ date('d M Y H:i:s Z', intval($earthquake->properties->time)/1000) }} PST
                            </td>
                            <td
                            >
                                {{ $earthquake->properties->mag }} mb
                                @if ($earthquake->properties->mag >= 5)
                                    <i class="fa fa-fw fa-warning" style="color: red;"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ $earthquake->properties->url }}" target="_blank">
                                    {{ $earthquake->properties->place }}
                                </a>
                            </td>
                            <td>{{ $earthquake->geometry->coordinates[1] }}ºE</td>
                            <td>{{ $earthquake->geometry->coordinates[0] }} ºN</td>
                            <td>{{ $earthquake->geometry->coordinates[2] }} km</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection