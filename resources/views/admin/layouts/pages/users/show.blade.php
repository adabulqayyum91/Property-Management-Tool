@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    User Detail | Admin Panel
@endsection
@section('content')
    <style>
        .form-control {
            margin: 0;
            width: 100%;
        }

        .btn-faqs {
            margin-top: 35px;
        }

        .profile-list {
            margin: 0;
            padding: 0;
            list-style: none;
            color:#000;
        }

        .profile-photo {
            position: relative;
            cursor: pointer;
            margin-right: 10%;
            margin-bottom: 10px;
        }
        .profile-photo img {
            width: 100%;
            display: block;
        }
         .profile-info {
            color: #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
            border-bottom: 1px solid #dedede;
        }

        .profile-position {
            font-size: 36px;
            font-weight: 400;
            line-height: 1.1;
            margin-bottom: 0;
            color:#000;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr">
                                                    <span>
                                                        User Detail
                                                    </span>
                                                </div>

                                                <div class="container">
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"><b><i class="fa fa-user-circle-o"--}}
                                                                                            {{--aria-hidden="true"></i>--}}
                                                                {{--</b>: {{!is_null($currentUser->name) ? $currentUser->name : ''}}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"> <b><i class="fa fa-envelope"--}}
                                                                                             {{--aria-hidden="true"></i>--}}
                                                                    {{--:--}}
                                                                {{--</b> {{!is_null($currentUser->email) ? $currentUser->email : ''}}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"><b><i class="fa fa-phone-square"--}}
                                                                                            {{--aria-hidden="true"></i>--}}
                                                                    {{--:--}}
                                                                {{--</b> {{!is_null($currentUser->phone) ? $currentUser->phone : ''}}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}

                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"><b>Your--}}
                                                                    {{--Interest:</b> {{ $currentUser->interest ? $currentUser->interest : ''}}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"><b>Manage income--}}
                                                                    {{--property:</b> {{ $currentUser->manage_income_property==0  ? 'No' : 'Yes' }}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"><b>How Found--}}
                                                                    {{--Us:</b> {{ $currentUser->about_us_source  ? $currentUser->about_us_source : ''}}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label"><b>Best time to contact--}}
                                                                    {{--you:</b> {{ $currentUser->contact_timing  ? $currentUser->contact_timing : ''}}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-md-6">--}}
                                                            {{--<label class="form-label">--}}
                                                                {{--<b>Status:</b> {{ $currentUser->status == 0 ? 'In Active' : 'Active' }}--}}
                                                            {{--</label>--}}
                                                        {{--</div>--}}

                                                        {{--<div class="col-md-2">--}}

                                                        {{--</div>--}}
                                                    {{--</div>--}}

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="profile-photo">
                                                                <img src="{{asset('img/avatar.png')}}"
                                                                     class="photo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="profile-info">
                                                                <h2 class="profile-position">
                                                                    {{$currentUser->first_name}} {{$currentUser->last_name}}
                                                                </h2>
                                                            </div>
                                                            <ul class="profile-list">

                                                                {{--<li class="clearfix">--}}
                                                                    {{--<label class="form-label"><b><i--}}
                                                                                    {{--class="fa fa-user-circle-o"--}}
                                                                                    {{--aria-hidden="true"></i>--}}
                                                                        {{--</b>: {{!is_null($currentUser->name) ? $currentUser->name : ''}}--}}
                                                                    {{--</label>--}}
                                                                {{--</li>--}}

                                                                <li class="clearfix">
                                                                    <label class="form-label"> <b><i
                                                                                    class="fa fa-envelope"
                                                                                    aria-hidden="true"></i>
                                                                            :
                                                                        </b> {{!is_null($currentUser->email) ? $currentUser->email : ''}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label"><b><i
                                                                                    class="fa fa-phone-square"
                                                                                    aria-hidden="true"></i>
                                                                            :
                                                                        </b> {{!is_null($currentUser->phone) ? $currentUser->phone : ''}}
                                                                </label>
                                                                </li>
                                                                @if($currentUser->role->role->id!=1)
                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Street: </b>
                                                                        {{ is_null($currentUser->street) ? 'N/A': $currentUser->street}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>City: </b>
                                                                        {{ is_null($currentUser->city) ? 'N/A': $currentUser->city}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>State: </b>
                                                                        {{ is_null($currentUser->state) ? 'N/A': $currentUser->state}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Zip: </b>
                                                                        {{ is_null($currentUser->zip) ? 'N/A': $currentUser->zip}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>DOB: </b>
                                                                        {{ is_null($currentUser->date_of_birth) ? 'N/A': Carbon\Carbon::parse($currentUser->date_of_birth)->format("m/d/Y")}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>SSN: </b>
                                                                        {{ is_null($currentUser->social_security_number) ? 'N/A': Helper::hideStringLastPart($currentUser->social_security_number,4)}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Your Interest:</b> 
                                                                        {{ is_null($currentUser->interest) ? 'N/A': $currentUser->interest}}
                                                                    </label>
                                                                </li>


                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Manage
                                                                            income
                                                                            property:</b> {{ $currentUser->manage_income_property==0  ? 'No' : 'Yes' }}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>How
                                                                            Found
                                                                            Us:</b> {{ $currentUser->about_us_source  ? $currentUser->about_us_source : ''}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Best
                                                                            time to contact
                                                                            you:</b> {{ $currentUser->contact_timing  ? $currentUser->contact_timing : ''}}
                                                                    </label>
                                                                </li>


                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Status:</b> {{ $currentUser->status == 0 ? 'In Active' : 'Active' }}
                                                                    </label>
                                                                </li>

                                                                @endif
                                                                 @if(!is_null($currentUser->defaultPaymentMethod()))
                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Brand:</b>
                                                                        {{ $currentUser->defaultPaymentMethod()->card->brand ? $currentUser->defaultPaymentMethod()->card->brand : ''}}
                                                                    </label>
                                                                </li>


                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Country</b>
                                                                        {{ $currentUser->defaultPaymentMethod()->card->country  ? $currentUser->defaultPaymentMethod()->card->country : '' }}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Postal Code</b>
                                                                        {{ $currentUser->defaultPaymentMethod()->billing_details->address->postal_code  ? $currentUser->defaultPaymentMethod()->billing_details->address->postal_code : ''}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Expiry</b>
                                                                        {{ $currentUser->defaultPaymentMethod()->card->exp_month ? $currentUser->defaultPaymentMethod()->card->exp_month.'/'.$currentUser->defaultPaymentMethod()->card->exp_year : ''}}
                                                                    </label>
                                                                </li>

                                                                <li class="clearfix">
                                                                    <label class="form-label"><b>Next Billing Detail</b>
                                                                        {{ Helper::nextBillingDate($currentUser->asStripeCustomer()->id) }}
                                                                    </label>
                                                                </li>


                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Card:</b> ***-**{{$currentUser->defaultPaymentMethod()->card->last4?$currentUser->defaultPaymentMethod()->card->last4:''}}
                                                                    </label>
                                                                </li>
                                                                @endif
                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Plan:</b> {{$currentUser->plan?$currentUser->plan->name:''}}
                                                                    </label>

                                                                </li>
                                                                <li class="clearfix">
                                                                    <label class="form-label">
                                                                        <b>Charges:</b> ${{$currentUser->plan?$currentUser->plan->price:''}}
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!is_null($currentUser->defaultPaymentMethod()))
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"><span>Invoice Info</span>
                                                    </div>

                                                    <div class="container">

                                                        <div class="row">

                                                            <table id="example" class="table box-shadow table-bordered" style="width:100%">
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

                                                                @foreach($currentUser->invoices() as $i=> $invoice)
                                                                    <tr>
                                                                        <td>{{ !is_null($i) ? $i++ : ''}}</td>
                                                                        <td>{{ !is_null($invoice->status) ? $invoice->status : ''}}</td>
                                                                        <td>{{ !is_null($invoice->period_start) ? \Carbon\Carbon::createFromTimestamp($invoice->period_start) : ''}}</td>
                                                                        <td>{{ !is_null($invoice->period_end) ? \Carbon\Carbon::createFromTimestamp($invoice->period_end) : ''}}</td>
                                                                        <td>
                                                                            <a href="{{$currentUser->plan?url($invoice->invoice_pdf):''}}">
                                                                                <i class="fa fa-download" aria-hidden="true"> </i>
                                                                            </a>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>


                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
