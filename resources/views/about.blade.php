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
                <li>
                    <a href="//bible-api.com" target="_blank">Bible API</a> - This is a tiny little web app that provides a JSON API for grabbing Bible verses and passages.
                </li>
            </ul>
        </div>
    </div>
@endsection
