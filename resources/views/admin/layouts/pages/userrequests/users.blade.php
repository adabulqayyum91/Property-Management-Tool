@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    User Requests | Admin Panel
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


                            @if(isset($userRequests))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>User Requests</span></div>
                                                <table id="example" class="table table-bordered box-shadow" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($userRequests as $user)
                                                    <tr>
                                                        <td>{{ !is_null($i) ? $i++ : ''}}</td>
                                                        <td>{{ !is_null($user->name) ? $user->name : ''}}</td>
                                                        <td>{{ !is_null($user->email) ? $user->email : ''}}</td>
                                                        <td>{{ !is_null($user->phone) ?  $user->phone : ''}}</td>

                                                        <td>

                                                            <form action="{{route('userrequests.destroy',$user->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $userRequests->links() !!}
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
