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
                Earthquake Philippines is a side-project by <a href="//ridvanbaluyos.com" target="_blank" title="Ridvan Baluyos">Ridvan Baluyos</a>.
            </p>
            <hr>
            <h5>Tech Stack</h5>
            <ul>
                <li>
                    <a href="//laravel.com/" target="_blank">Laravel PHP Framework</a> - The PHP Framework For Web Artisans.
                </li>
                <li>
                    <a href="//getbootstrap.com/" target="_blank">Bootstrap</a> - Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile first projects on the web.
                </li>
                <li>
                    <a href="//www.chartjs.org/" target="_blank">Charts.js</a> - Simple yet flexible JavaScript charting for designers & developers.
                </li>
                <li>
                    <a href=//developers.google.com/maps/" target="_blank">Google Maps API</a> - Millions of websites and apps use Google Maps APIs to power location experiences for their users.
                </li>
                <li>
                    <a href="//www.iconj.com/" target="_blank">IconJ</a> - Manage Your Website Favicon Dynamically.
                </li>
                <li>
                    <a href="//startbootstrap.com/template-overviews/heroic-features/" target="_blank">Heroic Features</a> - Free Bootstrap Themes & Templates.
                </li>
            </ul>
            <hr>
            <h5>Infrastructure</h5>
            <ul>
                <li>
                    <a href="//aws.amazon.com/ec2/" target="_blank">Amazon EC2</a> - Amazon Elastic Compute Cloud (Amazon EC2) is a web service that provides secure, resizable compute capacity in the cloud.
                </li>
                <li>
                    <a href="//semaphore.co/" target="_blank">Semaphore</a> - Semaphore lets you send an SMS with a single line of code. No complicated setup, no dealing with telecom protocols and procedures.
                </li>
                <li>
                    <a href="//http://mailgun.com/" target="_blank">Mailgun</a> - Transactional Email API Service for Developers.
                </li>
                <li>
                    <a href="//www.cloudflare.com" target="_blank">Cloudflare</a> - Cloudflare speeds up and protects millions of websites, APIs, SaaS services, and other properties connected to the Internet.
                </li>
                <li>
                    <a href="//newrelic.com" target="_blank">New Relic</a> - Digital Performance Monitoring and Management.
                </li>
                <li>
                    <a href="//mixpanel.com" target="_blank">Mixpanel</a> - Product analytics for mobile, web, nad beyond.
                </li>
            </ul>
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