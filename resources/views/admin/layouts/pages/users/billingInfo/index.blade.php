@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Users | Admin Panel
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
            display: inline-block !important;
            margin-top: 0em;
        }
        .btn-linked {
            margin: 0px 10px 0px 0px !important;
            /*padding: 0px !important;*/
            /*background: #fff;*/
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">

                                @if(count($allUsers)!=0)

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>Users</span></div>
                                                    <table id="example" class="table table-bordered box-shadow" style="width:100%">
                                                        <thead class="bg-active">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Plan</th>
                                                            {{--<th>Status</th>--}}
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($allUsers as $user)
                                                            @if(!is_null($user->role->role) && $user->role->role->name !='Admin')
                                                            <tr>
                                                                <td>{{ !is_null($i) ? $i++ : ''}}</td>
                                                                <td>{{ !is_null($user->name) ? $user->name : ''}}</td>
                                                                <td>{{ !is_null($user->email) ? $user->email : ''}}</td>
                                                                <td>{{ !is_null($user->plan) ?  $user->plan->name : ''}}</td>
                                                                <td>
                                                                    <form action="{{route('billing-info',$user->id)}}" method="GET">
                                                                        <button class="btn btn-linked btn-info box-shadow"><i class="fa fa-eye"></i></button>


                                                                    </form>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    {!! $allUsers->links() !!}
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
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


        $(function() {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $('.status').change(function() {




                var status = $(this).prop('checked');
                var userid = $(this).attr('userid');
                //$('#console-event').html('Toggle: ' + $(this).attr('userid'))
                $.ajax({

                    type:'post',

                    url:'/admin/users',

                    data:{_token: CSRF_TOKEN,status:status, userid:userid},

                    success:function(data){

                        alert(data.success);

                    }

                });
            })
        })






        $('#toggle-event2').change(function() {
            $('#console-event').html('Toggle: ' + $(this).prop('checked'))













        });

    </script>


@endsection
