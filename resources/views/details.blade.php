@extends('layouts.default')
@section('title', $data['earthquake']->properties->title)
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
        </div>
    </div>

    <div class="row">
    </div>
@endsection