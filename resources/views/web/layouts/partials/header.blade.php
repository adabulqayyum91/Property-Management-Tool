<style type="text/css">
.login-btn-list-padding{
    padding: 10% 0% 0% 0%;
}
.bold{
    font-weight: bold;
}
</style>
<div id="app">
    <header class="main-header header-transparent sticky-header header-info">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                @if (Auth::guest())
                <a class="navbar-brand logo" href="{{url('/')}}" style="color: black;">
                    <img src="{{ asset('img/le-logo.png') }}" alt="Property Management Tool Logo">
                </a>
                @else
                <i id="sideBarBtn" onclick="openNav()" class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>

                <a class="navbar-brand logo admin-brand" href="{{url('/')}}" style="color: black;">
                    <img src="{{ asset('img/le-logo.png') }}" alt="Property Management Tool Logo">
                </a>

                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto cstm-nav">

                        @if (Auth::guest())

                        @if(url()->current() == route('landing-page'))
                        <li class="nav-item" > <a style="color:#000;" class="nav-link" href="#pricing-section">Signup</a> </li>
                        @endif
                        <li class="nav-item active" > <a style="color:#000;" class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#Login">Login</a> </li>
                        <li class="nav-item dropdown">
                            <a style="color:#000;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ventures
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li style="padding: 10px 5px;font-size: 14px;"><a style="padding: 10px 4px;" class="" href="{{url('new-venture-listings')}}" >
                                    New Venture listing
                                </a></li>
                                <li style="padding: 10px 5px;font-size: 14px;"><a style="padding: 10px 4px;" class="" href="{{url('current-venture-listings')}}">
                                    Current Venture listing
                                </a></li>
                            </ul>
                        </li>
                        {{--                        <li class="nav-item active customNavLi" > <a class="btn btn-theme btn-sm customNavBtn" href="javascript:void(0)" data-toggle="modal" data-target="#Login2">Get Started</a> </li>--}}
                        @else
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link dropdown-toggle" href="{{url('venture')}}">--}}
                                {{--Venture--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="dropdown nav-item active customNavLi">--}}
                            {{--<a class=" dropdown-toggle" data-toggle="dropdown" style="position: relative;top: 5px;">--}}
                                {{--Venture--}}
                                {{--<span class="caret"></span></a>--}}
                                {{--<ul class="dropdown-menu">--}}
                                    {{--<li style="padding: 10px 5px;font-size: 14px;"><a class="" href="{{url('new-venture-listings')}}" >--}}
                                        {{--New Venture listing--}}
                                    {{--</a></li>--}}
                                    {{--<li style="padding: 10px 5px;font-size: 14px;"><a class="" href="{{url('new-venture-listings')}}">--}}
                                        {{--Current Venture listing--}}
                                    {{--</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            @if(Auth::user()->role->role->name=="User")
                            <li class="nav-item" > <a style="color:#000;" class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#calculator">Calculator</a> </li>


                            <li class="nav-item dropdown">
                                <a style="color:#000;" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ventures
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li style="padding: 10px 5px;font-size: 14px;"><a style="padding: 10px 4px;" class="" href="{{url('new-venture-listings')}}" >
                                        New Venture listing
                                    </a></li>
                                    <li style="padding: 10px 5px;font-size: 14px;"><a style="padding: 10px 4px;" class="" href="{{url('current-venture-listings')}}">
                                        Current Venture listing
                                    </a></li>
                                </ul>
                            </li>
                            <li class="dropdown nav-item active customNavLi">
                                <button class="btn btn-theme btn-sm customNavBtn dropdown-toggle" type="button" data-toggle="dropdown">
                                    {{ \Illuminate\Support\Facades\Auth::user()->name  }}
                                    {{--<span class="caret"></span>--}}
                                </button>
                                <ul class="dropdown-menu">
                                    {{-- TODO: For future reference --}}
                                    {{-- <li style="padding: 10px 5px;font-size: 14px;"><a style="padding: 10px 10px;" class="" href="{{url('dashboard')}}">
                                        Dashboard
                                    </a></li> --}}
                                    <li style="padding: 10px 5px;font-size: 14px;"><a style="padding: 10px 10px;" class="" href="{{url('portfolio')}}">
                                        Portfolio
                                    </a></li>

                                    <li style="padding: 10px 5px;font-size: 14px;"> <a style="padding: 10px 10px;" class="" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                     Logout
                                 </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @elseif(Auth::user()->role->role->name=="Admin")
                    <a style="color:#000;" href="{{url('/admin/home')}}">Home</a>
                    @else
                    <a style="color:#000;" href="{{url('/manager/communication')}}">Home</a>
                    @endif

                    {{--<li class="nav-item active customNavLi" >--}}
                        {{--<a class="btn btn-theme btn-sm customNavBtn" href="{{url('profiles')}}">--}}
                            {{--{{ \Illuminate\Support\Facades\Auth::user()->name  }}--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item active customNavLi" >--}}
                        {{--<a  class="btn btn-theme btn-sm customNavBtn" href="{{ route('logout') }}"--}}
                        {{--onclick="event.preventDefault();--}}
                        {{--document.getElementById('logout-form').submit();">--}}
                        {{--Logout--}}
                    {{--</a>--}}
                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                        {{--{{ csrf_field() }}--}}
                    {{--</form>--}}
                {{--</li>--}}
                @endif
            </ul>
        </div>
    </nav>
</div>
</header>



</div>
<div class="modal fade" id="calculator" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="cancelSaleLabel">Calculator</h5>
            <button type="button" class="close" data-dismiss="modal" id="cncl" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-content">
                <div class="container" style="text-align: center;">
                    <form id="calculator-form">
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label>Purchase Amount</label><br>
                                <input type="number" id="purhcase_amount" step="0.01" required="true">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label>Time Owned (months)</label><br>
                                <input type="number" id="time_owned" step="1" required="true">
                            </div>
                        </div>
                        <br>
                        {{-- Time Onwed IN YEARS --}}

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label>Cap Rate (%)</label><br>
                                <input type="number" id="cap_rate" step="0.01" required="true">
                            </div>
                            <div class="col-sm-12 col-md-6">

                                <label>Estimated Appreciation (%)</label><br>
                                <input type="number" id="estimated_appreciation" step="0.01" required="true">
                            </div>
                        </div>
                        <br>
                        {{-- Compounding Period Per Year 12 --}}

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label>Vacancy Rate (%)</label><br>
                                <input type="number" id="vacancy_rate" step="0.01" required="true">
                            </div>
                            {{-- <div class="col-sm-12 col-md-6">

                                <label>Non Vacancy Rate</label><br>
                                <input type="number" id="non_vacancy_rate" step="0.01" required="true">
                            </div> --}}
                        </div>
                        <br>
                        <div class="row mb-1">
                            <div class="col-md-12 float-right">
                                <button type="submit" class="btn btn-primary">
                                    Calculate
                                </button>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12" style="text-align: left;">

                                <table class="table">
                                    <tr>
                                        <td>Potential Beginning Monthly Rental Income $</td>
                                        <td class="float-right">$<span class="bold" id="potential_beginning_monthly_rental_income">0</span></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Potential Monthly Rental Income $</td>
                                        <td class="float-right">$<span class="bold" id="total_potential_monthly_rental_income">0</span></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Potential Appreciation $</td>
                                        <td class="float-right">$<span class="bold" id="total_potential_appreciation">0</span></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Potential return in $</td>
                                        <td class="float-right">$<span class="bold" id="total_potential_return_in_dollar">0</span></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Potential return in %</td>
                                        <td class="float-right"><span class="bold" id="total_potential_return_in_percentage">0</span>%</span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Potential return per year in %</td>
                                        <td class="float-right"><span class="bold" id="total_potential_return_per_year">0</span>%</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if (Auth::guest())
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="cancelSaleLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" id="cncl" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            </div>
            <div class="form-content-box">
                <!-- details -->
                <div class="details">
                    <!-- Logo -->
                    <h3> Property Management Tool </h3>
                    <!-- Form start -->
                    <form method="POST" name="getLogin">
                        @csrf

                        <div class="form-group">

                            <input id="email" type="email" placeholder="Email Address"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <input id="password" placeholder="Password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="row">

                            <div class="col-sm-6 form-check">
                                <input class="ez-hide" type="checkbox" name="remember"
                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label pointer" for="remember">
                                    <u>{{ __('Remember Me') }}</u>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                {{-- TODO: For Future User --}}
                                {{-- <a class="link-not-important pull-right" href="javascript:void(0)" onclick="forgot()">Forgot Password</a><a type="hidden" id="frgt" data-toggle="modal" data-target="#forgot"></a> --}}
                                <a class="link-not-important pull-right" href="{{url('password/reset')}}" target="_blank">Forgot Password</a>

                            </div>
                        </div>
                        <br>
                        <div class="form-group mb-0 mt-2">
                            <button type="submit" class="btn-md button-theme btn-block" id="saveLogin">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                    <!-- Social List -->
                    <ul class="social-list clearfix">
                        <input type="hidden" id="login-token" value="{{csrf_token()}}">

                        <!-- TODO: used for as a future signin options -->
                        <!-- <li onclick="fblogin()"><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li onclick="handleAuthClickGoogle()"><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stripePayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Payment Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-content-box">
                <!-- details -->
                <div class="details">
                    <!-- Logo -->
                    <h3> Property Management Tool </h3>
                    <div class="row">

                        @php $plans = App\Models\Plan::get(); @endphp
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme">
                                @foreach($plans as $plan)

                                <div class="item">
                                    <div class="col-sm-12 col-md-12">

                                        <div class="frb-group">

                                            <div class="frb frb-primary">
                                                <input type="radio" id="radio-button-1{{$plan->id}}" data-price="{{$plan->price}}" name="stripe-plan" value="{{ encrypt($plan->id)}}">
                                                <label for="radio-button-1{{$plan->id}}">
                                                    <h2 class="frb-title text-center" style="margin-bottom: 5px;
                                                    font-weight: 600;">{{$plan->name}}</h2>
                                                    <div class="frb-description text-center">{{ Config::get('constants.CURRENCY_SIGN').number_format($plan->price , 2, ',', '.')}}/ Month</div>
                                                </label>
                                            </div>
                                    {{-- <div class="frb-description text-center"><sup style="font-size: 20px;
                                       position: relative;
                                       top: 0px;

                                       font-weight: 400;">$</sup>{{$plan->price}}/ Month</div>--}}
                                   </div>
                               </div>
                           </div>

                           @endforeach
                       </div>
                   </div>
               </div>
               <div class="zeroPriceSocialPopup">
                <div class="form-group">
                    <div class="btn-group btn-group-lg" role="group" aria-label="...">
                          
                        <label for="step11" id="continue-step11" class="continue">
                            <div class="card-footer3">
                                {{--onclick="$('#part11').hide()"--}}
                                <button class="btn btn-theme btn-sm customNavBtn zero-social-price-form"
                                type="submit">Submit
                            </button>

                        </div>
                    </label>
                </div>
            </div>

        </div>
        <!-- Form start -->
        <div class="stripeSocialPopup">
            <form action="{{ url('postStripe') }}" method="post" id="paymentForm" class="paymentForm">
                @csrf
                <div class="form-group stripe-card-form">
                    <div class="card-body"
                    style="border-radius:3px;border: 1px solid #eee;height: 45px;padding: 12px;">
                    <div id="paymentCardElements">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors. -->
                    <div class="card-errors" role="alert"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group btn-group-lg" role="group" aria-label="..."
                    style="width:100%;">

                    <label for="step11" id="continue-step11" class="continue" style="width:100%;">
                        <div class="card-footer3">
                            <label style="width:100%;">
                                <button class="btn btn-theme btn-sm customNavBtn stripePayment"
                                style="width:100% !important;"
                                type="submit">Get Started
                            </button>
                        </label>
                    </div>
                </label>
            </div>
        </div>
    </div>
</form>


</div>
</div>
</div>
</div>
</div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $("#calculator-form").submit(function(e){
            let purhcase_amount = $('#purhcase_amount').val()? parseFloat($('#purhcase_amount').val()):0;
            let time_owned = $('#time_owned').val()? parseFloat($('#time_owned').val()):0;
            let cap_rate = $('#cap_rate').val()? parseFloat($('#cap_rate').val()):0;
            let estimated_appreciation = $('#estimated_appreciation').val()? parseFloat($('#estimated_appreciation').val()):0;
            let vacancy_rate = $('#vacancy_rate').val()? parseFloat($('#vacancy_rate').val()):0;

            let time_owned_in_years = time_owned/12;
            let compounding_period  = 12;
            let non_vacancy_rate = 100 - vacancy_rate;

            let cap_rate_in_points = cap_rate/100;
            let estimated_appreciation_in_points = estimated_appreciation/100;

            let potential_beginning_monthly_rental_income = (purhcase_amount * (cap_rate/100)) / 12;
            let total_potential_monthly_rental_income  = ((FV((cap_rate_in_points/compounding_period), time_owned, 0, (-1)*purhcase_amount))- purhcase_amount) * (non_vacancy_rate/100);
            let total_potential_appreciation  = (FV((estimated_appreciation_in_points/compounding_period), time_owned, 0, (-1)*purhcase_amount))- purhcase_amount;

            let total_potential_return_in_dollar = total_potential_monthly_rental_income + total_potential_appreciation;
            let total_potential_return_in_percentage = (total_potential_return_in_dollar/purhcase_amount)*100;
            let total_potential_return_per_year = (total_potential_return_in_percentage/time_owned)*12;


            $('#potential_beginning_monthly_rental_income').text(potential_beginning_monthly_rental_income.toFixed(2));
            $('#total_potential_monthly_rental_income').text(total_potential_monthly_rental_income.toFixed(2));
            $('#total_potential_appreciation').text(total_potential_appreciation.toFixed(2));
            $('#total_potential_return_in_dollar').text(total_potential_return_in_dollar.toFixed(2));
            $('#total_potential_return_in_percentage').text(total_potential_return_in_percentage.toFixed(2));
            $('#total_potential_return_per_year').text(total_potential_return_per_year.toFixed(2));

            console.log(total_potential_monthly_rental_income, total_potential_appreciation, total_potential_return_in_dollar, total_potential_return_in_percentage, total_potential_return_per_year);

            // console.log(purhcase_amount,time_owned,cap_rate,estimated_appreciation,vacancy_rate,non_vacancy_rate, time_owned_in_years, compounding_period, non_vacancy_rate)

            e.preventDefault();
        });
    });

    function FV(rate, nper, pmt, pv, type) {
        var pow = Math.pow(1 + rate, nper),
        fv;

        pv = pv || 0;
        type = type || 0;

        if (rate) {
            fv = (pmt*(1+rate*type)*(1-pow)/rate)-pv*pow;
        } else {
            fv = -1 * (pv + pmt * nper);
        }
        return fv;
    }

</script>

@if (Auth::guest())

<script>

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
</script>

<script src="https://js.stripe.com/v3/"></script>

<script>
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
            confirmButtonText: 'Ok',
            reverseButtons: true
        }).then((result) => {
            location.reload(true);

        })
    };
    // Create a Stripe client.
    {{--var stripe = Stripe('{{ env("STRIPE_KEY") }}');--}}
    {{--function stripeStarted() {--}}
    {{--var stripePublishKey = '{{Config::get('constants.STRIPE_KEY')}}';--}}
    {{--var stripe = Stripe(stripePublishKey);--}}
    {{--// Create an instance of Elements.--}}
    {{--var elements = stripe.elements();--}}

    {{--// Custom styling can be passed to options when creating an Element.--}}
    {{--// (Note that this demo uses a wider set of styles than the guide below.)--}}
    {{--var style = {--}}
    {{--base: {--}}
    {{--color: '#32325d',--}}
    {{--lineHeight: '18px',--}}
    {{--fontFamily: '"Helvetica Neue", Helvetica, sans-serif',--}}
    {{--fontSmoothing: 'antialiased',--}}
    {{--fontSize: '16px',--}}
    {{--'::placeholder': {--}}
    {{--color: '#aab7c4'--}}
    {{--}--}}
    {{--},--}}
    {{--invalid: {--}}
    {{--color: '#fa755a',--}}
    {{--iconColor: '#fa755a'--}}
    {{--}--}}
    {{--};--}}

    {{--// Create an instance of the card Element.--}}
    {{--var card = elements.create('card', {style: style});--}}
    {{--card.unmount('#getStartedCardElement');--}}
    {{--// Add an instance of the card Element into the `card-element` <div>.--}}
    {{--card.mount('#card-element');--}}

    {{--// Handle real-time validation errors from the card Element.--}}
    {{--card.addEventListener('change', function (event) {--}}
    {{--var displayError = document.getElementById('card-errors');--}}
    {{--if (event.error) {--}}
    {{--//                    $('.card-errors').html(event.error.message);--}}
    {{--displayError.textContent = event.error.message;--}}
    {{--} else {--}}
    {{--//                    $('.card-errors').html('');--}}
    {{--displayError.textContent = '';--}}
    {{--}--}}
    {{--});--}}
    {{--// Handle form submission.--}}

    {{--var form = document.getElementById('payment-form');--}}
    {{--//        card.addEventListener('change', function(event) {--}}
    {{--form.addEventListener('submit', function (event) {--}}
    {{--event.preventDefault();--}}
    {{--var first_name = $('#part1 input').val();--}}
    {{--var last_name = $('#part2 input').val();--}}
    {{--var email = $('#part4 input').val();--}}
    {{--var phone = $('#part6 input[name="phone"]').val();--}}

    {{--stripe.createPaymentMethod(--}}
    {{--'card', card, {--}}
    {{--billing_details: {--}}
    {{--name: first_name + ' ' + last_name,--}}
    {{--email: email,--}}
    {{--phone: phone--}}
    {{--}--}}
    {{--}--}}
    {{--)--}}

    {{--.then(function (result) {--}}
    {{--// Handle result.error or result.paymentMethod--}}

    {{--stripeTokenHandler(result.paymentMethod);--}}

    {{--});--}}

    {{--});--}}

    {{--}--}}

    {{--stripeStarted();--}}
</script>

<script>

    /* =========================================================================================
     Description: function for get started pop on home page nav bar
     ----------------------------------------------------------------------------------------
     ========================================================================================== */
     function stripeTokenHandler(result) {

        // Insert the token ID into the form so it gets submitted to the server
        var first_name = $('#part1 input[name="first_name"]').val();
        var last_name = $('#part2 input[name="last_name"]').val();
        var about_us_source = $('#part3 select').val();
        var email = $('#part4 input').val();
        var password = $('#part5 input').val();
        var phone = $('#part6 input[name="phone"]').val();
        var manage_income_property = $('#part7 input[name="manage_income_property"]').val();
        var plan = $('select[name="plan"]').val();
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
                $('.stripe_register_now').html(loading + ' Processing').attr('disabled', 'disabled');

            },
            url: "{{ url('stripeStore') }}",
            dataType: 'json',
            data: {
                'email': email,
                'brand': result.card.brand,
                'plan': plan,
                'last_four_digit': result.card.last4,
                'first_name': first_name,
                'last_name': last_name,
                'phone': phone,
                'about_us_source': about_us_source,
                'password': password,
                'manage_income_property': manage_income_property,
                'interest': interest,
                'contact_timing': contact_timing,
                'stripeToken': result.id
            },
            error: function (error) {
                $('.stripe_register_now').html('Submit').removeAttr('disabled');
                alert('Something went wrong. Please try again later.');
            },
            success: function (data) {
                if (data.status == true) {
                    $("#Login2").html("#part1");
                    $("#Login2").modal("hide");
                    /* window.location.reload();
                    swal("Done!", "You Are Registered!", "success");*/
                    handleResponse(data.message);

                    // swal("Done!", data.message, "success");
                } else {
                    $('.stripe_register_now').html('Submit').removeAttr('disabled');
                    $.each(data.error, function (k, v) {
                        toastr.error(v, 'Error', {timeOut: 5000})
                    });
                    return false;
                }
            },
            type: 'POST'
        });
    }
</script>
@endif
