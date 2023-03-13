@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Ownership Selling List | Admin Panel
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
        .edit-btn{
            float: right;
            width: 44%;
            padding-left: 9px;
        }
        .del-btn{
            width: 44%;
            margin: 0 -5px;
        }
        form {
            display: inherit !important;
            margin-top: 0em;
        }
        .create-plans{display: block !important;}
        .btn-linked {
            margin: 0px 10px 0px 0px !important;
            /*padding: 0px !important;*/
            /*background: #fff;*/
        }
        .datepicker td, .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker {
            margin-bottom: 0;
        }
        .option-bar {
            margin-bottom: 30px;
            padding: 25px 25px;
            background: #fff;
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.1);
        }
        .modal-dialog {
            max-width: 600px;
            margin: 1.75rem auto;
        }
        input[type=checkbox] {
            /*position: absolute;*/
            opacity: 1;
        }
    </style>
@endsection
@section('content')
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <!-- Properties section body start -->
                            {{--<div class="properties-section-body content-area">--}}
                                            {{--<!-- Option bar start -->--}}
                                {{--<div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">--}}
                                                {{--<h4 style="text-align: center;margin-bottom: 3%;"> Ownership Selling List </h4>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- Properties section body end -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span> Ownership Selling List </span></div>


                                                <div id="ven-id">

                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Venture ID</th>
                                                        <th>Listing ID</th>
                                                        <th>Member ID</th>
                                                        <th>Price</th>
                                                        <th>Ownership</th>
                                                        <th>Description</th>
                                                        <th>Date Listed</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($listings) > 0)
                                                        @foreach($listings as $listing)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{  !is_null($listing->venture)?$listing->venture->venture_automated_id:''}}</td>
                                                                <td>{{  !is_null($listing->ventureListing)? $listing->ventureListing->list_automated_id:''}}</td>
                                                                <td>{{  !is_null($listing->user)? $listing->user->member_automated_id:''}}</td>
                                                                <td>{{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($listing->price) ? $listing->price : '0', 2, ',', '.')}}.00</td>
                                                                <td>{{ !is_null($listing->ownership_percent)?$listing->ownership_percent:''}}%</td>
                                                                <td>{{ !is_null($listing->description)?$listing->description:''}}</td>
                                                                <td>{{ !is_null($listing->created_at) ?   \Carbon\Carbon::parse($listing->created_at)->format('m/d/Y') : '---'}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>

                                                </table>
                                                 {!! $listings->links() !!}
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
{{-- =========================================================================================
Description: Script for current Venture listing
----------------------------------------------------------------------------------------
========================================================================================== --}}

@section('javaScript')

@endsection
