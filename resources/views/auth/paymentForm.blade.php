{{--
/**
 * Created by PhpStorm.
 * User: Transdata
 * Date: 3/31/2020
 * Time: 7:38 AM
 */--}}
@extends('web.layouts.partials.app')
@section('page_title')
    Faqs | Property Management Tool
@endsection
@section('content')

{{--<div id="part11">--}}
                                        <div class="text-center"><img src="img/favicon.png" width="200px"
                                                                      height="150px"></div>
                                        <br>
                                        <p>We are excited to have you as a part of the family!
Please complete all of the inforation below and you will shortly be open to
                                            our
                                            site. We look forward to working with you!</p>
                                        <label>Which membership would you like to purchase?:</label>
                                        <div class="form-group">
                                            <select class="form-control search-fields" tabindex="-98" name="plan">
@foreach($plans as $plan)
    <option value="{{ $plan->id }}">{{ $plan->name }} ${{$plan->price}}</option>
    @endforeach


    </select>
    </div>
    <form action="{{ url('socialLoginPayment') }}" method="post" id="payment-form">
        @csrf
        <div class="form-group">
            <div class="card-body">
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
        </div>

        <div class="form-group">
            <div class="btn-group btn-group-lg" role="group" aria-label="...">
                <label for="step10" id="back-step10" class="back">
                    <div class="btn btn-theme btn-sm customNavBtn" role="button">
                        Back
                    </div>
                </label>
                  
                <label for="step11" id="continue-step11" class="continue">
                    <div class="card-footer3">
                        {{--onclick="$('#part11').hide()"--}}
                        <button class="btn btn-theme btn-sm customNavBtn"
                                type="submit">Submit
                        </button>
                    </div>
                </label>
            </div>
        </div>
    </form>


    {{--</div>--}}

@endsection

@if (Auth::guest())
    <script src="https://js.stripe.com/v3/"></script>
@section('script')

    <script>

        // Create a Stripe client.
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

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.

        var form = document.getElementById('payment-form');
        //        card.addEventListener('change', function(event) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var first_name = $('#part1 input').val();
            var last_name = $('#part2 input').val();
            var email = $('#part4 input').val();
            var phone = $('input[name="phone"]').val();

//            stripe.createPaymentMethod(
            stripe.createPaymentMethod(
                'card', card, {
                    billing_details: {
                        name: first_name + ' ' + last_name,
                        email: email,
                        phone:phone
                    }
                }
            )

                .then(function (result) {
                    console.log('****')
                    console.log(result)
                    stripeTokenHandler(result.paymentMethod);

                    // Handle result.error or result.paymentMethod
                });

        });

        // Submit the form with the payment method ID.
        function stripeTokenHandler(result) {

            // Insert the token ID into the form so it gets submitted to the server
            var first_name = $('input[name="first_name"]').val();
            var last_name = $('input[name="last_name"]').val();
            var email = $('#part4 input').val();
            var phone = $('input[name="phone"]').val();
            var plan = $('select[name="plan"]').val();
            var about_us_source = $('#part3 select').val();
            var password = $('#part5 input').val();
            var manage_income_property = $('input[name="manage_income_property"]').val();
            var interest = $('input[name="interest"]').val();
            var contact_timing = $("select[name=contact_timing]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
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
                    alert('Something went wrong. Please try again later.');
                },
                success: function (data) {
                    if (data.status == true) {
//                        toastr.error(data.message, 'Success', {timeOut: 5000})
                        $("#Login2").html("#part1");
                        $("#Login2").modal("hide");
                        window.location.reload();
                        swal("Done!", "You Are Registered!", "success");
                        swal("Done!", data.message, "success");
                    } else {
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
    @endsection
@endif
