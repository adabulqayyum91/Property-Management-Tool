@extends('web.layouts.partials.app')
@section('page_title')
    Survey | Member Panel
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
        .edit-btn{
            float: right;
            width: 44%;
            padding-left: 9px;
        }
        .del-btn{
            width: 44%;
            margin: 0 -5px;
        }
        form {
            margin-top: 0em;
        }
        .create-plans{display: block !important;}
        .btn-linked {
            margin: 0px 10px 0px 0px !important;
            /*padding: 0px !important;*/
            /*background: #fff;*/
        }
        .displayCheckbox{
            position: initial !important;
            opacity: 1 !important;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('web.layouts.partials.sideBar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="properties-section-body content-area" style="margin-top: 2%">
                                <div class="container">
                                    <div class="row">
                                            <!-- Option bar start -->
                                            <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-lg-block col-12">
                                                <h4 style="text-align: center;margin-bottom: 3%;">Survey Search</h4>
                                                <form id="survey-form">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                            <label class="form-label">Venture Name:</label>

                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                            <label class="form-label">Venture ID:</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="venture_id" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label class="form-label">Date From :</label>
                                                            <div class="form-group">
                                                                <div class="datepicker mdp date input-group p-0 shadow-sm">
                                                                    <input type="text" placeholder="Date From" class="form-control box-shadow" name="date_created_from" required >
                                                                    <div class="input-group-append"style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label class="form-label">Date To:</label>
                                                            <div class="form-group">
                                                                <div class="datepicker mdp date input-group p-0 shadow-sm">
                                                                    <input type="text" placeholder="Date To" class="form-control box-shadow" name="date_created_to" required >
                                                                    <div class="input-group-append" style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                </div>

                                                            </div><!-- DEnd ate Picker Input -->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <input class="btn btn-sm btn-theme float-right" id="searchSubmit" type="button" value="Submit" style="height: 42px;border-radius: 50px;">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session()->has('success'))
                                      <div class="alert alert-success">
                                          <strong>SUCCESS :</strong> {{ session('success') }}
                                      </div>
                                    @endif
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr">
                                                    <span>Surveys</span>
                                                </div>
                                                <div id="survey-id">
                                                    @include('web.survey.search_table_row')
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
@section('script')
    <script>
        $(document).ready(function(){
            $("#searchSubmit").click(function (e) {
                e.preventDefault();
                var formData=$(document).find('#survey-form').serialize()+"&to_user={{auth()->user()->id}}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/user/surveySearch') }}",
                    data: formData,
                    success: function (response) {
                        if(response.status == true){
                            toastr.success(response.message);
                            $("#survey-id").empty().html(response.view);
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
            $('.datepicker').datepicker({
                format: 'mm/dd/yyyy'
            });

        });
    </script>
@endsection
