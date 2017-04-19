@extends('layouts.default')
@section('title', 'Lost?')
@section('content')
<style type="text/css">
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>
<div class="row">
    <div class="error-template">
        <h1>Oops!</h1>
        <h2>404 Not Found</h2>
        <div class="error-details">
            Sorry, this page is stil under development.<br>
        </div>
        <div class="error-actions">
            <a href="/earthquake-history" class="btn btn-primary">
                <i class="icon-home icon-white"></i> Take Me Home </a>
            <a href="&#109;&#x61;&#105;&#x6c;&#116;&#111;&#58;&#x72;&#x69;&#100;&#x76;&#97;&#110;&#x40;&#x62;&#x61;&#x6c;&#117;&#x79;&#111;&#x73;&#x2e;&#x6e;&#101;&#116;" class="btn btn-default">
                <i class="icon-envelope"></i> Contact Developer </a>
        </div>
        <div class="error-details">
            <blockquote class="blockquote-reverse">
                <p>{{ $verse['verses'][0]['text'] }}</p>
                <footer>{{ $verse['reference'] }} {{ $verse['translation_name'] }}</footer>
            </blockquote>
        </div>
    </div>
</div>

@endsection