<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', 'Laravel')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/bootstrap-submenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('/frontend_temp/css/leaflet.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/frontend_temp/css/map.css')}}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/fonts/linearicons/style.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/dropzone.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/frontend_temp/css/slick.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('/css/tagsinput.css') }}">
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/bootstrap-datepicker.css')}}">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/style.css')}}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('/frontend_temp/css/skins/default.css')}}">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon" >
    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/ie10-viewport-bug-workaround.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/frontend_temp/css/overlaySidebar.css') }}">
    {{--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">--}}

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>

    <script  src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <script  src="{{ asset('/frontend_temp/js/ie-emulation-modes-warning.js') }}"></script>

    {{-- TODO: For Future User --}}
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script  src="js/html5shiv.min.js"></script>
    <script  src="js/respond.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert/dist/sweetalert.css">--}}
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    {{-- TODO: For Future User --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>--}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    {{-- TODO: For Future User --}}
    {{--<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>--}}
    <style type="text/css">
        .pointer{
            cursor: pointer;
        }
        .notification-icon{
            background: red;
            border-radius: 25px;
            padding: 3px;
            color:white;
            border:1px solid black;
        }
        .actionButtonCell{
            white-space: nowrap;
        }
    </style>
    <script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=e9379c06a5f59' async='true'></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155070813-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-155070813-2');
    </script>
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    
</head>
<body>

<div class="page_loader"></div>
    @include('web.layouts.partials.header')
    @include('web.layouts.partials.overlaySidebar')
    @yield('css')
    @yield('content')
    @include('web.layouts.partials.footer')

</body>

{{--<script src="{{ asset('/frontend_temp/js/jquery-2.2.0.min.js') }}"></script>--}}
@jquery
@toastr_js
<!-- Modal -->

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
<script  src="{{ asset('/frontend_temp/js/front-app.js') }}"></script>
<script  src="{{ asset('/frontend_temp/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!-- Custom javascript -->
<script src="{{ asset('js/creditcard.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/jquery-input-mask-phone-number.min.js') }}"></script>
<script src="{{ asset('js/jquery.creditCardValidator.js') }}"></script>
<script src="{{ asset('js/tagsinput.js') }}"></script>
<script  src="{{ asset('/frontend_temp/js/ie10-viewport-bug-workaround.js') }}"></script>
<script  src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
</script>
<script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=e9379c06a5f59' async='true'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@yield('script')
@toastr_render
<script>
    function forgot() {
        $('#cncl').click()
        $('#frgt').click()
    }

    $('#profile_phone').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });
    $('.contact').usPhoneFormat({
        format: '(xxx) xxx-xxxx',
    });
