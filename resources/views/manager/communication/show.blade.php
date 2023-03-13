@extends('manager.layouts.partials..dashboardApp')
@section('page_title')
    Communication Detail | Manager Panel
@endsection
@section('content')
    <style>
        label{
            font-weight: bold;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('manager.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="clearfix mb-30 comments-tr">
                                                <span>Message Details</span>
                                            </div>
                                            <label>From:</label> {{$communication->fromUser->first_name}} {{$communication->fromUser->last_name}}
                                            <br>
                                            <label>Venture:</label> {{$communication->venture->venture_name}}
                                            <br>
                                            <label>Subject:</label> {{$communication->subject}}
                                            <br>
                                            <label>Body:</label> {{$communication->body}}
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
