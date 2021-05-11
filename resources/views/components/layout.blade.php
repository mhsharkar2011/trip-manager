<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths skrollr skrollr-desktop" style=""><!--<![endif]--><head>
    <meta charset="utf-8">
<title>TeamSlice Inc. - A Product Development Company based out of Toronto</title>
<meta name="description" content="13 years of experience developing mobile applications, web applications from ideation to implementation.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="css/flexslider.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/line-icons.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/elegant-icons.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/theme.css" rel="stylesheet" type="text/css" media="all">
<link href="css/custom.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
<!--[if gte IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie9.css" />
<![endif]-->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700" rel="stylesheet" type="text/css">
<script type="text/javascript" id="www-widgetapi-script" src="//www.youtube.com/s/player/838cc154/www-widgetapi.vflset/www-widgetapi.js" async=""></script><script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<link href="//fonts.googleapis.com/css?family=Titillium+Web:300,300italic" rel="stylesheet" type="text/css">
<link href="css/font-titillium.css" rel="stylesheet" type="text/css">

<!--TeamSlice-->
<link href="teamslice-theme.css" rel="stylesheet" type="text/css" media="all">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.plugin.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
    #img-iframe-container{
            display:none;
            color:#F25022;
            background-color:#EFEFEF;
            border:2px solid #00A4EF;
            text-align:justify;
            position: fixed;
            top: 30%;
            right: 0;
            z-index: 20;
        }
</style>
</head>

<body>
    <div>
    @if(auth()->check())
        <div style="background-color: #ebebeb; padding: 5px 5px; text-align: right; position:sticky; top: 0; z-index: 100">
            <button id="publish_all_btn" style="display: none" class="btn btn--light">Publish all</button>
            <a style="display: inline-block;padding: 3px 3px;background-color: #000;color: #fff;text-decoration:none"
                href="{{ get_route_from_uri(request()->route()->uri) }}">
                EDIT TEMPLATE
            </a>
        </div>
    @endif
    <script>
        var AuthUser = "{{{ (auth()->check()) ? auth()->check() : null }}}";
    </script>
    <div class="loader" style="opacity: 0; display: none;">
        <div class="spinner">
          <div class="double-bounce1"></div>
          <div class="double-bounce2"></div>
        </div>
    </div>
            
    <div class="nav-container">
<nav class="fullscreen-nav top-bar overlay-bar">

    <div class="top-menu-container">
        <div class="row">
            <div class="col-sm-12">
                <a href="/">
                    <img alt="logo" class="outer-logo" src="img/teamslice-logo-teal.svg">
                </a>
            </div>
        </div>
    </div>	

    <div class="fullscreen-nav-toggle">
        <i class="icon icon_menu"></i>
        <i class="icon icon_close"></i>
    </div>
    
    <div class="fullscreen-nav-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="/">
                        <img class="logo logo-wide" alt="Logo" src="img/teamslice-logo-white.svg">
                    </a>
                    <ul class="menu">
                        <li><a href="/">Home</a></li>
                        <li><a href="/development">Development Services</a></li>
                        <li><a href="/incubator">Incubator</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>	
</nav>
</div>
    
    <div class="main-container">
        {{ $slot }}
    </div>
    
    <div class="footer-container">
<footer class="details">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img alt="TeamSlice" class="logo" src="img/teamslice-logo-white.svg">
                <p>Want to get our rates and how we work? Feel free to send an email with your project needs. Let us hear out your goal, let's make it happen, together!</p>
            </div>
            
            <div class="col-sm-3">
                <h1>Contact</h1>
                <p>contact@teamslice.ca<br>+1 416 473 9284<br>&nbsp;<br>
                    500 King St. W.<br>
                    Toronto, Canada</p>
            </div>
            <div class="col-sm-5">
                <h1>Map</h1>
                <iframe frameborder="0" style="width:100%;height:300px" src="//www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60623.30386234685!2d-79.41831974165828!3d43.63958456377794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34d951b167f3%3A0xb9b98e2c3ba7a24d!2s500%20King%20St%20W%2C%20Toronto%2C%20ON%20M5V%201L8!5e0!3m2!1sen!2sca!4v1619704984139!5m2!1sen!2sca"></iframe>
            </div>
            
            <!--div class="col-sm-4">
                <h1>Social Profiles</h1>
                <ul class="social-icons">
                    <li>
                        <a href="#">
                            <i class="icon social_twitter"></i>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="icon social_facebook"></i>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="icon social_instagram"></i>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="icon social_dribbble"></i>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="icon social_tumblr"></i>
                        </a>
                    </li>
                    
                    <li>
                        <a href="#">
                            <i class="icon social_pinterest"></i>
                        </a>
                    </li>
                </ul>
            </div-->
        </div>
        @include('livecms.img-iframe-container')
        
        <div class="row">
            <div class="col-sm-12">
                <span class="sub">© Copyright 2021&nbsp;<a href="/">TeamSlice</a>&nbsp;- All Rights Reserved</span>
            </div>
        </div>
        
    </div>
</footer>
</div>
    <script src="//www.youtube.com/iframe_api"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/skrollr.min.js"></script>
    <script src="js/spectragram.min.js"></script>
    <script src="js/scrollReveal.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/twitterFetcher_v10_min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="teamslice.js"></script>

</div>
</body>
</html>