</script>
@if (Auth::guest())

    <script>
        {{--'{{env('FACEBOOK_ID')}}',--}}
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '230549744795507',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v3.0'
            });
        };

        (function(d, s, id) {                      // Load the SDK asynchronously
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>


<script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion_async.js" charset="utf-8"></script>
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>
        var clientId = '352677919392-fmik4a26dv71j15of1ep6unbftvgrfu2.apps.googleusercontent.com';
        {{--"{{env('GOOGLE_CLIENT_ID')}}";--}}

        var apiKey = '4TsOOuBXq3RVQ7AXmg1khXJ3';
                {{--"{{env('GOOGLE_CLIENT_SECRET')}}";--}}

        var scopes = 'https://www.googleapis.com/auth/userinfo.email';
var socialEmail='';
var socialName='';
        function handleClientLoad() {
            gapi.client.setApiKey(apiKey);
            window.setTimeout(checkAuth,1);
        }
        function fblogin() {

            FB.login(function (response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', {locale:'en_US',fields:'id,name,first_name,last_name,email'},
                        function (response) {
                        console.log('Good to see you, ' + response.name + '.');
                        console.log(response);
                        $.ajax({
                            method:'post',
                            url:"{{'/facebookStore'}}",
                            data:{
                                email:response.email,
                                id:response.id,
                                first_name:response.first_name,
                                last_name:response.last_name,
                                name:response.first_name +' '+response.last_name,
                                _token:$('#login-token').val(),
                            },
                            success:function (result) {
                                if(result.status=='web_register'){
                                window.location.href=result.redirect;
                            }else if(result.status=='different_source'){
                                    toastr.error(result.message, 'Error', {timeOut: 5000});return false;
                                }else if(result.status=='social_account_created'){
                                    // window.location.href=result.redirect;
                                    $('#Login').modal('hide');
                                    $('#stripePayment').modal('show');
                                    socialEmail=result.user.email;
                                    socialName=result.user.name;
                                    stripeHandleResponse();
                                }else if(result.status=='social_login'){
                                    window.location.href=result.redirect;
                                }

                            }
                        })

                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });
        };
        function handleAuthClick(event) {
            btn = $('.google-connect');
            btn.attr('disabled','disabled');
            btn.find('i').remove();
            btn.append('<i class="fa fa-spinner fa-sm fa-1x fa-spin custom-spin"></i>');
            gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
            return false;
        };
        function handleAuthResult(authResult) {
            if (authResult && !authResult.error)
            {
                var tkn=$('#login-token').val();
                $.ajax({
                    url: '/googleStore',
                    data: {'token': authResult.access_token},
                    headers: { 'X-XSRF-TOKEN' : tkn},
                    error: function() {

                    },
                    success: function(response) {
                        removeSpinner = false;
                        if(!response.success)
                        {
                            server_messages_container = $('.server_messages_container_login');
                            server_messages_container.html('<div class="well">'+ response.message +'</div>');
                            server_messages_container.show();
                            setTimeout(function(){
                                server_messages_container.hide('slow');
                            },5000);
                            removeSpinner = true;
                        }
                        else
                        {
                            if(!response.redirect){
                                $('#r_top_bar').html(response.view);
                                $('#content-modal').modal('hide');
                                removeSpinner = true;
                            }else{
                                window.location.href=response.path;
                                removeSpinner = false;
                            }
                        }
                        if(removeSpinner){
                            btn = $('.google-connect');
                            btn.find('i').remove();
                            btn.removeAttr('disabled');
                        }
                    },
                    type: 'POST'
                });
            } else {

            }
        }
       function handleAuthClickGoogle(event) {
            btn = $('.js_google-connect');
            btn.attr('disabled','disabled');
            btn.find('i').remove();
            btn.append('<i class="fa fa-spinner fa-sm fa-1x fa-spin custom-spin"></i>');
            gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResultGoogle);
            return false;
        }
        function handleAuthResultGoogle(authResult) {
            if (authResult && !authResult.error) {
                var tkn=$('#login-token').val();
                $.ajax({
                    method:'post',
                    url:"{{'/googleStore'}}",
                    data:{
                        token: authResult.access_token,
                        _token:$('#login-token').val(),
                    },
                    success:function (result) {
                        if(result.status=='web_register'){
                            window.location.href=result.redirect;
                        }else if(result.status=='different_source'){
                            toastr.error(result.message, 'Error', {timeOut: 5000});return false;
                        }else if(result.status=='social_account_created'){
                            // window.location.href=result.redirect;
                            $('#Login').modal('hide');
                            $('#stripePayment').modal('show');
                            socialEmail=result.user.email;
                            socialName=result.user.name;
                            stripeHandleResponse();
                        }else if(result.status=='social_login'){
                            window.location.href=result.redirect;
                        }

                    }
                })
            } else {

            }
        }
        function  stripeHandleResponse() {
            var stripePublishKey = '{{Config::get('constants.STRIPE_KEY')}}';
            var stripe = Stripe(stripePublishKey);
            // Create an instance of Elements.
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});
            // card.unmount('#card-element');
            card.mount('#paymentCardElements');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function (event) {
                if (event.error) {
                    $('.card-errors').html(event.error.message);
                } else {
                    $('.card-errors').html('');
                }
            });
            // Handle form submission.

            var getStartedForm = document.getElementById('paymentForm');

            getStartedForm.addEventListener('submit', function (event) {
                event.preventDefault();
                var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                var stripePlan= $('input[name=stripe-plan]:checked').val();
                //create key for laravel cashier for payment and subscription purpose
                stripe.createPaymentMethod(
                    'card', card, {
                        billing_details: {
                            name: socialName,
                            email: socialEmail//started_email,
                            // phone: started_phone
                        }
                    }
                )
                    .then(function (result) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': "{{csrf_token()}}"
                            }
                        });
                        $.ajax({
                            //loader in button
                            beforeSend: function () {
                                $('.stripePayment').html(loading + ' Processing').attr('disabled', 'disabled');
                            },
                            url: "{{ url('socialStripeStore') }}",
                            dataType: 'json',
                            data: {
                                'email': socialEmail,
                                'brand': result.paymentMethod.card.brand,
                                'plan': stripePlan,
                                'last_four_digit': result.paymentMethod.card.last4,
                                'stripeToken': result.paymentMethod.id
                            },
                            error: function (error) {
                                $('.stripePayment').html('GET STARTED').removeAttr('disabled');
                                toastr.error(error.message, 'Error', {timeOut: 5000});
                            },
                            success: function (data) {
                                if (data.status == true) {
                                    // window.location.reload();
                                    // swal("Done!", "You Are Registered!", "success");
                                    // swal("Done!", data.message, "success");

                                    $('#stripePayment').modal('hide');

                                    window.location.href=data.redirect;

                                } else if (data.status == false) {
                                    toastr.error(data.message, 'Error', {timeOut: 5000});
                                    $('.stripePayment').html('GET STARTED').removeAttr('disabled');

                                } else if (data.stripeStatus == false) {
                                    toastr.error(data.message, 'Error', {timeOut: 5000});
                                    $('.stripePayment').html('GET STARTED').removeAttr('disabled');

                                } else {
                                    $.each(data.error, function (k, v) {
                                        toastr.error(v, 'Error', {timeOut: 5000})
                                    });
                                    $('.stripePayment').html('GET STARTED').removeAttr('disabled');
                                }
                            },
                            type: 'POST'
                        });
                    });
            })
        }
    /* =========================================================================================
     Description: Method for header get started
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

        $(".stripeSocialPopup").hide();
        $(".zeroPriceSocialPopup").hide();
        $("input[type=radio][name=stripe-plan]").on('change', function() {
            let price =$(this).attr('data-price');
            if(price == 0){
                $(".stripeSocialPopup").hide();
                $(".zeroPriceSocialPopup").show();

            }else{
                $(".stripeSocialPopup").show();
                $(".zeroPriceSocialPopup").hide();

            }
        });

        $('.zero-social-price-form').click(function () {
            var plan = $('input[name=stripe-plan]:checked').val();
            var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                beforeSend: function () {
                    $('.zero-social-price-form').html(loading + ' Processing').attr('disabled', 'disabled');
                },
                url: "{{ url('zeroPricePlanSocialLogin') }}",
                dataType: 'json',
                data: {
                    'email': socialEmail,
                    'plan': plan
                },
                error: function (error) {
                    $('.zero-social-price-form').html('Submit').removeAttr('disabled');
                    alert('Something went wrong. Please try again later.');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#stripePayment').modal('hide');
                        window.location.href=data.redirect;

                    } else {
                        $('.zero-social-price-form').html('Submit').removeAttr('disabled');
                        $.each(data.error, function (k, v) {
                            toastr.error(v,'Error', {timeOut: 5000})
                        });
                        return false;
                    }
                },
                type: 'POST'
            });

        })




</script>
    @endif
<script>

                $(document).ready(function () {

                    $('.owl-carousel').owlCarousel({
                        loop: false,
                        items: 2,
                        margin: 10,
                        nav: false,
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 2,
//                                nav: true
                            },
                            600: {
                                items: 2,
                                nav: false
                            }
//                            1000: {
//                                items: 2,
//                                nav: true,
//                                loop: false,
//                                margin: 20
//                            }
                        }
                    })


                  $(".get-stripe-form").hide();
                    $(".zeroPrice").hide();
                    $("select[name='plan']").on('change', function() {
                        var option = $('option:selected', this).attr('data-price');

                        if(option == 0){
                            $(".get-stripe-form").hide();
                            $(".zeroPrice").show();

                        }else{
                            $(".get-stripe-form").show();
                            $(".zeroPrice").hide();

                        }
                    });
                });



                  $("form[name='getLogin']").on('submit',function(e){
                        e.preventDefault();
                    });

                    $("form[name='getLogin']").validate({
                        // Specify validation rules
                        rules: {
                            // The key name on the left side is the name attribute
                            // of an input field. Validation rules are defined
                            // on the right side
                            email: {
                                required: true,
                                // Specify that email should be validated
                                // by the built-in "email" rule
                                email: true
                            },
                            password: {
                                required: true,
                                minlength: 5
                            }
                        },
                        // Specify validation error messages
                        messages: {
                            password: {
                                required: "Please Enter password",
                                minlength: "Your password must be at least 8 characters long"
                            },
                            email: {
                                required: "Please enter an valid email address",
                                email: "Please enter a email address"
                            }
//                }
                        },
                        // Make sure the form is submitted to the destination defined
                        // in the "action" attribute of the form when valid
                        submitHandler: function (form) {
                            var formData = $("form[name='getLogin']").serialize();
                            var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': "{{csrf_token()}}",//$('meta[name="_token"]').attr('content')
                                }
                            });
                            $.ajax({
                                beforeSend: function () {
                                    $('#saveLogin').html(loading + ' Processing').attr('disabled', 'disabled');
                                },
                                type: 'POST',
                                url: "{{ url('webLoginPost') }}",
                                data: formData,
                                success: function (data) {
                                    if (data.status == true) {
                                        $("#Login2").modal("hide");
                                        toastr.success(data.message, {timeOut: 5000});
                                        {{-- location.href = "{{ url('current-venture-listings')}}"; --}}
                                        location.href = "{{ url('/')}}";

                                    } else {
                                        $('#saveLogin').html('Login').removeAttr('disabled');
                                        toastr.error(data.error);
                                        return false;
                                    }
                                },
                                error: function () {
                                    $('#saveLogin').html('Login').removeAttr('disabled');

                                }
                            });
                        }
                    });



  /* =========================================================================================
       Description: Method for header get started
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

                    $(".get-stripe-form").hide();
                    $(".zeroPrice").hide();

                    $("select[name='plan']").on('change', function() {
                        var option = $('option:selected', this).attr('data-price');

                        if(option == 0){
                            $(".get-stripe-form").hide();
                            $(".zeroPrice").show();

                        }else{
                            $(".get-stripe-form").show();
                            $(".zeroPrice").hide();

                        }
                    });


  /* =========================================================================================
       Description: Method for header get started click on join now and select zero plan
       here is a button and button save functionality is below
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

 $('.zero-price-form').click(function () {
                        var first_name = $('#part1 input[name="first_name"]').val();
                        var last_name = $('#part2 input[name="last_name"]').val();
                        var about_us_source = $('#part3 select').val();
                        var email = $('#part4 input').val();
                        var password = $('#part5 input').val();
                        var phone = $('#part6 input[name="phone"]').val();
                        var plan = $('select[name="plan"]').val();
                        var manage_income_property = $('#part7 input[name="manage_income_property"]').val();
                        var interest = $('#part8 input[name="interest"]').val();
                        var contact_timing = $("#part9 select[name=contact_timing]").val();
                        var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': "{{csrf_token()}}"
                            }
                        });
                        $.ajax({
                            beforeSend: function () {
                                $('.zero-price-form').html(loading + ' Processing').attr('disabled', 'disabled');
                            },
                            url: "{{ url('zeroPlanPrice') }}",
                            dataType: 'json',
                            data: {
                                'email': email,
                                'plan': plan,
                                'first_name': first_name,
                                'last_name': last_name,
                                'phone': phone,
                                'about_us_source': about_us_source,
                                'password': password,
                                'manage_income_property': manage_income_property,
                                'interest': interest,
                                'contact_timing': contact_timing
                            },
                            error: function (error) {
                                $('.zero-price-form').html('Submit').removeAttr('disabled');
                                alert('Something went wrong. Please try again later.');
                            },
                            success: function (data) {
                                if (data.status == true) {
                                    $("#Login2").html("#part1");
                                    $("#Login2").modal("hide");

                                    handleResponse(data.message);
                                } else {
                                    $('.zero-price-form').html('Submit').removeAttr('disabled');
                                    $.each(data.error, function (k, v) {
                                        toastr.error(v,'Error', {timeOut: 5000})
                                    });
                                    return false;
                                }
                            },
                            type: 'POST'
                        });

                    });




  /* =========================================================================================
       Description: Method for header get started contact me first button
       ----------------------------------------------------------------------------------------
       ========================================================================================== */
   $('#contact_me_first').click(function (e) {
                        e.preventDefault();
                        var btn = $(this);
                        var first_name = $('#part1 input[name="first_name"]').val();
                        var last_name = $('#part2 input[name="last_name"]').val();
                        var about_us_source = $('#part3 select').val();
                        var email = $('#part4 input').val();
                        var password = $('#part5 input').val();
                        var phone = $('#part6 input[name="phone"]').val();
                        var manage_income_property = $('#part7 input[name="manage_income_property"]').val();
                        var interest = $('#part8 input[name="interest"]').val();
                        var contact_timing = $("#part9 select[name=contact_timing]").val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': "{{csrf_token()}}",
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('storeMember') }}",
                            data: {
                                'email': email,
                                'first_name': first_name,
                                'last_name': last_name,
                                'phone': phone,
                                'about_us_source': about_us_source,
                                'password': password,
                                'manage_income_property': manage_income_property,
                                'interest': interest,
                                'contact_timing': contact_timing
                            },
                            success: function (data) {
                                if (data.status == true) {
                                    $("#Login2").html("#part1");
                                    $("#Login2").modal("hide");
                                    handleResponse(data.message);
                                } else {
                                    $.each(data.error, function (k, v) {
                                        toastr.error(v, 'Error', {timeOut: 5000})
                                    });
                                    return false;
                                }
                            },
                        });
                    });

 /* =========================================================================================
       Description: Method for header get started Validations
       ----------------------------------------------------------------------------------------
       ========================================================================================== */

     $("#first_name").on("keypress", function (event) {
                        // Disallow anything not matching the regex pattern (A to Z uppercase, a to z lowercase and white space)
                        // For more on JavaScript Regular Expressions, look here: https://developer.mozilla.org/en-US/docs/JavaScript/Guide/Regular_Expressions
                        var englishAlphabetAndWhiteSpace = /[A-Za-z ]/g;

                        // Retrieving the key from the char code passed in event.which
                        // For more info on even.which, look here: http://stackoverflow.com/q/3050984/114029
                        var key = String.fromCharCode(event.which);

                        //alert(event.keyCode);

                        // For the keyCodes, look here: http://stackoverflow.com/a/3781360/114029
                        // keyCode == 8  is backspace
                        // keyCode == 37 is left arrow
                        // keyCode == 39 is right arrow
                        // englishAlphabetAndWhiteSpace.test(key) does the matching, that is, test the key just typed against the regex pattern
                        if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
                            return true;
                        }

                        // If we got this far, just return false because a disallowed key was typed.
                        return false;
                    });

                    $('#first_name').on("paste", function (e) {
                        e.preventDefault();
                    });
                    $("#last_name").on("keypress", function (event) {

                        // Disallow anything not matching the regex pattern (A to Z uppercase, a to z lowercase and white space)
                        // For more on JavaScript Regular Expressions, look here: https://developer.mozilla.org/en-US/docs/JavaScript/Guide/Regular_Expressions
                        var englishAlphabetAndWhiteSpace = /[A-Za-z ]/g;

                        // Retrieving the key from the char code passed in event.which
                        // For more info on even.which, look here: http://stackoverflow.com/q/3050984/114029
                        var key = String.fromCharCode(event.which);

                        //alert(event.keyCode);

                        // For the keyCodes, look here: http://stackoverflow.com/a/3781360/114029
                        // keyCode == 8  is backspace
                        // keyCode == 37 is left arrow
                        // keyCode == 39 is right arrow
                        // englishAlphabetAndWhiteSpace.test(key) does the matching, that is, test the key just typed against the regex pattern
                        if (event.keyCode == 8 || event.keyCode == 37 || event.keyCode == 39 || englishAlphabetAndWhiteSpace.test(key)) {
                            return true;
                        }

                        // If we got this far, just return false because a disallowed key was typed.
                        return false;
                    });

                    $('#last_name').on("paste", function (e) {
                        e.preventDefault();
                    });

                    $('#phone_number').usPhoneFormat({
                        format: '(xxx) xxx-xxxx',
                    });
                    $('#phone').usPhoneFormat({
                        format: '(xxx) xxx-xxxx',
                    });
                    $("#phone_number").bind("keypress", function (e) {
                        var keyCode = e.which ? e.which : e.keyCode

                        if (!(keyCode >= 48 && keyCode <= 57)) {
                            $(".error").css("display", "inline");
                            return false;
                        } else {
                            $(".error").css("display", "none");
                        }
                    });

                    $("#phone").bind("keypress", function (e) {
                        var keyCode = e.which ? e.which : e.keyCode

                        if (!(keyCode >= 48 && keyCode <= 57)) {
                            $(".error").css("display", "inline");
                            return false;
                        } else {
                            $(".error").css("display", "none");
                        }
                    });

                    $('#step2').click(function (e) {
                        e.preventDefault();
                        if ($(this).is(":checked")) {
//        console.log('true')
                            var data = $('#part1 input').val();
                            if (data == '') {
                                toastr.error("Please Enter First Name");
                                $("#step2:checked ~ #part1").css({"opacity": "1", "height": "auto", "display": "block"});
                                $("#step2:checked ~ #part2").css({"opacity": "0", "height": "0", "display": "none"});
                            } else if (data.match('[a-zA-Z]')) {
                                $("#step2:checked ~ #part1").css({"opacity": "0", "height": "0", "display": "none"});
                                $("#step2:checked ~ #part2").css({"opacity": "1", "height": "auto", "display": "block"});
                            } else {
                                toastr.error("Please Enter Only Alphabets");
                                $("#step2:checked ~ #part1").css({"opacity": "1", "height": "auto", "display": "block"});
                                $("#step2:checked ~ #part2").css({"opacity": "0", "height": "0", "display": "none"});

                            }
                        } else {
                            console.log('false');

                        }

                    });

                    $('#back-step2').click(function (e) {
                        e.preventDefault();
                        var data = $(this).val();
//        console.log(data);
                        $("#part1").css({"opacity": "1", "height": "auto", "display": "block"});
                        $("#part2").css({"opacity": "0", "height": "0", "display": "none"});

                    });


                    $('#step3').click(function (e) {
                        e.preventDefault();
//        console.log('here');
                        if ($(this).is(":checked")) {
//        console.log('true')
                            var data = $('#part2 input').val();
                            if (data == '') {
                                toastr.error("Please Enter Last Name ");
                                $("#step3:checked ~ #part2").css({"opacity": "1", "height": "auto"});
                                $("#step3:checked ~ #part3").css({"opacity": "0", "height": "0"});
                            } else if (data.match('[a-zA-Z]')) {
                                $("#step3:checked ~ #part2").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step3:checked ~ #part3").css({"opacity": "1", "height": "auto", "display": "block"});
                            } else {
                                toastr.error("Please Enter Only Alphabets ");
                                $("#step3:checked ~ #part2").css({"opacity": "1", "height": "auto"});
                                $("#step3:checked ~ #part3").css({"opacity": "0", "height": "0"});

                            }
                        } else {
                            console.log('false');

                        }

                    });
                    $('#back-step3').click(function (e) {
                        e.preventDefault();

                        $("#part2").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part3").css({"opacity": "0", "height": "0", "display": "none"});

                    });
                    $('#step4').click(function (e) {
                        e.preventDefault();
//        console.log('here');
                        if ($(this).is(":checked")) {
//        console.log('true');
                            var data = $('#part3 select').val();
//        console.log(data);
                            if (data == '') {
                                toastr.error("Please Select Option ");
                                $("#step4:checked ~ #part3").css({"opacity": "1", "height": "auto"});
                                $("#step4:checked ~ #part4").css({"opacity": "0", "height": "0"});
                            } else {
                                $("#step4:checked ~ #part3").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step4:checked ~ #part4").css({"opacity": "1", "height": "auto", "display": "block"});

                            }
                        } else {
                            console.log('false');

                        }

                    });

                    $('#back-step4').click(function (e) {
                        e.preventDefault();

                        $("#part3").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part4").css({"opacity": "0", "height": "0", "display": "none"});
                    });

                    $('#step5').click(function (e) {
                        e.preventDefault();
//        console.log('here');
                        if ($(this).is(":checked")) {
                            console.log('true');
                            var data = $('#part4 input').val();
//        console.log(data);
                            if (data == '') {
                                toastr.error("Please Enter Email Address");
                                $("#step5:checked ~ #part4").css({"opacity": "1", "height": "auto"});
                                $("#step5:checked ~ #part5 ").css({"opacity": "0", "height": "0"});
                            } else if (data.match('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$')) {
                                $("#step5:checked ~ #part4").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step5:checked ~ #part5 ").css({"opacity": "1", "height": "auto", "display": "block"});
                            } else {
                                toastr.error("Please Enter Valid Email Address");
                                $("#step5:checked ~ #part4").css({"opacity": "1", "height": "auto"});
                                $("#step5:checked ~ #part5 ").css({"opacity": "0", "height": "0"});

                            }
                        } else {
                            console.log('false');

                        }

                    });
                    $('#back-step5').click(function (e) {
                        e.preventDefault();

                        $("#part4").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part5").css({"opacity": "0", "height": "0", "display": "none"});
                    });
                    $('#step6').click(function (e) {
                        e.preventDefault();
//        console.log('here');
                        if ($(this).is(":checked")) {
//        console.log('true');
                            var data = $('#part5 input').val();
//        console.log(data);

//        if (data == ''){
//        toastr.error("Please Enter Mobile Number");
//        $("#step6:checked ~ #part5").css({"opacity": "1","height": "auto"});
//        $("#step6:checked ~ #part6 ").css({"opacity": "0","height": "0"});
//        //                    }else if (!$.isNumeric(data)){
//        }else if (data.match('^([0-9]*\,?[0-9]+|[0-9]+\,?[0-9]*)?$')){
//
//        $("#step6:checked ~ #part5").css({"opacity": "0","height": "0", "width": "none"});
//        $("#step6:checked ~ #part6 ").css({"opacity": "1","height": "auto","display": "block"});
//        } else{
//        toastr.error("Please Enter valid Mobile Number");
//        $("#step6:checked ~ #part5").css({"opacity": "1","height": "auto"});
//        $("#step6:checked ~ #part6 ").css({"opacity": "0","height": "0"});
//
//        }
//        }else{
//        console.log('false');
//
//        }
                            if (data == '') {
                                toastr.error("Please Enter Password");
                                $("#step6:checked ~ #part5").css({"opacity": "1", "height": "auto"});
                                $("#step6:checked ~ #part6 ").css({"opacity": "0", "height": "0"});

                            } else {

                                $("#step6:checked ~ #part5").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step6:checked ~ #part6 ").css({"opacity": "1", "height": "auto", "display": "block"});
                            }
                        } else {
                            console.log('false');
                        }

                    });

                    $('#back-step6').click(function (e) {
                        e.preventDefault();

                        $("#part5").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part6").css({"opacity": "0", "height": "0", "display": "none"});

                    });

                    $('#step7').click(function (e) {
                        e.preventDefault();
                        console.log('here');
                        if ($(this).is(":checked")) {
                            console.log('true');
                            var data = $('#part6 input').val();
                            console.log(data);

                            if (data == '') {
                                toastr.error("Please Enter Mobile Number");
                                $("#step7:checked ~ #part6").css({"opacity": "1", "height": "auto"});
                                $("#step7:checked ~ #part7").css({"opacity": "0", "height": "0"});
                                //                    }else if (!$.isNumeric(data)){
                            }
//        else if (data.match('^([0-9]*\,?[0-9]+|[0-9]+\,?[0-9]*)?$')){
//
//            $("#step7:checked ~ #part6").css({"opacity": "0","height": "0", "width": "none"});
//            $("#step7:checked ~ #part7").css({"opacity": "1","height": "auto","display": "block"});
//        }
                            else {
//        toastr.error("Please Enter valid Mobile Number");
//
//            $("#step7:checked ~ #part6").css({"opacity": "1","height": "auto"});
//            $("#step7:checked ~ #part7").css({"opacity": "0","height": "0"});
                                $("#step7:checked ~ #part6").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step7:checked ~ #part7").css({"opacity": "1", "height": "auto", "display": "block"});
                            }
                        } else {
                            console.log('false');

                        }


                    });
                    $('#back-step7').click(function (e) {
                        e.preventDefault();

                        $("#part6").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part7").css({"opacity": "0", "height": "0", "display": "none"});

                    });

                    $('#step8').click(function (e) {
                        e.preventDefault();
//        console.log('here');

                        if ($(this).is(":checked")) {
//        console.log('true');
                            var data = $("#part7 input[name='manage_income_property']:checked").val();
//        console.log(data);
                            if (data == undefined || data == '') {
                                toastr.error("Please Select Option");
                                $("#step8:checked ~ #part7").css({"opacity": "1", "height": "auto"});
                                $("#step8:checked ~ #part8").css({"opacity": "0", "height": "0"});
                            } else {
                                $("#step8:checked ~ #part7").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step8:checked ~ #part8").css({"opacity": "1", "height": "auto", "display": "block"});

                            }
                        } else {
                            console.log('false');

                        }


                    });
                    $('#back-step8').click(function (e) {
                        e.preventDefault();

                        $("#part7").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part8").css({"opacity": "0", "height": "0", "display": "none"});

                    });

                    $('#step9').click(function (e) {
                        e.preventDefault();
//        console.log('here');
                        if ($(this).is(":checked")) {
//        console.log('true');
                            var data = $("#part8 input").val();
//        console.log(data);
                            if (data == undefined || data == '') {
                                toastr.error("Please Enter Interest");
                                $("#step9:checked ~ #part8").css({"opacity": "1", "height": "auto"});
                                $("#step9:checked ~ #part9").css({"opacity": "0", "height": "0"});
                            } else {
                                $("#step9:checked ~ #part8").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step9:checked ~ #part9").css({"opacity": "1", "height": "auto", "display": "block"});

                            }
                        } else {
                            console.log('false');

                        }

                    });
                    $('#back-step9').click(function (e) {
                        e.preventDefault();

                        $("#part8").css({"opacity": "1", "height": "auto", "width": "none"});
                        $("#part9").css({"opacity": "0", "height": "0", "display": "none"});

                    });
                    $('#step10').click(function (e) {
                        e.preventDefault();
//            console.log('here');


                        if ($(this).is(":checked")) {
//        console.log('true');
                            var data = $("#part9 select").val();
//        console.log(data);
                            if (data == undefined || data == '') {
                                toastr.error("Please Select Option");
                                $("#step10:checked ~ #part9").css({"opacity": "1", "height": "auto"});
                                $("#step10:checked ~ #part10").css({"opacity": "0", "height": "0"});
                            } else {
                                $("#step10:checked ~ #part9").css({"opacity": "0", "height": "0", "width": "none"});
                                $("#step10:checked ~ #part10").css({"opacity": "1", "height": "auto", "display": "block"});

                            }
                        } else {
                            console.log('false');

                        }

                    });

                    $('#step11').click(function (e) {
                        e.preventDefault();
//            console.log('here');


                        $("#part11").css({"opacity": "1", "height": "auto", "display": "block"});
                        $("#part10").css({"opacity": "0", "height": "0", "display": "none"});


                    });
              /*      $('#step12').click(function (e) {
                        e.preventDefault();
//            console.log('here');


                        $("#part12").css({"opacity": "1", "height": "auto", "display": "block"});
                        $("#part10").css({"opacity": "0", "height": "0", "display": "none"});


                    });*/

                    $('#back-step10').click(function (e) {
                        e.preventDefault();

                        $("#part10").css({"opacity": "1", "height": "auto", "display": "block"});
                        $("#part11").css({"opacity": "0", "height": "0", "display": "none"});

                    });



