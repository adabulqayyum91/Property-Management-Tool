@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create Venture | Admin Panel
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
        .datepicker0 td, .datepicker0 th {
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
                                    <form action="{{route('update-create-form')}}" method="POST" id="updateVenture">
                                        @csrf
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>New Venture Listing </span> <span class="form-check pl-0 pull-right">
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
                                                                        <input type="text" class="form-control box-shadow" placeholder="Listing Id" name="listing_id" value="{{request()->id}}" readonly>
                                                                        @if($errors->has('purcahse_price'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('purchase_price') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow"
                                                                                name="venturetype" style="height: 45px;" readonly>
                                                                            @foreach($listingTypes as $type)
                                                                                <option value="{{$venture->venture_type}}"  {{$type->title===$venture->venture_type ? ' selected' : ''}} >{{$type->title}}</option>
                                                                            @endforeach

                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Listing Status:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="listing_status" style="height: 45px;">
                                                                            <option value="Pending">Pending</option>
                                                                            <option value="Live">Live</option>
                                                                            <option value="Inactive">Inactive</option>

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
                                                                            <input type="text" placeholder="Date of Incorporation" class="form-control box-shadow" name="date_fund_by" value="{{ \Carbon\Carbon::parse($venture->date_of_incorporation)->format('m/d/Y')}}" readonly>
                                                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                        </div>
                                                                        {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" required>--}}
                                                                        @if($errors->has('date_of_incorporation'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('date_of_incorporation') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Name:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture Name" value="{{$venture->venture_name}}" name="venture_name" readonly>
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
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="vendor_id" value="{{$venture->venture_automated_id	}}" readonly>
                                                                        @if($errors->has('purcahse_price'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('purcahse_price') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Target Amount:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Target Amount" name="target_amount" value="{{$venture->target_amount}}" readonly>
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
                                                                        <input type="text" class="form-control box-shadow" placeholder="CAP Rate" name="cap_rate" value="{{$venture->initial_cap}}" readonly>
                                                                        @if($errors->has('managing_member'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('managing_member') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Description:</label>
                                                                    <div class="form-group">
                                                                        <textarea  type="textarea" class="form-control box-shadow" placeholder="Description" name="description" style="height: 150px;"></textarea>
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
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Street" name="property_street" value="{{ !is_null($venture->VentureDetail) ? $venture->VentureDetail->property_street : ''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property City" name="property_city" value="{{!is_null($venture->VentureDetail) ? $venture->VentureDetail->property_city : ''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property State:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property State" name="property_state" value="{{ !is_null($venture->state) ? $venture->state->name : ''}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Zip" name="property_zip"  value="{{ !is_null($venture->VentureDetail)?$venture->VentureDetail->property_zip:''}}" readonly>
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
                                {{--    <div class="document-section">
                                        @include('admin.layouts.pages.newVentures.partials.documentTab')
                                    </div>--}}
{{--                                            <input type="hidden" name="id" id="id" value={!! $newVentureList->id !!}>--}}
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
                                                                        <input class="form-control box-shadow" name="file" id="input_multifileSelect" type="file" id="files">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Name of Document:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Document Name" name="documentName" >
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                            <input type="hidden" name="id" id="id" value={!! $newVentureList->id !!}>--}}
                                            <div class="dashboard-list">
                                                <div class="dashboard-message bdr clearfix ">
                                                    <div class="tab-box-2">
                                                        <div class="clearfix mb-30 comments-tr"><span>Pictures</span></div>
                                                        <div class="container2">
                                                            <div class="comments-tr2">
                                                             {{--   <ul class="allimages row">
                                                                    @include('admin.layouts.pages.newVentures.partials.imagesSection')
                                                                </ul>
                                                                <hr>--}}
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Upload Multiple Images Here:</label>
                                                                        <div class="form-group">
                                                                            <input type="file" class="form-control box-shadow" placeholder="Images" multiple name="images[]" id="images" >
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <input type="submit" class="btn btn-sm btn-theme" value="Save" style="border-radius: 50px;">
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
   {{--  =========================================================================================
    Description: Script for New Venture List
    ----------------------------------------------------------------------------------------
    ========================================================================================== --}}
@endsection
@section('javaScript')
    @include('admin.layouts.pages.map-script')
    <script type="text/javascript">
        $(document).ready(function() {
            //****Swal button****
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
                    location.href = "{{ url('admin/new-venture-listing')}}";
                } else if (
                        /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                    location.reload(true);
                }
            })
            }
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
                            handleResponse(response.message);
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
            //****Image popup for view****
            $(document).on('click','.image-popup', function () {
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
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

            //****Delete New Venture List Document****

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
