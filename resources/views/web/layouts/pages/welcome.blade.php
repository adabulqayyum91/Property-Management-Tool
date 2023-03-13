@extends('web.layouts.partials.app')
@section('content')
<!-- Banner start -->
<div class="banner banner" id="banner">
    <div id="bannerCarousole" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $slider)

            <div class="carousel-item banner-max-height {{ $loop->iteration == 1 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{ asset('img/banner/'.$slider->photo)}}" alt="banner">
                <div class="carousel-caption banner-slider-inner d-flex h-100 text-center">
                    <div class="carousel-content container">
                        <div class="text-center">
                            <h1>{{ isset($slider->title) ? $slider->title : ''}}</h1>
                            <p>
                               {{ isset($slider->description) ? $slider->description : '' }}
                           </p>

                       </div>
                   </div>
               </div>
           </div>
            @endforeach

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
        <div class="main-title text-center">
            <h1>Its just a matter of getting started</h1>
            <p>Learn how it works</p>
        </div>
        @if(isset($video->link))
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-none d-xl-block d-lg-block">
                <div class="service-info">
                    <iframe width="100%" height="400"
                            src="{{$video->link}}">
                    </iframe>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Services end -->


    <!-- Counters strat -->
    <div class="counters overview-bgi">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-sale"></i>
                        <h1 class="counter">967</h1>
                        <p>Listings For Sale</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-user"></i>
                        <h1 class="counter">396</h1>
                        <p>Members</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="counter-box">
                        <i class="flaticon-work"></i>
                        <h1 class="counter">177</h1>
                        <p>Ventures</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Counters end -->

    <!-- Footer start -->
    <footer class="footer">
        <div class="container footer-inner">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-item clearfix"style="color: white;">
                        Property Management Tool
                        <div class="text">
                            <p>We were born out of frustration. Frustration around a market that has been around for dozens of years. A market that has failed to help the average person play in a game that has created more wealth over the last 100 years than any other industry.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-item">
                        <h4>Contact Us</h4>
                        <div class="f-border"></div>
                        <ul class="contact-info">
                            <li>
                                <i class="flaticon-pin"></i>1234 Any Road, SLC, Utah 84107
                            </li>
                            <li>
                                <i class="flaticon-mail"></i><a href="mailto:sales@hotelempire.com">info@gmail.com</a>
                            </li>
                            <li>
                                <i class="flaticon-phone"></i><a href="tel:+55-417-634-7071">206-786-9213</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-item">
                        <h4>
                            Useful Links
                        </h4>
                        <div class="f-border"></div>
                        <ul class="links">
                            <li>
                                <a href="faqs2.html">FAQs</a>
                            </li>
                            <li>
                                <a href="company1.html">Company</a>
                            </li>
                            <li>
                                <a href="terms1.html">Terms</a>
                            </li>
                            <li>
                                <a href="privacy-policy1.html">Privacy & Policy</a>
                            </li>
                            <li>
                                <a href="contact-us.html">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-item clearfix">
                        <h4>Subscribe</h4>
                        <div class="f-border"></div>
                        <div class="Subscribe-box">
                            <p>Interested in learning more. Add your email address here to get updates about our offering and how we can help you reach your goals.</p>
                            <form class="form-inline" action="#" method="GET">
                                <input type="text" class="form-control mb-sm-0 customInput" id="inlineFormInputName3" placeholder="Email Address">
                                <button type="submit" class="btn"><i class="fa fa-paper-plane"></i></button>
                            </form>
                        </div>
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
                    <p class="copy">© 2019 <a href="#">Property Management Tool Inc.</a> All Rights Reserved.</p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="social-list clearfix">
                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="google"><i class="fa fa-instagram customInstaIcn"></i></a></li>
                        <li><a href="#" class="rss"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Sub footer end -->

    <!-- Full Page Search -->
    <div id="full-page-search">
        <button type="button" class="close">×</button>
        <form action="http://storage.googleapis.com/themevessel-products/neer/index.html#">
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-sm button-theme">Search</button>
        </form>
    </div>


    <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cancelSaleLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" id="cncl" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="form-content-box">
            <!-- details -->
            <div class="details">
              <!-- Logo -->
              <h3> Property Management Tool </h3>
              <!-- Form start -->
              <form action="{{URL::Route('login')}}" method="post">
                <div class="form-group">
                  <input type="email" name="email" class="input-text" placeholder="Email Address">
              </div>
              <div class="form-group">
                  <input type="password" name="Password" class="input-text" placeholder="Password">
              </div>
              <div class="row">
                  <div class="col-sm-6 text-left">
                    <label>
                      <input type="checkbox" class="ez-hide">
                  Remember me </label>
              </div>
              <div class="col-sm-6"> <a class="link-not-important pull-right" href="javascript:void(0)" onclick="forgot()">Forgot Password</a><a type="hidden" id="frgt" data-toggle="modal" data-target="#forgot"></a> </div>
          </div>
          <br>
          <div class="form-group mb-0 mt-2">
              <button type="submit" class="btn-md button-theme btn-block" >login</button>
          </div>
      </form>
      <!-- Social List -->
      <ul class="social-list clearfix">
        <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
    </ul>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Forgot</h5>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="form-content-box">
                <!-- details -->
                <div class="details">
                    <!-- Logo -->
                    <h3> Property Management Tool </h3>
                    <!-- Form start -->
                    <form action="index.html" method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="input-text" placeholder="Email Address">
                        </div>

                        <br>
                        <div class="form-group mb-0 mt-2">
                            <button type="submit" class="btn-md button-theme btn-block" >Forgot</button>
                        </div>
                    </form>
                    <!-- Social List -->
                    <ul class="social-list clearfix">
                        <li><a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="google-bg"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Login2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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



                                <form action="" role="form" id="msform">
                                    <input id="step2" type="checkbox">
                                    <input id="step3" type="checkbox">
                                    <input id="step4" type="checkbox">
                                    <input id="step5" type="checkbox">
                                    <input id="step6" type="checkbox">
                                    <input id="step7" type="checkbox">
                                    <input id="step8" type="checkbox">
                                    <input id="step9" type="checkbox">
                                    <input id="step10" type="checkbox">
                                  {{--  <input id="step11" type="checkbox">
                                    <input id="step12" type="checkbox">--}}



                                    <div id="part1">

                                        <label>What is your first name?</label>
                                        <input type="text" class="form-control" placeholder="Name" name="first_name" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:1%"> <span class="sr-only">0% Complete</span> </div>
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
                                        <input placeholder="Last Name" class="form-control" type="text" name="last_name">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%"> <span class="sr-only">10% Complete</span> </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                            <label for="step2" id="back-step2" class="back">
                                                <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                            </label>
                                              

                                            <label for="step3" id="continue-step3" class="continue">
                                                <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                            </label>

                                        </div>
                                    </div>

                                    <div id="part3">


                                        <label>How Did You hear About Us:</label>
                                        <!--<div class="dropdown bootstrap-select search-fields">-->
                                            <select class="form-control search-fields" tabindex="-98"  name="about_us_source">
                                                <option value="Billborad">Billborad</option>
                                                <option value="Radio">Radio</option>
                                                <option value="Web Search">Web Search</option>
                                                <option value="Refered By a Friend">Refered By a Friend</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <!--<button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="button" title="Billborad"><div class="filter-option"><div class="filter-option-inner">Billborad</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div>-->
                                            <!--</div>-->
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%"> <span class="sr-only">20% Complete</span> </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                <label for="step3" id="back-step3" class="back">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                                </label>

                                                  
                                                <label for="step4" id="continue-step4" class="continue">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                                </label>

                                            </div>
                                        </div>

                                        <div id="part4">


                                            <label>Ok... and your email address?</label>
                                            <input placeholder="Email Address" class="form-control" type="email" name="email">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%"> <span class="sr-only">30% Complete</span> </div>
                                            </div>

                                            <br>
                                            <br>
                                            <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                <label for="step4" id="back-step4" class="back">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                                </label>

                                                  
                                                <label for="step5" id="continue-step5" class="continue">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                                </label>

                                            </div>
                                        </div>


                                        <div id="part5">


                                            <label>What is the best number to call you on?</label>
                                            <input placeholder="Phone Number" class="form-control" type="text"  name="phone">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%"> <span class="sr-only">40% Complete</span> </div>
                                            </div>
                                            <br>
                                            <br>

                                            <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                <label for="step5" id="back-step5" class="back">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                                </label>

                                                  
                                                <label for="step6" id="continue-step6" class="continue">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                                </label>

                                            </div>
                                        </div>



                                        <div id="part6">


                                            <label>Are you willing to learn about owning and managing
                                            income properties?</label><br>
                                            <div class="btn_radio">

                                                <input type="radio" name="manage_income_property" value="1">

                                                <span>yes</span>

                                                <input type="radio" name="manage_income_property" value="0">

                                                <span>No</span>

                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                <label for="step6" id="back-step6" class="back">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                                </label>

                                                  
                                                <label for="step7" id="continue-step7" class="continue">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                                </label>

                                            </div>
                                        </div>


                                        <div id="part7">


                                            <label>ok... just a couple more questions... what
                                            interests you about what we offer?</label>
                                            <input placeholder="Enter Interest" class="form-control" type="text" name="interest">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%"> <span class="sr-only">60% Complete</span> </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                <label for="step7" id="back-step7" class="back">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                                </label>
                                                  

                                                <label for="step8" id="continue-step8" class="continue">
                                                    <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                                </label>

                                            </div>
                                        </div>

                                        <div id="part8">


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
                                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%"> <span class="sr-only">70% Complete</span> </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                    <label for="step8" id="back-step8" class="back">
                                                        <div class="btn btn-theme btn-sm customNavBtn" role="button">Back</div>
                                                    </label>
                                                      

                                                    <label for="step9" id="continue-step9" class="continue">
                                                        <div class="btn btn-theme btn-sm customNavBtn" role="button">Continue</div>
                                                    </label>

                                                </div>
                                            </div>


                                            <div id="part9">


                                                <div class="text-center"> <img src="img/favicon.png" width="200px" height="150px"> </div><br>
                                                <p>Because of the nature of our business, we require all new members to
                                                    participate in our training class and pass our exam so you understand
                                                    everything. At this point, you have two options:<br><br>
                                                    1) If you are already familiar with everything and are ready to hit the ground
                                                    running, please join. You will have access to our site, but will be limited on your
                                                    transactions until you have passed a knowledge based test. We will contact you shortly to
                                                    schedule a time to participate in our training and test.<br><br>
                                                    2) Don't join now and we will contact you shortly to schedule the training. You will not have access to the site, but can join once you have gone through
                                                training.</p>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%"> <span class="sr-only">80% Complete</span> </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">

                                                    <label for="step10" id="back-step10" class="back">
                                                        <div class="btn btn-theme btn-sm customNavBtn" id="register_now" type="submit" role="button">Join Now</div>
                                                    </label>

                                                      
                                                    <label for="step11" id="continue-step11" class="continue">
                                                        <div class="btn btn-theme btn-sm customNavBtn" role="button" id="contact_me_first" type="submit">Contact me First</div>
                                                    </label>

                                                </div>
                                            </div>


                                         {{--   <div id="part10">


                                                <div class="text-center"> <img src="img/favicon.png" width="200px" height="150px"> </div><br>
                                                <p>We are excited to have you as a part of the family!
                                                    Please complete all of the inforation below and you will shortly be open to our
                                                site. We look forward to working with you!</p>
                                                <label>Which membership would you like to purchase?:</label>
                                                <!--<div class="dropdown bootstrap-select search-fields">-->
                                                    <select class="form-control search-fields" tabindex="-98">
                                                        <option>Month to Month $15</option>
                                                        <option>Annual $99</option>

                                                    </select>
                                                    <!--<button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="button" title="Month to Month $10"><div class="filter-option"><div class="filter-option-inner">Month to Month $10</div></div>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu " role="combobox"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1"><ul class="dropdown-menu inner show"></ul></div></div></div>-->
                                                    <br><br>
                                                    <input type="text" placeholder="Name as it appears on your credit card" class="form-control">
                                                    <br><br>
                                                    <input type="radio" name="abc" value="">Visa
                                                    <input type="radio" name="abc" value="" style="margin-left: 3%">MC
                                                    <input type="radio" name="abc" value="" style="margin-left: 3%">AMEX
                                                    <input type="radio" name="abc" value="" style="margin-left: 3%">Discover
                                                    <br><br>

                                                    <input type="text" placeholder="Credit Card Number" class="form-control">
                                                    <br><br>
                                                    <div id="sandbox-container" class="mt-20">

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Expiration Date</label>
                                                                <input type="text" class="form-control" placeholder="1/1/2019">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>CVC</label>
                                                                <input type="text" class="form-control" placeholder="CVC">
                                                            </div>

                                                        </div></div>
                                                        <br>
                                                        <p>By submitting payment information, you agree to the terms and conditions and
                                                        Privancy Policy found here.</p>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%"> <span class="sr-only">90% Complete</span> </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="btn-group btn-group-lg" role="group" aria-label="...">
                                                            <label for="step11" id="continue-step11" class="continue">
                                                                <div class="btn btn-theme btn-sm customNavBtn" onclick="$('#part10').hide()">Submit</div>
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div id="part11">


                                                        <div class="text-center">  <img src="img/favicon.png" width="200px" height="150px"></div>
                                                        <p>Thank you for your interest in Property Management Tool! We will have one of our
                                                            representatives contact you shortly to discuss next steps. If you
                                                            just joined, please click the Log In buttion and you will be redirected to
                                                        the login page.</p>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"> <span class="sr-only">100% Complete</span> </div>
                                                        </div>


                                                        <br>
                                                        <br>
                                                        <div class="btn-group btn-group-lg" role="group" aria-label="...">
                                                            <label for="step11" id="back-step11" class="back">
                                                                <a class="btn btn-theme btn-sm customNavBtn" href="javascript:void(0)" data-toggle="modal" data-target="#Login">Login</a>
                                                            </label>   
                                                            <label class="continue">
                                                                <a href="index.html" class="btn btn-theme btn-sm customNavBtn">Close</a>
                                                            </label>
                                                        </div>
                                                    </div>--}}

                                                </form>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="LoginF" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancelSaleLabel">Login</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="form-content-box">
                                <!-- details -->
                                <div class="details">
                                    <!-- Logo -->
                                    <h3> Property Management Tool </h3>
                                    <!-- Form start -->
                                    <form action="{{URL::Route('forgot')}}" method="post">
                                        <div class="text-center"><img src="img/logo.png"></div>
                                        <p>Forgot password? Please enter your email address and we will send you a link to reset your password
                                        </p>
                                        <div class="form-group">
                                            <input type="email" name="email" class="input-text" placeholder="Email Address">
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
@endsection
