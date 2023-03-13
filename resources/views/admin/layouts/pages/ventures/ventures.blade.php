@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Ventures | Admin Panel
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
            display: inline-block !important;
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
                            <!-- Properties section body start -->
                            <div class="properties-section-body content-area" style="margin-top: 5%">
                                <div class="container">
                                    <div class="row">
                                        <div class="">
                                            <!-- Option bar start -->
                                            <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                                                <h4 style="text-align: center;margin-bottom: 3%;">Venture Search</h4>
                                                <form id="venture-form">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="float-right mb-3">
                                                        <a href="{{ route('ventures.create') }}" class="btn btn-sm btn-theme btn-md"  style="border-radius: 50px;">Create Venture</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <label class="form-label">Venture Type:</label>
                                                        <div class="form-group">
                                                            <select class="form-control box-shadow" name="type" style="height: 45px;">
                                                                <option value="Any">Any</option>
                                                                <option value="Single Family">Single Family</option>
                                                                <option value="Multi Family">Multi Family</option>
                                                                <option value="Retail">Retail</option>
                                                                <option value="Comercial">Commercial</option>

                                                            </select>
                                                    </div>
                                                    </div>
                                                    {{-- TODO: Old Logic for future use --}}
                                                    {{-- <div class="col-lg-4 col-md-4 col-sm-4">

                                                        <label class="form-label">Venture Catogory:</label>
                                                        <div class="form-group">
                                                            <select class="form-control box-shadow" name="catogory" style="height: 45px;">
                                                                <option value="newVenture">New Venture</option>
                                                                <option value="currentVenture">Current Venture</option>
                                                            </select>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <label class="form-label">Venture Name:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" placeholder="Venture Name" name="venture_name" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <label class="form-label">Venture ID:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" placeholder="Venture ID" name="venture_id" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <label class="form-label">Date Created From	:</label>
                                                    {{--<div class="form-group">--}}
                                                    <!-- Date Picker Input -->
                                                        <div class="form-group">
                                                            <div class="datepicker date input-group p-0 shadow-sm">
                                                                <input type="text" placeholder="Date Created From" class="form-control box-shadow" name="date_created_from" required >
                                                                <div class="input-group-append"style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                            </div>

                                                        </div><!-- DEnd ate Picker Input -->

                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                        <label class="form-label">To:</label>
                                                    <!-- Date Picker Input -->
                                                        <div class="form-group">
                                                            <div class="datepicker date input-group p-0 shadow-sm">
                                                                <input type="text" placeholder="To" class="form-control box-shadow" name="date_created_to" required >
                                                                <div class="input-group-append" style="position: absolute;right: 0;height: 100%;"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                            </div>

                                                        </div><!-- DEnd ate Picker Input -->


                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="btn btn-sm btn-theme" id="searchSubmit" type="button" value="Submit" style="height: 42px;border-radius: 50px;">

                                                    </div>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Properties section body end -->
                            @if(isset($allVentures))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Ventures</span></div>
                                                <div id="ven-id">
                                                <table id="venturesTable" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Venture ID</th>
                                                        <th>Name</th>
                                                        <th>Target Amount</th>
                                                        <th>Market CAP</th>
                                                        <th>Source Type</th>
                                                        <th>Venture Type</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($allVentures as $venture)
                                                    <tr>
                                                        <td>{{ $loop->iteration  }}</td>
                                                        <td>{{ !is_null($venture->venture_automated_id) ? $venture->venture_automated_id : '---'}}</td>
                                                        <td>{{ !is_null($venture->venture_name) ? $venture->venture_name : ''}}</td>
                                                        <td>{{ !is_null($venture->target_amount) ?  formatCurrency($venture->target_amount): 'N/A'
                                                            }}
                                                        </td>
                                                        <td>{{ !is_null($venture->initial_cap) ?  $venture->initial_cap.'%' : '0%'}}</td>
                                                        <td>{{ !is_null($venture->venture_source_type) ?  $venture->venture_source_type : ''}}</td>
                                                        <td>{{ !is_null($venture->venture_type) ?  $venture->venture_type : ''}}</td>
                                                        <td>{{ !is_null($venture->venture_status) ?  $venture->venture_status : ''}}</td>
                                                        <td style="white-space: nowrap;">
                                                            <form action="{{route('ventures.edit',$venture->id)}}" method="GET">
                                                                <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            {{--<form action="{{route('ventures.show',$venture->id)}}" method="GET">--}}
                                                                {{--<button class="btn btn-linked btn-info box-shadow"><i class="fa fa-eye"></i></button>--}}
                                                            {{--</form>--}}
                                                           {{-- <form action="{{route('ventures.destroy',$venture->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                            </form>--}}
                                                            <meta name="csrf-token" content="{{ csrf_token() }}">

                                                            <button class="btn btn-linked btn-danger box-shadow deleteRecord" data-id="{{ $venture->id }}"><i  class="fa fa-trash"></i></button>

                                                            <a  title="Rental Details" 
                                                                href="{{url('admin/venture-rental-detail/'.$venture->id)}}"target="_blank" 
                                                                class="btn btn-linked btn-primary box-shadow">RD</a>
                                                            <a  title="Ownership Details"
                                                                href="{{url('admin/venture-ownership-detail/'.$venture->id)}}" 
                                                                target="_blank" 
                                                                class="btn btn-linked btn-info box-shadow">OD</a>
                                                            <a  title="Property Managers"
                                                                href="{{url('admin/venture-managers/'.$venture->id)}}" 
                                                                target="_blank" 
                                                                class="btn btn-linked btn-success box-shadow">PM</a>
                                                            <a  title="Transactions"
                                                                href="{{url('admin/venture-transactions/'.$venture->id)}}" 
                                                                target="_blank" 
                                                                class="btn btn-linked btn-danger box-shadow">TR</a>
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $allVentures->links() !!}
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javaScript')
    <script type="text/javascript" defer>

        //******search in Index page*****
        $("#searchSubmit").click(function (e) {
            e.preventDefault();
            var formData=$(document).find('#venture-form').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/venturesSearch') }}",
                data: formData,
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        $("#ven-id").empty().html(response.view);
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
            format: 'mm-dd-yyyy'
        });
        $(".deleteRecord").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                $.ajax(
                    {
                        url: "{{url('')}}"+"/admin/ventures/"+id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token
                        },
                        success: function (response){
                            if(response.status == true){
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                )
                                location.reload(true);
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
        })

        });

    </script>
@endsection
