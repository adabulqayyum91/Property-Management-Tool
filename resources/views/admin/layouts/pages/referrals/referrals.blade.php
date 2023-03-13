@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Referrals | Admin Panel
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
        .create-plans{display: block !important;}
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
                            @if(isset($allReferrals))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Referrals</span></div>
                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Referred Name</th>
                                                        <th>Referred ID</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($allReferrals as $refer)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ !is_null($refer->user_id) ? $refer->user_id : ''}}</td>
                                                        <td>{{ !is_null($refer->statuses) ? $refer->statuses()->first()->title : ''}}</td>
                                                        <td>{{ !is_null($refer->first_name) ? $refer->first_name : ''}}</td>
                                                        <td>{{ !is_null($refer->last_name) ? $refer->last_name : ''}}</td>
                                                        <td>{{ !is_null($refer->phone) ? $refer->phone : ''}}</td>
                                                        <td>{{ !is_null($refer->email) ? $refer->email : ''}}</td>
                                                        <td>{{ !is_null($refer->referred_by_name) ? $refer->referred_by_name : ''}}</td>
                                                        <td>{{ !is_null($refer->referred_by_id) ? $refer->referred_by_id : ''}}</td>
                                                        <td>
                                                            <form action="{{route('referrals.edit',$refer->id)}}" method="GET">
                                                                <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            <form action="{{route('referrals.destroy',$refer->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $allReferrals->links() !!}
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