</script>
<script>
 /* =========================================================================================
         Description: function for forgot password Modal
         ----------------------------------------------------------------------------------------
   ========================================================================================== */
    function forgot() {
           $('#cncl').click()
          $('#frgt').click()
        };

 /* =========================================================================================
         Description: function for store forgot password
         ----------------------------------------------------------------------------------------
   ========================================================================================== */
                //****Swal button****
                function  handleResponse(message) {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-warning'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Success',
                        text: message,
                        icon: 'success',
                        allowOutsideClick: false,
                        confirmButtonText: 'ok',
                        reverseButtons: true
                    }).then((result) => {
                        location.reload(true);

                })
                };
 $('.forgot_reset').click(function (e) {

                    e.preventDefault();
                    var btn = $(this);
                    var form = $(this).closest('form');
                    var formData = form.serialize();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="_token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('forgot.password') }}",
                        data: formData,
                        success: function (data) {

                            if (data.status == false) {
                                toastr.error(data.message, 'Error', {timeOut: 2000})
                                return false;
                            } else if (data.status == true) {
//                        toastr.success(data.message, 'Success', {timeOut: 2000})
                                console.log(data.message);
                                $('#forgot-form')[0].reset();
                                $('#forgot').modal('hide');

                                handleResponse(data.message);

                                // swal("Done!", data.message, "success");
                                // window.location.reload();
                            }
                        },
                        error: function () {
                            alert('error');
                        }
                    });
                });
            </script>

<script>
    /* =========================================================================================
     Description: function for get started pop on home page after plan selection
     ----------------------------------------------------------------------------------------
     ========================================================================================== */

</script>
</html>
