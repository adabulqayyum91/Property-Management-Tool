@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    View Plan | Admin Panel
@endsection
@section('css')
    <style>
        .profile-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .profile-list li {
            padding-bottom: 10px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .profile-list .title {
            display: block;
            width: 170px;
            float: left;
            color: #212529;
            font-size: 16px;
            font-weight: bold;
            line-height: 20px;
        }
        .profile-list .cont {
            display: block;
            margin-left: 125px;
            font-size: 16px;
            font-weight: 400;
            line-height: 20px;
            color: #212529;
        }</style>
@endsection
@section('content')

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
                                                                <ul class="profile-list">
                                                                    <li class="clearfix">
                                                                        <strong class="title">Plan Name:</strong>
                                                                        <span class="cont">{{!is_null($currentPlan->name) ? $currentPlan->name : ''}}</span>
                                                                    </li>
                                                                    <li class="clearfix">
                                                                        <strong class="title">Plan Price</strong>
                                                                        <span class="cont">{{!is_null($currentPlan->price) ? $currentPlan->price : ''}}</span>
                                                                    </li>

                                                                    <li class="clearfix">
                                                                        <strong class="title">Description</strong>
                                                                        <span class="cont">{!! !is_null($currentPlan->description) ? $currentPlan->description : ''!!}</span>
                                                                    </li>
                                                                </ul>
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
