@extends('web.layouts.partials.app')
@section('page_title')
    View Referal User | Admin Panel
@endsection
@section('css')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
        }
        .btn-faqs{
            margin-top: 35px;
        }
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
        }
    </style>
@endsection
@section('content')

    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('web.layouts.partials.sideBar')

                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>View Referral Friend</span></div>
                                                <form action="{{route('plans.update',$refferal->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">


                                                            <div class="col-md-12">
                                                                <ul class="profile-list">
                                                                    <li class="clearfix">
                                                                        <strong class="title">Name:</strong>
                                                                        <span class="cont">{{!is_null($refferal->name) ? $refferal->name : ''}}</span>
                                                                    </li>
                                                                    <li class="clearfix">
                                                                        <strong class="title">E-mail</strong>
                                                                        <span class="cont">{{!is_null($refferal->email) ? $refferal->email : ''}}</span>
                                                                    </li>
                                                                    <li class="clearfix">
                                                                        <strong class="title">Phone</strong>
                                                                        <span class="cont">{{!is_null($refferal->phone) ? $refferal->phone : ''}}</span>
                                                                    </li>
                                                                    <li class="clearfix">
                                                                        <strong class="title">Contact Source</strong>
                                                                        <span class="cont">{{!is_null($refferal->contact_source) ? $refferal->contact_source : ''}}</span>
                                                                    </li>
                                                                    <li class="clearfix">
                                                                        <strong class="title">Status</strong>
                                                                        <span class="cont">{{!is_null($refferal->status) ? $refferal->status : ''}}</span>
                                                                    </li>
                                                                    <li class="clearfix">
                                                                        <strong class="title">Description</strong>
                                                                        <span class="cont">{{!is_null($refferal->description) ? $refferal->description : ''}}</span>
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
