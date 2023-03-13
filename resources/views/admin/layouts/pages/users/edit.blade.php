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
                                    @if(session()->has('success'))
                                        <div class="alert alert-success">
                                            <strong>SUCCESS :</strong> {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            @if($currentUser->role->role->id==2)
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr float-right"> <button class="btn btn-primary"  data-toggle="modal" data-target="#deleteConfirm">Cancel Subscription</button></div>    
                                                    <div class="clearfix mb-30 comments-tr"> <span>Edit User</span></div>                                                
                                                    <form action="{{route('users.update',$currentUser->id)}}" method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <label class="form-label">Name:</label>
                                                                    <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Full Name" name="name" value="{{!is_null($currentUser->name) ? $currentUser->name : ''}}" required>
                                                                    @if($errors->has('name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('name') }}
                                                                        </div>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Email:</label>
                                                                    <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Full Name" name="email" value="{{!is_null($currentUser->email) ? $currentUser->email : ''}}" required>
                                                                    @if($errors->has('email'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('email') }}
                                                                        </div>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">First Name:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow w-full m-0" placeholder="First Name" name="first_name"
                                                                            value="{{ isset($currentUser) ? $currentUser->first_name : '' }}" required>
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
                                                                        <input type="text" class="form-control box-shadow w-full m-0" placeholder="Last Name" name="last_name"
                                                                            value="{{ isset($currentUser) ? $currentUser->last_name : '' }}" required>
                                                                            @if($errors->has('last_name'))
                                                                                    <div class = "alert alert-danger">
                                                                                        {{ $errors->first('last_name') }}
                                                                                    </div>
                                                                            @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Date of Birth:</label>
                                                                    <div class="form-group">
                                                                        <div class="date input-group p-0 shadow-sm" id="dateOfBirth">
                                                                            <input type="text" placeholder="Date of Birth" class="form-control box-shadow" name="date_of_birth" 
                                                                                value="{{ isset($currentUser) ? $currentUser->date_of_birth : '' }}">
                                                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                        </div>

                                                                        @if($errors->has('date_of_birth'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('date_of_birth') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                <label>Phone:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow w-full m-0" placeholder="Phone" name="phone" id="profile_phone"
                                                                            value="{{ isset($currentUser) ? $currentUser->phone : '' }}" required >
                                                                            @if($errors->has('profile_phone'))
                                                                                    <div class = "alert alert-danger">
                                                                                        {{ $errors->first('profile_phone') }}
                                                                                    </div>
                                                                            @endif
                                                                    </div>                                                        
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>SSN:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow w-full m-0" placeholder="Social Security Number" name="social_security_number"
                                                                            value="{{ isset($currentUser) ? $currentUser->social_security_number : '' }}" required >
                                                                            @if($errors->has('social_security_number'))
                                                                                    <div class = "alert alert-danger">
                                                                                        {{ $errors->first('social_security_number') }}
                                                                                    </div>
                                                                            @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label">Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Street" name="street" 
                                                                            value="{{ isset($currentUser) ? $currentUser->street : '' }}" required>
                                                                            @if($errors->has('street'))
                                                                                    <div class = "alert alert-danger">
                                                                                        {{ $errors->first('street') }}
                                                                                    </div>
                                                                            @endif                                                              
                                                                   </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="City" name="city" 
                                                                            value="{{ isset($currentUser) ? $currentUser->city : '' }}" require>
                                                                            @if($errors->has('city'))
                                                                                    <div class = "alert alert-danger">
                                                                                        {{ $errors->first('city') }}
                                                                                    </div>
                                                                            @endif                                                              
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">State:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="state" style="height: 45px;">
                                                                            <option selected  disabled="disabled"> Select State </option>
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state->id}}"  {{$state->id==$currentUser->state ? ' selected' : ''}} >
                                                                                    {{$state->name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('state'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Zip" name="zip" 
                                                                            value="{{ isset($currentUser) ? $currentUser->zip : '' }}" required>
                                                                            @if($errors->has('zip'))
                                                                                    <div class = "alert alert-danger">
                                                                                        {{ $errors->first('zip') }}
                                                                                    </div>
                                                                            @endif                                                              
                                                                    </div>
                                                                </div>


                                                                

                                                                {{-- TODO:Old Logic for future use --}}
                                                                {{-- <div class="col-md-6">
                                                                    <label>Profile Image:</label>
                                                                    <div class="form-group">
                                                                        <label class="btn btn-block btn-file-upload">
                                                                            @if(isset($currentUser->photo))
                                                                                <img src="{{asset('uploads/user_profile/'.$currentUser->photo)}}" class="photo" height="200px" width="100%" alt=""
                                                                                     style="display: block; margin:0 auto;">
                                                                                <input type="file" name="photo" class="w-full" style="display: none;">
                                                                            @else
                                                                                <img src="{{asset('img/avatar.png')}}" class="photo" height="200px" width="100%" alt=""
                                                                                     style="display: block; margin:0 auto;">
                                                                                <input type="file" name="photo" class="w-full" style="display: none;">
                                                                            @endif
                                                                        </label>
                                                                        @if($errors->has('photo'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('photo') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div> --}}
                                                                <div class="col-md-12">
                                                                    <input type="submit" class="btn btn-sm btn-primary box-shadow" value="Update" style="border-radius: 50px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">@if($currentUser->role->role->id==1) <span>Edit Admin</span> @else <span>Edit Property Manager</span>@endif</div>
                                                    <form action="{{route('users.update',$currentUser->id)}}" method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <label class="form-label">First Name:</label>
                                                                    <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="First Name" name="first_name" value="{{!is_null($currentUser->first_name) ? $currentUser->first_name : ''}}" required>
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
                                                                    <input type="text" class="form-control box-shadow" placeholder="Last Name" name="last_name" value="{{!is_null($currentUser->last_name) ? $currentUser->last_name : ''}}" required>
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
                                                                    <input type="text" class="form-control box-shadow" placeholder="Phone" name="phone" value="{{!is_null($currentUser->phone) ? $currentUser->phone : ''}}" required>
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
                                                                    <input type="text" class="form-control box-shadow" placeholder="Full Name" name="email" value="{{!is_null($currentUser->email) ? $currentUser->email : ''}}" required readonly="readonly">
                                                                    @if($errors->has('email'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('email') }}
                                                                        </div>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <input type="submit" class="btn btn-sm btn-primary box-shadow float-right" value="Update" style="border-radius: 50px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="tab-box-2 mt-5">
                                                    <div class="clearfix mb-30 comments-tr"><span>Change Password</span></div>
                                                    <form action="{{url('/admin/update-password',$currentUser->id)}}" method="POST" enctype="multipart/form-data">                                                        
                                                        @csrf
                                                        <div class="container">
                                                            <div class="row">               
                                                                <div class="col-md-12">
                                                                    <label>Password:</label>
                                                                    <div class="form-group">
                                                                        <input type="password" class="form-control box-shadow" name="new_password" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mt-4">
                                                                    <input type="submit" class="btn btn-sm btn-primary box-shadow float-right" value="Update" style="border-radius: 50px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
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
    
    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to cancel subscription?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="cancelSubscription" data-id={{ $currentUser->id }}>Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>            
        <script>                        
            $(document).ready(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $('#dateOfBirth').datepicker({
                    format: 'yyyy-mm-dd'
                });     

                $('#cancelSubscription').on("click", function(){
                    var userID = $("#cancelSubscription").attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: "{{ url('admin/user/cancelUserSubscription') }}",                            
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {userID},
                            success: function(response){
                                if(response.status)
                                {                                                                                                    
                                    toastr.success(response.message);
                                    setTimeout(function(){
                                        location.replace("{{ url('admin/users/') }}");
                                    },2000)                                     
                                }
                                else
                                {
                                    toastr.danger(response.message);
                                }
                            } 
                        });                                    
                });
            });
            
        </script>
@endsection
