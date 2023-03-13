@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Add Property Manager | Property Manager Panel
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Add Property Manager</span></div>                                                
                                                <form action="{{url('admin/store-property-manager/')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <label class="form-label">First Name:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="First Name" name="first_name" required>
                                                                @if($errors->has('first_name'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('first_name') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <label class="form-label">Last Name:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Last Name" name="last_name" required>
                                                                @if($errors->has('last_name'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('last_name') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <label class="form-label">Phone:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Phone" name="phone" required>
                                                                @if($errors->has('phone'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('phone') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Email:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Email" name="email" required/>
                                                                @if($errors->has('email'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('email') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">

                                                                <label class="form-label">Password:</label>
                                                                <div class="form-group">
                                                                <input type="password" class="form-control box-shadow" placeholder="Password" name="password" required>
                                                                @if($errors->has('password'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('password') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input type="submit" class="btn btn-sm btn-primary box-shadow float-right" value="Add" style="border-radius: 50px;">
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
