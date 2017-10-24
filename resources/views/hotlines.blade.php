@extends('layouts.default')
@section('title', 'Emergency Hotlines in the Philippines')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-3 col-lg-offset-4 col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-phone fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><h1>911</h1></div>
                        </div>
                    </div>
                </div>
                <a href="tel:911">
                    <div class="panel-footer">
                        <span class="pull-left">Emergency Hotline</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-12">
            @php $ctr = 0; @endphp
            @foreach (config('references.hotlines') as $heading=>$hotlines)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <strong>{{ $heading }}</strong>
                    </div>
                    <ul class="list-group">
                        @foreach ($hotlines as $heading2=>$hotline)
                            <li class="list-group-item">{{ $heading2 }}:
                                <div class="btn-group" role="group" aria-label="Default button group">
                                    @foreach ($hotline as $number)
                                        <a href="tel:{{ str_replace(['-', '(', ')', ' '], '', $number) }}" class="btn btn-xs btn-default" role="button">{{ $number }}</a>
                                    @endforeach
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            <p>
                <small><em>source:
                    <a href="//www.gov.ph/emergency-hotlines/" target="_blank">gov.ph</a>,
                    <a href="http://www.rappler.com/bulletin-board/36729-emergency-hotlines" target="_blank">rappler.com</a>
                </em></small>
            </p>
        </div>
    </div>
@endsection