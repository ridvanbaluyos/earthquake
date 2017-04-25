@extends('layouts.default')
@section('title', 'Earthquake 101')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
            <p>
                More relevant content and reference about earthquakes will be added soon. I'm still doing research. :D
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Richter Scale<small> <sup><a href="https://en.wikipedia.org/wiki/Richter_magnitude_scale">[1]</a></sup></small></h3>
            <img class="img-responsive" src="/images/richter-scale.gif" title="Richter Scale" />
            <h5>Color Legend: </h5>
            <div class="progress">
                <div class="progress-bar" style="width: 10%; background: #0000ff;">
                    <span>0 ~ 1 Not Felt</span>
                </div>
                <div class="progress-bar" style="width: 10%; background: #0d98ba;">
                    <span>2 ~ 4 Minor </span>
                </div>
                <div class="progress-bar" style="width: 10%; background: #00ff00;">
                    <span>4 ~ 5 Small</span>
                </div>
                <div class="progress-bar" style="width: 10%; background: #ffa500;">
                    <span>5 ~ 6 Moderate</span>
                </div>
                <div class="progress-bar" style="width: 15%; background: #ff69b4;">
                    <span>6 ~ 7 Strong</span>
                </div>
                <div class="progress-bar" style="width: 20%; background: #ff1493;">
                    <span>7 ~ 8 Major</span>
                </div>
                <div class="progress-bar" style="width: 25%; background: #ff0000;">
                    <span>8 ~  Great</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <h3>Earthquake Magnitude Squale <small><sup><a href="https://en.wikipedia.org/wiki/Richter_magnitude_scale">[2]</a></sup></small></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Magnitude</th>
                        <th>Description</th>
                        <th>What it feels like</th>
                        <th>Estimated Count Each Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Less than 2.0</td>
                        <td>Micro</td>
                        <td>Normally only recorded by seismographs. Most people cannot feel them.</td>
                        <td>Millions per year.</td>
                    </tr>
                    <tr>
                        <td>2.0 ~ 2.9</td>
                        <td>Minor</td>
                        <td>A few people feel them. No building damage.</td>
                        <td>Over 1 million per year.</td>
                    </tr>
                    <tr>
                        <td>3.0 ~ 3.9</td>
                        <td>Minor</td>
                        <td>Some people feel them. Objects inside can be seen shaking.</td>
                        <td>Over 100,000 per year.</td>
                    </tr>
                    <tr>
                        <td>4.9 ~ 5.0</td>
                        <td>Light</td>
                        <td>Most people feel it. Indoor objects shake or fall to floor.</td>
                        <td>10,000 to 15,000 per year.</td>
                    </tr>
                    <tr>
                        <td>5.9 ~ 5.9</td>
                        <td>Moderate</td>
                        <td>Can damage or destroy buildings not designed to withstand earthquakes. Everyone feels it.</td>
                        <td>1,000 to 1,500 per year.</td>
                    </tr>
                    <tr>
                        <td>6.0 ~ 6.9</td>
                        <td>Strong</td>
                        <td>Wide spread shaking far from epicenter. Damages building.</td>
                        <td>100 to 150 per year.</td>
                    </tr>
                    <tr>
                        <td>7.0 ~ 7.9</td>
                        <td>Major</td>
                        <td>Wide spread damage in most areas.</td>
                        <td>10 to 20 per year.</td>
                    </tr>
                    <tr>
                        <td>8.0 ~ 8.9</td>
                        <td>Great</td>
                        <td>Wide spread damage in large areas.</td>
                        <td>About 1 per year.</td>
                    </tr>
                    <tr>
                        <td>9.0 ~ 9.9</td>
                        <td>Great</td>
                        <td>Severe damage to most buildings.</td>
                        <td>About 1 per 5~50 years.</td>
                    </tr>
                    <tr>
                        <td>10.0 or over</td>
                        <td>Massive</td>
                        <td>Never recorded.</td>
                        <td>Never recorded.</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-right">
                <small>sources: <a href="//www.geo.mtu.edu/UPSeis/magnitude.html" target="_blank">www.geo.mtu.edu/UPSeis/magnitude.html</a></small>
            </p>
        </div>
    </div>
@endsection