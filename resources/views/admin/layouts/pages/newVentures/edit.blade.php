@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit New Venture | Admin Panel
@endsection
@section('css')
    <style>

        /* Style the Image Used to Trigger the Modal */
        .image-popup {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .image-popup:hover {
            opacity: 0.7;
            transform: scale(1.1);
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close-modal {
            position: absolute;
            top: 86px;
            right: 35px;
            color: #f1f1f1;
            font-size: 60px;
            font-weight: bold;
            transition: 0.3s;
            opacity:1;
        }

        .modal-backdrop.show {
            opacity: 0;
            display: none;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
        .form-control {
            margin: 0;
            width: 100%;
        }

        .btn-faqs {
            margin-top: 35px;
        }

        .datepicker0 td, .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker0 {
            margin-bottom: 0;
        }
        .media-status{
            position: absolute;
            right: 20px;
            top: 6px;
            display: none;
        }
        .media-delete{
            position: absolute;
            left: 20px;
            top: 6px;
            display: none;
        }
        .image-delete{
            position: absolute;
            left: 20px;
            top: 50px;
            display: none;
        }        
        .toggle-off.btn {
            padding-left: 15px;
        }
        .toggle-on.btn {
            padding-left: 5px;
        }
        .media-box:hover .media-status, .media-box:hover .media-delete, .image-box:hover .image-delete{
            display: block;
        }            

        /* Style the Image Used to Trigger the Modal */
        .image-popup {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .image-popup:hover {
            opacity: 0.7;
            transform: scale(1.1);
        }
        .form-control{
            margin: 0;
            width: 100%;
        }
        .btn-faqs{
            margin-top: 35px;
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
        .not-featured{
            background-color:rgba(0, 0, 0, 0.3);
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="{{route('new-venture-listing.update',$newVentureList->id)}}" id="updateVenture" method="POST">
                                        @method('PUT')
                                        @csrf
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>New Venture Listing </span>
                                                    <span class="form-check pl-0 pull-right">
                                                    <span for="gridCheck">
                                                        Feature Listing
                                                    </span>
                                                    <input id="toggle-event" class="status" name="feature_listing" type="checkbox" data-toggle="toggle" {{  $newVentureList->feature ===1 ? "checked" : "" }}>
                                                    <div id="console-event"></div>
                                                    </span>
                                                </div>



                                                <div class="container">
                                                    <div class="comments-tr2">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Listing ID:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Listing Id" name="listing_id" value="{{$newVentureList->list_automated_id}}" readonly>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Venture Type:</label>
                                                                <div class="form-group">
{{--                                                                    {{$newVentureList->venture->VentureDetail->type }}--}}
                                                                    <input class="form-control box-shadow"
                                                                        name="venturetype" style="height: 45px;" value="{{$newVentureList->venture->venture_type}}" readonly>                                                                                                                                                
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Listing Status:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control box-shadow" name="listing_status" style="height: 45px;">
                                                                        <option value="Pending" {{($newVentureList->list_status==='Pending') ? ' selected' : ''}}>Pending</option>
                                                                        <option value="Live" {{($newVentureList->list_status==='Live')? ' selected' : ''}}>Live</option>
                                                                        <option value="Inactive" {{($newVentureList->list_status==='Inactive') ? ' selected' : ''}}>Inactive</option>

                                                                    </select>
                                                                    @if($errors->has('listing_status'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('listing_status') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Date Fund By	:</label>
                                                                <div class="form-group">
                                                                    <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                        <input type="text" placeholder="Date of Incorporation" class="form-control box-shadow" name="date_fund_by" value="{{ \Carbon\Carbon::parse($newVentureList->venture->date_of_incorporation)->format('m/d/Y')}}" readonly>
                                                                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Venture Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Venture Name" value="{{!is_null($newVentureList->venture)?$newVentureList->venture->venture_name:''}}" name="venture_name" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Venture ID:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="vendor_id" value="{{!is_null($newVentureList->venture)?$newVentureList->venture->venture_automated_id:''	}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Target Amount:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Target Amount" name="target_amount" value="{{!is_null($newVentureList->venture)?$newVentureList->venture->purchase_price:''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">CAP Rate :</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="CAP Rate" name="cap_rate" value="{{!is_null($newVentureList->venture)?$newVentureList->venture->initial_cap:''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Description:</label>
                                                                <div class="form-group">
                                                                    <textarea  type="textarea" class="form-control box-shadow" placeholder="Description" name="description" required row="10">{{$newVentureList->description}}</textarea>
                                                                    @if($errors->has('description'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('description') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
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
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Street" name="property_street" value="{{!is_null($newVentureList->venture->VentureDetail)?$newVentureList->venture->VentureDetail->property_street:''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property City" name="property_city" value="{{!is_null($newVentureList->venture->VentureDetail)?$newVentureList->venture->VentureDetail->property_city:''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property State:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property State" name="property_state" value="{{!is_null($newVentureList->venture->state)?$newVentureList->venture->state->name:''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Zip" name="property_zip"  value="{{!is_null($newVentureList->venture->VentureDetail)?$newVentureList->venture->VentureDetail->property_zip:''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <label class="form-label">Use Marker to set location:</label>                                                                    
                                                                    <input type="checkbox" name="useMarker" {{ ($newVentureList->useMarker) ? 'checked' : '' }} style="width:30px; height: 20px;">                                                                    
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="hidden" name="lngLatStatus" value="{{ ($newVentureList->useMarker) ? 'true' : 'false' }}">
                                                                    <input type="hidden" name="longitude" value="{{!is_null($newVentureList->longitude)?$newVentureList->longitude:''}}">
                                                                    <input type="hidden" name="latitude" value="{{!is_null($newVentureList->latitude)?$newVentureList->latitude:''}}">
                                                                    <div id="mapCanvas"></div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <br>
                                                                    <input type="submit" class="btn btn-sm btn-primary" value="Save"  style="border-radius: 50px;">
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <form id="uploadDocument" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value={!! $newVentureList->id !!}>
                                        @csrf

                                        <div class="dashboard-list">
                                            <div class="document-section">
                                                <div class="tabs-section" style="border:1px solid #eee;">
                                                    <div class="row2">

                                                        <div class="col-md-12">
                                                            <div class="tab-content" id="myTabContent">

                                                                <div class="row text-center mb-2">
                                                                    @foreach($newVentureList->medias()->where('type', null)->get() as $file)
                                                                        <div class="col-md-3 media-box">
                                                                            <a href="{{ asset('uploads/ventures/'.$file->file_name) }}" download
                                                                               style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                                <h6>{{!is_null($file->title)?$file->title:''}}</h6>
                                                                                <small>{{ \Carbon\Carbon::parse($file->created_at)->format('m-d-Y') }}</small>
                                                                            </a>

                                                                            <span class="media-delete">
                                                                                <button type="button"
                                                                                        data-file="{{$file->id}}"
                                                                                        class="btn btn-xs btn-warning">
                                                                                        <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">
                                                        <span>Upload Information</span></div>
                                                    <div class="container2">
                                                        <div class="comments-tr2">
                                                            <div class="row">

                                                                <div class="col-md-2">
                                                                    <label class="form-label">Choose File:</label>
                                                                    <div class="form-group">
                                                                        <input class="form-control box-shadow" name="files" id="input_multifileSelect files" type="file">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Name of Document:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Document Name" name="documentName" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="submit" class="uploaddocuments btn btn-sm btn-theme" value="Upload" style="margin-top: 35px;border-radius: 50px;">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                    <form id="UploadImages" action="{{route('newListingVentureUploadImages')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value={!! $newVentureList->id !!}>
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"><span>Pictures</span></div>
                                                    <div class="container2">
                                                        <div class="comments-tr2">
                                                            <p>Venture Images:<br><small>(Note: Deleting the image here will also delete the image in venture section)</small></p>
                                                            <ul class="allimages row">
                                                                @foreach($ventureListImages as $image)
                                                                    <li class="col-md-2 image-box">
                                                                        <button type="button"
                                                                        data-file="{{$image->id}}"
                                                                        class="btn btn-primary btn-block make-featured-image {{ ($newVentureList->featuredImageId == $image->id) ? '' : 'not-featured' }}">
                                                                            <i class="fa fa-star"></i>
                                                                        </button>                              
                                                                        <img src="{{ asset('uploads/ventures/'.$image->file_name) }}" alt="{{ !is_null($newVentureList->venture)?$newVentureList->venture->venture_name:'' }}" class="img-responsive image-popup mb-4 mt-2" style="width: 100%; height: 140px;" >

                                                                        <span class="image-delete">
                                                                            <button type="button"
                                                                                    data-file="{{$image->id}}"
                                                                                    class="btn btn-xs btn-warning">
                                                                                    <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </span>                                     
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <p>Listing Images:</p>
                                                            <ul class="allimages row">

                                                                {{-- @php
                                                                $newVentureListImages = $newVentureList->medias()->where('type', 'IMAGE')->get();                     
                                                                @endphp --}}
                                                                @foreach($newVentureListImages as $image)
                                                                    <li class="col-md-2 image-box">
                                                                        <button type="button"
                                                                        data-file="{{$image->id}}"
                                                                        class="btn btn-primary btn-block make-featured-image {{ ($newVentureList->featuredImageId == $image->id) ? '' : 'not-featured' }}">
                                                                            <i class="fa fa-star"></i>
                                                                        </button>                              
                                                                        <img src="{{ asset('uploads/ventures/'.$image->file_name) }}" alt="{{ !is_null($newVentureList->venture)?$newVentureList->venture->venture_name:'' }}" class="img-responsive image-popup mb-4 mt-2" style="width: 100%; height: 140px;" >

                                                                        <span class="image-delete">
                                                                            <button type="button"
                                                                                    data-file="{{$image->id}}"
                                                                                    class="btn btn-xs btn-warning">
                                                                                    <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </span>                                     
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Upload Multiple Images Here:</label>
                                                                    <div class="form-group">
                                                                        <input type="file" class="form-control box-shadow" placeholder="Images" multiple name="images[]" id="images" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="submit" class="but_upload btn btn-sm btn-theme"
                                                                           value="Upload" style="margin-top: 35px;border-radius: 50px;">
                                                                </div>


                                                            </div>
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
    <!-- The Modal -->
    <div id="imageModal" class="modal">

        <!-- The Close Button -->
        <span class="close-modal" onclick="$('#imageModal').modal('hide')">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="modal-image">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    <style>
        .displayinline{ display: inline-block; margin-right: 10px;}
    </style>


@endsection
@section('javaScript')
@include('admin.layouts.pages.map-script')
    {{--  =========================================================================================
            Description: Script for New Venture List
    ----------------------------------------------------------------------------------------
    ========================================================================================== --}}
 <script>
        $(document).ready(function() {
            //****Image popup****
            $(document).on('click','.image-popup', function () {
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
            });

            //****Save New Venture List****

            $("#updateVenture").submit(function(e){
                e.preventDefault();
                let url=$(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            $('.allimages').html(response.data);
                            $("#UploadImages")[0].reset();
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
            //****Save Document ****

            $("#uploadDocument").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('UploadNewVentureListDocument') }}",
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            $('.document-section').html(response.data);
                            $("#uploadDocument")[0].reset();
                            $("[data-toggle='toggle']").bootstrapToggle();
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

            //****Save Images****

            $("#UploadImages").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('newListingVentureUploadImages') }}",
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            // $('.allimages').html(response.data);
                            // $("#UploadImages")[0].reset();
                            location.reload();                          
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

            //****Date picker****

            $('.datepicker0').datepicker({
                format: 'mm-dd-yyyy'
            });

            $("#nameofpic").change(function(){
                if(!$('#nameofpic').val()){

                    $('.nameofpicerror').css("display", "block");
                }
                else{
                    $('.nameofpicerror').css("display", "none");
                }
            });

            //****Delete Document****
            $(document).on('click','.image-delete button', function() {
                if(confirm('Are you sure?')) {
                    var $this = $(this);
                    $this.attr('disabled', 'disabled');
                    var mediaID = $this.data('file');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/new-venture-image-delete')}}",
                        data: {_token: $('meta[name="csrf-token"]').attr('content'), mediaID: mediaID},
                        success: function (response) {
                            if (response.status) {
                                $this.parents('.image-box').remove();
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });


            $(document).on('click','.media-delete button', function() {

                if(confirm('Are you sure?')) {
                    var $this = $(this);
                    $this.attr('disabled', 'disabled');
                    var mediaID = $this.data('file');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/new-venture-media-delete')}}",
                        data: {_token: $('meta[name="csrf-token"]').attr('content'), mediaID: mediaID},
                        success: function (response) {
                            if (response.status) {
                                $this.parents('.media-box').remove();
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });

            $(document).on('click','.make-featured-image', function(){
                var $this = $(this);
                // $this.attr('disabled', 'disabled');
                var ImageID = $this.data('file');  
                var ventureID = $('#id').val();                   
                // console.log(ImageID);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/make-image-featured')}}",
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), ImageID: ImageID, ventureID: ventureID},
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)  
                            location.reload();                          
                        }else{
                            toastr.error(response.message);
                        }
                    }
                });
            });

        });

    </script>
@endsection
