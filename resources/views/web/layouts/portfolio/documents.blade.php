@extends('web.layouts.partials.app')
@section('page_title')
Venture Documents | Property Management Tool
@endsection

@section('content')
<div class="dashboard">
    <div class="container-fluid">
        <div class="row">
            @include('web.layouts.partials.sideBar')
            <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                <div class="content-area5">
                    <div class="dashboard-content">
                        <div class="dashboard-header clearfix">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h4>Documents</h4>
                                </div>
                            </div>
                            <div class="dashboard-list">
                                <div class="dashboard-message bdr clearfix ">
                                    <div class="tab-box-2">
                                        <div class="clearfix mb-30 comments-tr">
                                            <span>Download Information</span>
                                        </div>
                                        <div class="container">
                                            <div class="comments-tr2">
                                                <form id="download-information">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Date of Document
                                                            from:</label>
                                                            <div class="form-group">
                                                                <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                    <input type="text" placeholder="Date"
                                                                    class="form-control box-shadow"
                                                                    name="from"
                                                                    required>
                                                                    <div class="input-group-append"><span
                                                                        class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">To:</label>
                                                            <div class="form-group">
                                                                <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                    <input type="text" placeholder="Date"
                                                                    class="form-control box-shadow"
                                                                    name="to"
                                                                    required>
                                                                    <div class="input-group-append"><span
                                                                        class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>
                                                                {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" required>--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="submit" class="btn btn-sm btn-theme"
                                                            value="Submit" style="margin-top:35px; border-radius: 50px;">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="document-section">
                                                @include('web.layouts.venture.documentTab')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- TODO: OLD LOGIC --}}
                            {{-- <form id="uploadDocument" action="{{url('portfolio/upload-document')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value={!! $currentVenture->id !!}>
                                @csrf

                                <div class="dashboard-list">
                                    <div class="dashboard-message bdr clearfix ">
                                        <div class="tab-box-2">
                                            <div class="clearfix mb-30 comments-tr">
                                                <span>Upload Information</span></div>
                                                <div class="container">
                                                    <div class="comments-tr2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Document Type:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control box-shadow" name="document_type_id" style="height: 45px;">
                                                                        @foreach($documentTypes as $type)
                                                                        <option value="{{$type->id}}"  >{{$type->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="visibility" value="Visible">

                                                            <div class="col-md-6">
                                                                <label class="form-label">Choose File:</label>
                                                                <div class="form-group">
                                                                    <input class="form-control box-shadow" name="file" id="input_multifileSelect" type="file" id="files">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Name of Document:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Document Name" name="documentName" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Date of Document to apply :</label>
                                                                <div class="form-group">
                                                                    <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                        <input type="text" placeholder="Date" class="form-control box-shadow" name="date_of_document" >
                                                                        <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="submit" class="uploaddocuments btn btn-sm btn-theme" value="Upload" style="border-radius: 50px;">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
        $(document).ready(function(){
            $('#download-information').submit(function(e){
                e.preventDefault();

                var form = $(this);
                $.ajax({
                    url: "{{ url('user/download-information') }}",
                    type: 'POST',
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), from: form.find('input[name="from"]').val(), to: form.find('input[name="to"]').val(), id: {{$currentVenture->id}}},
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            $('.document-section').html(response.data);
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
            $("#uploadDocument").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ url('portfolio/upload-document') }}",
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
            $('.datepicker0').datepicker({
                format: 'mm-dd-yyyy'
            });
        });
    </script>
    @endsection
