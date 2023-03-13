<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon" >

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .heading{
            font-size: 1.125rem;
            color: #4d4d4d;
            margin-top: 15px;
        }
        .card-header{
            background: #376bff;
            color:white;
        }
        .btn-primary{
            background: #376bff;
            color:white;
        }
    </style>
</head>
<body>
    <div id="app">
        <center>
            <a class="navbar-brand heading" href="{{ url('/') }}">
               {{ config('app.name', 'Laravel') }}
            </a>
        </center>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
