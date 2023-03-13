@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit City | Admin Panel
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Edit City</span></div>
                                                <form action="{{route('cities.update',$currentCity->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">State Code:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control box-shadow" name="state_id">
                                                                        <option value="{{!is_null($currentCity) ? $currentCity->state()->first()->id : ''}}" selected>{{!is_null($currentCity) ? $currentCity->state()->first()->name : ''}}</option>
                                                                    @foreach($allStates as $state)
                                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('state_id'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('state_id') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">State Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="State Name" name="name" value="{{!is_null($currentCity->name) ? $currentCity->name : ''}}">
                                                                    @if($errors->has('name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('name') }}
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
