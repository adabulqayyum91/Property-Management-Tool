@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create Current Venture | Admin Panel
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
        .datepicker0 td, .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker0 {
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

        .media-box:hover .media-status, .media-box:hover .media-delete, .image-box:hover .image-delete{
            display: block;
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
        .comments-tr span {
            font-size: 16px;
            margin: 0;
            font-weight: 600;
            padding-bottom: 15px;
            display: inline-block;
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

                                    <form action="{{route('current-venture-listing.update',$currentVentureList->id)}}" id="updateVenture" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>Current Venture Listing Details </span>
                                                        <span class="form-check pull-right">
                                                        <span for="gridCheck">
                                                            Feature Listing
                                                        </span>
                                                        <input id="toggle-event" class="status"  name="feature_listing" type="checkbox" data-toggle="toggle" {{  $currentVentureList->feature ===1 ? "checked" : "" }}>
                                                        <div id="console-event"></div>
                                                    </span>
                                                    </div>


                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Listing ID:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Listing Id" name="listing_id" value="{{$currentVentureList->list_automated_id}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Member ID:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Member ID" name="venture_name"
                                                                               value="{{count($currentVentureList->users) ? $currentVentureList->users()->first()->member_automated_id : ''}}"
                                                                               required readonly>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Username:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Username"
                                                                               name="venture_name"
                                                                               value="{{count($currentVentureList->users) ? $currentVentureList->users()->first()->email : ''}}"
                                                                               required readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Type:</label>

                                                                    <div class="form-group">
                                                                        {{$currentVentureList->venture->VentureDetail->type }}
                                                                        <input class="form-control box-shadow"
                                                                            name="venturetype" style="height: 45px;" value="{{$currentVentureList->venture->venture_type}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture ID:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="vendor_id" value="{{$currentVentureList->venture->venture_automated_id}}" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Name:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture Name" value="{{$currentVentureList->venture->venture_name}}" name="venture_name" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">CAP Rate% :</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="CAP Rate" name="cap_rate" value="{{!is_null($currentVentureList->venture)?$currentVentureList->venture->initial_cap:''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Listing Status:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="listing_status" style="height: 45px;">
                                                                            <option value="Pending" {{$currentVentureList->list_status=='Pending' ? ' selected' : ''}}>Pending</option>
                                                                            <option value="Live" {{$currentVentureList->list_status=='Live' ? ' selected' : ''}}>Live</option>
                                                                            <option value="Inactive" {{$currentVentureList->list_status=='Inactive' ? ' selected' : ''}}>Inactive</option>

                                                                        </select>
                                                                        @if($errors->has('listing_status'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('listing_status') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">Asking Price:</label>
                                                                    <div class="form-group">
                                                                        <input type="number" class="form-control box-shadow" placeholder="Asking Price" name="asking_price" value="{{$currentVentureList->asking_price}}" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <label class="form-label">% Of Owner's Holdings:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="% Of Owner's Holdings"
                                                                               value="{{$currentVentureList->percentage_of_ownership}}"
                                                                               name="percentage_of_ownership" required>
                                                                        @if($errors->has('percentage_of_ownership'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('percentage_of_ownership') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Description:</label>
                                                                    <div class="form-group">
                                                                        <textarea  type="textarea" class="form-control box-shadow" placeholder="Description" name="description" required row="10">{{$currentVentureList->description}}</textarea>
                                                                        @if($errors->has('desc'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('desc') }}
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
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Street" name="property_street" value="{{$currentVentureList->venture->VentureDetail->property_street}}" readonly>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property City" name="property_city" value="{{$currentVentureList->venture->VentureDetail->property_city}}" readonly>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property State:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property State" name="property_state" value="{{$currentVentureList->venture->state->name}}" readonly>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Zip" name="property_zip"  value="{{$currentVentureList->venture->VentureDetail->property_zip}}" readonly>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <label class="form-label">Use Marker to set location:</label>                                                                    
                                                                    <input type="checkbox" name="useMarker" {{ ($currentVentureList->useMarker) ? 'checked' : '' }} style="width:30px; height: 20px;">                                                                    
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="hidden" name="lngLatStatus" value="{{ ($currentVentureList->useMarker) ? 'true' : 'false' }}">
                                                                    <input type="hidden" name="longitude" value="{{!is_null($currentVentureList->longitude)?$currentVentureList->longitude:''}}">
                                                                    <input type="hidden" name="latitude" value="{{!is_null($currentVentureList->latitude)?$currentVentureList->latitude:''}}">
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
                                        <input type="hidden" name="id" id="id" value={!! $currentVentureList->id !!}>
                                        @csrf

                                        <div class="dashboard-list">
                                            <div class="document-section">
                                                <div class="tabs-section" style="border:1px solid #eee;">
                                                    <div class="row2">

                                                        <div class="col-md-12">
                                                            <div class="tab-content" id="myTabContent">

                                                                <div class="row text-center">
                                                                    @foreach($currentVentureList->medias()->where('type', null)->get() as $file)
                                                                        <div class="col-md-3 media-box">
                                                                            <a href="{{ asset('uploads/ventures/'.$file->file_name) }}" download
                                                                               style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                                <h6>{{$file->title}}</h6>
                                                                                <small>{{ \Carbon\Carbon::parse($file->created_at)->format('m-d-Y') }}</small>
                                                                            </a>
                                                                                <span class="media-delete">
                                                                                    <button type="button"
                                                                                        data-file="{{$file->id}}"
                                                                                        class="btn btn-xs btn-warning">
                                                                                        <i class="fa fa-trash"></i></button>
                                                                                </span>
                                                                        </div>
                                                                    @endforeach
                                                                    @foreach($propertySummaries as $file)
                                                                        <div class="col-md-3 media-box">
                                                                            <a href="{{ asset('uploads/ventures/'.$file->file_name) }}" download
                                                                               style="display: block;border: 1px solid #0a0a00;padding: 10px;border-radius: 2px;">
                                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                                <h6>{{$file->title}}</h6>
                                                                                <small>{{ \Carbon\Carbon::parse($file->created_at)->format('m-d-Y') }}</small>
                                                                            </a>
                                                                                <span class="media-delete">
                                                                                    <button type="button"
                                                                                        data-file="{{$file->id}}"
                                                                                        class="btn btn-xs btn-warning">
                                                                                        <i class="fa fa-trash"></i></button>
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
                                                                    <input type="submit" class="uploaddocuments btn btn-sm btn-theme" value="Upload" style="margin-top: 35px;border-radius:50px;">
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
                                        <input type="hidden" name="id" id="id" value={!! $currentVentureList->id !!}>
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"><span>Pictures</span></div>
                                                    <div class="container2">
                                                        <div class="comments-tr2">
                                                            @php
                                                                $newVentureListImages = $currentVentureList->medias()->where('type', 'IMAGE')->get();                                                                    
                                                                $ventureImages = $venture->medias()->where('type', 'IMAGE')->get();
                                                            @endphp
                                                            <p>Venture Images:<br><small>(Note: Deleting the image here will also delete the image in venture section)</small></p>
                                                            <ul class="allimages row">
                                                                @foreach($ventureImages as $image)
                                                                    <li class="col-md-2 image-box">
                                                                        <button type="button"
                                                                        data-file="{{$image->id}}"
                                                                        class="btn btn-primary btn-block make-featured-image {{ ($currentVentureList->featuredImageId == $image->id) ? '' : 'not-featured' }}">
                                                                            <i class="fa fa-star"></i>
                                                                        </button>
                                                                        <img src="{{ asset('uploads/ventures/'.$image->file_name) }}" alt="{{ $currentVentureList->venture->venture_name }}" class="img-responsive image-popup mb-4 mt-2" style="width: 100%; height: 140px;" >
                                                                        <span class="image-delete">
                                                                            <button type="button"
                                                                                  data-file="{{$image->id}}"
                                                                                  class="btn btn-xs btn-warning"><i
                                                                                  class="fa fa-trash"></i></button>
                                                                            </span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <p>Listing Images:</p>
                                                            <ul class="allimages row">
                                                                @foreach($newVentureListImages as $image)
                                                                    <li class="col-md-2 image-box">
                                                                        <button type="button"
                                                                        data-file="{{$image->id}}"
                                                                        class="btn btn-primary btn-block make-featured-image {{ ($currentVentureList->featuredImageId == $image->id) ? '' : 'not-featured' }}">
                                                                            <i class="fa fa-star"></i>
                                                                        </button>
                                                                        <img src="{{ asset('uploads/ventures/'.$image->file_name) }}" alt="{{ $currentVentureList->venture->venture_name }}" class="img-responsive image-popup mb-4 mt-2" style="width: 100%; height: 140px;" >
                                                                        <span class="image-delete">
                                                                            <button type="button"
                                                                                  data-file="{{$image->id}}"
                                                                                  class="btn btn-xs btn-warning"><i
                                                                                  class="fa fa-trash"></i></button>
                                                                            </span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-4 image-box">
                                                                    <label class="form-label">Upload Multiple Images Here:</label>
                                                                    <div class="form-group">
                                                                        <input type="file" class="form-control box-shadow" placeholder="Images" multiple name="images[]" id="images" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="submit" class="but_upload btn btn-sm btn-theme"
                                                                           value="Upload" style="margin-top: 35px;border-radius:50px;">
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

    {{-- =========================================================================================
    Description: Script for edit Current Venture Listing
    ----------------------------------------------------------------------------------------
    ========================================================================================== --}}

    <script type="text/javascript">
        $(document).ready(function() {

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

            //open image in popup
            $(document).on('click','.image-popup', function () {
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
            });
            //update form detail
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
            //save document
            $("#uploadDocument").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('UploadCurrentVentureListDocument') }}",
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
            //save images
            $("#UploadImages").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('currentListingVentureUploadImages') }}",
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
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
            //date picker
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
            //delete document
            $(document).on('click','.media-delete button', function() {

                if(confirm('Are you sure?')) {
                    var $this = $(this);
                    $this.attr('disabled', 'disabled');
                    var mediaID = $this.data('file');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/current-venture-media-delete')}}",
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
