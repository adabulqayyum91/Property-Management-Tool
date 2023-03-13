@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Users | Admin Panel
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
        .btn-linked {
            margin: 0px 10px 0px 0px !important;
            /*padding: 0px !important;*/
            /*background: #fff;*/
        }
        .filters-form{display:block !important;}
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

                            <div class="properties-section-body content-area">
                                <div class="container p-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(session()->has('success'))
                                                <div class="alert alert-success">
                                                    <strong>SUCCESS :</strong> {{ session('success') }}
                                                </div>
                                            @endif
                                            <!-- Option bar start -->
                                            <form action="{{ url('admin/users-search') }}" method="GET" class="filters-form">
                                            <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                                                <h4 style="text-align: center;margin-bottom: 2%;margin-top: 1%;">User Search</h4>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label class="form-label">User Name:</label>

                                                        <div class="form-group">
                                                            <input type="text" class="form-control box-shadow" name="name" placeholder="Search By Name"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <label class="form-label">Email:</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="email" placeholder="Search By Email"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input class="btn btn-sm btn-theme" type="submit" value="Submit" style="height: 42px; margin-top:30px;border-radius: 50px;">

                                                    </div>

                                                </div>

                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>




                        @if(isset($allUsers))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">                                                
                                                <div class="clearfix mb-30 comments-tr"> 
                                                    <span>Users 

                                                        <a href="{{ route('exportUsers') }}" class="pull-right mb-20 btn btn-warning">Export Users</a>
                                                        <a href="{{ url('admin/add-subAdmin') }}" class="pull-right mb-20 btn btn-info">Add Admin</a>
                                                        <a href="{{ url('admin/add-property-manager') }}" class="pull-right mb-20 btn btn-primary">Add Property Manager</a>
                                                    </span>
                                                </div>                                                
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-bordered box-shadow" style="width:100%">
                                                        <thead class="bg-active">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Action</th>
                                                            <th>Member ID</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            {{-- <th>Street</th>
                                                            <th>city</th>
                                                            <th>state</th>
                                                            <th>zip</th> --}}
                                                            <th>Type</th>
                                                            <th>Status</th>
                                                            <th>Verified</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($allUsers as $user)

                                                        <tr>
                                                            <td>{{ !is_null($i) ? $i++ : 'N/A'}}</td>
                                                            <td class="nowrap">
                                                                <form action="{{route('users.edit',$user->id)}}" method="GET">
                                                                    <button class="btn btn-warning box-shadow"><i class="fa fa-edit"></i></button>

                                                                </form>
                                                                <form action="{{route('users.show',$user->id)}}" method="GET">
                                                                    <button class="btn btn-info box-shadow"><i class="fa fa-eye"></i></button>


                                                                </form>
                                                                <form action="{{route('users.destroy',$user->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-danger box-shadow"><i  class="fa fa-trash"></i></button>

                                                                </form>
                                                                <form action="{{route('users.destroy',$user->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                </form>

                                                                <form action="{{route('billing-info',$user->id)}}" method="GET">
                                                                <button class="btn btn-success box-shadow"><i class="fa fa-info-circle" aria-hidden="true"></i></button>

                                                                </form>

                                                            </td>
                                                            <td>{{ !is_null($user->member_automated_id) ?  $user->member_automated_id : 'N/A'}}</td>
                                                            <td>{{ !is_null($user->first_name) ? $user->first_name : 'N/A'}}</td>
                                                            <td>{{ !is_null($user->last_name) ? $user->last_name : 'N/A'}}</td>
                                                            <td>{{ !is_null($user->email) ? $user->email : 'N/A'}}</td>
                                                            <td>{{ !is_null($user->phone) ?  $user->phone : 'N/A'}}</td>
                                                            {{-- <td>{{ !is_null($user->street) ?  $user->street : ''}}</td>
                                                            <td>{{ !is_null($user->city) ?  $user->city : ''}}</td>
                                                            <td>
                                                                 @foreach($states as $state)
                                                                    @if($state->id == $user->state)
                                                                        {{$state->name}}
                                                                    @endif    
                                                                @endforeach
                                                            </td>
                                                            <td>{{ !is_null($user->zip) ?  $user->zip : ''}}</td> --}}
                                                            <td style="width: 100px;">{{ !is_null($user->role->role) ?  $user->role->role->name : ''}}</td>
                                                            <td>
                                                                <div class="form-check pl-0">

                                                                    <input id="toggle-event" class="status" userid={{$user->id}} type="checkbox" data-toggle="toggle" {{  $user->status===1 ? "checked" : "" }}>
                                                                    <div id="console-event"></div>
                                                                </div>
                                                            </td>
                                                            <td>

                                                                <div class="form-check pl-0">

                                                                    <input id="toggle-event" class="verfied" userid={{$user->id}} type="checkbox" data-toggle="toggle" {{  $user->verified ===1 ? "checked" : "" }}>
                                                                    <div id="console-event"></div>
                                                                </div>
                                                            </td>
                                                            
                                                        </tr>

                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
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

                    url: "{{url('admin/users')}}" ,

                    data:{_token: CSRF_TOKEN,status:status, userid:userid},

                    success:function(data){

                        alert(data.success);

                    }

                });
            });

            /* =========================================================================================
             Description: function for update user as verified and now able to login
             ----------------------------------------------------------------------------------------
             ========================================================================================== */
            $('.verfied').change(function() {
                var verified = $(this).prop('checked');
                var userid = $(this).attr('userid');
                $.ajax({

                    type:'post',
                    url: "{{url('admin/users')}}" ,
                    data:{_token: CSRF_TOKEN,verified:verified, userid:userid},

                    success:function(data){

//                        alert(data.success);

                    }

                });
            })
        })

        $('#toggle-event2').change(function() {
            $('#console-event').html('Toggle: ' + $(this).prop('checked'))

        });
    </script>


@endsection
