@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Plans | Admin Panel
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
        }
        .comments-tr span {
            font-size: 16px;
            font-weight: 600;
            padding-bottom: 15px;
            display: inline-block;
            vertical-align: sub;
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
                            @if(count($allPlans)!=0)

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> 
                                                    <span>User Plans</span>
                                                    <span class="float-right">
                                                        <input id="toggle-event" class="planStatus"  type="checkbox" data-toggle="toggle" {{$priceSectionSetting->status === 1 ? "checked" : "" }}>
                                                        <div id="console-event"></div>
                                                    </form>
                                                </div>
                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Description</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($allPlans as $plan)
                                                    <tr>
                                                        <td>{{ !is_null($i) ? $i++ : ''}}</td>
                                                        <td>{{ !is_null($plan->name) ? $plan->name : ''}}</td>
                                                        <td>{{ formatCurrency($plan->price) }}</td>
                                                        <td>{!! !is_null($plan->description) ?  $plan->description : ''!!}</td>
                                                        <td>
                                                            <form>
                                                                <input id="toggle-event" class="status" planid="{{$plan->id}}" type="checkbox" data-toggle="toggle" {{  $plan->status === 1 ? "checked" : "" }}>
                                                                <div id="console-event"></div>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{route('plans.edit',$plan->id)}}" method="GET">
                                                                <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            <form action="{{route('plans.show',$plan->id)}}" method="GET">
                                                                <button class="btn btn-linked btn-info box-shadow"><i class="fa fa-eye"></i></button>
                                                            </form>
                                                            <meta name="csrf-token" content="{{ csrf_token() }}">

                                                            <button class="btn btn-linked btn-danger box-shadow deleteRecord" data-id="{{ $plan->id }}" id="plan-destroy" ><i  class="fa fa-trash"></i></button>                                                                                                           
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $allPlans->links() !!}
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
                        url: "/admin/plans/"+id,
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

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             /* =========================================================================================
             Description: function for update plan status for showing on home yes or not
             ----------------------------------------------------------------------------------------
             ========================================================================================== */
            $('.status').change(function() {
                var status = $(this).prop('checked') === false ? 0 : 1;            
                var planid = $(this).attr('planid');
                $.ajax({

                    type:'post',

                    url: "{{url('api/plan/update-status')}}" ,

                    data:{_token: CSRF_TOKEN,status:status, id:planid},

                    success:function(response){

                        if(response.status == true){
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            )
                        }else{
                            toastr.error(response.message);
                        }
                    }

                });
            });
            /* =========================================================================================
             Description: function for show/hide plans  on home page
             ----------------------------------------------------------------------------------------
             ========================================================================================== */
             $('.planStatus').change(function() {
                var status = $(this).prop('checked') === false ? 0 : 1;
                $.ajax({

                    type:'post',

                    url: "{{url('api/setting/update-price-section-status')}}" ,

                    data:{_token: CSRF_TOKEN,status:status},

                    success:function(response){
                        if(response.status == true){
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            )
                        }else{
                            toastr.error(response.message);
                        }
                    }

                });
            });
        })
    </script>
    @endsection
