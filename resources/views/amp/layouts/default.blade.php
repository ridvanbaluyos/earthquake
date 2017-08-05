<!DOCTYPE html>
<HTML amp="amp" lang="en">
<head>
    <title>Earthquake Philippines</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#682591"/>

    <meta name="author" content="Ridvan Baluyos">
    <meta name="description" content="Earthquake Philippines sends SMS and E-mail alerts whenever an earthquake occurs. It also provides safety, graphs and charts, references, and useful information about earthquakes."/>
    <meta name="keywords" content="earthquake today, earthquake philippines, earthquake alert, earthquake alert philippines, phivolcs"/>

    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Home"/>
    <meta property="og:description" content="Earthquake Philippines sends SMS and E-mail alerts whenever an earthquake occurs. It also provides earthquake safety tips and information, graphs and charts, references, and other useful information about earthquakes."/>
    <meta property="og:url" content="https://earthquake.ph"/>
    <meta property="og:site_name" content="Earthquake Philippines"/>
    <meta property="og:image" content="https://earthquake.ph/og-image.jpeg "/>

    <link href="https://www.earthquake.ph/amp" rel="amphtml"/>
    <link href="https://www.earthquake.ph" rel="canonical"/>

    <link rel="shortcut icon" href="/favicon.gif" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <style amp-custom>
    @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 400;
        src: local("Roboto"), local("Roboto-Regular"), url(https://fonts.gstatic.com/s/roboto/v15/CWB0XYA8bzo0kSThX0UTuA.woff2) format("woff2"), url(https://fonts.gstatic.com/s/roboto/v15/2UX7WLTfW3W8TclTUvlFyQ.woff) format("woff"), url(https://fonts.gstatic.com/s/roboto/v15/QHD8zigcbDB8aPfIoaupKOvvDin1pK8aKteLpeZ5c0A.ttf) format("truetype");
    }
    @font-face {
        font-family: "Roboto";
        font-style: normal;
        font-weight: 700;
        src: local("Roboto Bold"), local("Roboto-Bold"), url(https://fonts.gstatic.com/s/roboto/v15/d-6IYplOFocCacKzxwXSOFtXRa8TVwTICgirnJhmVJw.woff2) format("woff2"), url(https://fonts.gstatic.com/s/roboto/v15/d-6IYplOFocCacKzxwXSOD8E0i7KZn-EPnyo3HZu7kw.woff) format("woff"), url(https://fonts.gstatic.com/s/roboto/v15/d-6IYplOFocCacKzxwXSOCZ2oysoEQEeKwjgmXLRnTc.ttf) format("truetype");
    }
    @font-face {
        font-family: "Roboto";
        font-style: italic;
        font-weight: 400;
        src: local("Roboto Italic"), local("Roboto-Italic"), url(https://fonts.gstatic.com/s/roboto/v15/vPcynSL0qHq_6dX7lKVByfesZW2xOQ-xsNqO47m55DA.woff2) format("woff2"), url(https://fonts.gstatic.com/s/roboto/v15/1pO9eUAp8pSF8VnRTP3xnvesZW2xOQ-xsNqO47m55DA.woff) format("woff"), url(https://fonts.gstatic.com/s/roboto/v15/W4wDsBUluyw0tK3tykhXEXYhjbSpvc47ee6xR_80Hnw.ttf) format("truetype");
    }
    @font-face {
        font-family: "Roboto Slab";
        font-style: normal;
        font-weight: 400;
        src: local("Roboto Slab Regular"), local("RobotoSlab-Regular"), url(https://fonts.gstatic.com/s/robotoslab/v6/y7lebkjgREBJK96VQi37Zo4P5ICox8Kq3LLUNMylGO4.woff2) format("woff2"), url(https://fonts.gstatic.com/s/robotoslab/v6/y7lebkjgREBJK96VQi37ZobN6UDyHWBl620a-IRfuBk.woff) format("woff"), url(https://fonts.gstatic.com/s/robotoslab/v6/y7lebkjgREBJK96VQi37ZiwlidHJgAgmTjOEEzwu1L8.ttf) format("truetype");
    }
    @font-face {
        font-family: "Roboto Slab";
        font-style: normal;
        font-weight: 700;
        src: local("Roboto Slab Bold"), local("RobotoSlab-Bold"), url(https://fonts.gstatic.com/s/robotoslab/v6/dazS1PrQQuCxC3iOAJFEJYlIZu-HDpmDIZMigmsroc4.woff2) format("woff2"), url(https://fonts.gstatic.com/s/robotoslab/v6/dazS1PrQQuCxC3iOAJFEJTqR_3kx9_hJXbbyU8S6IN0.woff) format("woff"), url(https://fonts.gstatic.com/s/robotoslab/v6/dazS1PrQQuCxC3iOAJFEJTdGNerWpg2Hn6A-BxWgZ_I.ttf) format("truetype");
    }
    /* fallback */
    @font-face {
        font-family: "Material Icons";
        font-style: normal;
        font-weight: 400;
        src: local("Material Icons"), local("MaterialIcons-Regular"), url(https://fonts.gstatic.com/s/materialicons/v18/2fcrYFNaTjcS6g4U3t-Y5ZjZjT5FdEJ140U2DJYC3mY.woff2) format("woff2");
    }

    body {
        background:#f9f9f9;
        margin:0;
        padding:0;
        color:#333;
        font-size:15px;
        font-family:Roboto,Arial,Sans-serif;
        border-top:300px solid #ebebeb;
    }

    a:link {
        color:#0e72b5;
        text-decoration:none;
    }
    a:visited {
        color:#0e72b5;
        text-decoration:none;
    }
    a:hover {
        color:#333;
        text-decoration:underline;
    }
    a img {
        border-width:0;
    }

    /* Header */

    #header-wrapper {
        width:100%;
        padding:0;
        color:#212121;
        font-weight:400;
        background-color:#fff;
        position:fixed;
        top:0;
        left:0;
        width:100%;
        height:60px;
        box-shadow: 2px 1px 1px rgba(0,0,0,.15);
        z-index:999;
    }
    #header {
        max-width:768px;
        color:#212121;
        text-align:left;
        margin:0 auto;
    }

    #header h1 {
        margin:0;
        padding:0;
        font-size:140%;
        float:left;
        color:#212121;
        line-height:60px;
    }

    #header a {
        color:#212121;
        text-decoration:none;
        -webkit-transition:all .4s ease;
        transition:all .4s ease;
    }

    #header a:hover {
        color:#0379c4;
    }

    #header .description {
        margin:0 0 0 20px;
        padding:0 0 15px;
        text-transform:capitalize;
        line-height:60px;
        float:left;
    }

    #header amp-img {
        margin-top:-5px;
        margin-right:5px;
        height:auto;
        width:auto;
        vertical-align:middle;
    }

    #header-wrapper h5{background:none;border:none}
    .acc-header {max-width:320px;position:absolute;top:0;right:-2px;z-index:900;}
    .mi-22 {font-size:22px}
    .search-fixed {position:fixed;top:20px;right:17px;z-index:1001;}
    .search-wrapper{float:right;top:60px;right:0;background:#f8f8f8;border-left:1px solid #ddd;border-top:1px solid #ddd;padding:15px;box-shadow: 2px 1px 1px rgba(0,0,0,.15);z-index:1001}
    #search-box{width:250px;height:27px;float:right;padding:0;margin:0;position:relative}
    #search-box form{border:1px solid #ccc;line-height:27px}
    .search-form{border:none;color:gray;width:100%;padding:0 30px 0 10px;height:27px;line-height:27px;font-size:14px;font-weight:400;margin:0;-moz-box-sizing:border-box;box-sizing:border-box}
    .search-button{background:0 0;width:30px;height:29px;line-height:29px;padding:3px 0 0 0;text-align:center;margin:0;top:0;right:0;font-size:16px;color:#888;position:absolute;border:none;border-radius:0;text-shadow:none;box-shadow:none;cursor:pointer}
    .search-form:focus,.search-form:hover,.search-button:focus,.search-button:hover{border:none;outline:0;color:#000}

    /* AMP Sidebar */
    .btn-amp-sidebar{display:inline-block;background-image:url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii0zIC02IDI0IDI0Ij48cGF0aCBmaWxsPSIjNEE0QTRBIiBkPSJNMCAxMmgxOHYtMkgwdjJNMCA3aDE4VjVIMHYyTTAgMHYyaDE4VjBIMCIvPjwvc3ZnPg==);background-repeat:no-repeat;background-size:30px 24px;background-position:center center;background-color:transparent;width:40px;height:40px;border:none;position:fixed;top:10px;left:10px;z-index:1001;cursor:pointer}
    amp-sidebar{width:240px;background:#27597a;color:#fff;}
    amp-sidebar ul{padding:0;list-style:none}
    amp-sidebar li{line-height:40px;padding:0;list-style:none;color:#fff;border-bottom:1px solid #30698f;text-align:center;font-size:14px}
    amp-sidebar li:nth-child(1){border-top:1px solid #30698f;}
    amp-sidebar li:hover{background:#2e6589}
    amp-sidebar li>a{color:#fff;text-decoration:none;padding:5px 10px}
    amp-sidebar button{margin-left:20px}
    .amp-sidebar-image{line-height:100px;vertical-align:middle}
    .amp-close-image{top:15px;left:205px;cursor:pointer}
    a.sidebaramp{color:#fff;text-decoration:none}
    .amp-sidebar-about {min-width:240px;min-height:240px;text-align:center;font-size:14px;}
    .amp-sidebar-about p{padding:15px 15px 0 15px;line-height:1.4em}
    .amp-sidebar-profile {max-width:100px;min-width:100px;border-radius:100px;margin:20px auto;background:#517b94}
    .amp-sidebar-profile amp-img {border-radius:100px;}
    #sidebar h6 {border:none;background:none;font-size:14px;font-weight:normal;margin-left:20px}
    #sidebar p {line-height:1.6em}
    section[expanded] .show-more,section:not([expanded]) .show-less{display:none;}
    .contact-box {background:#194a6a;padding:20px;border-top:1px solid #30698f;text-align:left}
    .contact-box svg{width:20px; height:20px;vertical-align: -4px;margin-right:10px}
    .contact-box span svg path{fill:#accbdf}
    .contact-me {min-width:210px;display:block}
    p.soc-icon {margin-top:5px;height:30px;padding:0}
    .soc-icon svg{width:20px; height:20px;}
    .soc-icon span svg path{fill:#80aac6;transition: all .5s ease-in-out;}
    .soc-icon span svg:hover path{fill:#fff}
    .soc-icon .youtube svg {width: 24px;height: 24px;vertical-align: -2px;}

    .status-msg-wrap{font-size:100%;width:auto;margin:0 30px 30px 0;position:relative;padding:0}
    .status-msg-border{border:1px solid #ccc;opacity:.4;width:100%;text-align:center;position:relative;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box}
    .status-msg-bg{background-color:#fff;opacity:.8;width:100%;position:relative;z-index:1}
    .status-msg-body{text-align:center;padding:.3em 0;width:auto;top:0;left:0;right:0;position:absolute;z-index:4}
    .status-msg-hidden{visibility:hidden;padding:.3em 0}
    .status-msg-wrap a{padding-left:.4em;font-weight:500}

    /* Outer-Wrapper */
    #outer-wrapper {
        width:100%;
        margin:0 auto;
        padding:0;
        text-align:left;
    }
    #content-wrapper {
        max-width:768px;
        margin:0 auto;
    }
    #main-wrapper {
        width:103%;margin:-180px auto 15px;
        word-wrap:break-word; /* fix for long text breaking sidebar float in IE */
        overflow:hidden;     /* fix for long non-text content breaking IE sidebar float */
    }
    .image-wrapper {width:100%:height:auto}

    #sidebar-wrapper {display:none}

    /* Headings */

    h2 {
        margin:1.5em 0 .75em;
        line-height:1.4em;
        text-transform:capitaize;
    }


    /* Posts */
    .post-meta {
        margin-top:-10px;
        display:block;
        text-align: left;
        font-size: 11px;
        color: #aaa;
        padding: 30px 10px 30px 0;
        border-top:1px solid #ddd;
        border-bottom:1px solid #ddd;
        -moz-box-sizing:border-box;
        -webkit-box-sizing:border-box;
        box-sizing:border-box;
    }
    .post-meta a {
        color: #0e72b5;
        text-decoration: none;
    }
    .post-meta a:hover {
        color:#aaa;
    }
    .post-meta-span {
        margin-right: 15px;
    }
    .post {
        width:47%;
        padding:0;
        background-color:#fff;
        box-shadow: 0 0 3px rgba(0,0,0,0.12),0 0 2px rgba(0,0,0,0.18);
        overflow: hidden;
        border:1px solid #dbdbdb;
        height:400px;
        float:left;
        margin:0 20px 20px 0;
        position:relative
    }
    .post-inner{padding:20px}
    .post h2 {
        margin:.25em 0 0 0;
        padding:0 0 4px;
        font-size:20px;
        font-weight:700;
        line-height:1.3em;
        color:#333;
    }

    .post h2 a, .post h3 a:visited, .post h3 strong {
        display:block;
        text-decoration:none;
        color:#333;
        transition: all .5s ease-in-out;
    }

    .post h2 strong, .post h2 a:hover {
        color:#0e72b5;
    }
    .post h3 {
        margin:.25em 0 0 0;
        padding:0 0 4px;
        font-size:140%;
        font-weight:700;
        line-height:1.3em;
        color:#333;
    }
    .post .post-title {
        margin-bottom:15px;
    }

    .post-body {
        margin:15px 0 .75em;
        line-height:1.6em;
    }

    .post-body img{
        width:100%
    }
    .post-body blockquote {
        line-height:1.3em;
    }

    .post-footer {
        margin:40px 0;
        line-height:1.7em;
    }

    .comment-link {
        margin-left:.6em;
    }
    .post blockquote {
        margin:1em 20px;
    }
    .post blockquote p {
        margin:.75em 0;
    }

    /* Costumize */
    .post-thumbnail {
        width:100%;
        height:auto;
        float:left;
        margin:2px 15px 15px 0;
    }
    pre {
        padding:.5em 1em;
        margin: 0;
        white-space:pre;
        overflow:auto;
        background-color:#f1f1f1;
        font-size:14px;
        clear:both;
        border-left:3px solid #ccc;
        color:#111;
    }
    code {
        font-family:Consolas,Monaco,"Andale Mono","Courier New",Courier,Monospace;
        line-height:20px;
        color:#db4437;
        font-size:14px;
    }
    pre code {
        display: block; padding: 0.5em;
        line-height:1.5em;
        color: black;
    }
    ::selection { background: #1066b9;color:white }
    ::-moz-selection { background: #1066b9; color:white}
    .thumbnail-cadangan {display:none}
    .centered {text-align:center}


    #blog-pager-newer-link a{
        float:left;margin-left:0;background:#aaa;color:#fff;border-radius:100px;width:30px;height:30px;transition:all .4s ease-out}

    #blog-pager-older-link a{float:right;margin-right:20px;background:#aaa;color:#fff;border-radius:100px;width:30px;height:30px;transition:all .4s ease-out;}

    .home-link {display:none}

    #blog-pager-newer-link a:hover, #blog-pager-older-link a:hover{background:#0379c4;color:#fff}
    #blog-pager {
        text-align:center;
    }

    .font-arrow {font-size:28;vertical-align:-11px}

    .feed-links {
        display:none;
    }
    .clear {clear:both}

    /* Profile
    ----------------------------------------------- */
    .profile-img {
        float:left;
        margin-top:0;
        margin-right:5px;
        margin-bottom:5px;
        margin-left:0;
        padding:4px;
        border:1px solid #ccc;
    }

    .profile-data {
        margin:0;
        text-transform:uppercase;
        letter-spacing:.1em;
        font-weight:bold;
        line-height:1.6em;
    }

    .profile-datablock {
        margin:.5em 0 .5em;
    }

    .profile-textblock {
        margin:0.5em 0;
        line-height:1.6em;
    }

    .profile-link {
        text-transform:uppercase;
        letter-spacing:.1em;
    }

    /* Footer
    ----------------------------------------------- */
    #footer-wrapper {
        height:80px;
        width:100%;
        clear:both;
        color:#666;
        text-align:left;
        display:block;
        font-size:14px;
        background-color:#ebebeb;
    }
    #footer {
        max-width:768px;
        margin:0 auto;
        padding:0;
        color:#999;
    }
    #footer a {
        color:#666;
        text-decoration:none;
    }
    #footer a:hover {
        color:#0e72b5;
    }
    img {
        max-width:100%;
        height:auto;
        width:auto;
    }
    .creditpic{margin-top:20px;padding:30px 0 30px;position:relative}
    .credit-wrapper {max-width:768px;margin:0 auto}
    .credit{line-height:1.6em;font-size:12px;font-weight:400;color:#888;clear:both;margin:0 auto;padding:0;text-align:left}
    .credit-right{float:right}
    .credit a,.credit a:visited{color:#666;text-decoration:none}
    .credit a:hover{color:#0379C4;text-decoration:none}
    /* RESPONSIVE */

    @media screen and (max-width:768px) {
        .post {width:46.5%;}
        #header, #content-wrapper, #footer {max-width:728px}
        #header h1 {text-align:center; margin:0 auto;float:none}
        .description {display:none}
        .post {margin-bottom:12px}
        #main-wrapper {margin-top:-200px}
        .search-wrapper{top:0}
    }

    @media screen and (max-width:736px) {
        #header, #content-wrapper, #footer {max-width:690px}
    }

    @media screen and (max-width:667px) {
        #header, #content-wrapper, #footer {max-width:627px}
        .post {height:420px}
    }

    @media screen and (max-width:640px) {
        .post {width:46%;}
        #header, #content-wrapper, #footer {max-width:600px}
        #header h1 {text-align:center; margin:0 auto;float:none}
        .description {display:none}
    }
    @media screen and (max-width:600px) {
        #header, #content-wrapper, #footer {max-width:560px}
        #main-wrapper {margin-top:-215px}
    }
    @media screen and (max-width:568px) {
        #header, #content-wrapper, #footer {max-width:545px}
    }
    @media screen and (max-width:414px) {
        #main-wrapper {width:100%}
        .post {width:99%;box-shadow:none;height:390px}
        #header, #content-wrapper, #footer {max-width:390px}
        #blog-pager-older-link a {margin-right:0}
        .credit-right{float:left}
        .creditpic{padding:25px 0 20px;}
        #main-wrapper {margin-top:-225px}
        #search-box{width:270px}
    }
    @media screen and (max-width:375px) {
        #header, #content-wrapper, #footer {max-width:350px}
        .post {margin-bottom:10px}
    }
    @media screen and (max-width:360px) {
        #header, #content-wrapper, #footer {max-width:340px}
        #main-wrapper {margin-top:-230px}
    }
    @media screen and (max-width:320px) {
        #header, #content-wrapper, #footer {max-width:300px}
        .post-snippet {display:none}
        .post-inner {padding:5px 15px 0}
        .post {height:auto}
    }
    </style>
    <style amp-boilerplate="amp-boilerplate">body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate="amp-boilerplate">body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async="async" src="https://cdn.ampproject.org/v0.js"></script>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "url": "https://earthquake.ph/",
        "name": "Earthquake Philippines",
        "author": {
            "@type": "Person",
            "name": "Ridvan Baluyos"
        },
        "description": "Earthquake Philippines",
        "publisher": "Ridvan Baluyos",
    }
    </script>
    <script async="async" custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
</head>

<body itemscope="itemscope" itemtype="http://schema.org/WebPage">
<button class="btn-amp-sidebar" on="tap:sidebar.toggle" aria-label="Sidebar Menu"></button>
<amp-sidebar id="sidebar" layout="nodisplay" side="left">
    <nav>
        <ul>
            <li><a class="sidebaramp" href="/">Home</a></li>
            <li><a class="sidebaramp" href="/earthquakes" itemprop="url" title="All Earthquakes">All</a></li>
            <li><a class="sidebaramp" href="/earthquake-graphs-charts" itemprop="url" title="Graphs">Graphs</a></li>
            <li><a class="sidebaramp" href="/earthquake-heatmap" itemprop="url" title="Heatmap">Heatmap</a></li>
            <li><a class="sidebaramp" href="/earthquake-safety-and-preparedness" itemprop="url" title="Safety and Preparedness">Safety and Preparedness</a></li>
            <li><a class="sidebaramp" href="/earthquake-101" itemprop="url" title="Heatmap">Earthquake 101</a></li>
            <li><a class="sidebaramp" href="/earthquake-hotlines" itemprop="url" title="Heatmap">Hotlines</a></li>
            <li><a class="sidebaramp" href="/about" itemprop="url" title="Heatmap">About</a></li>
        </ul>
    </nav>
</amp-sidebar>
<header id="header-wrapper" itemprop="mainEntity" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
    <div class="header section" id="header"><div class="widget Header" data-version="1" id="Header1">
            <div id="header-inner">
                <div class="titlewrapper">
                    <h1 class="title">
                        <a href="/" itemprop="url" title="Earthquake Philippines ⚡">
                            <span itemprop="name">
                                <amp-img alt="Logo" height="30" src="https://2.bp.blogspot.com/-Gwr5P8uOy7I/WARCMkUJUgI/AAAAAAAAHvs/wbnz3_FS8qI-RDwV9Gk4Tkk1LUfN0eCngCK4B/s1600/ampicon2.png" title="AMP HTML ⚡" width="30"></amp-img>
                                Earthquake Philippines
                            </span>
                        </a>
                    </h1>
                </div>
                <div class="descriptionwrapper">
                    <p class="description"><span></span></p>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="outer-wrapper">
    @yield("content")
    <footer id="footer-wrapper">
        <div class="footer" id="footer">
            <div class="clear"></div>
            <div class="creditpic">
                <div class="credit-wrapper">
                    <div class="credit">
                        <span itemprop="copyrightYear">&#169; 2017</span>
                        <span itemprop="copyrightHolder" itemscope="itemscope" itemtype="https://schema.org/Organization">
                            <a href="https://earthquake.ph" itemprop="url" title="Earthquake Philippines">
                                <span itemprop="name">earthquake.ph</span>
                            </a> ·
                            <a href="https://earthquake.ph" itemprop="url" title="Earthquake Philippines">
                                <span itemprop="name">source code</span>
                            </a>
                        </span>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </footer>
</div>
</body>
</HTML>