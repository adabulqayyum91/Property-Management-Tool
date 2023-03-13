{{--/**
 * Created by PhpStorm.
 * User: Zahra
 * Date: 4/8/2020
 * Time: 2:53 PM
 */--}}
@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Ventures | Admin Panel
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
                            <div class="properties-section-body content-area">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if(session()->has('success'))
                                              <div class="alert alert-success">
                                                  <strong>SUCCESS :</strong> {{ session('success') }}
                                              </div>
                                            @endif
                                            <!-- Option bar start -->
                                            <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                                                <h4 style="text-align: center;margin-bottom: 3%;">New Venture Listing</h4>
                                                <form id="new-venture-form">
                                                <div class="row float-right">
                                                    <div class="col-md-12">
                                                       <a class="btn btn-sm btn-theme btn-md"  style="border-radius: 50px;" data-toggle="modal" data-target="#Login">Create New Venture Listing</a> 
                                                    </div>
                                                </div>
                                                <br><br><br>
                                                <div class="row">
                                                    
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <label class="form-label">Listing Date:</label>
                                                    {{--<div class="form-group">--}}
                                                    <!-- Date Picker Input -->
                                                        <div class="form-group">
                                                            <div class="datepicker date input-group p-0 shadow-sm">
                                                                <input type="text" placeholder="Date From" class="form-control box-shadow" name="date_listed_from" required >
                                                                <div class="input-group-append"style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                            </div>


                                                            {{--<input type="text" class="form-control box-shadow" placeholder="Date of Purchase" name="date_of_Purchase" required>--}}
                                                            @if($errors->has('date_of_Purchase'))
                                                                <div class = "alert alert-danger">
                                                                    {{ $errors->first('date_of_Purchase') }}
                                                                </div>
                                                            @endif
                                                        </div><!-- DEnd ate Picker Input -->
                                                        {{--</div>--}}


                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <label class="form-label">  </label>
                                                    {{--<div class="form-group">--}}
                                                    <!-- Date Picker Input -->
                                                        <div class="form-group mt-2">
                                                            <div class="datepicker date input-group p-0 shadow-sm">
                                                                <input type="text" placeholder="Date To" class="form-control box-shadow" name="date_listed_to" required >
                                                                <div class="input-group-append" style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                            </div>


                                                            {{--<input type="text" class="form-control box-shadow" placeholder="Date of Purchase" name="date_of_Purchase" required>--}}
                                                            @if($errors->has('date_of_Purchase'))
                                                                <div class = "alert alert-danger">
                                                                    {{ $errors->first('date_of_Purchase') }}
                                                                </div>
                                                            @endif
                                                        </div><!-- DEnd ate Picker Input -->
                                                        {{--</div>--}}


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
                                                            <input type="text" class="form-control box-shadow" placeholder="List ID" name="listing_id" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label class="form-label">Venture Name:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label class="form-label">Target Amount From:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" placeholder="Target Amount From" name="target_amount_from" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label class="form-label">Target Amount To:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" placeholder="Target Amount To" name="target_amount_to" required>

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
                                    </div>
                                </div>
                            </div>
                            <!-- Properties section body end -->




                            {{--                            @if(isset($allVentures))--}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>New Venture Listing <a href="{{ route('exportNewVentureListing') }}" class="pull-right mb-20 btn btn-warning">Export New Venture Listing</a></span></div>

                                              {{--  <div class="text-right mb-3">
                                                    <a href=""><i class="fa fa-download" aria-hidden="true"></i> &nbsp;Export Result in CSV File</a>
                                                </div>--}}
                                                <div id="ven-id">

                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Listing ID</th>
                                                        <th>Venture Name</th>
                                                        <th>Date Fund By</th>
                                                      {{--  <th>%
                                                            Committed</th>--}}
                                                        <th>Target Amount</th>
                                                        <th>Date Listed</th>
                                                        {{--<th>%CAP RATE</th>--}}
                                                        <th>Listing Status</th>
                                                        <th>Commitment Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($VentureListing)!=0)
                                                        @foreach($VentureListing as $venture)
                                                    <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ !is_null($venture->list_automated_id) ? $venture->list_automated_id : 'N/A'}}</td>
                                                        <td>{{ !is_null($venture->venture) ? $venture->venture->venture_name : 'N/A'}}</td>
                                                        <td>{{ !is_null($venture->venture) ?   \Carbon\Carbon::parse($venture->venture->date_of_incorporation)->format('m/d/Y') : 'N/A'}}</td>
                                                        <td>{{ !is_null($venture->venture) ? formatCurrency($venture->venture->target_amount) : 'N/A'}}</td>
                                                        <td>{{ !is_null($venture) ?   \Carbon\Carbon::parse($venture->created_at)->format('m/d/Y')  : 'N/A'}}</td>
                                                        {{--<td>{{  !is_null($venture->venture) ?  $venture->venture->initial_cap : 'N/A'}}</td>--}}
                                                    <td>{{ !is_null($venture->list_status) ? $venture->list_status : 'N/A'}}</td>
                                                    <td>{{ !is_null($venture->status) ? $venture->status : 'N/A'}}</td>
                                                        <td>
                                                            <form action="{{url('admin/new-venture-listing/'.$venture->venture->venture_automated_id.'/venture-detail/'.$venture->list_automated_id.'/edit')}}" method="GET">
                                                                <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                            </form>

                                                            <form action="{{route('new-venture-listing.destroy',$venture->id)}}" method="POST" >
                                                                {{-- TODO: For Future Reference --}}
                                                                {{-- id="newVentureDelete" --}}
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                            </form>

                                                            <form action="{{url('admin/new-venture-listing/'.$venture->list_automated_id.'/userCommit')}}" method="GET">
                                                                <button class="btn btn-linked  btn-primary box-shadow"></i> Commitments <span class="badge" style="background-color: #fff;">{{ $venture->commits()->count() }}</span></button>
                                                            </form>

                                                            {{--@if($venture->whereHas('commits',function ($q){--}}
                                                                {{--$q->where('status', Config::get('constants.VENTURE_COMMIT_STATUS')[2]);--}}
                                                                {{--})->count() == $venture->commits()->count())--}}
                                                            @if(!($venture->status=="Closed" || $venture->status=="Inactive"))
                                                                @if(Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount? $venture->venture->target_amount : '0')>=100)
                                                                    <form action="{{url('admin/change-new-venture-commitment-status')}}" method="POST" id="status-change-form">
                                                                        @csrf
                                                                        <input type="hidden" value="{{ $venture->id }}" name="venture_listing_id">
                                                                        @if($venture->status!="Closing")
                                                                            <select autocomplete="off" class="form-control" name="status" onchange="$(this).parent().submit()" required>
                                                                                <option value="" {{ is_null($venture->status) ? 'selected' : 'N/A'}} disabled>Select Status</option>
                                                                                @foreach(Config::get('constants.NEW_VENTURE_LISTING_STATUS') as $status)
                                                                                    @if($status!="Closed")
                                                                                    <option value="{{ $status }}" {{ $venture->status == $status ? 'selected="selected"' : ''}}>{{ $status }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        @else
                                                                            <div>
                                                                            <input type="number" placeholder="Purchase Price" step="0.01" name="target_amount" required=""/>
                                                                            <input type="hidden" name="status" value="Closed">
                                                                            <button type="submit" style="width: 100%;">Close</button>
                                                                            </div>
                                                                        @endif
                                                                    </form>
                                                                @endif
                                                            @endif
                                                        </td>


                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                    </tbody>

                                                </table>
                                                {!! $VentureListing->links() !!}
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
    {{------Modal-------}}
    <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelSaleLabel">Create New Venture Listing</h5>
                    <button type="button" class="close" data-dismiss="modal" id="cncl" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block" style="margin-bottom: 0;">

                    <!-- <div class="row venture-search" >
                        <div class="col-lg-8 col-md-8 col-sm-8 offset-md-2">
                            <div class="form-group row">
                                <div class="col-sm-12" >
                                    <input class="form-control" type="text" placeholder="Search " name="other_option">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row venture-search">
                        <div class="col-lg-8 col-md-8 col-sm-8 offset-md-2">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="form-label">Venture Name:</label>

                                    <div class="form-group">
                                        <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" required>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="form-label">Venture ID:</label>

                                    <div class="form-group">
                                        <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="venture_id" required>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <input class="btn btn-sm btn-theme btn-md venture-search-button" type="button" value="Search Ventures" style="border-radius: 50px;">

                        </div>
                    </div>


                    <div class="vantures- mt-5 ventureList">
                        <table id="example" class="table box-shadow table-bordered" style="width:100%">
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

                                            <input class="form-check-input" name="venture-radio" type="radio" id="gridCheck" value="{{$venture->venture_automated_id}}" {{$venture->VentureExist() == true?'disabled':''}}>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span data-toggle="tooltip" data-placement="top"  title="{{$venture->venture_name}} is already taken">
                                        {{$venture->venture_name}}
                                    </span>
<br>

                                </td>
                                <td>{{$venture->venture_automated_id}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>


                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <input class="btn btn-sm btn-theme btn-md" type="button" id="new_venture_listing" value="Create New Venture listing" style="border-radius: 50px;">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
{{--  =========================================================================================
   Description: Script for New Venture List
   ----------------------------------------------------------------------------------------
   ========================================================================================== --}}

@section('javaScript')

        <script type="text/javascript">
            $('.datepicker').datepicker({
                format: 'mm-dd-yyyy'
            });
            $(document).ready(function() {

                $('#new_venture_listing').click(function () {
            var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
            var radioValue = $("input[name='venture-radio']:checked").val();
            if (typeof radioValue === "undefined") {
                toastr.error('Please Select Venture', 'Error', {timeOut: 5000});
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
                url: "{{ route('new-venture-listing.store') }}",
                dataType: 'json',
                data: {
                    'venture_id': radioValue
                },
                error: function (error) {
//                    $('.getStart').html('GET STARTED').removeAttr('disabled');
                    toastr.error(data.message, 'Error', {timeOut: 5000});
                    alert('Something went wrong. Please try again later.');
                },
                success: function (data) {

                    if (data.status == true) {
                    $('#Login').modal("hide");
//                        Swal("Done!", 'test', "success");
                        Swal.fire(
                            'Success!',
                            'Venture Selected Successfully,Plese add further Details !!',
                            'success'
                        ).then((result) => {
                            location.href = data.url;

                    });
                    }
                    else {
                            toastr.error(data.message, 'Error', {timeOut: 5000});
                        $('.getStart').html('GET STARTED').removeAttr('disabled');
                    }
                },
                type: 'POST'
            });


        });

        //******search in popup*****
                $('.venture-search-button').click(function () {
                    var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                    var ventureName = $(".venture-search input[name='venture_name']").val();
                    var ventureId = $(".venture-search input[name='venture_id']").val();
                    var otherOption = $(".venture-search input[name='other_option']").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': "{{csrf_token()}}"
                        }
                    });
                    $.ajax({
                        //loader in button
                        beforeSend: function () {
                            $(this).html(loading + ' Processing').attr('disabled', 'disabled');
                        },
                        url: "{{ route('searchVenture') }}",
                        dataType: 'json',
                        data: {
                            'venture_id': ventureId,
                            'ventureName': ventureName,
                            'otherOption': otherOption
                        },
                        error: function (error) {
//                    $('.getStart').html('GET STARTED').removeAttr('disabled');
                            toastr.error(data.message, 'Error', {timeOut: 5000});
                            alert('Something went wrong. Please try again later.');
                        },
                        success: function (data) {

                            if (data.status == true) {
                                $(".ventureList").empty().html(data.view);
                            }
                            else {
                                $.each(data.error, function (k, v) {
                                    toastr.error(v, 'Error', {timeOut: 5000})
                                });
                                $('.getStart').html('GET STARTED').removeAttr('disabled');
                            }
                        },
                        type: 'POST'
                    });


                });


                //******search in Index page*****

                $("#searchSubmit").click(function (e) {
                    e.preventDefault();
                    var formData=$(document).find('#new-venture-form').serialize();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': "{{csrf_token()}}"
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/searchNewVenture') }}",
                        data: formData,
                            success: function (response) {
                                if(response.status == true){
                                    toastr.success(response.message);
                                    $("#ven-id").empty().html(response.view);
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
                //******Delete New Venture List*****

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
    </script>

    @endsection
