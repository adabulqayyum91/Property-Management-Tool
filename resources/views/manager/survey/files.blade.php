@extends('manager.layouts.partials.dashboardApp')
@section('page_title')
    Survey Files | Manager Panel
@endsection
@section('content')
    <style>
        label{
            font-weight: bold;
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 5px;
            font-size: 15px;
            padding: 1px;
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
            top: 15px;
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
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('manager.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>{{$survey->subject}} <small>({{$survey->venture->venture_automated_id}})</small></h4>
                                    <form id="uploadDocument" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value={!! $survey->id !!}>
                                        @csrf

                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">
                                                        <span>Files <small>(Files are downloadable)</small></span>
                                                    </div>
                                                    <div class="container2">
                                                        <div class="comments-tr2">
                                                            <div class="document-section">
                                                                @include('manager.survey.documentTab')
                                                            </div>
                                                            <hr>
                                                            <div class="row">

                                                                <div class="col-md-2">
                                                                    <label class="form-label">Choose File:</label>
                                                                    <div class="form-group">
                                                                        <input class="form-control box-shadow" name="files" id="input_multifileSelect files" type="file">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Name of File:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="File Name" name="documentName" required>
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


                                    <form id="UploadImages" action="{{route('uploadImages')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value={!! $survey->id !!}>
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"><span>Pictures <small>(Images are downloadable)</small></span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <ul class="allimages row">
                                                                @include('manager.survey.imageSection')
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
@endsection
@section('javaScript')
    <script>
        $(document).ready(function(){
            $("#uploadDocument").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('UploadSurveyDocument') }}",
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
            $("#UploadImages").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('surveyUploadImages') }}",
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
            $(document).on('click','.image-delete button', function() {
                if(confirm('Are you sure?')) {
                    var $this = $(this);
                    $this.attr('disabled', 'disabled');
                    var mediaID = $this.data('file');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/manager/survey/image-delete')}}",
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
                        url: "{{ url('/manager/survey/image-delete')}}",
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