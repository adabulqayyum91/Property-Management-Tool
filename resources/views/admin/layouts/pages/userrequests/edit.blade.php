@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit User | Admin Panel
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
    </style>
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Update User</span></div>
                                                <form action="{{route('users.update',$user->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Name:</label>
                                                                <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{!is_null($user->name) ? $user->name : ''}}" required readonly="readonly">
                                                                @if($errors->has('name'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('name') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Email:</label>
                                                                <input type="text" class="form-control" placeholder="Full Name" name="email" value="{{!is_null($user->email) ? $user->email : ''}}" required readonly="readonly">
                                                                @if($errors->has('email'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('email') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Status:</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>In Active</option>
                                                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>

                                                                </select>
                                                                @if($errors->has('status'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('status') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="submit" class="btn btn-sm btn-theme btn-faqs" value="Update" style="border-radius: 50px;">
                                                            </div>
                                                        </div>
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

@endsection
