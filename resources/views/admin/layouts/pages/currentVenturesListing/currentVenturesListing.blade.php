@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Ventures | Admin Panel
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
            max-width: 700px;
            margin: 1.75rem auto;
        }
        input[type=checkbox] {
            /*position: absolute;*/
            opacity: 1;
        }
    </style>
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
                                        <div class="">
                                            <!-- Option bar start -->
                                            <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                                                <h4 style="text-align: center;margin-bottom: 3%;">Listing Search</h4>

                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-group row">
                                                            <div class="col-sm-12" >
                                                                <input class="form-control" type="text" placeholder="Search other options">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">

                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <div class="">

                                                            <a class="btn btn-sm btn-theme btn-md"  style="border-radius: 50px;" data-toggle="modal" data-target="#Login">Create current Venture Listing</a>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <label class="form-label">Date Listed From	:</label>
                                                    {{--<div class="form-group">--}}
                                                    <!-- Date Picker Input -->
                                                        <div class="form-group">
                                                            <div class="datepicker date input-group p-0 shadow-sm">
                                                                <input type="text" placeholder="Date From" class="form-control box-shadow" name="date_listing_from" required >
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
                                                        <label class="form-label">To:</label>
                                                    {{--<div class="form-group">--}}
                                                    <!-- Date Picker Input -->
                                                        <div class="form-group">
                                                            <div class="datepicker date input-group p-0 shadow-sm">
                                                                <input type="text" placeholder="Date To" class="form-control box-shadow" name="date_listing_to" required >
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
                                                                <option value="singlefamily">Single Family</option>
                                                                <option value="multifamily">Multi Family</option>
                                                                <option value="retail">Retail</option>
                                                                <option value="comercial">Comercial</option>
                                                                <option value="any">any</option>

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">

                                                        <label class="form-label">Listing Status:</label>
                                                        <div class="form-group">
                                                            <select class="form-control box-shadow" name="listing_status" style="height: 45px;">
                                                                <option value="live">Live</option>
                                                                <option value="pending">Pending</option>
                                                                <option value="inactive">Inactive</option>

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
                                                            <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="listing_id" required>

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
                                                            <input type="text" class="form-control box-shadow" placeholder="Asking Price From" name="asking_price_from" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label class="form-label">Asking Price To:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" placeholder="Asking Price To" name="asking_price_to" required>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="btn btn-sm btn-theme" type="button" value="Submit" style="height: 42px;">

                                                    </div>
                                                </div>
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Ventures Listing</span></div>

                                                <div class="text-right mb-3">
                                                    <a href=""><i class="fa fa-download" aria-hidden="true"></i> &nbsp;Export Result in CSV File</a>
                                                </div>

                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>Listing ID</th>
                                                        <th>Ownership Sequence</th>
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

                                                    {{--@foreach($allVentures as $venture)--}}
                                                    {{--<tr>--}}
                                                    {{--<td>{{ !is_null($i) ? $i++ : ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->venture_name) ? $venture->venture_name : ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->purcahse_price) ? "".env('CURRENCY_SIGN').number_format($venture->purcahse_price , 2, ',', '.'): ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->initial_cap) ?  $venture->initial_cap : ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->venture_city) ?  $venture->venture_city : ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->venture_state) ?  $venture->venture_state : ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->venture_zip) ?  $venture->venture_zip : ''}}</td>--}}
                                                    {{--<td>{{ !is_null($venture->type) ?  $venture->type : ''}}</td>--}}

                                                    {{--<td>--}}
                                                    {{--<form action="{{route('ventures.edit',$venture->id)}}" method="GET">--}}
                                                    {{--<button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>--}}
                                                    {{--</form>--}}
                                                    {{--<form action="{{route('ventures.show',$venture->id)}}" method="GET">--}}
                                                    {{--<button class="btn btn-linked btn-info box-shadow"><i class="fa fa-eye"></i></button>--}}
                                                    {{--</form>--}}
                                                    {{--<form action="{{route('ventures.destroy',$venture->id)}}" method="POST">--}}
                                                    {{--@method('DELETE')--}}
                                                    {{--@csrf--}}
                                                    {{--<button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>--}}
                                                    {{--</form>--}}
                                                    {{--</td>--}}
                                                    {{--</tr>--}}
                                                    {{--@endforeach--}}
                                                    </tbody>
                                                </table>
                                                {{--                                                    {!! $allVentures->links() !!}--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--@endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
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
                    {{--create current venture filter--}}
<div class="create-current-venture-filter">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 offset-md-2">
                            <div class="form-group row">
                                <div class="col-sm-12" >
                                    <input class="form-control" type="text" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                            <input class="btn btn-sm btn-theme btn-md" type="button" value="Search Ventures" style="border-radius: 50px;">

                        </div>
                    </div>


                    <div class="vantures- mt-5">
                        <table id="example" class="table box-shadow table-bordered" style="width:100%">
                            <thead class="bg-active">
                            <tr>
                                <th>Select</th>
                                <th>Venture Name</th>
                                <th>Venture ID</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck">

                                        </div>
                                    </div>
                                </td>
                                <td>Test Venture 8</td>
                                <td>V987654</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck">

                                        </div>
                                    </div>
                                </td>
                                <td>Test Venture 9</td>
                                <td>V987658</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
</div>

                    {{--create user filter--}}

                    <div class="create-user-filter">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 offset-md-2">
                                <div class="form-group row">
                                    <div class="col-sm-12" >
                                        <input class="form-control" type="text" placeholder="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 offset-md-2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <label class="form-label">User ID:</label>

                                        <div class="form-group">
                                            <input type="text" class="form-control box-shadow" placeholder="User ID" name="user_id" required>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <label class="form-label"></label>
                                        <div class="form-group">
                                        <input class="btn btn-sm btn-theme btn-md mt-2" type="button" value="Search User" style="border-radius: 50px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="vantures- mt-5">
                            <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                <thead class="bg-active">
                                <tr>
                                    <th>Select</th>
                                    <th>Venture Name</th>
                                    <th>Venture ID</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">

                                            </div>
                                        </div>
                                    </td>
                                    <td>Test Venture 8</td>
                                    <td>V987654</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">

                                            </div>
                                        </div>
                                    </td>
                                    <td>Test Venture 9</td>
                                    <td>V987658</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <input class="btn btn-sm btn-theme btn-md" type="button" value="Create Current Venture listing" style="border-radius: 50px;">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection