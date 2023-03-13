@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create New Venture /list| Admin Panel
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
        .datepicker td, .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker {
            margin-bottom: 0;
        }
        input[type=checkbox] {
            /*position: absolute;*/
            opacity: 1;
        }

        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /*#map div{height:250px;}*/
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
        .comments-tr span {
            font-size: 16px;
            margin: 0;
            font-weight: 600;
            padding-bottom: 15px;
            display: inline-block;
        }
        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;

        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
        #target {
            width: 345px;
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

                                    <form action="{{route('ventures.store')}}" method="POST">
                                        @csrf
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">
                                                        <span>Current Venture Listing </span>
                                                        <span class="form-check pl-0 pull-right">
                                                        <span for="gridCheck">
                                                            Feature Listing
                                                        </span>
                                                            <input id="toggle-event" class="status" name="feature_listing" type="checkbox" data-toggle="toggle" checked>
                                                            <div id="console-event"></div>
                                                        </span>
                                                    </div>


                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Listing ID:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Listing Id" name="listing_id" required>
                                                                        @if($errors->has('purcahse_price'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('purcahse_price') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">User ID:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="User ID" name="venture_name" required>

                                                                    @if($errors->has('venture_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">Username/Email:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Username/Email" name="venture_name" required>

                                                                    @if($errors->has('venture_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_type" style="height: 45px;"  required>
                                                                            <option value="singlefamily">Single Family</option>
                                                                            <option value="multifamily">Multi Family</option>
                                                                            <option value="retail">Retail</option>
                                                                            <option value="comercial">Comercial</option>

                                                                        </select>
                                                                        @if($errors->has('venture_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture ID:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="venture_id" required>
                                                                        @if($errors->has('venture_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Name:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="vendor_name" required>
                                                                        @if($errors->has('purcahse_price'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('purcahse_price') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Listing Status:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="listing_status" style="height: 45px;" required>
                                                                            <option value="live">Live</option>
                                                                            <option value="pending">Pending</option>
                                                                            <option value="inactive">Inactive</option>

                                                                        </select>
                                                                        @if($errors->has('venture_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Asking Price:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Asking Price" name="asking_price" required>
                                                                        @if($errors->has('staff_manager'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('staff_manager') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">CAP Rate :</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="CAP Rate" name="cap_rate" required readonly>
                                                                        @if($errors->has('managing_member'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('managing_member') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">% Of Total Ownership:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="% Ownership For Sale" name="ownership_perc" required>
                                                                        @if($errors->has('managing_member'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('managing_member') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">

                                                                    <div class="form-group" style="margin-top: 35px;">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="gridCheck" name="feature_listing" required>
                                                                            <p for="gridCheck">
                                                                                Feature Listing
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Description:</label>
                                                                    <div class="form-group">
                                                                        <textarea  type="textarea" class="form-control box-shadow" placeholder="Description" name="desc" required row="10"></textarea>
                                                                        @if($errors->has('initial_cap'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('initial_cap') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                {{--<div class="col-md-2">--}}
                                                                {{--<input type="submit" class="btn btn-sm btn-primary" value="Save" required>--}}
                                                                {{--</div>--}}
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>Property Specific</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-4">
                                                                    <ul style="display:inline-flex;">
                                                                        <li class="mr-2"><img src="{{asset('img/upload-image.png')}}" class="photo" alt=""> </li>
                                                                        <li class="mr-2"><img src="{{asset('img/upload-image.png')}}" class="photo" alt=""> </li>
                                                                        <li class="mr-2"><img src="{{asset('img/upload-image.png')}}" class="photo" alt=""> </li>
                                                                        <li class="mr-2"><img src="{{asset('img/upload-image.png')}}" class="photo" alt=""> </li>
                                                                        <li class="mr-2"><img src="{{asset('img/upload-image.png')}}" class="photo" alt=""> </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Street" name="property_street" required>
                                                                        @if($errors->has('venture_street'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property City" name="property_city" required>
                                                                        @if($errors->has('venture_city'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property State:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property State" name="property_state" required>
                                                                        @if($errors->has('venture_state'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Zip" name="property_zip" required>
                                                                        @if($errors->has('venture_zip'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_zip') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="hidden" name="lngLatStatus" value="false">
                                                                    <input type="hidden" name="longitude" value="">
                                                                    <input type="hidden" name="latitude" value="">
                                                                    <div id="mapCanvas"></div>
                                                                </div>

                                                                <div class="col-md-2 mt-5">
                                                                    <input type="submit" class="btn btn-sm btn-primary" value="preview"  style="border-radius: 50px;">
                                                                </div>
                                                                <div class="col-md-2 mt-5">
                                                                    <input type="submit" class="btn btn-sm btn-primary" value="Save"  style="border-radius: 50px;">
                                                                </div>

                                                            </div>

                                                            {{--<div class="row">--}}
                                                                {{--<div class="col-md-4"></div>--}}
                                                                {{--<div class="col-md-2">--}}
                                                                    {{--<input type="submit" class="btn btn-sm btn-primary" value="preview"  style="border-radius: 50px;">--}}
                                                                {{--</div>--}}
                                                                {{--<div class="col-md-2">--}}
                                                                    {{--<input type="submit" class="btn btn-sm btn-primary" value="Save"  style="border-radius: 50px;">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                        </div>



                                                    </div>
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

@endsection
