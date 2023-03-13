@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create Venture | Admin Panel
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
        .photo{
            width: 100%;
            max-height: 100px;
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


                                    <form action="{{route('ventures.store')}}" method="POST" enctype="multipart/form-data" id="venture-form">
                                        @csrf
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>Create Venture</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Venture Name:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" >
                                                                        @if($errors->has('venture_name'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Date of Incorporation	:</label>
                                                                    <div class="form-group">

                                                                        <div class="datepicker1 date input-group p-0 shadow-sm">
                                                                            <input type="text" placeholder="Date of Incorporation" class="form-control box-shadow" name="date_of_incorporation" >
                                                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                        </div>
                                                                        {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" >--}}
                                                                        @if($errors->has('date_of_incorporation'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('date_of_incorporation') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Date of Purchase	:</label>
                                                                {{--<div class="form-group">--}}
                                                                <!-- Date Picker Input -->
                                                                    <div class="form-group">

                                                                        <div class="datepicker2 date input-group p-0 shadow-sm">
                                                                            <input type="text" placeholder="Date of Purchase" class="form-control box-shadow" name="date_of_Purchase" >
                                                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                        </div>

                                                                        @if($errors->has('date_of_Purchase'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('date_of_Purchase') }}
                                                                            </div>
                                                                        @endif
                                                                    </div><!-- DEnd ate Picker Input -->
                                                                    {{--</div>--}}


                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Purchase Price:</label>
                                                                    <div class="form-group">
                                                                        <input type="number" class="form-control box-shadow" placeholder="Purchase Price" name="purchase_price" >
                                                                        @if($errors->has('purcahse_price'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('purchase_price') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Target Amount:</label>
                                                                    <div class="form-group">
                                                                        <input type="number" class="form-control box-shadow" placeholder="Target Amount" name="target_amount" >
                                                                        @if($errors->has('target_amount'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('target_amount') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Market CAP:</label>
                                                                    <div class="form-group">
                                                                        <input type="number" class="form-control box-shadow" placeholder="Market CAP" name="initial_cap" step="0.01">
                                                                        @if($errors->has('initial_cap'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('initial_cap') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Staff Manager:</label>
                                                                    <div class="form-group">

                                                                        <input type="text" class="form-control box-shadow" placeholder="Staff Manager" name="staff_manager" >

                                                                        @if($errors->has('staff_manager'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('staff_manager') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Manager:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Manager" name="managing_member" >
                                                                        @if($errors->has('managing_member'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('managing_member') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture Street" name="venture_street" >
                                                                        @if($errors->has('venture_street'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture City" name="venture_city" >
                                                                        @if($errors->has('venture_city'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture State:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_state" style="height: 45px;">
                                                                            <option selected value=""> Select State </option>
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state->id}}"  >{{$state->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('venture_state'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Venture Zip" name="venture_zip" >
                                                                        @if($errors->has('venture_zip'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('venture_zip') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Status:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_status" style="height: 45px;">
                                                                            <option value="Active"  >Active</option>
                                                                            <option value="Inactive" >Inactive</option>
                                                                        </select>
                                                                        @if($errors->has('type'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('type') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_type" style="height: 45px;">
                                                                            @foreach($ventureTypes as $type)
                                                                                <option value="{{$type}}"  >{{$type}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Source Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_source_type" style="height: 45px;">
                                                                            @foreach($ventureSourceTypes as $type)
                                                                                <option value="{{$type}}"  >{{$type}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>

                                                                {{--<div class="col-md-2">--}}
                                                                {{--<label class="form-label"></label>--}}

                                                                {{--<div class="col-md-2">--}}
                                                                {{--<input type="submit" class="btn btn-sm btn-primary" value="Save" >--}}
                                                                {{--</div>--}}
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
                                                    <div class="clearfix mb-30 comments-tr"> <span>Property Management Specific</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Management Company:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Management Company:" name="property_management_company" >
                                                                        @if($errors->has('property_management_company'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_company') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label"> Management Contact:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow contact" placeholder=" Management Contact" name="property_management_contact" >
                                                                        @if($errors->has('property_management_contact'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_contact') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label"> Management Street:</label>


                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder=" Management Street" name="property_management_street" >
                                                                        @if($errors->has('property_management_street'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label"> Management Phone:</label>

                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow contact" placeholder=" Management Phone" name="property_management_phone" >
                                                                        @if($errors->has('property_management_phone'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_phone') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label"> Management City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder=" Management City" name="property_management_city" >
                                                                        @if($errors->has('property_management_city'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label"> Management State:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="property_management_state" style="height: 45px;">
                                                                            <option selected value=""> Select State </option>
                                                                            @foreach($states as $state)                                                                           
                                                                                <option value="{{$state->id}}"  >{{$state->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        @if($errors->has('property_management_state'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label"> Management Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder=" Management Zip" name="property_management_zip" >
                                                                        @if($errors->has('property_management_zip'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_management_zip') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Property Street" name="property_street" >
                                                                        @if($errors->has('property_street'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="City" name="property_city" >
                                                                        @if($errors->has('property_city'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property State:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="property_state" style="height: 45px;">
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state->id}}"  >{{$state->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        @if($errors->has('property_state'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Property Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Zip" name="property_zip" >
                                                                        @if($errors->has('property_zip'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('property_zip') }}
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
                                                    <div class="clearfix mb-30 comments-tr"> <span>Upload Media</span></div>
                                                    <div class="container2">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Document Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="document_type_id" style="height: 45px;">
                                                                            @foreach($documentTypes as $type)
                                                                                <option value="{{$type->id}}"  >{{$type->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-2">
                                                                    <label class="form-label">Visibility:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="visibility" style="height: 45px;">
                                                                            <option value="Visible">Visible</option>
                                                                            <option value="Hidden">Hidden</option>

                                                                        </select>
                                                                        @if($errors->has('visibility'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('visibility') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <label class="form-label">Choose File:</label>
                                                                    <div class="form-group">
                                                                        <input class="form-control box-shadow" name="file" id="input_multifileSelect" type="file" id="files">

                                                                        @if($errors->has('file'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('file') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Name of Document:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Document Name" name="documentName" >
                                                                        @if($errors->has('documentName'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('documentName') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Date of Document to apply	:</label>
                                                                    <div class="form-group">
                                                                        <div class="datepickerDoc date input-group p-0 shadow-sm">
                                                                            <input type="text" placeholder="Date" class="form-control box-shadow" name="date_of_document" >
                                                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                        </div>
                                                                        {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" >--}}
                                                                        @if($errors->has('date_of_document'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('date_of_document') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                {{--<div class="col-md-4">--}}
                                                                {{--<input type="button" class="uploaddocuments btn btn-sm btn-info" value="Upload" style="margin-top:35px;">--}}
                                                                {{--</div>--}}

                                                                {{--<div class="col-md-2">--}}
                                                                {{--<input type="submit" class="btn btn-sm btn-primary" value="Save" >--}}
                                                                {{--</div>--}}
                                                            </div>

                                                        </div>
                                                        <hr>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <ul style="display:inline-flex;" class="gallery row"></ul>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Upload Multiple Images Here:</label>
                                                                <div class="form-group">
                                                                    <input type="file" class="form-control box-shadow" placeholder="Images" multiple name="images[]" id="images" >
                                                                    @if($errors->has('images'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('images') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button id="submit-create-venture" type="submit" class="btn btn-sm btn-theme float-right" value="Save" style="border-radius: 50px;">
                                                                    Save
                                                                </button>
                                                            </div>
                                                            {{--<div class="col-md-4">--}}
                                                            {{--<label class="form-label">Name of Pic/Video	:</label>--}}
                                                            {{--<div class="form-group">--}}

                                                            {{--<input type="text" class="form-control box-shadow" placeholder="Name of Pic" name='nameofpic' id='nameofpic' >--}}
                                                            {{--@if($errors->has('nameofpic'))--}}
                                                            {{--<div class = "alert alert-danger">--}}
                                                            {{--{{ $errors->first('nameofpic') }}--}}
                                                            {{--</div>--}}
                                                            {{--@endif--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-md-4">--}}
                                                            {{--<input type="submit" class="btn btn-sm btn-info" value="Upload" style="margin-top: 35px;">--}}
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
@section('javaScript')
    <script type="text/javascript">
        
        $(document).ready(function() {
            $('.datepicker2').datepicker({
                format: 'mm-dd-yyyy'
            });
            $('.datepicker1').datepicker({
                format: 'mm-dd-yyyy'
            });
            $('.datepickerDoc').datepicker({
                format: 'mm-dd-yyyy'
            });
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
            $('#venture-form').submit(function(e){
                e.preventDefault();
                $('#submit-create-venture').html("<i class='fa fa-spinner fa-spin'></i>");
                $.ajax({
                    url: '{{ route('ventures.store') }}',
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            handleResponse(response.message)
                        }else{
                            toastr.error(response.message);
                            $('#submit-create-venture').html("Save");
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                        $('#submit-create-venture').html("Save");

                    }
                });
            });
        });

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
                cancelButtonText: 'Create New',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                location.href = "{{ url('admin/ventures')}}";
            } else if (
                    /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                location.reload(true);
            }
        })
        }

        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    $(placeToInsertImagePreview).empty();
                    reader.onload = function(event) {
                        $(placeToInsertImagePreview).append('<li class="mb-2 col-md-2"><img src="'+event.target.result+'" class="photo"/></li>')
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            imagesPreview(this, 'ul.gallery');
        });
    </script>
@endsection
