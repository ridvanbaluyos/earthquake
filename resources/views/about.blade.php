@extends('layouts.default')
@section('title', 'About')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p>
                Earthquake Philippines is a side-project by <a href="//ridvanbaluyos.com" target="_blank" title="Ridvan Baluyos">Ridvan Baluyos</a>. This site is currently on incremental development.
            </p>
            <hr>
            <h5>Data Source</h5>
            <ul>
                <li>
                    <a href="//www.usgs.gov/">United States Geological Survey</a> - Science for a change world.
                </li>
            </ul>
        </div>
    </div>
@endsection
