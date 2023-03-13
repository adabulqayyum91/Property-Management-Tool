@extends('web.layouts.partials.app')
@section('page_title')
Home | Property Management Tool
@endsection

@section('content')
<style>
#email-error, #password-error, #last_name-error, #first_name-error, #phone-error {
    color: #FF0000;
}
.pricing-1 .plan-header p{font-size:14px;}
.pricing-1 .plan-header .plan-price {
    color: #000;
}
.pricing-1 .plan-header .plan-price span {
    font-size: 16px;
    color: #000;
    font-weight: 400;
}
.pricing-1 .plan-header .plan-price sup{
    color:#000;
}
.card-errors{color:red;padding-top: 10px;}

.pricing-1 ul li {
    list-style: disc;
    list-style-position: inside;
}
.pricing-1 ul ul li{
    list-style: circle;
    list-style-position: inside;
    padding: 10px 0 10px 20px;
    text-indent: -1em;
}
.pricing-1 a { color: blue;}
blockquote p {
    padding: 15px;
    background: #eee;
    border-radius: 5px;
}

blockquote p::before {
    content: '\201C';
}
blockquote p::after {
    content: '\201C';
}

</style>
<!-- Banner start -->
<div class="banner banner" id="banner">
    <div id="bannerCarousole" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @if(isset($allSliders))
            @foreach($allSliders as $slider)
            <div class="carousel-item banner-max-height {{ $loop->iteration == 1 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{ asset('img/banner/'.$slider->photo)}}" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="text-center">
                            <h1>{{ isset($slider) ? $slider->title : ''}}</h1>
                            <p>
                             {{ isset($slider) ? $slider->description : '' }}
                         </p>

                     </div>
                 </div>
             </div>
         </div>
         @endforeach
         @endif

     </div>
     <a class="carousel-control-prev" href="#bannerCarousole" role="button" data-slide="prev">
        <span class="slider-mover-left" aria-hidden="true">
            <i class="fa fa-angle-left"></i>
        </span>
    </a>
    <a class="carousel-control-next" href="#bannerCarousole" role="button" data-slide="next">
        <span class="slider-mover-right" aria-hidden="true">
            <i class="fa fa-angle-right"></i>
        </span>
    </a>
</div>

<div class="container search-options-btn-area">
    <a class="search-options-btn d-lg-none d-xl-none">
        <div class="search-options d-none d-xl-block d-lg-block">Search Options</div>
        <div class="icon"><i class="fa fa-chevron-up"></i></div>
    </a>
</div>
<!-- Search Section start -->
</div>


<!-- Banner end -->
<div class="services content-area bg-grea-3" style="padding-top: 45px">
    <div class="container">
        <!-- Main title -->
        @if(!is_null($currentVideo))
        <div class="main-title text-center">
            <h1>{{$currentVideo->title}}</h1>
            <p>{{$currentVideo->description}}</p>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                <div class="service-info service-padding">
                    <iframe width="100%" height="400"
                    src="{{$currentVideo->link}}">
                </iframe>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
<!-- Services end -->

<!-- price table start -->
@if (Auth::guest() && $priceSectionSetting->status === 1)
<div class="pricing-tables pt-5 pb-3" id="pricing-section">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h1>Pricing Tables</h1>
            <p>Finding your perfect plan.</p>
        </div>
        <div class="row justify-content-center">
            @foreach($plans as $plan)
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="pricing-1 plan">
                    <div class="plan-header">
                        <h5>{{$plan->name}}</h5>
                        <p>{!!isset($plan->description) ? $plan->description : ''!!}</p>

                        <div class="plan-price"><sup>$</sup>{{$plan->price}}<span>/month</span> </div>
                    </div>
                    <div class="plan-list">

                        <div class="plan-button text-center">
                            <button class="btn btn-outline pricing-btn button-theme planModal {{$plan->price =='0'?'register-form':'getStarted'}}" data-id="{{ encrypt($plan->id)}}">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endif
<!-- price table end -->

<!-- Counters strat -->
<div class="counters overview-bgi">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-sale"></i>
                    <h1 class="counter">{{ \App\Models\VentureListing::where('list_status','Live')->count() }}</h1>
                    <p>Listings For Sale</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-user"></i>
                    <h1 class="counter">{{ App\Helpers\Helper::membersCount() }}</h1>
                    <p>Members</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="counter-box">
                    <i class="flaticon-work"></i>
                    <h1 class="counter">{{ \App\Models\Venture::count() }}</h1>
                    <p>Ventures</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Counters end -->
