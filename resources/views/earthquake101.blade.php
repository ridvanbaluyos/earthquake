@extends('layouts.default')
@section('title', 'Earthquake 101')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3>@yield('title')</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3>Earthquake Magnitude Squale</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Magnitude</th>
                        <th>Earthquake Effects</th>
                        <th>Estimated Count Each Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2.5 or less</td>
                        <td>Usually not felt, but can be recorded by seismograph.</td>
                        <td>900,000</td>
                    </tr>
                    <tr>
                        <td>2.5 to 5.4</td>
                        <td>Often felt, but only causes minor damage.</td>
                        <td>30,000</td>
                    </tr>
                    <tr>
                        <td>5.5 to 6.0</td>
                        <td>Slight damage to buildings and other structures.</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>6.1 to 6.9</td>
                        <td>May cause a lot of damage in very populated areas.</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>7.0 to 7.9</td>
                        <td>Major earthquake. Serious damage.</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td>8.0 or greater</td>
                        <td>Great earthquake. Can totally destroy communities near the epicenter.</td>
                        <td>One every 5 to 10 years</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h3>Earthquake Magnitude Classes</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Magnitude</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Great</td>
                    <td>8 or more</td>
                </tr>
                <tr>
                    <td>Major</td>
                    <td>7 - 7.9</td>
                </tr>
                <tr>
                    <td>Strong</td>
                    <td>6 - 6.9</td>
                </tr>
                <tr>
                    <td>Moderate</td>
                    <td>5 - 5.9</td>
                </tr>
                <tr>
                    <td>Light</td>
                    <td>4 - 4.9</td>
                </tr>
                <tr>
                    <td>Minor</td>
                    <td>3 -3.9</td>
                </tr>
                </tbody>
            </table>
            <p class="text-right">
                <small>source: <a href="/www.geo.mtu.edu/UPSeis/magnitude.html">www.geo.mtu.edu/UPSeis/magnitude.html</a></small>
            </p>
        </div>
    </div>
@endsection