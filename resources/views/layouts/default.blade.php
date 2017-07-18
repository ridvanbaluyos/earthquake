<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ridvan Baluyos">
    <meta name="description" content="Earthquake Philippines sends SMS and E-mail alerts whenever an earthquake occurs. It also provides safety, graphs and charts, references, and useful information about earthquakes."/>
    <meta name="keywords" content="earthquake today, earthquake philippines, earthquake alert, earthquake alert philippines, phivolcs" />

    <link rel="canonical" href="https://earthquake.ph"/>
    <link rel="amphtml" href="https://earthquake.ph/amp" />

    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@yield('title', 'Earthquake Philippines - Your friendly earthquake barker')"/>
    <meta property="og:description" content="@yield('description', 'Earthquake Philippines sends SMS and E-mail alerts whenever an earthquake occurs. It also provides earthquake safety tips and information, graphs and charts, references, and other useful information about earthquakes.')"/>
    <meta property="og:url" content="@yield('og-url', 'https://earthquake.ph')"/>
    <meta property="og:site_name" content="Earthquake Philippines"/>
    <meta property="og:image" content="@yield('og-image', 'https://earthquake.ph/og-image.jpeg') "/>

    <title>Earthquake Philippines - @yield('title')</title>
    <link rel="shortcut icon" href="/favicon.gif" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="{{ mix('/css/all.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Mixpanel -->
    <script type="text/javascript">(function(e,a){if(!a.__SV){var b=window;try{var c,l,i,j=b.location,g=j.hash;c=function(a,b){return(l=a.match(RegExp(b+"=([^&]*)")))?l[1]:null};g&&c(g,"state")&&(i=JSON.parse(decodeURIComponent(c(g,"state"))),"mpeditor"===i.action&&(b.sessionStorage.setItem("_mpcehash",g),history.replaceState(i.desiredHash||"",e.title,j.pathname+j.search)))}catch(m){}var k,h;window.mixpanel=a;a._i=[];a.init=function(b,c,f){function e(b,a){var c=a.split(".");2==c.length&&(b=b[c[0]],a=c[1]);b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,
            0)))}}var d=a;"undefined"!==typeof f?d=a[f]=[]:f="mixpanel";d.people=d.people||[];d.toString=function(b){var a="mixpanel";"mixpanel"!==f&&(a+="."+f);b||(a+=" (stub)");return a};d.people.toString=function(){return d.toString(1)+".people (stub)"};k="disable time_event track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config reset people.set people.set_once people.increment people.append people.union people.track_charge people.clear_charges people.delete_user".split(" ");
            for(h=0;h<k.length;h++)e(d,k[h]);a._i.push([b,c,f])};a.__SV=1.2;b=e.createElement("script");b.type="text/javascript";b.async=!0;b.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?MIXPANEL_CUSTOM_LIB_URL:"file:"===e.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";c=e.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c)}})(document,window.mixpanel||[]);
        mixpanel.init("3f35087518d348d8b66bf257e7e2105f");</script>

    <!-- AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-4589920233758218",
            enable_page_level_ads: true
        });
    </script>
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
                        <a href="/earthquake-101"><i class="fa fa-fw fa-lightbulb-o"></i> Earthquake 101</a>
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
                <p class="text-center">
                    <small>&copy; {{ date('Y') }} <a href="//earthquake.ph">earthquake.ph</a></small> · 
                    <small><a href="//github.com/ridvanbaluyos/earthquake">source code</a></small>
                </p>
            </div>
        </div>
    </footer>
    </div>

    <!-- jQuery -->
    <script src="/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Charts -->
    <script src="/js/moment.min.js"></script>
    <script src="/js/Chart.min.js"></script>

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

    <script>
        mixpanel.track("Pageview");
    </script>
</body>
</html>
