<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ridvan Baluyos">
    <meta name="description" content="Earthquake alerts, safety, preparedness, and information in the Philippines."/>
    <meta name="keywords" content="earthquake today, earthquake philippines, earthquake alert, earthquake alert philippines, phivolcs" />
    <link rel="canonical" href="https://earthquake.gundamserver.com"/>

    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="EarthquakePH - Your friendly earthquake barker."/>
    <meta property="og:description" content="Earthquake Philippines is an aggregator of earthquake information, from various reliable sources, in order to help Filipinos prepare and get notified."/>
    <meta property="og:url" content="https://earthquake.gundamserver.com"/>
    <meta property="og:site_name" content="EarthquakePH"/>
    <meta property="og:image" content="/og-image.jpg"/>

    <title>EarthquakePH - @yield('title')</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="css/all.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Earthquake Philippines</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/earthquakes"><i class="fa fa-history"></i> All</a>
                    </li>
                    <li>
                        <a href="/earthquake-graphs-charts"><i class="fa fa-line-chart"></i> Graphs</a>
                    </li>
                    <li>
                        <a href="/earthquake-heatmap"><i class="fa fa-thermometer-half"></i> Heatmap</a>
                    </li>
                    <li>
                        <a href="/earthquake-safety-and-preparedness"><i class="fa fa-fw fa-life-saver"></i> Safety and Preparedness</a>
                    </li>
                    <li>
                        <a href="/earthquake-survival-kit"><i class="fa fa-fw fa-medkit"></i> Survival Kit</a>
                    </li>
                    <li>
                        <a href="/earthquake-hotlines"><i class="fa fa-fw fa-volume-control-phone"></i> Hotlines</a>
                    </li>
                    <li>
                        <a href="/about"><i class="fa fa-fw fa-info-circle"></i> About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        @yield('content')
        <!-- /.row -->
        <hr>
    </div>
    <div class="container">
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <small>nose boop <a href="https://ridvanbaluyos.com">ridvanbaluyos.com</a></small>
                    <small>data source <a href="https://earthquake.usgs.gov/">u.s. geological survey</a></small>
                </p>
            </div>
        </div>
    </footer>
    </div>

<!-- JQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Charts -->
<script src="js/moment.min.js"></script>
<script src="js/Chart.min.js"></script>

<!-- Page Specific JS -->
@yield('js-page-specific')

<!-- Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-45399063-5', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