<div class="modal fade" id="priceTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">

<div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="cancelSaleLabel">Get Started</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

        <div class="form-content-box">

            <!-- details -->

            <div class="details">

                <!-- Logo -->

                <div class="properties-details-page content-area">
                    <div class="container">
                        <div class="row">
                            <div id="msform">


                                <div id="part1044">

                                    <label>Email</label>
                                    <input type="text" placeholder="abc@gmail.com" class="form-control" name="email"
                                    required>
                                    <span style="font-size: 10px;">Your Email Addresss Serve as your Username</span>
                                    <div style="display: none;" id="validation_email_custom"
                                    class="validation-advice">Please Enter Email .
                                </div>

                                <br>
                                <br>
                                <label>Password</label>
                                <span style="float: right;font-size:10px;"><input type="checkbox"
                                  class="showPassword"
                                  style="opacity: 1;position:relative;">Show Password</span>
                                  <input type="password" placeholder="Password" class="form-control passwordType"
                                  name="password" >
                                  <div style="display: none;" id="validation_password_custom"
                                  class="validation-advice">Please Enter Password .
                              </div>

                              <div id="sandbox-container" class="mt-20">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name"
                                        name="first_name">
                                        <div style="display: none;" id="validation_first_name_custom"
                                        class="validation-advice">Please Enter First Name .
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name"
                                    name="last_name">
                                    <div style="display: none;" id="validation_last_name_custom"
                                    class="validation-advice">Please Enter Last Name .
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Phone Number</label>
                        </div>
                        <div class="col-sm-4 pr-0">
                            <select name="countryCode" class="form-control" id="" disabled
                            style="border-radius: 0;height:45px;">
                            <option data-countryCode="GB" value="44">UK (+44)</option>
                            <option data-countryCode="US" value="1" Selected>USA (+1)</option>
                        </select></div>
                        <div class="col-sm-8 pl-0">
                            <input type="text" class="form-control phone" placeholder="" id=""
                            name="phone" required>
                            <div style="display: none;" id="validation_phone_custom"
                            class="validation-advice">Please Enter Phone Number .
                        </div>

                    </div>
                </div>


            </div>
            <br>
            <form action="{{ url('postStripe') }}" method="post" id="getStartedForm" class="getStartedForm">
                @csrf
                <div class="form-group stripe-card-form">
                    <div class="card-body"
                    style="border-radius:3px;border: 1px solid #eee;height: 45px;padding: 12px;">
                    <div id="getStartedCardElement">
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
                                <button class="btn btn-theme btn-sm customNavBtn getStart"
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
</div>
</div>
</div>


<div class="modal fade priceZeroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">

<div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="cancelSaleLabel">Get Started</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

        <div class="form-content-box">

            <!-- details -->

            <div class="details">

                <!-- Logo -->

                <div class="properties-details-page content-area">
                    <div class="container">
                        <div class="row">
                            <div id="msform">

                                <form  method="post" action="{{url('zeroPlanPrice')}}" name="userWithoutPlan">
                                    @csrf
                                    <div class="part1044">

                                        <label>Email</label>
                                        <input type="text" placeholder="abc@gmail.com" class="form-control" name="email" required>
                                        <span style="font-size: 10px;">Your Email Addresss Serve as your Username</span>
                                        <div style="display: none;" id="validation_email_custom"
                                        class="validation-advice">Please Enter Email .
                                    </div>

                                    <br>
                                    <br>
                                    <label>Password</label>
                                    <span style="float: right;font-size:10px;">
                                        <input type="checkbox"
                                        class="showPassword"
                                        style="opacity: 1;position:relative;">Show Password</span>
                                        <input type="password" placeholder="Password" class="form-control passwordType"
                                        name="password" >


                                        <div style="display: none;" id="validation_password_custom"
                                        class="validation-advice">Please Enter Password .
                                    </div>
                                    <input type="hidden" name="plan" id="hiddenPlan">
                                    <div id="sandbox-container" class="mt-20">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name"
                                                name="first_name" required>
                                                <div style="display: none;" id="validation_first_name_custom"
                                                class="validation-advice">Please Enter First Name .
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="Last Name"
                                            name="last_name" required>
                                            <div style="display: none;" id="validation_last_name_custom"
                                            class="validation-advice">Please Enter Last Name .
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Phone Number</label>
                                </div>
                                <div class="col-sm-4 pr-0">
                                    <select name="countryCode" class="form-control" id="" disabled
                                    style="border-radius: 0;height:45px;">
                                    <option data-countryCode="GB" value="44">UK (+44)</option>
                                    <option data-countryCode="US" value="1" Selected>USA (+1)</option>
                                </select></div>
                                <div class="col-sm-8 pl-0">
                                    <input type="text" class="form-control phone" placeholder="" id=""
                                    name="phone" required>
                                    <div style="display: none;" id="validation_phone_custom"
                                    class="validation-advice">Please Enter Phone Number .
                                </div>

                            </div>
                        </div>


                    </div>
                    <br>
                    <label style="width:100%;">
                        <button class="btn btn-theme btn-sm customNavBtn getStart"
                        style="width:100% !important;"
                        type="submit">Get Started
                    </button>
                </label>
            </form>

        </div>

    </div>

