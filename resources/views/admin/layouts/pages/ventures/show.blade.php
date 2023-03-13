@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    View Venture | Admin Panel
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
                                                <div class="clearfix mb-30 comments-tr"> <span>View Venture</span></div>
                                                <form action="{{route('ventures.update',$currentVenture->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="form-label"> Name:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" value="{{!is_null($currentVenture->venture_name) ? $currentVenture->venture_name : ''}}" placeholder=" Name" name="venture_name" readonly>
                                                                    @if($errors->has('venture_name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('venture_name') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Date of Incorporation	:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" value="{{!is_null($currentVenture->date_of_incorporation) ? $currentVenture->date_of_incorporation : ''}}" readonly>
                                                                    @if($errors->has('date_of_incorporation'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('date_of_incorporation') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Date of Purchase	:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Date of Purchase" name="date_of_Purchase"  value="{{!is_null($currentVenture->date_of_Purchase) ? $currentVenture->date_of_Purchase : ''}}" readonly>
                                                                    @if($errors->has('date_of_Purchase'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('date_of_Purchase') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Purcahse Price:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder=" Price" name="purcahse_price" value="{{!is_null($currentVenture->purcahse_price) ? $currentVenture->purcahse_price : ''}}" readonly>
                                                                    @if($errors->has('purcahse_price'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('purcahse_price') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Market CAP:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Market CAP" name="initial_cap" value="{{!is_null($currentVenture->initial_cap) ? $currentVenture->initial_cap : ''}}" readonly>
                                                                    @if($errors->has('initial_cap'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('initial_cap') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Staff Manager:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Staff Mmanager" name="staff_manager" value="{{!is_null($currentVenture->staff_manager) ? $currentVenture->staff_manager : ''}}" readonly>
                                                                    @if($errors->has('staff_manager'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('staff_manager') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Managing Member:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder="Managing Member" name="managing_member" value="{{!is_null($currentVenture->managing_member) ? $currentVenture->managing_member : ''}}" readonly>
                                                                    @if($errors->has('managing_member'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('managing_member') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label"> Street:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder=" Street" name="venture_street" value="{{!is_null($currentVenture->venture_street) ? $currentVenture->venture_street : ''}}" readonly>
                                                                    @if($errors->has('venture_street'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('venture_street') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label"> City:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder=" City" name="venture_city" value="{{!is_null($currentVenture->venture_city) ? $currentVenture->venture_city : ''}}" readonly>
                                                                    @if($errors->has('venture_city'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('venture_city') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label"> State:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder=" State" name="venture_state" value="{{!is_null($currentVenture->venture_state) ? $currentVenture->venture_state : ''}}" readonly>
                                                                    @if($errors->has('venture_state'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('venture_state') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label"> Zip Code:</label>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control box-shadow" placeholder=" Zip Code" name="venture_zip" value="{{!is_null($currentVenture->venture_zip) ? $currentVenture->venture_zip : ''}}" readonly>
                                                                    @if($errors->has('venture_zip'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('venture_zip') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">Type:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control box-shadow" name="type" style="height: 45px;" readonly disabled>
                                                                        <option value="Active" {{ $currentVenture->type === 'Active' ? 'selected' : '' }} >Active</option>
                                                                        <option value="Inactive" {{ $currentVenture->type === 'Inactive' ? 'selected' : '' }} >Inactive</option>

                                                                    </select>
                                                                    @if($errors->has('venture_name'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('venture_name') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
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
