@extends('web.layouts.partials.app')
@section('page_title')
    Create Reffer-Friend
@endsection
@section('css')
    <style>
        .error{color:red !important;}
        .form-check .radio-label{
            position: relative;
            cursor: pointer;
            color: #4d4d4d;
            font-size: 15px !important;
        }
        input[type="radio"]{
            position: absolute;
            right: 9000px;
        }
        input[type="radio"] + .label-text:before{
            content: "\f10c";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing:antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 5px;
        }

        input[type="radio"]:checked + .label-text:before{
            content: "\f192";
            color: #376bff;
            animation: effect 250ms ease-in;
        }

        input[type="radio"]:disabled + .label-text{
            color: #aaa;
        }

        input[type="radio"]:disabled + .label-text:before{
            content: "\f111";
            color: #ccc;
        }
    </style>

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
                                        <h4>Refer A Friend</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="clearfix mb-30 comments-tr"> <span>Referal Bonus - If your family or friend joins after we contact them, you will get 6 months free! </span></div>
                                            <div class="tab-box-2">
                                                <div class="submit-address">
                                                    <form method="POST" name="referralUser">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>What is the name of the person you would like us to contact on your behalf?</label>
                                                                            <input type="text" class="input-text" name="name" placeholder="Name Of Person">
                                                                            @if($errors->has('name'))
                                                                                <div class = "alert alert-danger">
                                                                                    {{ $errors->first('name') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>What is the best way to contact them?</label>
                                                                            <select class="form-control search-fields" tabindex="-98" name="contact_source">
                                                                                <option value="Email">Email</option>
                                                                                <option value="Phone">Phone</option>
                                                                                <option value="Either">Either</option>
                                                                            </select>
                                                                            @if($errors->has('contact_source'))
                                                                                <div class = "alert alert-danger">
                                                                                    {{ $errors->first('contact_source') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Email Address</label>
                                                                            <input type="text" class="input-text" name="email" placeholder="Email Address">
                                                                            @if($errors->has('email'))
                                                                                <div class = "alert alert-danger">
                                                                                    {{ $errors->first('email') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Phone Number</label>
                                                                            <input type="text" class="input-text contact" name="phone" placeholder="Phone Number">
                                                                            @if($errors->has('phone'))
                                                                                <div class = "alert alert-danger">
                                                                                    {{ $errors->first('phone') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>Special request or things you would like us to know.</label>
                                                                            <textarea class="input-text" name="description" placeholder="Description"></textarea>
                                                                            @if($errors->has('description'))
                                                                                <div class = "alert alert-danger">
                                                                                    {{ $errors->first('description') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p>We will only use this information to extend an invite to one of our information seminars or to use our services. We will not sell or otherwise use their information for any other purpose. </p>
                                                                <button class="btn btn-md button-theme" type="submit" id="saveReferral" style="border-radius: 50px;">Submit</button> </div>

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
    </div>
@endsection

{{--  =========================================================================================
 Description: Script for New Venture List
 ----------------------------------------------------------------------------------------
 ========================================================================================== --}}
@section('script')

    <script>

        $("form[name='referralUser']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                email: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
                    email: true
                },
                name: {
                    required: true
                    // minlength: 5
                },
                phone:{
                    required: true
                },
                description:{
                    required: true
                },
                contact_source:{
                    required: true
                }
            },

            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function (form) {
                var formData = $("form[name='referralUser']").serialize();
                var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}",
                    }
                });
                $.ajax({
                    beforeSend: function () {
                        $('#saveReferral').html(loading + ' Processing').attr('disabled', 'disabled');
                    },
                    type: 'POST',
                    url: "{{route('refer-friends.store')}}",
                    data: formData,
                    success: function (data) {

                        if (data.status == true) {
                            handleResponse(data.message);
                        } else {
                            $('#saveReferral').html('Submit').removeAttr('disabled');
                            toastr.error(data.error);
                            return false;
                        }
                    },

                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                            $('#saveReferral').html('Submit').removeAttr('disabled');

                        });
                    }
                });
            }
        });

        //****sweet alert method****
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
                location.href = "{{ url('refer-friends')}}";
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
