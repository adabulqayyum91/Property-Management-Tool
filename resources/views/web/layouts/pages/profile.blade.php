@extends('web.layouts.partials.app')
@section('page_title')
    Profile | Property Management Tool
@endsection
@section('css')
    <style>
        #card-errors {
            color: #FF0000;
            padding-top: 10px;
        }
        .form-control{
            margin: 0;
            width: 100%;
        }
        /*.btn-faqs{*/
        /*margin-top: 35px;*/
        /*}*/
        .datepicker td, .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker {
            margin-bottom: 0;
            z-index: 1000 !important;
        }
        .profile-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .profile-list li a{

            padding: 0 !important;

        }
        .profile-list .title {
            display: block;
            width: 150px;
            float: left;
            color: #333333;
            font-size: 14px;
            font-weight: 700;
            line-height: 25px;
            text-transform: uppercase;
        }
        .profile-list .cont {
            display: block;
            margin-left: 125px;
            font-size: 15px;
            font-weight: 400;
            line-height: 25px;
            /*color: #9da0a7;*/
        }
        .leaving-label{
            font-size: 20px !important;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')



    <!-- Contact 2 start -->

    {{--<div class="faq content-area-9">--}}

        {{--<div class="container">--}}

            <!-- Main title -->


    <div class="dashboard">
        <div class="container-fluid">

            <div class="row">
                @include('web.layouts.partials.sideBar')

                <div class="col-lg-10 col-md-10 col-sm-10 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="">
                                    <div class="profile-photo">
                                        <form action="{{url('profiles',$currentUser->id)}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf

                                            <label class="btn btn-block btn-file-upload">
                                                {{--@dd($currentUser->photo)--}}
                                                <!-- @if(isset($currentUser->photo))
                                                    <img src="{{asset('uploads/user_profile/'.$currentUser->photo)}}" class="photo" width="100%" alt=""
                                                         style="display: block; margin:0 auto;">
                                                    <input type="file" name="photo" class="w-full" style="display: none;">
                                                @else
                                                    <img src="{{asset('img/avatar.png')}}" class="photo" width="100%" alt=""
                                                         style="display: block; margin:0 auto;">
                                                    <input type="file" name="photo" class="w-full" style="display: none;">
                                                @endif -->
                                            </label>
                                    </div>
                                </div>
                                <div  class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Profile</span></div>


                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label">First Name:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow w-full m-0" placeholder="First Name" name="first_name"
                                                                    value="{{ isset($currentUser) ? $currentUser->first_name : '' }}" required>
                                                                    @if($errors->has('first_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('first_name') }}
                                                                            </div>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Last Name:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow w-full m-0" placeholder="Last Name" name="last_name"
                                                                    value="{{ isset($currentUser) ? $currentUser->last_name : '' }}" required>
                                                                    @if($errors->has('last_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('last_name') }}
                                                                            </div>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow w-full m-0" placeholder="Email" name="email"
                                                                    value="{{ isset($currentUser) ? $currentUser->email : '' }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Date of Birth:</label>
                                                            <div class="form-group">
                                                                <div class="date input-group p-0 shadow-sm" id="dateOfBirth">
                                                                    <input type="text" placeholder="Date of Birth" class="form-control box-shadow" name="date_of_birth"
                                                                        value="{{ isset($currentUser) ? $currentUser->date_of_birth : '' }}">
                                                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                </div>

                                                                @if($errors->has('date_of_birth'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('date_of_birth') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <label>Phone:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow w-full m-0" placeholder="Phone" name="phone" id="profile_phone"
                                                                    value="{{ isset($currentUser) ? $currentUser->phone : '' }}" required >
                                                                    @if($errors->has('profile_phone'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('profile_phone') }}
                                                                            </div>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>SSN:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow w-full m-0" placeholder="Social Security Number" name="social_security_number"
                                                                    value="{{ isset($currentUser) ? $currentUser->social_security_number : '' }}" required >
                                                                    @if($errors->has('social_security_number'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('social_security_number') }}
                                                                            </div>
                                                                    @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Street:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Street" name="street"
                                                                    value="{{ isset($currentUser) ? $currentUser->street : '' }}" required>
                                                                    @if($errors->has('street'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('street') }}
                                                                            </div>
                                                                    @endif
                                                           </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">City:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="City" name="city"
                                                                    value="{{ isset($currentUser) ? $currentUser->city : '' }}" require>
                                                                    @if($errors->has('city'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('city') }}
                                                                            </div>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">State:</label>
                                                            <div class="form-group">
                                                                <select class="form-control box-shadow" name="state" style="height: 45px;">
                                                                    <option selected  disabled="disabled"> Select State </option>
                                                                    @foreach($states as $state)
                                                                        <option value="{{$state->id}}"  {{$state->id==$currentUser->state ? ' selected' : ''}} >
                                                                            {{$state->name}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('state'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('state') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Zip:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Zip" name="zip"
                                                                    value="{{ isset($currentUser) ? $currentUser->zip : '' }}" required>
                                                                    @if($errors->has('zip'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('zip') }}
                                                                            </div>
                                                                    @endif
                                                            </div>
                                                        </div>


                                                    <div class="col-md-12 pl-0 mt-3">
                                                        <input type="submit" class="btn btn-sm btn-primary btn-faqs box-shadow float-right" value="Update">
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!is_null($detail))
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <table class="table box-shadow table-bordered mt-4" style="width:100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Brand</td>
                                                                        <td>{{$detail->brand}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Country</td>
                                                                        <td>{{$detail->country}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Postal Code</td>
                                                                        <td>{{$billingInfo->address->postal_code}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Expiry</td>
                                                                        <td>{{$detail->exp_month}}/{{$detail->exp_year}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Card</td>
                                                                        <td>***-**{{$detail->last4}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Next Billing Date</td>
                                                                        <td>{{ Helper::nextBillingDate($currentUser->asStripeCustomer()->id) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>E-mail</td>
                                                                        <td><a href="mailto:"{{$billingInfo->email}}>{{$billingInfo->email}}</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td>{{$billingInfo->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Plan Subscription Start Period</td>
                                                                        <td>{{ !is_null($subscription->current_period_start) ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_start)->format('m/d/Y') : ''}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Plan Subscription End Period</td>
                                                                        <td>{{ !is_null($subscription->current_period_end) ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('m/d/Y') : ''}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            {{-- TODO: Old Logic for futue use --}}
                                                            {{-- <ul class="profile-list">
                                                                <li class="clearfix">
                                                                    <strong class="title">Brand</strong>
                                                                    <span class="cont">{{$detail->brand}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Country</strong>
                                                                    <span class="cont">{{$detail->country}}</span>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <strong class="title">Postal Code</strong>
                                                                    <span class="cont">{{$billingInfo->address->postal_code}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Expiry</strong>
                                                                    <span class="cont">{{$detail->exp_month}}/{{$detail->exp_year}}</span>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <strong class="title">Card</strong>
                                                                    <span class="cont">***-**{{$detail->last4}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Next Billing Detail
                                                                    </strong>
                                                                    <span class="cont">
                                                                        {{ Helper::nextBillingDate($currentUser->asStripeCustomer()->id) }}
                                                                    </span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">E-mail</strong>
                                                                    <span class="cont"><a href="mailto:"{{$billingInfo->email}}>{{$billingInfo->email}}</a></span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Name</strong>
                                                                    <span class="cont">{{$billingInfo->name}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Plan</strong>
                                                                    <span class="cont">{{$currentUserPlan->name}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Plan Subscription Start Period</strong>
                                                                    <span class="cont"> {{ !is_null($subscription->current_period_start) ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_start)->format('m/d/Y') : ''}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <strong class="title">Plan Subscription End Period</strong>
                                                                    <span class="cont"> {{ !is_null($subscription->current_period_end) ? \Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->format('m/d/Y') : ''}}</span>
                                                                </li>
                                                                <li class="clearfix">
                                                                    <button class="{{$subscription->cancel_at_period_end == false?'subscribe':''}}">{{$subscription->cancel_at_period_end == false?'Subscribe':'Un Subscribe'}}</button>
                                                                    <span id="un-sub"></span>
                                                                    @if($subscription->cancel_at_period_end == true)
                                                                        <span class="cont">Your subscription has been set to cancel at the end of the billing period</span>
                                                                    @endif
                                                                </li>
                                                            </ul> --}}
                                                        </div>
                                                    </div>

                                                </div>
                                                </form>
                                            </div>
                                            <table id="example" class="table box-shadow table-bordered mt-4" style="width:100%">
                                                <thead class="bg-active">
                                                <tr>
                                                    <th>#</th>
                                                    <th>status</th>
                                                    <th>Issued Date</th>
                                                    <th>End Date</th>
                                                    <th>Invoice</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($invoices as $i=> $invoice)
                                                    <tr>
                                                        <td>{{ $loop->iteration  }}</td>
                                                        <td>{{ !is_null($invoice->status) ? $invoice->status : ''}}</td>
                                                        <td>{{ !is_null($invoice->period_start) ? \Carbon\Carbon::createFromTimestamp($invoice->period_start)->format('m/d/Y'): ''}}</td>
                                                        <td>{{ !is_null($invoice->period_end) ? \Carbon\Carbon::createFromTimestamp($invoice->period_end)->format('m/d/Y'): ''}}</td>
                                                        <td>
                                                            <a href="{{url($invoice->invoice_pdf)}}">
                                                                <i class="fa fa-download" aria-hidden="true"> </i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif

                                    @if(is_null($currentUser->provider))
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Change Password</span></div>
                                                <form action="{{url('changePassword',$currentUser->id)}}" method="POST">
                                                    @csrf

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Old Password:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow w-full m-0" placeholder="Old Password"
                                                                           name="old_password" required>
                                                                    @if($errors->has('old_password'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('old_password') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">New Password:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow w-full m-0" placeholder="New Password"
                                                                           name="password" required>
                                                                    @if($errors->has('password'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('password') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Confirm Password:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow w-full m-0" placeholder="Confirm Password"
                                                                           name="confirm_password" required>
                                                                    @if($errors->has('confirm_password'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('confirm_password') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 pl-0">
                                                            <input type="submit" class="btn btn-sm btn-primary btn-faqs box-shadow float-right" value="Update">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    {{-- <div class="dashboard-list">
                                         <div class="dashboard-message bdr clearfix ">
                                             <div class="tab-box-2">
                                                 <div class="clearfix mb-30 comments-tr"> <span>Membership fee Structure</span></div>
                                                 <form action="" method="POST">
                                                     @csrf

                                                     <div class="container">
                                                         <div class="row">
                                                             <div class="col-md-6">
                                                                 <label class="form-label">Select Membership:</label>
                                                                 <div class="form-group">
                                                                     <select class="form-control box-shadow" name="type" style="height: 45px;">
                                                                         <option value="monthlyfee">Monthly Fee</option>
                                                                         <option value="annualfee">Annual Fee</option>

                                                                     </select>

                                                                 </div>
                                                             </div>
                                                             <div class="col-md-6">
                                                                 <label class="form-label">Membership Fee:</label>
                                                                 <div class="form-group">
                                                                     <input type="text" class="form-control box-shadow w-full m-0" placeholder="Membership Fee"
                                                                            name="password" required>

                                                                 </div>
                                                             </div>
                                                             <div class="col-md-2">
                                                                 <input type="submit" class="btn btn-sm btn-primary btn-faqs box-shadow" value="Save">
                                                             </div>

                                                         </div>


                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>--}}

                                     @if(!is_null($detail))
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Payment Detail</span></div>
                                                <form action="" method="POST">
                                                    @csrf

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Current Credit Card Ending in:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow w-full m-0" value="{{$detail->last4}}" readonly>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">CC Expires:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow w-full m-0" value="{{$detail->exp_month}}/{{$detail->exp_year}}" readonly>

                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Change Payment Information</span></div>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            {{--<label class="form-label">Select Plan :</label>--}}
                                                            {{--  <div class="form-group">
                                                                  <select class="form-control box-shadow" name="type" style="height: 45px;">
                                                                      <option value="visa">Visa</option>
                                                                      <option value="mastercard">Master Card</option>
                                                                      <option value="americanexpress">American Express</option>
                                                                      <option value="discover">Discover</option>

                                                                  </select>

                                                              </div>--}}

                                                            {{--   <div class="form-group">
                                                                   <select class="form-control box-shadow" name="type" style="height: 45px;">                                                                        @foreach($plans as $plan)
                                                                           <option value="{{ $plan->stripe_plan }}">{{ $plan->name }} ${{$plan->price}}</option>
                                                                       @endforeach


                                                                   </select>
                                                               </div>--}}
                                                            <form action="{{ url('stripeUpdate') }}" method="post" id="payment-form">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <div class="card-body box-shadow" style="border-radius:3px;border: 1px solid #eee;height: 45px;padding: 12px;">
                                                                        <div id="card-element">
                                                                            <!-- A Stripe Element will be inserted here. -->
                                                                        </div>
                                                                        <!-- Used to display form errors. -->
                                                                        <div id="card-errors" role="alert"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group float-right">
                                                                    {{--<div class="btn-group btn-group-lg" role="group" aria-label="...">--}}
                                                                          
                                                                        <label for="step11" id="continue-step11" class="continue" style="float: left;">
                                                                            <div class="card-footer3">
                                                                                <button class="btn btn-sm btn-primary btn-faqs box-shadow stripeUpdate float-right"
                                                                                        type="submit">Update
                                                                                </button>
                                                                            </div>
                                                                        </label>
                                                                    {{--</div>--}}
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                     @endif
                                </div>

                                <a style="color: white;width: 100%;margin-bottom: 10px;" class="btn btn-danger float-right" type="button" data-toggle="modal" data-target="#deleteAccountRequest">Delete Account</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="deleteAccountRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountRequestLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body text-center">
                    <div class="link mt-20 mb-20">
                        <form method="POST" id="deleteAccountRequestForm">
                            @csrf
                            <label class="leaving-label">
                                We are sorry to see you go. Would you be willing to share the reason for your departure?
                            </label>
                            <textarea class="form-control" rows="8" name="reason_leaving"></textarea>
                            <input type="submit" value="Send Request" class="btn btn-primary"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--</div>--}}


    {{--</div>--}}


@endsection

@section('script')

    <script src="https://js.stripe.com/v3/"></script>

    <script>

        $(document).ready(function() {

            $('#dateOfBirth').datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        $("#deleteAccountRequestForm").submit(function(e){
            e.preventDefault();
            var url="{{ url('accountDeleteRequest') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        // $("#ven-id").empty().html(response.view);
                        // window.location.reload();
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        toastr.error(item);
                    });
                }
            });
        });
        // Create a Stripe PAyment form.
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

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            if (event.error) {
                $('#card-errors').html(event.error.message);
            } else {
                $('#card-errors').html('');
            }
        });
        var form = document.getElementById('payment-form');
        //        card.addEventListener('change', function(event) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var name = '{{$currentUser->first_name.' '.$currentUser->last_name}}';
            var email = '{{$currentUser->email}}';
            stripe.createPaymentMethod(
                'card', card, {
                    billing_details: {
                        name: name ,
                        email: email
                    }
                }
            )

                .then(function (result) {
                    stripeTokenHandler(result.paymentMethod);

                    // Handle result.error or result.paymentMethod
                });

        });

        // Submit the form with the payment method ID.
        function stripeTokenHandler(result) {
            var user_id = '{{$currentUser->id}}';
            var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                beforeSend: function () {
                    $('.stripeUpdate').html(loading + ' Processing').attr('disabled','disabled');
                },
                url: "{{ url('stripeUpdate') }}",
                dataType: 'json',
                data: {
                    'brand': result.card.brand,
                    'last_four_digit': result.card.last4,
                    'stripeToken': result.id,
                    'user_id': user_id
                },
                error: function (error) {
                    toastr.error(data.message, 'Error', {timeOut: 5000})
                    $('.stripeUpdate').html('Update').removeAttr('disabled');

//                    alert('Something went wrong. Please try again later.');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('.stripeUpdate').html('Update').removeAttr('disabled');

                        toastr.success(data.message, 'Success', {timeOut: 5000})

                    } else {
                        $('.stripeUpdate').html('Update').attr('disabled','disabled');
                        toastr.error(data.message, 'Error', {timeOut: 5000})
                        return false;
                    }
                },
                type: 'POST'
            });
        }
        $('.subscribe').click(function(){
            var $this = $(this);
            var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            if($this.hasClass('subscribe')){
                $this.html(loading + ' Processing').attr('disabled','disabled');
                $.ajax({
                    url: "{{route('unsubscribe')}}",
                    type: 'GET',
                    success: function(response) {
                        toastr.error(response.message, 'Error', {timeOut: 5000});
                        $this.html('Un Subscribe').attr('disabled','disabled');
                        $('#un-sub').text('Your subscription has been set to cancel at the end of the billing period');
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    }
                });
            } else {
                $this.text('Subscribe');
            }
        });

    </script>
@endsection