</div>
</div>
</div>


</div>
</div>
</div>
</div>
@endsection
@if (Auth::guest())

@section('script')
<script src="https://js.stripe.com/v3/"></script>
<script>
                /* =========================================================================================
                 Description: function for get started pop on home page after plan selection
                 ----------------------------------------------------------------------------------------
                 ========================================================================================== */
                 $(document).ready(function () {
                     $('.phone').usPhoneFormat({
                         format: '(xxx) xxx-xxxx',
                     });
                     $('.showPassword').click(function () {
                        var passType = $('.passwordType').attr('type');
                        if (passType === "password") {

                            $('.passwordType').attr('type', 'text');
                        } else {
                            $('.passwordType').attr('type', 'password');

                        }
                    });

                     $('.getStarted').click(function (e) {

                        var started_plan = $(this).attr('data-id');

                        $('#priceTable').modal('show');
                    // console.log(started_plan);
                    $('#part1044 input[name="first_name"]').val('');
                    $('#part1044 input[name="last_name"]').val('');
                    $('#part1044 input[name="email"]').val('');
                    $('#part1044 input[name="phone"]').val('');
                    $('#part1044 input[name="password"]').val('');

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
                    card.unmount('#card-element');
                    card.mount('#getStartedCardElement');

                    // Handle real-time validation errors from the card Element.
                    card.addEventListener('change', function (event) {
                        if (event.error) {
                            $('.card-errors').html(event.error.message);
                        } else {
                            $('.card-errors').html('');
                        }
                    });
                    // Handle form submission.

                    var getStartedForm = document.getElementById('getStartedForm');
                    getStartedForm.addEventListener('submit', function (event) {
                        event.preventDefault();
                        var started_first_name = $('#part1044 input[name="first_name"]').val();
                        var started_last_name = $('#part1044 input[name="last_name"]').val();
                        var started_email = $('#part1044 input[name="email"]').val();
                        var started_phone = $('#part1044 input[name="phone"]').val();
                        var started_password = $('#part1044 input[name="password"]').val();
                        var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                        //validation for input fields
                        if (started_first_name == '') {
                            $('#validation_first_name_custom').show();
//                    return false;
} else {
    $('#validation_first_name_custom').hide();
}
if (started_last_name == '') {
    $('#validation_last_name_custom').show();
} else {
    $('#validation_last_name_custom').hide();
}
if (started_email == '') {
    $('#validation_email_custom').show();
} else {
    $('#validation_email_custom').hide();
}
if (started_password == '') {
    $('#validation_password_custom').show();
} else {
    $('#validation_password_custom').hide();
}
if (started_phone == '') {
    $('#validation_phone_custom').show();
} else {
    $('#validation_phone_custom').hide();
}
                        //create key for laravel cashier for payment and subscription purpose
                        stripe.createPaymentMethod(
                            'card', card, {
                                billing_details: {
                                    name: started_first_name + ' ' + started_last_name,
                                    email: started_email,
                                    phone: started_phone
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
                                        $('.getStart').html(loading + ' Processing').attr('disabled', 'disabled');
                                    },
                                    url: "{{ url('getStartedStripeStore') }}",
                                    dataType: 'json',
                                    data: {
                                        'email': started_email,
                                        'brand': result.paymentMethod.card.brand,
                                        'plan': started_plan,
                                        'last_four_digit': result.paymentMethod.card.last4,
                                        'first_name': started_first_name,
                                        'last_name': started_last_name,
                                        'phone': started_phone,
                                        'password': started_password,
                                        'stripeToken': result.paymentMethod.id

                                    },
                                    error: function (error) {
                                        $('.getStart').html('GET STARTED').removeAttr('disabled');
                                        toastr.error(error.message, 'Error', {timeOut: 5000});
                                    },
                                    success: function (data) {
                                        if (data.status == true) {
                                            // window.location.reload();
                                            // swal("Done!", "You Are Registered!", "success");
                                            // swal("Done!", data.message, "success");

                                            $('#priceTable').modal('hide');

                                            handleResponse(data.message);

                                        } else if (data.status == false) {
                                            toastr.error(data.message, 'Error', {timeOut: 5000});
                                            $('.getStart').html('GET STARTED').removeAttr('disabled');

                                        }
                                        else if (data.stripeStatus == false) {
                                            toastr.error(data.message, 'Error', {timeOut: 5000});
                                            $('.getStart').html('GET STARTED').removeAttr('disabled');

                                        }

                                        else {
                                            $.each(data.error, function (k, v) {
                                                toastr.error(v, 'Error', {timeOut: 5000})
                                            });
                                            $('.getStart').html('GET STARTED').removeAttr('disabled');
                                        }
                                    },
                                    type: 'POST'
                                });
                        });

                    });
});
});
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
                // click for open zero plan popup
                $('.register-form').click(function () {
                    $('.priceZeroModal').modal('show');
                    let planValue = $(this).attr('data-id')
                    $('#hiddenPlan').val(planValue);
                });
                //zero popup validation
                $("form[name='userWithoutPlan']").validate({
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
                            },
                            first_name:{
                                required: true,
                            },
                            last_name:{
                                required: true,
                            },


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
                            },
                            first_name:{
                                required: "Please Enter First Name"
                            },
                            last_name:{
                                required: "Please Enter Last Name"
                            },
                            phone:{
                                required: "Please Enter Phone Number"

                            }

