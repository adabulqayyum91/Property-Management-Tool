@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    View  Referral User | Admin Panel
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
                                                <div class="clearfix mb-30 comments-tr"> <span>View Plan</span></div>
                                                <form action="{{route('plans.update',$currentPlan->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label"><b>Plan Name: </b> {{!is_null($currentPlan->name) ? $currentPlan->name : ''}}</label>


                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label"><b>Plan Price: </b> {{!is_null($currentPlan->price) ? $currentPlan->price : ''}}</label>

                                                            </div>
                                                            <div class="col-md-12">
                                                                <label><b>Description: </b> {{!is_null($currentPlan->description) ? $currentPlan->description : ''}}</label>

                                                            </div>
                                                            <div class="col-md-2">
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
        </div>
    </div>

@endsection
