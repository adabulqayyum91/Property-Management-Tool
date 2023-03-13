@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit Referrals | Admin Panel
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Edit Referral</span></div>
                                                @if(isset($currentReferral))
                                                <form action="{{route('referrals.update',$currentReferral->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Referral Status:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="status_id">
                                                                        <option value="{{ !is_null($currentReferral->status_id) ? $currentReferral->status_id : '' }}">{{ !is_null($currentReferral->statuses()->first()->title) ? $currentReferral->statuses()->first()->title : '' }}</option>
                                                                        @if(isset($allStatuses))
                                                                            @foreach($allStatuses as $status)
                                                                                <option value="{{ !is_null($status->id) ? $status->id : ''}}">{{ !is_null($status->title) ? $status->title : '' }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">User:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="user_id">
                                                                        @if(isset($allUsers))
                                                                            @foreach($allUsers as $user)
                                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">First Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="First Name" value="{{ !is_null($currentReferral->first_name) ? $currentReferral->first_name : ''}}" name="first_name" required>
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
                                                                    <input type="text" class="form-control box-shadow" placeholder="Last Name" value="{{ !is_null($currentReferral->last_name) ? $currentReferral->last_name : ''}}" name="last_name" required>
                                                                    @if($errors->has('last_name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('last_name') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">Email:</label>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control box-shadow" placeholder="Email" value="{{ !is_null($currentReferral->email) ? $currentReferral->email : ''}}" name="email" readonly required>
                                                                    @if($errors->has('email'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('email') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">Phone:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Phone" value="{{ !is_null($currentReferral->phone) ?  $currentReferral->phone : '' }}" name="phone" required>
                                                                    @if($errors->has('phone'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('phone') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">Referred Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Referred Name" value="{{ !is_null($currentReferral->referred_by_name) ? $currentReferral->referred_by_name : ''}}" name="referred_by_name" required>
                                                                    @if($errors->has('referred_by_name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('referred_by_name') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Referred ID:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Referred ID" value="{{!is_null($currentReferral->referred_by_id) ? $currentReferral->referred_by_id : ''}}" name="referred_by_id" required>
                                                                    @if($errors->has('referred_by_name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('referred_by_name') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input type="submit" class="btn btn-sm btn-theme" value="Save" required style="border-radius: 50px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
    </div>

@endsection