//                }
},
                        // Make sure the form is submitted to the destination defined
                        // in the "action" attribute of the form when valid
                        submitHandler: function (form) {
                                var formData = $("form[name='userWithoutPlan']").serialize();//alert(form.serialize());
                                var started_plan = $('.part1044 input[name="plan"]').val();
                                var started_first_name = $('.part1044 input[name="first_name"]').val();
                                var started_last_name = $('.part1044 input[name="last_name"]').val();
                                var started_email = $('.part1044 input[name="email"]').val();
                                var started_phone = $('.part1044 input[name="phone"]').val();
                                var started_password = $('.part1044 input[name="password"]').val();
                                var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-Token': "{{csrf_token()}}"
                                    }
                                });
                                $.ajax({
                                    beforeSend: function () {
                                        $('#saveLogin').html(loading + ' Processing').attr('disabled', 'disabled');
                                    },
                                    url: "{{ url('zeroPlanPrice') }}",
                                    data: {
                                        'email': started_email,
                                        'plan': started_plan,
                                        'first_name': started_first_name,
                                        'last_name': started_last_name,
                                        'phone': started_phone,
                                        'password': started_password,

                                    },
                                    error: function (error) {
                                        $('.getStart').html('GET STARTED').removeAttr('disabled');
                                        toastr.error(data.message, 'Error', {timeOut: 5000});
                                    // alert('Something went wrong. Please try again later.');
                                },
                                success: function (data) {
                                    if (data.status == true) {
                                       /* window.location.reload();
                                        swal("Done!", "You Are Registered!", "success");
                                        swal("Done!", data.message, "success");*/
                                        $('.priceZeroModal').modal('hide');
                                        handleResponse(data.message);

                                    } else if (data.status == false) {
                                        toastr.error(data.message, 'Error', {timeOut: 5000});
                                        $('.getStart').html('GET STARTED').removeAttr('disabled');

                                    }
                                    else if (data.stripeStatus == false) {
                                        toastr.error(data.message, 'Error', {timeOut: 5000});
                                        $('.getStart').html('GET STARTED').removeAttr('disabled');

                                    }

                                    else {
                                        $.each(data.error, function (k, v) {
                                            toastr.error(v, 'Error', {timeOut: 5000})
                                        });
                                        $('.getStart').html('GET STARTED').removeAttr('disabled');
                                    }
                                },
                                type: 'POST'
                            });
                            }
                        });


                    </script>
                    @endsection
                    @endif
