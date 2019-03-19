<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="{{ asset('front/images/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <!-- Plugin-CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('front/css/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('front/css/themify-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('front/css/magnific-popup.css') }}" rel="stylesheet">

    <link href="{{ asset('front/css/animate.css') }}" rel="stylesheet">

    <!-- Main-Stylesheets -->
    <link href="{{ asset('front/css/normalize.css') }}" rel="stylesheet">

    <link href="{{ asset('front/style.css') }}" rel="stylesheet">

    <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">

    <script src="{{ asset('front/js/vendor/modernizr-2.8.3.min.js') }}" rel="stylesheet"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1503393679796720',
                cookie     : true,  // enable cookies to allow the server to access the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v3.2' // use graph api version 2.8
            });
        };
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        console.log('after title')
    </script>
    <div id="app">
        @yield('content')
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2&appId=1503393679796720&autoLogAppEvents=1"></script>
    <script>

    </script>
    <!--Vendor-JS-->
    <script src="{{ asset('front/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('front/js/vendor/bootstrap.min.js') }}"></script>
    <!--Plugin-JS-->
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/contact-form.js') }}"></script>
    <script src="{{ asset('front/js/jquery.parallax-1.1.3.js') }}"></script>
    <script src="{{ asset('front/js/scrollUp.min.js') }}"></script>
    <script src="{{ asset('front/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/wow.min.js') }}"></script>
    <!--Main-active-JS-->
    <script src="{{ asset('front/js/main.js') }}"></script>
</body>
</html>
