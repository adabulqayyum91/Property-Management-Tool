@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create Current Venture | Admin Panel
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
        .comments-tr span {
            font-size: 16px;
            margin: 0;
            font-weight: 600;
            padding-bottom: 15px;
            display: inline-block;
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

                                <form action="{{route('update-currentVenture-create-form',$currentVentureList->id)}}"
                                      method="POST" id="updateVenture">
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
                                                            <input id="toggle-event" class="status" name="feature" type="checkbox" data-toggle="toggle" checked>
                                                            <div id="console-event"></div>
                                                        </span>
                                                </div>

                                                <div class="container">
                                                    <div class="comments-tr2">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Listing ID:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Listing Id"
                                                                           name="listing_id"
                                                                           value="{{$currentVentureList->list_automated_id}}"
                                                                           readonly>

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
                                                                <label class="form-label">Username/Email:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Username/Email"
                                                                           name="venture_name"
                                                                           value="{{count($currentVentureList->users) ? $currentVentureList->users()->first()->email : ''}}"
                                                                           required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Venture Type:</label>
                                                                <div class="form-group">
                                                                    {{$currentVentureList->venture->VentureDetail->type }}
                                                                    <select class="form-control box-shadow"
                                                                            name="venturetype" style="height: 45px;"
                                                                            readonly>
                                                                        @foreach($listingTypes as $type)
                                                                            <option value="{{$currentVentureList->venture->venture_type}}" {{$type->title===$currentVentureList->venture->venture_type ? ' selected' : ''}} >{{$type->title}}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Venture ID:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Venture ID" name="vendor_id"
                                                                           value="{{$currentVentureList->venture->venture_automated_id	}}"
                                                                           readonly>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">Venture Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Venture Name"
                                                                           value="{{$currentVentureList->venture->venture_name}}"
                                                                           name="venture_name" readonly>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Listing Status:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control box-shadow"
                                                                            name="listing_status"
                                                                            style="height: 45px;">
                                                                        <option value="Pending" {{$currentVentureList->list_status=='Pending' ? ' selected' : ''}}>Pending</option>
                                                                        <option value="Live" {{$currentVentureList->list_status=='Live' ? ' selected' : ''}}>Live</option>
                                                                        <option value="Inactive" {{$currentVentureList->list_status=='Inactive' ? ' selected' : ''}}>Inactive</option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Asking Price:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Asking Price"
                                                                           name="asking_price" >
                                                                    @if($errors->has('asking_price'))
                                                                        <div class="alert alert-danger">
                                                                            {{ $errors->first('asking_price') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">% Of Total
                                                                    Ownership:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="% Ownership For Sale"
                                                                           name="percentage_of_ownership" >
                                                                    @if($errors->has('percentage_of_ownership'))
                                                                        <div class="alert alert-danger">
                                                                            {{ $errors->first('percentage_of_ownership') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label">CAP Rate% :</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="CAP Rate" name="cap_rate"
                                                                           value="{{$currentVentureList->venture->initial_cap}}"
                                                                           >

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Description:</label>
                                                                <div class="form-group">
                                                                    <textarea type="textarea"
                                                                              class="form-control box-shadow"
                                                                              placeholder="Description"
                                                                              name="description"
                                                                              row="10"></textarea>
                                                                    @if($errors->has('description'))
                                                                        <div class="alert alert-danger">
                                                                            {{ $errors->first('description') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">

                                                                {{--<div class="form-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input"
                                                                               type="checkbox" id="gridCheck"
                                                                               name="feature" value="1">
                                                                        <p for="gridCheck">
                                                                            Feature Listing
                                                                        </p>
                                                                    </div>
                                                                </div>--}}

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
                                                <div class="clearfix mb-30 comments-tr">
                                                    <span>Property Specific</span></div>
                                                <div class="container">
                                                    <div class="comments-tr2">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label">Property Street:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Property Street"
                                                                           name="property_street"
                                                                           value="{{$currentVentureList->venture->VentureDetail->property_street}}"
                                                                           readonly>
                                                                    @if($errors->has('venture_street'))
                                                                        <div class="alert alert-danger">
                                                                            {{ $errors->first('venture_street') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Property City:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Property City"
                                                                           name="property_city"
                                                                           value="{{$currentVentureList->venture->VentureDetail->property_city}}"
                                                                           readonly>
                                                                    @if($errors->has('venture_city'))
                                                                        <div class="alert alert-danger">
                                                                            {{ $errors->first('venture_city') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Property State:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Property State"
                                                                           name="property_state"
                                                                           value="{{$currentVentureList->venture->state->name}}"
                                                                           readonly>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Property Zip:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Property Zip"
                                                                           name="property_zip"
                                                                           value="{{$currentVentureList->venture->VentureDetail->property_zip}}"
                                                                           readonly>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input type="hidden" name="lngLatStatus" value="false">
                                                                <input type="hidden" name="longitude" value="">
                                                                <input type="hidden" name="latitude" value="">
                                                                <div id="mapCanvas"></div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="document-section">
                                        @include('admin.layouts.pages.currentVentures.partials.documentTab')
                                    </div>
                                    <input type="hidden" name="id" id="id" value={!! $currentVentureList->id !!}>
                                    @csrf

                                    <div class="dashboard-list">
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
                                                                    <input class="form-control box-shadow"
                                                                           name="file" id="input_multifileSelect files"
                                                                           type="file">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Name of Document:</label>
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Document Name"
                                                                           name="documentName">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" id="id" value={!! $currentVentureList->id !!}>
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"><span>Pictures</span></div>
                                                <div class="container2">
                                                    <div class="comments-tr2">
                                                        <ul class="allimages row">

                                                            @include('admin.layouts.pages.currentVentures.partials.imagesSection')
                                                        </ul>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="form-label">Upload Multiple Images
                                                                    Here:</label>
                                                                <div class="form-group">
                                                                    <input type="file"
                                                                           class="form-control box-shadow"
                                                                           placeholder="Images" multiple
                                                                           name="images[]" id="images">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mt-3">
                                                                <input type="submit" class="btn btn-sm btn-theme"
                                                                       value="Save" style="border-radius: 50px;">
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
    <style>
        .displayinline{ display: inline-block; margin-right: 10px;}
    </style>

@endsection
@section('javaScript')
@include('admin.layouts.pages.map-script')
    {{--=========================================================================================
    Description: function for get started pop on home page after plan selection
    ----------------------------------------------------------------------------------------
    ========================================================================================== --}}

    <script type="text/javascript">
        $(document).ready(function() {
            //swal button
            function  handleResponse(message) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-warning',
                        cancelButton: 'btn btn-info mr-2'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Success',
                    text: message,
                    icon: 'success',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonText: 'View Listing',
//                    cancelButtonText: 'Create New',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                    location.href = "{{ url('admin/current-venture-listing')}}";
                } else if (
                        /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                    location.reload(true);
                }
            })
            }

            //save venture
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
                            handleResponse(response.message);
//                            toastr.success(response.message)
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
            //image popup
            $(document).on('click','.image-popup', function () {
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
            });

            //upload file
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
            //save image
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
            //date picker
            $('.datepicker2').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('.datepicker1').datepicker({
                format: 'yyyy-mm-dd'
            });
            $('.datepicker0').datepicker({
                format: 'yyyy-mm-dd'
            });
            //display image
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
                        url: "{{ url('admin/media-delete')}}",
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

        });



    </script>
@endsection
