@extends('manager.layouts.partials.dashboardApp')
@section('page_title')
    Communication | Manager Panel
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
                @include('manager.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="properties-section-body content-area" style="margin-top: 2%">
                                <div class="container">
                                    <div class="row">
                                            <!-- Option bar start -->
                                            <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-lg-block col-12">
                                                <h4 style="text-align: center;margin-bottom: 3%;">Message Search</h4>
                                                <form id="communication-form">
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
                                                <!-- <button data-toggle="modal" data-target="#compose-email-vpm" style="margin-top:-10px" class="btn btn-danger float-right">Create Message For PM</button> -->
                                                <button data-toggle="modal" data-target="#compose-email-vo" style="margin-top:-10px" class="btn btn-warning float-right">Create Message VO</button>
                                                <div class="clearfix mb-30 comments-tr">
                                                    <span>Inbox</span>
                                                </div>
                                                <div id="communication-id">
                                                    @include('manager.communication.search_table_row')
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
    <div class="modal fade" id="compose-email-vo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Compose email to Venture Owners?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('/manager/communication-vo/store')}}">
                    @csrf
                    <div class="modal-body">
                        <label>Venture:</label>
                        <select class="form-control" name="venture_id" required>
                            @foreach($ventures as $v)
                                <option value="{{$v->id}}">{{$v->venture_name}}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <label>Subject:</label>
                        <input class="form-control" type="text" name="subject" required/>
                        <br><br>
                        <label>Body:</label>
                        <textarea class="form-control" name="body" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary cancel-commit">Send</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <div class="modal fade" id="compose-email-vpm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Compose email to Property Managers?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('/user/communication-vpm/store')}}">
                    @csrf
                    <div class="modal-body">
                        <label>Venture:</label>
                        <select class="form-control" name="venture_id" required>
                            @foreach($ventures as $v)
                                <option value="{{$v->id}}">{{$v->venture_name}}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <label>Subject:</label>
                        <input class="form-control" type="text" name="subject" required/>
                        <br><br>
                        <label>Body:</label>
                        <textarea class="form-control" name="body" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary cancel-commit">Send</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>

    <div class="modal fade commit-popup" id="confirmBulkDelete"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelSaleLabel">Bulk Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="delete-emails">Yes</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>    
@endsection
@section('javaScript')
    <script>
        $(document).ready(function(){
            $("#searchSubmit").click(function (e) {
                e.preventDefault();
                var formData=$(document).find('#communication-form').serialize()+"&to_user={{auth()->user()->id}}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/manager/communicationSearch') }}",
                    data: formData,
                    success: function (response) {
                        if(response.status == true){
                            toastr.success(response.message);
                            $("#communication-id").empty().html(response.view);
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
            $('#delete-emails').click(function () {     

                $("#confirmBulkDelete").modal('hide');                      
                var checkedArray = [];
                var input = document. getElementsByName('communication_id[]'); 
                
                for(var i = 0; i < input.length; i++)
                {
                    if(input[i].checked)
                    {                        
                        checkedArray.push(parseInt(input[i].value));
                    }
                }
                var finalValues = checkedArray.join(",");
                console.log(checkedArray);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/manager/communication/bulk-delete') }}",
                    data: 'ids='+finalValues,
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    success: function (response) {                          
                        if(response.status == true){
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then(function(){
                                    location.reload();
                                }
                            );
                        }else{
                            toastr.error(response.message, 'Error', {timeOut: 5000});
                        }
                    },
                });
            });

        });
    </script>
@endsection
