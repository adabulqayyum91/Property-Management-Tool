{{--/**
 * Created by PhpStorm.
 * User: Zahra
 * Date: 4/8/2020
 * Time: 2:53 PM
 */--}}
@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Current Venture List | Admin Panel
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
        .create-btn{
            border-radius:50px
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
                            <div class="properties-section-body content-area">
                                <!-- Option bar start -->
                                <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                                    <h4 style="text-align: center;margin-bottom: 3%;">Current Venture Listing</h4>
                                    <form id="current-venture-form">
                                        <div class="row" >
                                            <div class="col-12">
                                                <div class="float-right mb-3">
                                                    <a class="btn btn-sm btn-theme btn-md create-btn" href="{{url('admin/create-listing-select-user')}}" target="_blank">
                                                        Create Current Venture Listing
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <label class="form-label">Listing Date:</label>
                                            {{--<div class="form-group">--}}
                                            <!-- Date Picker Input -->
                                                <div class="form-group">
                                                    <div class="datepicker date input-group p-0 shadow-sm">
                                                        <input type="text" placeholder="Date From" class="form-control box-shadow" name="date_listed_from" required >
                                                        <div class="input-group-append"style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                    </div>


                                                    @if($errors->has('date_of_Purchase'))
                                                        <div class = "alert alert-danger">
                                                            {{ $errors->first('date_of_Purchase') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- End ate Picker Input -->
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <label class="form-label">  </label>
                                                <div class="form-group mt-2">
                                                    <div class="datepicker date input-group p-0 shadow-sm">
                                                        <input type="text" placeholder="Date To" class="form-control box-shadow" name="date_listed_to" required >
                                                        <div class="input-group-append" style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                    </div>

                                                    @if($errors->has('date_of_Purchase'))
                                                        <div class = "alert alert-danger">
                                                            {{ $errors->first('date_of_Purchase') }}
                                                        </div>
                                                    @endif
                                                </div><!-- End ate Picker Input -->


                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">

                                                <label class="form-label">Venture Type:</label>
                                                <div class="form-group">
                                                    <select class="form-control box-shadow" name="venture_type" style="height: 45px;">
                                                        <option value="Any">Any</option>
                                                        @foreach($listingTypes as $type)
                                                            <option value="{{$type->title}}">{{$type->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">

                                                <label class="form-label">Listing Status:</label>
                                                <div class="form-group">
                                                    <select class="form-control box-shadow" name="listing_status" style="height: 45px;">
                                                        <option value="Any">Any</option>
                                                        <option value="Live">Live</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Inactive">Inactive</option>

                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <label class="form-label">Venture ID:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="venture_id" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2">
                                                <label class="form-label">Listing ID:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="Listing ID" name="listing_id" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <label class="form-label">Venture Name:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <label class="form-label">Asking Price From:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="Asking Price From:" name="asking_price_from" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <label class="form-label">Asking Price To:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="Asking Price To" name="asking_price_to" required>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <label class="form-label">CAP From:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="CAP From" name="cap_from" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <label class="form-label">CAP To:</label>

                                                <div class="form-group">
                                                    <input type="text" class="form-control box-shadow" placeholder="CAP To" name="cap_to" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <input class="btn btn-sm btn-theme" id="searchSubmit" type="button" value="Submit Query" style="height: 42px;border-radius: 50px;">

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Properties section body end -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Current Venture Listing <a href="{{ route('exportCurrentVentureListing') }}" class="pull-right mb-20 btn btn-warning">Export Current Venture Listing</a></span></div>


                                                <div id="ven-id">

                                                    <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                        <thead class="bg-active">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Listing ID</th>
                                                            <th>%Ownership Sequence</th>
                                                            <th>Venture Name</th>
                                                            <th>Asking Price</th>
                                                            <th>Seller Email</th>
                                                            <th>Featured Listing</th>
                                                            <th>Date Listed</th>
                                                            <th>Listing Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(count($currentVentureListing)!=0)
                                                            @foreach($currentVentureListing as $venture)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{  !is_null($venture->list_automated_id)?$venture->list_automated_id:''}}</td>
                                                                    <td>{{ !is_null($venture->percentage_of_ownership)?$venture->percentage_of_ownership:''}} %</td>
                                                                    <td>{{ !is_null($venture->venture)?$venture->venture->venture_name:''}}</td>
                                                                    <td>{{ !is_null($venture->venture) ? formatCurrency($venture->asking_price):'N/A'}}</td>
                                                                    <td>{{ count($venture->users)>=1?$venture->users[0]->email:''}}
                                                                    </td>
                                                                    <td>{{ $venture->feature==0?'No':'Yes'}}</td>
                                                                    <td>{{ !is_null($venture->venture) ?   \Carbon\Carbon::parse($venture->created_at)->format('m/d/Y') : ''}}</td>
                                                                    <td>{{  !is_null($venture->list_status)?$venture->list_status:''}}</td>
                                                                    <td>
                                                                        <form action="{{url('admin/current-venture-listing/'.$venture->venture->id.'/venture-detail/'.$venture->id.'/edit')}}" method="GET">
                                                                            <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                                        </form>
                                                                        {{-- <form action="{{route('ventures.show',$venture->id)}}" method="GET">
                                                                             <button class="btn btn-linked btn-info box-shadow"><i class="fa fa-eye"></i></button>
                                                                         </form>--}}
                                                                        <form action="{{route('current-venture-listing.destroy',$venture->id)}}" method="POST" id="newVentureDelete">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                                        </form>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>

                                                    </table>
                                                    {!! $currentVentureListing->links() !!}
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
    
    <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelSaleLabel">Create Current Venture Listing</h5>
                    <button type="button" class="close" data-dismiss="modal" id="cncl" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block" style="margin-bottom: 0;">
                    <div class="create-current-venture-filter">
                        <div class="vantures- mt-2 ventureList">
                            <table id="venturesList" class="table box-shadow table-bordered" style="width:100%">
                                <thead class="bg-active">
                                <tr>
                                    <th>Select</th>
                                    <th>Venture Name</th>
                                    <th>Venture ID</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ventures as $venture)
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="venture-radio" type="radio" onchange="getVentureOwnerUsers({{$venture->id}})" id="gridCheck" value="{{$venture->id}}">

                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$venture->venture_name}}</td>
                                        <td>{{$venture->venture_automated_id}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="create-user-filter">
                        <div class="vantures- mt-4 user-list">
                            <table id="example" class="table box-shadow table-bordered w-100" >
                                <thead class="bg-active">
                                <tr>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>User Automated ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Select Venture First.
                                        </td>
                                    </tr>
                                    {{-- TODO: This code is for future use. It will not effect anything --}}
                                    {{-- @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="user-radio" type="radio"  id="gridCheck" value="{{$user->id}}">

                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->member_automated_id}}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <input class="btn btn-sm btn-theme btn-md" type="button"  id="new_venture_listing" value="Create Current Venture listing" style="border-radius: 50px;">
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
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'mm-dd-yyyy'
        });
        $(document).ready(function() {
            $('#venturesList').DataTable({
                "lengthMenu": [5, 10, 25, 50],
                "pageLength": 5
            });


            //******search in popup for venture*****

            $("#searchVenture").click(function (e) {
                e.preventDefault();
                var ventureName = $(".venture-search-div input[name='venture_name']").val();
                var ventureId = $(".venture-search-div input[name='venture_id']").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/searchVentures') }}",
                    dataType: 'json',
                    data: {
                        'venture_id': ventureId,
                        'ventureName': ventureName
                    },
                    success: function (response) {
                        if(response.status == true){
                            toastr.success(response.message);
                            $(".ventureList").empty().html(response.view);
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

            //****popup search****
            $('#new_venture_listing').click(function () {
                var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                var radioValue = $("input[name='venture-radio']:checked").val();
                var radioUserValue = $("input[name='user-radio']:checked").val();
                if (typeof radioValue === "undefined" ){
                    toastr.error('Please Select Venture', 'Error', {timeOut: 5000});
                    return false;
                }
                if(typeof radioUserValue  === "undefined" ) {
                    toastr.error('Please Select User', 'Error', {timeOut: 5000});
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    //loader in button
                    beforeSend: function () {
//                    $('.getStart').html(loading + ' Processing').attr('disabled', 'disabled');
                        $(this).html(loading + ' Processing').attr('disabled', 'disabled');
                    },
                    url: "{{ route('current-venture-listing.store') }}",
                    dataType: 'json',
                    data: {
                        'venture_id': radioValue,
                        'user_id': radioUserValue
                    },

                    success: function (data) {

                        if (data.status == true) {
                            $('#Login').modal("hide");
                            location.href = data.url;
                        }
                        else {
                            $.each(data.error, function (k, v) {
                                toastr.error(v, 'Error', {timeOut: 5000})
                            });
                            $('.getStart').html('GET STARTED').removeAttr('disabled');
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    },
                    type: 'POST'
                });
            });

            //*****Current Venture List****
            $("#searchSubmit").click(function (e) {
                e.preventDefault();
                var formData=$(document).find('#current-venture-form').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/searchCurrentVenture') }}",
                    data: formData,
                    success: function (response) {

                        if(response.status == true){
                            toastr.success(response.message);
                            $("#ven-id").empty().html(response.view);

                        }else{
                            toastr.error(response.message);
                        }
                    }
                });
            });
            //******Delete Current Venture*****
            $("#newVentureDelete").submit(function(e){
                e.preventDefault();
                var url=$(this).attr('action');

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
                            window.location.reload();
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
        });

        function getVentureOwnerUsers(venture_id) {
            var userId = $(".user-search input[name='user_id']").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/searchUser') }}",
                data:  {
                    'user_id': userId,
                    'venture_id': venture_id
                },
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        $(".user-list").empty().html(response.view);
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
        }
    </script>

@endsection
