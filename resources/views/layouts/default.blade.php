<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ridvan Baluyos">

    <meta name="description" content="EarthquakePH is an aggregator of earthquake information, from various reliable sources, in order to help Filipinos prepare and notified."/>
    <link rel="canonical" href="https://earthquake.gundamserver.com"/>

    meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="EarthquakePH - Your friendly earthquake barker."/>
    <meta property="og:description" content="EarthquakePH is an aggregator of earthquake information, from various reliable sources, in order to help Filipinos prepare and notified."/>
    "/>
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
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">EarthquakePH <small>(dev)</small></a>
        </div>
        @include('partials.top-menu')
        @include('partials.side-menu')
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<!-- Datetime Picker JS -->
<script type="text/javascript">
    $(function () {
        $('#start_date, #end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: new Date(),
            useCurrent: true,
        });
    });
</script>
</body>
</html>
