@extends('layouts.default')
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
    <div class="col-lg-12">
        <div class="jumbotron">
            <h1>Hello there!</h1>
            <p>This dashboard is still under construction. There's not much content yet but it will be populated soon with fancy graphs, numerics, references, etc. </p>
            <p>For the meantime, you might want to check the <a href="/earthquake-history">past earthquakes.</a></p>
            <a href="//thecatapi.com"><img src="//thecatapi.com/api/images/get?format=src&type=gif"></a>

        </div>
    </div>
</div>
@endsection