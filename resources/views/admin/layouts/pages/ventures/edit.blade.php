@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit Venture | Admin Panel
@endsection
@section('content')
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.partials.sidebar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                        <form action="{{route('ventures.update',$currentVenture->id)}}" method="POST" id="venture-form">
                                            @method('PUT')
                                            @csrf
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"><span>Edit Venture</span>
                                                    </div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Venture Name:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               value="{{!is_null($currentVenture->venture_name) ? $currentVenture->venture_name : ''}}"
                                                                               placeholder=" Name"
                                                                               name="venture_name">
                                                                        @if($errors->has('venture_name'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('venture_name') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Date of Incorporation
                                                                        :</label>
                                                                    <div class="form-group">
                                                                        <div class="datepicker2 date input-group p-0 shadow-sm">
                                                                            <input type="text"
                                                                                   placeholder="Date of Incorporation"
                                                                                   class="form-control box-shadow"
                                                                                   name="date_of_incorporation"
                                                                                   value="{{!is_null($currentVenture->date_of_incorporation) ? \Carbon\Carbon::parse($currentVenture->date_of_incorporation)->format('m-d-Y') : ''}}">
                                                                            <div class="input-group-append"><span
                                                                                        class="input-group-text"><i
                                                                                            class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" value="{{!is_null($currentVentures->date_of_incorporation) ? $currentVentures->date_of_incorporation : ''}}">--}}
                                                                        @if($errors->has('date_of_incorporation'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('date_of_incorporation') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Date of Purchase :</label>
                                                                    <div class="form-group">
                                                                        <div class="datepicker1 date input-group p-0 shadow-sm">
                                                                            <input type="text"
                                                                                   placeholder="Date of Purchase"
                                                                                   class="form-control box-shadow"
                                                                                   name="date_of_Purchase"
                                                                                   value="{{!is_null($currentVenture->date_of_Purchase) ? \Carbon\Carbon::parse($currentVenture->date_of_Purchase)->format('m-d-Y') : ''}}">
                                                                            <div class="input-group-append"><span
                                                                                        class="input-group-text"><i
                                                                                            class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        @if($errors->has('date_of_Purchase'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('date_of_Purchase') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Purchase Price:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Price"
                                                                               name="purchase_price"
                                                                               value="{{!is_null($currentVenture->purchase_price) ? $currentVenture->purchase_price : ''}}">
                                                                                @if($errors->has('purchase_price'))
                                                                                    <div class="alert alert-danger">
                                                                                        {{ $errors->first('purchase_price') }}
                                                                                    </div>
                                                                                @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Target Amount:</label>
                                                                    <div class="form-group">
                                                                        <input type="number" class="form-control box-shadow" placeholder="Target Amount" name="target_amount"   value="{{!is_null($currentVenture->target_amount) ? $currentVenture->target_amount : ''}}">
                                                                        @if($errors->has('target_amount'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('target_amount') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Market CAP:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Market CAP"
                                                                               name="initial_cap"
                                                                               value="{{!is_null($currentVenture->initial_cap) ? $currentVenture->initial_cap : ''}}">
                                                                        @if($errors->has('initial_cap'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('initial_cap') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Staff Manager:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Staff Manager"
                                                                               name="staff_manager"
                                                                               value="{{!is_null($currentVenture->staff_manager) ? $currentVenture->staff_manager : ''}}">
                                                                        @if($errors->has('staff_manager'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('staff_manager') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Manager:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Manager"
                                                                               name="managing_member"
                                                                               value="{{!is_null($currentVenture->managing_member) ? $currentVenture->managing_member : ''}}">
                                                                        @if($errors->has('managing_member'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('managing_member') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder=" Street"
                                                                               name="venture_street"
                                                                               value="{{!is_null($currentVenture->venture_street) ? $currentVenture->venture_street : ''}}">
                                                                        @if($errors->has('venture_street'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('venture_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Venture City"
                                                                               name="venture_city"
                                                                               value="{{!is_null($currentVenture->venture_city) ? $currentVenture->venture_city : ''}}">
                                                                        @if($errors->has('venture_city'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('venture_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture State:</label>
                                                                    <div class="form-group">


                                                                        <select class="form-control box-shadow" name="venture_state" style="height: 45px;">
                                                                            <option selected value=""> Select State </option>
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state->id}}" {{$state->id==$currentVenture->venture_state ? ' selected' : ''}}   >{{$state->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('venture_state'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('venture_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Zip Code:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Zip Code"
                                                                               name="venture_zip"
                                                                               value="{{!is_null($currentVenture->venture_zip) ? $currentVenture->venture_zip : ''}}">
                                                                        @if($errors->has('venture_zip'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('venture_zip') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Status:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_status" style="height: 45px;">
                                                                            <option value="Active" {{ $currentVenture->venture_status == 'Active' ? 'selected' : '' }} >Active</option>
                                                                            <option value="Inactive" {{ $currentVenture->venture_status == 'Inactive' ? 'selected' : '' }} >Inactive</option>
                                                                        </select>
                                                                        @if($errors->has('type'))
                                                                            <div class = "alert alert-danger">
                                                                                {{ $errors->first('type') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_type" style="height: 45px;">
                                                                            @foreach($ventureTypes as $type)
                                                                                <option value="{{$type}}" {{ $currentVenture->venture_type == $type ? 'selected' : '' }} >{{$type}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Venture Source Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="venture_source_type" style="height: 45px;">
                                                                            @foreach($ventureSourceTypes as $type)
                                                                                <option value="{{$type}}" {{ $currentVenture->venture_source_type == $type ? 'selected' : '' }} >{{$type}}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>                                                                

                                                        </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">
                                                        <span>Property Specific</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label"> Management
                                                                        Company:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"

                                                                               placeholder="Management Company:"
                                                                               name="property_management_company" value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_management_company : ''}}" required>

                                                                        @if($errors->has('property_management_company'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_company') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label"> Management
                                                                        Contact:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow contact"

                                                                                placeholder=" Management Contact"
                                                                               name="property_management_contact" required  value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_management_contact : ''}}">


                                                                        @if($errors->has('property_management_contact'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_contact') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Management Street:</label>


                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"

                                                                               placeholder="Street"
                                                                               name="property_management_street" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_management_street : ''}}">

                                                                        @if($errors->has('property_management_street'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Management Phone:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow contact"

                                                                               placeholder="Phone"
                                                                               name="property_management_phone" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_management_phone : ''}}">


                                                                        @if($errors->has('property_management_phone'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_phone') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Management City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"

                                                                               placeholder="City"
                                                                               name="property_management_city" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_management_city : ''}}">


                                                                        @if($errors->has('property_management_city'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Management State:</label>
                                                                    <div class="form-group">

                                                                        <select class="form-control box-shadow" name="property_management_state" style="height: 45px;">
                                                                            <option selected value=""> Select State </option>
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state->id}}" 
                                                                                {{$state->id==$currentVenture->ventureDetail->property_management_state ? 'selected':''}}>
                                                                                    {{$state->name}}
                                                                                </option>

                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('property_management_state'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Management Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"

                                                                               placeholder="Management Zip"
                                                                               name="property_management_zip" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_management_zip : ''}}">


                                                                        @if($errors->has('property_management_zip'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_management_zip') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Property Street:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Property Street"
                                                                               name="property_street" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_street : ''}}">
                                                                        @if($errors->has('property_street'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_street') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Property City:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Property City"
                                                                               name="property_city" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_city : ''}}">
                                                                        @if($errors->has('property_city'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_city') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Property State:</label>
                                                                    <div class="form-group">

                                                                        <select class="form-control box-shadow" name="property_state" style="height: 45px;">
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state->id}}" {{$state->id==$currentVenture->ventureDetail->property_state ? ' selected' : ''}}   >{{$state->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if($errors->has('property_state'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_state') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Property Zip:</label>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               class="form-control box-shadow"
                                                                               placeholder="Property Zip"
                                                                               name="property_zip" required value="{{!is_null($currentVenture->ventureDetail) ? $currentVenture->ventureDetail->property_zip : ''}}">
                                                                        @if($errors->has('property_zip'))
                                                                            <div class="alert alert-danger">
                                                                                {{ $errors->first('property_zip') }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="submit" class="btn btn-sm btn-theme" value="Save" style="margin-top: 37px;border-radius: 50px;">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">
                                                        <span>Download Information</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <form id="download-information">
                                                                <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Date of Document
                                                                        from:</label>
                                                                    <div class="form-group">
                                                                        <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                            <input type="text" placeholder="Date"
                                                                                   class="form-control box-shadow"
                                                                                   name="from"
                                                                                   required>
                                                                            <div class="input-group-append"><span
                                                                                        class="input-group-text"><i
                                                                                            class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">To:</label>
                                                                    <div class="form-group">
                                                                        <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                            <input type="text" placeholder="Date"
                                                                                   class="form-control box-shadow"
                                                                                   name="to"
                                                                                   required>
                                                                            <div class="input-group-append"><span
                                                                                        class="input-group-text"><i
                                                                                            class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" required>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="submit" class="btn btn-sm btn-theme"
                                                                           value="Submit" style="margin-top:35px; border-radius: 50px;">
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>

                                                        <div class="document-section">
                                                            @include('admin.layouts.pages.ventures.documentTab')
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="uploadDocument" action="{{'uploaddocument'}}" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id" value={!! $currentVenture->id !!}>
                                            @csrf

                                            <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr">
                                                        <span>Upload Information</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Document Type:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="document_type_id" style="height: 45px;">
                                                                            @foreach($documentTypes as $type)
                                                                                <option value="{{$type->id}}"  >{{$type->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <label class="form-label">Visibility:</label>
                                                                    <div class="form-group">
                                                                        <select class="form-control box-shadow" name="visibility" style="height: 45px;">
                                                                            <option value="Visible">Visible</option>
                                                                            <option value="Hidden">Hidden</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label class="form-label">Choose File:</label>
                                                                    <div class="form-group">
                                                                        <input class="form-control box-shadow" name="file" id="input_multifileSelect" type="file" id="files">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Name of Document:</label>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control box-shadow" placeholder="Document Name" name="documentName" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Date of Document to apply	:</label>
                                                                    <div class="form-group">
                                                                        <div class="datepicker0 date input-group p-0 shadow-sm">
                                                                            <input type="text" placeholder="Date" class="form-control box-shadow" name="date_of_document" >
                                                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="submit" class="uploaddocuments btn btn-sm btn-theme" value="Upload" style="border-radius: 50px;">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>

                                        <form id="UploadImages" action="{{route('uploadImages')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <input type="hidden" name="id" id="id" value={!! $currentVenture->id !!}>
                                            <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"><span>Pictures</span></div>
                                                    <div class="container">
                                                        <div class="comments-tr2">
                                                            <ul class="allimages row">
                                                                @include('admin.layouts.pages.ventures.imagesSection')
                                                            </ul>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Upload Multiple Images Here:</label>
                                                                    <div class="form-group">
                                                                        <input type="file" class="form-control box-shadow" placeholder="Images" multiple name="images[]" id="images" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="submit" class="but_upload btn btn-sm btn-theme"
                                                                           value="Upload" style="margin-top: 35px;border-radius: 50px;">
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>
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



    <!-- The Modal -->
    <div id="imageModal" class="modal">

        <!-- The Close Button -->
        <span class="close-modal" onclick="$('#imageModal').modal('hide')">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="modal-image">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    <style>
        .displayinline{ display: inline-block; margin-right: 10px;}
    </style>
    <script src="{{ asset('/frontend_temp/js/jquery-2.2.0.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click','.image-popup', function () {
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
            });


            $("#uploadDocument").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('UploadVentureDocument') }}",
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            $('.document-section').html(response.data);
                            $("#uploadDocument")[0].reset();
                            $("[data-toggle='toggle']").bootstrapToggle();
                        }else{
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    }
                });
            });

            $("#UploadImages").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('uploadImages') }}",
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            $('.allimages').html(response.data);
                            $("#UploadImages")[0].reset();
                        }else{
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    }
                });
            });
            $('.datepicker2').datepicker({
                format: 'mm-dd-yyyy'
            });
            $('.datepicker1').datepicker({
                format: 'mm-dd-yyyy'
            });
            $('.datepicker0').datepicker({
                format: 'mm-dd-yyyy'
            });
            $("#nameofpic").change(function(){
                if(!$('#nameofpic').val()){

                    $('.nameofpicerror').css("display", "block");
                }
                else{
                    $('.nameofpicerror').css("display", "none");
                }
            });

            $(document).on('change','.media-status-btn', function() {
                var status = $(this).prop('checked');
                var mediaID = $(this).data('file');
                $.ajax({
                    type:'post',
                    url:"{{ url('admin/media-status-change')}}",
                    data:{_token: $('meta[name="csrf-token"]').attr('content'),status:status, mediaID:mediaID},
                    success:function(response){
                        if(response.status){
                            toastr.success(response.message);
                        }else{
                            toastr.error(response.message);
                        }
                    }

                });
            });

            $(document).on('click','.media-delete button', function() {

                if(confirm('Are you sure?')) {
                    var $this = $(this);
                    $this.attr('disabled', 'disabled');
                    var mediaID = $this.data('file');
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/media-delete')}}",
                        data: {_token: $('meta[name="csrf-token"]').attr('content'), mediaID: mediaID},
                        success: function (response) {
                            if (response.status) {
                                $this.parents('.media-box').remove();
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        }

                    });
                }
            });

            $('#venture-form').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                        }else{
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    }
                });
            });

            $('#download-information').submit(function(e){
                e.preventDefault();

                var form = $(this);
                $.ajax({
                    url: "{{ url('admin/download-information') }}",
                    type: 'POST',
                    data: {_token: $('meta[name="csrf-token"]').attr('content'), from: form.find('input[name="from"]').val(), to: form.find('input[name="to"]').val(), id: $('#id').val()},
                    success: function (response) {
                        if(response.status){
                            toastr.success(response.message)
                            $('.document-section').html(response.data);
                            $("[data-toggle='toggle']").bootstrapToggle();
                        }else{
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                    }
                });
            });
        });



    </script>
@endsection
