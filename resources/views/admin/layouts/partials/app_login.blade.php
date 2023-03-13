<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('page_title', 'Laravel')
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/bootstrap-submenu.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('/frontend_temp/css/leaflet.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/frontend_temp/css/map.css')}}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/fonts/linearicons/style.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/dropzone.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/slick.css')}}">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/style.css')}}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('/frontend_temp/css/skins/default.css')}}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/ie10-viewport-bug-workaround.css')}}">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <script src="{{ asset('/frontend_temp/js/ie-emulation-modes-warning.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script  src="{{ asset('js/html5shiv.min.js')}}"></script>
        <script  src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="sub-banner overview-bgi">
    <div id="app">

        <!-- Main header start -->
        {{--<header class="main-header header-transparent sticky-header text-center">--}}
        {{--<div class="container">--}}
            {{--<nav class="navbar navbar-expand-lg navbar-light">--}}
                {{--<a class="navbar-brand logo" href="{{url('/')}}" style="color: black; margin-left: 480px;">--}}
                    {{--<img src="{{ asset('img/le-logo.png') }}" alt="Property Management Tool Logo">--}}
                {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                    {{--<span class="navbar-toggler-icon"></span>--}}
                {{--</button>--}}

            {{--</nav>--}}
        {{--</div>--}}
        {{--</header>--}}

        <!-- Main header end -->
        @yield('content')

    </div>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Modal -->
    <script src="{{ asset('/frontend_temp/js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('/frontend_temp/js/popper.min.js') }}"></script>
    <script src="{{ asset('/frontend_temp/js/bootstrap.min.js') }}"></script>

    <script  src="{{ asset('/frontend_temp/js/bootstrap-submenu.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/rangeslider.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.mb.YTPlayer.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/bootstrap-select.min.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.easing.1.3.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.scrollUp.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/leaflet.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/leaflet-providers.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/leaflet.markercluster.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/dropzone.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/slick.min.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.filterizr.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.magnific-popup.min.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/jquery.countdown.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/maps.js') }}"></script>
    <script  src="{{ asset('/frontend_temp/js/app.js') }}"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script  src="{{ asset('/frontend_temp/js/ie10-viewport-bug-workaround.js') }}"></script>
    <!-- Custom javascript -->
    <script  src="{{ asset('/frontend_temp/js/ie10-viewport-bug-workaround.js') }}"></script>
    <script>
        $(document).ready(function () {
            // $('.customInstaIcn').css('color','grey');

            // $(".customInstaIcn").hover(function() {
            //     $(this).css("color","mediumvioletred")
            // }).mouseout(function(){
            //     $(this).css({"color":"grey",});
            // });

        })
        function forgot() {
            $('#cncl').click()
            $('#frgt').click()
        }
    </script>
</body>
</html>
