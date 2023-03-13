@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    User Detail | Admin Panel
@endsection
@section('content')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
        }
        .btn-faqs{
            margin-top: 35px;
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
                                                <div class="clearfix mb-30 comments-tr"> <span>User Detail</span></div>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><b><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                                                        </b>: {{!is_null($user->name) ? $user->name : ''}}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"> <b><i class="fa fa-envelope" aria-hidden="true"></i>
                                                                        : </b> {{!is_null($user->email) ? $user->email : ''}}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><b><i class="fa fa-phone-square" aria-hidden="true"></i>
                                                                        : </b> {{!is_null($user->phone) ? $user->phone : ''}}</label>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label"><b>Your Interest:</b> {{ $user->interest ? $user->interest : ''}}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><b>Manage income property:</b> {{ $user->manage_income_property==0  ? 'No' : 'Yes' }}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><b>How Found Us:</b> {{ $user->about_us_source  ? $user->about_us_source : ''}}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><b>Best time to contact you:</b> {{ $user->contact_timing  ? $user->contact_timing : ''}}</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"> <b>Status:</b> {{ $user->status == 0 ? 'In Active' : 'Active' }}</label>
                                                            </div>

                                                            <div class="col-md-2">

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
        </div>
    </div>

@endsection
