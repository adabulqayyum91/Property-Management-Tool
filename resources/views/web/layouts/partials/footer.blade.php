<style>
#email-error, #password-error, .validation-advice {
    color: #FF0000;
}
</style>

<!-- Footer start -->
<footer class="footer">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item clearfix" style="color: white;">
                    <img src="{{ asset('img/white-logo.png') }}" alt="Property Management Tool Logo" width="250px">
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>Contact Us</h4>
                    <div class="f-border"></div>
                    <ul class="contact-info">
                        {{--<li>--}}
                            {{--<i class="flaticon-pin"></i>20/F Green Road, Dhanmondi, Dhaka--}}

                        {{--</li>--}}
                        <li>
                            <i class="flaticon-mail"></i><a href="mailto:Contact@gmail.com">Contact@gmail.com</a>
                        </li>
                        {{--<li>--}}
                            {{--<i class="flaticon-phone"></i><a href="tel:+55-417-634-7071">+0477 85X6 552</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="flaticon-fax"></i>+0477 85X6 552--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>Useful Links</h4>
                    <div class="f-border"></div>
                    <ul class="contact-info">
                        <li class="nav-item padding-0">
                            <a  href="{{url('/faqs')}}" style="text-transform: capitalize">
                                FAQs
                            </a>
                        </li>
                        @php
                        $allPages = \App\Models\Page::get();
                        @endphp

                        @if(isset($allPages))
                        @foreach($allPages as $page)

                        <li class="nav-item padding-0">
                            <a  href="{{url('pages/'.$page->slug)}}" style="text-transform: capitalize">
                                {{$page->title}}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="footer-item clearfix" style="margin-top: -40px;height: 350px;">
                    <iframe src="https://app.popt.in/landing/17c59879b45e3" frameborder="0" style="width: 100%;height: 100%"></iframe>
                    {{--<div id="pixel-script-poptin"></div>--}}
                    {{--<div class="f-border"></div>--}}
                    {{--<div class="Subscribe-box">--}}
                        {{--<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt--}}
                        {{--mollit.</p>--}}
                        {{--<form class="form-inline" action="#" method="GET">--}}
                            {{--<input type="text" class="form-control mb-sm-0 customInput" id="inlineFormInputName3"--}}
                            {{--placeholder="Email Address">--}}
                            {{--<button type="submit" class="btn"><i class="fa fa-paper-plane"></i></button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- Sub footer start -->
<div class="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <p class="copy">© 2020 <a href="#">Property Management Tool Inc.</a> All Rights Reserved. Design & Develop by <a href="http://transdata.biz" target="_blank">TransData</a></p>
            </div>
            <div class="col-lg-4 col-md-4">
                <ul class="social-list clearfix">
                    <li><a href="https://www.facebook.com/Sample" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/Sampleinc?lang=en" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    {{-- TODO: For future reference --}}
                    {{-- <li><a href="#" class="google"><i class="fa fa-instagram customInstaIcn"></i></a></li>
                    <li><a href="#" class="rss"><i class="fa fa-youtube"></i></a></li> --}}

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Sub footer end -->

@if (Auth::guest())
<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="modal-title" id="cancelSaleLabel">Forgot Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="form-content-box">
            <!-- details -->
            <div class="details">
                <!-- Logo -->
                <h3> Property Management Tool </h3>
                <!-- Form start -->
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="#" id="forgot-form">
                    @csrf
                    <div class="form-group">
                        <input id="forget-email" type="email" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-0 mt-2">
                        <button type="submit" class="btn-md button-theme btn-block forgot_reset" id="forgot_reset">Forgot Password
                        </button>
                    </div>
                </form>

                <!-- Social List -->
                <ul class="social-list clearfix">
                    <input type="hidden" id="login-token" value="{{csrf_token()}}">
                    <!-- TODO: used for as a future signin options -->
                        <!-- <li onclick="fblogin()"><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                            <li onclick="handleAuthClickGoogle()"><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="LoginF" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-content-box">
                <!-- details -->
                <div class="details">
                    <!-- Logo -->
                    <h3> Property Management Tool </h3>
                    <!-- Form start -->

                    <form action="currentVentures.html" method="post">
                        <div class="text-center"><img src="img/logo.png"></div>
                        <p>Forgot password? Please enter your email address and we will send you a link to reset your
                            password
                        </p>
                        <div class="form-group">
                            <input type="email" name="email" class="input-text" placeholder="Email Address" required
                            autocomplete="email" autofocus>
                        </div>

                        <br>
                        <div class="form-group mb-0 mt-2">
                            <button type="submit" class="btn-md button-theme btn-block">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Login2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"aria-hidden="true">

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
                                    <input id="step2" type="checkbox">
                                    <input id="step3" type="checkbox">
                                    <input id="step4" type="checkbox">
                                    <input id="step5" type="checkbox">
                                    <input id="step6" type="checkbox">
                                    <input id="step7" type="checkbox">
                                    <input id="step8" type="checkbox">
                                    <input id="step9" type="checkbox">
                                    <input id="step10" type="checkbox">
                                    <input id="step11" type="checkbox">
                                    <input id="step12" type="checkbox">

                                    <div id="part1">

                                        <label>What is your first name?</label>

                                        <input type="text" class="form-control" placeholder="Name" name="first_name"
                                        maxlength="30" id="first_name">


                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                            style="width:1%"><span class="sr-only">0% Complete</span></div>
                                        </div>

                                        <br>
                                        <br>
                                        <div class="btn-group btn-group-lg" role="group" aria-label="...">
                                            <label for="step2" id="continue-step2" class="continue">
                                                <div class="btn btn-theme btn-sm customNavBtn">Continue</div>
                                            </label>
                                        </div>
                                        <br>
                                    </div>


                                    <div id="part2">


                                        <label>Thank you and your last name?</label>

                                        <input placeholder="Last Name" class="form-control" type="text" name="last_name"
                                        maxlength="30" id="last_name">

                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"
                                            style="width:10%"><span class="sr-only">10% Complete</span></div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="btn-group btn-group-lg btn-group-justified" role="group"
                                        aria-label="...">

                                        <label for="step2" id="back-step2" class="back">
                                            <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                        </label>
                                          

                                        <label for="step3" id="continue-step3" class="continue">
                                            <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                                            </div>
                                        </label>

                                    </div>
                                </div>

                                <div id="part3">


                                    <label>How Did You hear About Us:</label>
                                    <select class="form-control search-fields" tabindex="-98" name="about_us_source"
                                    id="info">
                                    <option value="billboard">Billborad</option>
                                    <option value="Radio">Radio</option>
                                    <option value="Web Search">Web Search</option>
                                    <option value="Refered By a Friend">Refered By a Friend</option>
                                    <option value="Other">Other</option>
                                </select>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                    style="width:20%"><span class="sr-only">20% Complete</span></div>
                                </div>
                                <br>
                                <br>
                                <div class="btn-group btn-group-lg btn-group-justified" role="group"
                                aria-label="...">

                                <label for="step3" id="back-step3" class="back">
                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                </label>

                                  
                                <label for="step4" id="continue-step4" class="continue">
                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                                    </div>
                                </label>

                            </div>
                        </div>

                        <div id="part4">


                            <label>Ok... and your email address?</label>
                            <input placeholder="Email Address" class="form-control" type="email"
                            name="email" maxlength="70">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                style="width:30%"><span class="sr-only">30% Complete</span></div>
                            </div>

                            <br>
                            <br>
                            <div class="btn-group btn-group-lg btn-group-justified" role="group"
                            aria-label="...">

                            <label for="step4" id="back-step4" class="back">
                                <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                            </label>

                              
                            <label for="step5" id="continue-step5" class="continue">
                                <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                                </div>
                            </label>

                        </div>
                    </div>


                    <div id="part5">
                        <label>Ok... and your Password?</label>
                        <input placeholder="Password" class="form-control" type="password"
                        name="password" maxlength="70">
                        <div class="progress">

                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                            aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"
                            style="width:35%"><span class="sr-only">35% Complete</span></div>


                        </div>

                        <br>
                        <br>
                        <div class="btn-group btn-group-lg btn-group-justified" role="group"
                        aria-label="...">

                        <label for="step5" id="back-step5" class="back">
                            <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                        </label>

                          
                        <label for="step6" id="continue-step6" class="continue">
                            <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                            </div>
                        </label>

                    </div>


                </div>


                <div id="part6">

                    <label>What is the best number to call you on?</label>
                    <input placeholder="Phone Number" class="form-control" type="text" name="phone"
                    maxlength="13" id="phone_number">

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                        style="width:40%"><span class="sr-only">40% Complete</span></div>
                    </div>
                    <br>
                    <br>

                    <div class="btn-group btn-group-lg btn-group-justified" role="group"
                    aria-label="...">

                    <label for="step6" id="back-step6" class="back">
                        <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                    </label>

                      
                    <label for="step7" id="continue-step7" class="continue">
                        <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                        </div>
                    </label>

                </div>

            </div>


            <div id="part7">
                <label>Are you willing to learn about owning and managing
                income properties?</label><br>
                <div class="btn_radio">

                    <input type="radio" name="manage_income_property" value="1">

                    <span>yes</span>

                    <input type="radio" name="manage_income_property" value="0">

                    <span>No</span>

                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                    style="width:50%"><span class="sr-only">50% Complete</span></div>
                </div>
                <br>
                <br>
                <div class="btn-group btn-group-lg btn-group-justified" role="group"
                aria-label="...">

                <label for="step7" id="back-step7" class="back">
                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                </label>

                  
                <label for="step8" id="continue-step8" class="continue">
                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                    </div>
                </label>

            </div>


        </div>

        <div id="part8">
            <label>ok... just a couple more questions... what
            interests you about what we offer?</label>
            <input placeholder="Enter Interest" class="form-control" type="text"
            name="interest">
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                style="width:60%"><span class="sr-only">60% Complete</span></div>
            </div>
            <br>
            <br>
            <div class="btn-group btn-group-lg btn-group-justified" role="group"
            aria-label="...">

            <label for="step8" id="back-step8" class="back">
                <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
            </label>
              

            <label for="step9" id="continue-step9" class="continue">
                <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                </div>
            </label>

        </div>


    </div>


    <div id="part9">
        <label>When is the best time to contact
        you?</label>
        <!--<div class="dropdown bootstrap-select search-fields">-->
            <select class="form-control search-fields" tabindex="-98" name="contact_timing">
                <option value="Before 8 AM">Before 8 AM</option>
                <option value="8 AM to Noon">8 AM to Noon</option>
                <option value="Noon to 5 PM">Noon to 5 PM</option>
                <option value="After 5 PM">After 5 PM</option>
            </select>
            <!--<button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="button" title="Before 8 am"><div class="filter-option"><div class="filter-option-inner">Before 8 am</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>-->
            <div class="progress">
                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                style="width:70%"><span class="sr-only">70% Complete</span></div>
            </div>
            <br>
            <br>
            <div class="btn-group btn-group-lg btn-group-justified" role="group"
            aria-label="...">

            <label for="step9" id="back-step9" class="back">
                <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
            </label>
              

            <label for="step10" id="continue-step10" class="continue">
                <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue
                </div>
            </label>

        </div>

    </div>


    <div id="part10">


        <div class="text-center"><img src="img/favicon.png" width="200px"
          height="150px"></div>
          <br>
          <p>Because of the nature of our business, we require all new members to
            participate in our training class and pass our exam so you understand
            everything. At this point, you have two options:<br>
            1) If you are already familiar with everything and are ready to hit the
            ground
            running, please join. You will have access to our site, but will be limited
            on your
            transactions until you have passed a knowledge based test. We will contact
            you shortly to
            schedule a time to participate in our training and test.<br>
            2) Don't join now and we will contact you shortly to schedule the training.
            You will not have access to the site, but can join once you have gone
            through
        training.</p>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
            style="width:80%"><span class="sr-only">80% Complete</span></div>
        </div>
        <br>
        <br>
        <div class="btn-group btn-group-lg btn-group-justified" role="group"
        aria-label="...">

        <label for="step11" id="back-step11" class="back">
            <div class="btn btn-theme btn-sm customNavBtn" type="submit"
            role="button">Join Now
        </div>
    </label>

      
    <label for="step12" id="continue-step12" class="continue">
        <div class="btn btn-theme btn-sm customNavBtn" role="button"
        id="contact_me_first" type="submit">Contact me First
    </div>
</label>

</div>


</div>


<div id="part11">
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
            <option value="">Select Plan</option>

            @if(isset($plans))
            @foreach($plans as $plan)
            <option value="{{ $plan->id }}" data-price="{{$plan->price}}">{{ $plan->name }}
                ${{$plan->price}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="get-stripe-form">
            <form action="{{ url('postStripe') }}" method="post" id="payment-form">
                @csrf
                <div class="form-group">
                    <div class="card-body"
                    style="border-radius:3px;border: 1px solid #eee;height: 45px;padding: 12px;">
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
                            <button class="btn btn-theme btn-sm customNavBtn stripe_register_now"
                            type="submit">Submit
                        </button>

                    </div>
                </label>
            </div>
        </div>
    </form>
</div>
<div class="zeroPrice">
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
                    <button class="btn btn-theme btn-sm customNavBtn zero-price-form"
                    type="submit">Submit
                </button>

            </div>
        </label>
    </div>
</div>
</div>
<div id="part11">
    <div class="text-center"><img src="img/favicon.png" width="200px"
      height="150px"></div>
      <br>
      <p>We are excited to have you as a part of the family!
        Please complete all of the inforation below and you will shortly be open to
        our
    site. We look forward to working with you!</p>
    <label>Which membership would you like to purchase?:</label>
    <div class="form-group">
        <select class="form-control search-fields" tabindex="-98">
            <option>Month to Month $15</option>
            <option>Annual $99</option>
        </select>
    </div>
    <div class="form-group">
        <input type="text" placeholder="Name as it appears on your credit card"
        class="form-control">
    </div>
    <div class="form-group">
        <div class="input-wrapped full" id="validateCard">
            <input type="text" size="20" name="ccNumber" maxlength="16"
            id="cardnumber" class="full form-control"
            placeholder="1234 5678 9012 3456" data-creditcard="true">
            <i class="icon-ok"></i>
            <span class="icon-ok"></span>
        </div>
    </div>
    <div class="form-group">
        <p>By submitting payment information, you agree to the terms and conditions
            and
        Privancy Policy found here.</p>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-primary"
            role="progressbar" aria-valuenow="90" aria-valuemin="0"
            aria-valuemax="100" style="width:90%"><span class="sr-only">90% Complete</span>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="btn-group btn-group-lg" role="group" aria-label="...">
        <label for="step10" id="back-step10" class="back">
            <div class="btn btn-theme btn-sm customNavBtn" role="button">Back
            </div>
        </label>
          
        <label for="step11" id="continue-step11" class="continue">
            <button class="btn btn-theme btn-sm customNavBtn register_now"
            id="register_now"
            onclick="$('#part11').hide()">Submit
        </button>
    </label>
</div>
</div>


</div>


<div id="part12">

    <div class="text-center"><img src="img/favicon.png" width="200px"
      height="150px"></div>
      <p>Thank you for your interest in Property Management Tool! We will have one of our
        representatives contact you shortly to discuss next steps. If you
        just joined, please click the Log In buttion and you will be redirected to
    the login page.</p>
    <div class="progress">
        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
        style="width:100%"><span class="sr-only">100% Complete</span></div>
    </div>
    <br>
    <br>
    <div class="btn-group btn-group-lg" role="group" aria-label="...">
        <label for="step11" id="back-step11" class="back">
            <a class="btn btn-theme btn-sm customNavBtn" href="javascript:void(0)"
            data-toggle="modal" data-target="#Login">Login</a>
        </label>   
        <label class="continue">
            <a href="index.html" class="btn btn-theme btn-sm customNavBtn">Close</a>
        </label>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endif

