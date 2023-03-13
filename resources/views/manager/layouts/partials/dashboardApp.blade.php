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
    <link href="{{ asset('/frontend_temp/libraries/bootstrap4-toggle.min.css')}}" rel="stylesheet">
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
{{--    <link rel="stylesheet" type="text/css"  href="{{ asset('frontend_temp/css/dropzone.css')}}/">--}}
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/slick.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/bootstrap-datepicker.css')}}">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/mdb.css') }}">--}}
    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/style.css')}}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('/frontend_temp/css/skins/default.css')}}">
    {{--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/ie10-viewport-bug-workaround.css')}}">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script  src="{{ asset('js/ie8-responsive-file-warning.js')}}"></script><![endif]-->
    <script  src="{{ asset('/frontend_temp/js/ie-emulation-modes-warning.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script  src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script  src="{{ asset('js/respond.min.js') }}"></script>
    <![endif]-->
    <link href="{{asset('frontend_temp/libraries/toastr.min.css')}}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/overlaySidebar.css') }}">
</head>
<body>
    <div id="app">

        <!-- Main header start -->



        <header class="main-header header-2 fixed-header">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light">
        <i id="sideBarBtn" onclick="openNav()" class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
        <a class="navbar-brand logo pad-0" href="{{ url('admin/home')}}"> Property Management Tool </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-buttons ml-auto d-none d-xl-block d-lg-block">
          <ul>

            <li hidden> <a class="btn btn-theme btn-md" href="#">My Account</a> </li>
              <li>
                  <a  class="btn btn-theme btn-md" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>

<style>
    .error{color:red !important;}
    .notification-icon{
        background: red;
        border-radius: 25px;
        padding: 3px;
        color:white;
        border:1px solid black;
    }
</style>
        <!-- Main header end -->
        @yield('css')
        @include('manager.layouts.partials.overlaySidebar')
        @yield('content')

    </div>



</body>
<script type="text/javascript">
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
</script>

<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

<!-- Modal -->

<script src="{{ asset('/frontend_temp/js/jquery-2.2.0.min.js')}}"></script>
<script src="{{ asset('/frontend_temp/js/popper.min.js')}}"></script>
<script src="{{ asset('/frontend_temp/js/bootstrap.min.js')}}"></script>

<script  src="{{ asset('/frontend_temp/js/bootstrap-submenu.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/rangeslider.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.mb.YTPlayer.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/bootstrap-select.min.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.easing.1.3.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.scrollUp.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/leaflet.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/leaflet-providers.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/leaflet.markercluster.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/dropzone.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/slick.min.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.filterizr.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.magnific-popup.min.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.countdown.js')}}"></script>
<script src="{{ asset('js/jquery-input-mask-phone-number.min.js') }}"></script>
<script  src="{{ asset('/frontend_temp/js/maps.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
<script src="{{asset('frontend_temp/libraries/bootstrap4-toggle.min.js')}}"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script  src="{{ asset('/frontend_temp/js/ie10-viewport-bug-workaround.js')}}"></script>
<!-- Custom javascript -->
{{--    <script  src="{{ asset('/frontend_temp/js/ie10-viewport-bug-workaround.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('frontend_temp/libraries/toastr.min.js')}}"></script>
<script src="{{asset('frontend_temp/libraries/sweetalert2@9.js')}}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.validate.min.js') }}"></script>
<script  src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

@yield('javaScript')
@toastr_render

<script>
    function forgot() {
        $('#cncl').click()
        $('#frgt').click()
    }
    $('.datepicker').datepicker({
        clearBtn: true,
        format: "mm/dd/yyyy"
    });
    $('#ref_phone').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    }); $('.contact').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });

</script>


</html>
