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
    </div>
</div>
@endsection