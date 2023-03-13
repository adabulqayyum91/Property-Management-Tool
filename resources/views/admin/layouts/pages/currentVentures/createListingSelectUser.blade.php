{{--/**
 * Created by PhpStorm.
 * User: Zahra
 * Date: 4/8/2020
 * Time: 2:53 PM
 */--}}
@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Current Venture List | Admin Panel
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
        .create-btn{
            border-radius:50px
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
            display: inherit !important;
            margin-top: 0em;
        }
        .create-plans{display: block !important;}
        .btn-linked {
            margin: 0px 10px 0px 0px !important;
            /*padding: 0px !important;*/
            /*background: #fff;*/
        }
        .datepicker td, .datepicker th {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.85rem;
        }

        .datepicker {
            margin-bottom: 0;
        }
        .option-bar {
            margin-bottom: 30px;
            padding: 25px 25px;
            background: #fff;
            box-shadow: 0 0 35px rgba(0, 0, 0, 0.1);
        }
        .modal-dialog {
            max-width: 600px;
            margin: 1.75rem auto;
        }
        input[type=checkbox] {
            opacity: 1;
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
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Ventures List</span></div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="row venture-search-div">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <label class="form-label">Venture Name:</label>

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" required>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <label class="form-label">Venture ID:</label>

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="venture_id" required>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-right">
                                                        <input class="btn btn-sm btn-theme btn-md" id="searchVenture" type="button" value="Search Ventures" style="border-radius: 50px;">

                                                    </div>
                                                </div>
                                                <br>
                                                <div id="ven-id" class="ventureList">
                                                    @include('admin.layouts.pages.currentVentures.partials.popupSearchTableRow')
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Users List</span></div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="row user-search">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <label class="form-label">Username:</label>

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Username" name="username" required>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <label class="form-label">User Automated ID:</label>

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="User Automated ID" name="user_id" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                                                                <div class="form-group">
                                                                    <input class="btn btn-sm btn-theme btn-md mt-2" id="searchUser" type="button" value="Search User" onclick="getVentureOwnerUsers()" style="border-radius: 50px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="ven-id" class="user-list">

                                                    <table id="example" class="table box-shadow table-bordered w-100" >
                                                        <thead class="bg-active">
                                                        <tr>
                                                            <th>Select</th>
                                                            <th>Name</th>
                                                            <th>User Automated ID</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="3" class="text-center">
                                                                    Select Venture First.
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <input class="btn btn-sm btn-theme btn-md" type="button"  id="new_venture_listing" value="Create Current Venture listing" style="border-radius: 50px;">
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

{{-- Description: Script for current Venture listing --}}
@section('javaScript')
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'mm-dd-yyyy'
        });

        function loadVentures(pageNumber)
        {
            var ventureName = $(".venture-search-div input[name='venture_name']").val();
            var ventureId = $(".venture-search-div input[name='venture_id']").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/searchVentures') }}?page="+pageNumber,
                dataType: 'json',
                data: {
                    'venture_id': ventureId,
                    'ventureName': ventureName
                },
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        $(".ventureList").empty().html(response.view);
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
        }
        $(document).ready(function() {

            $(document).on('click', '#venture-links .pagination a', function(event){
                event.preventDefault(); 
                var page = $(this).attr('href').split('page=')[1];
                loadVentures(page);
            });

            $(document).on('click', '#user-links .pagination a', function(event){
                event.preventDefault(); 
                var page = $(this).attr('href').split('page=')[1];
                getVentureOwnerUsers(page);
            });

            //******search in popup for venture*****

            $("#searchVenture").click(function (e) {
                e.preventDefault();
                loadVentures(1);
            });

            //****popup search****
            $('#new_venture_listing').click(function () {
                var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                var radioValue = $("input[name='venture-radio']:checked").val();
                var radioUserValue = $("input[name='user-radio']:checked").val();
                if (typeof radioValue === "undefined" ){
                    toastr.error('Please Select Venture', 'Error', {timeOut: 5000});
                    return false;
                }
                if(typeof radioUserValue  === "undefined" ) {
                    toastr.error('Please Select User', 'Error', {timeOut: 5000});
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    //loader in button
                    beforeSend: function () {
                        // TODO: For future use
                        // $('.getStart').html(loading + ' Processing').attr('disabled','disabled');
                        $(this).html(loading + ' Processing').attr('disabled', 'disabled');
                    },
                    url: "{{ route('current-venture-listing.store') }}",
                    dataType: 'json',
                    data: {
                        'venture_id': radioValue,
                        'user_id': radioUserValue
                    },

                    success: function (data) {

                        if (data.status == true) {
                            $('#Login').modal("hide");
                            location.href = data.url;
                        }
                        else {
                            $.each(data.error, function (k, v) {
                                toastr.error(v, 'Error', {timeOut: 5000})
                            });
                            $('.getStart').html('GET STARTED').removeAttr('disabled');
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    },
                    type: 'POST'
                });
            });

            //*****Current Venture List****
            $("#searchSubmit").click(function (e) {
                e.preventDefault();
                var formData=$(document).find('#current-venture-form').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/searchCurrentVenture') }}",
                    data: formData,
                    success: function (response) {

                        if(response.status == true){
                            toastr.success(response.message);
                            $("#ven-id").empty().html(response.view);

                        }else{
                            toastr.error(response.message);
                        }
                    }
                });
            });
        });

        function getVentureOwnerUsers(pageNumber=1) {
            var userId = $(".user-search input[name='user_id']").val();
            var username = $(".user-search input[name='username']").val();
            var venture_id = $('input[name="venture-radio"]:checked').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/searchUser') }}?page="+pageNumber,
                data:  {
                    'user_id': userId,
                    'username':username,
                    'venture_id': venture_id
                },
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        $(".user-list").empty().html(response.view);
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
        }
    </script>
@endsection