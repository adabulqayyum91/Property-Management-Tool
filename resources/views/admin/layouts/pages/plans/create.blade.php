@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create Plan | Admin Panel
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
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Create Plans</span></div>
{{--                                                <form action="{{route('ventures.store')}}" method="POST" enctype="multipart/form-data" id="venture-form">--}}

                                                <form action="{{route('plans.store')}}" method="POST" enctype="multipart/form-data" id="plan-form">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Name:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Plan Name" name="name">
                                                                @if($errors->has('name'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('name') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Plan Type:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control search-fields" tabindex="-98" name="plan_type">
                                                                        <option value="month">Month</option>
                                                                        <option value="year">Year</option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Price:</label>
                                                                <div class="form-group">
                                                                <input type="number" class="form-control box-shadow" placeholder="Plan Price" name="price" >
                                                                @if($errors->has('price'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('price') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Description:</label>

                                                            <div class="form-group">
                                                                    <textarea id="editor" name="description" class="col-md-12 box-shadow"></textarea>
                                                                @if($errors->has('description'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                                <div class="col-md-12 mt-3">
                                                                    <input type="submit" class="btn btn-sm btn-theme" value="Save" style="border-radius: 50px;">
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
            </div>
        </div>
    </div>

@endsection
@section('javaScript')
    <script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
    <script type="text/javascript" defer>
        if (CKEDITOR.instances['editor']) {
            CKEDITOR.remove(CKEDITOR.instances['editor']);
        }

        CKEDITOR.replace( 'editor');

        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $('#plan-form').submit(function(e){
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement(); }
            e.preventDefault();
            $.ajax({
                url: '{{route('plans.store')}}',
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
                    }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        toastr.error(item);
                    });
                }
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
                location.href = "{{ url('admin/plans')}}";
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                location.reload(true);
            }
        })
        }

    </script>
@endsection
