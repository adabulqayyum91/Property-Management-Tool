@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Video | Admin Panel
@endsection
@section('content')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
        }
        .btn-vid{
            margin-top: 18px;
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Video Link</span></div>
                                                <form action="{{route('videos.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Title </label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Title" name="title"
                                                                       value="{{!is_null($currentVideo)? $currentVideo->title: ''}}" >
                                                                @if($errors->has('title'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('title') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Link:</label>
                                                                <label>(Only You tube Embed url) </label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="You Tube Embed Link" name="link"
                                                                       value="{{!is_null($currentVideo)? $currentVideo->link: ''}}"  required>
                                                                @if($errors->has('link'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('link') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Description </label>
                                                                <div class="form-group">
                                                                <textarea class="form-control box-shadow" placeholder="Description"
                                                                          name="description">{{!is_null($currentVideo)? $currentVideo->description: ''}}</textarea>
                                                                @if($errors->has('description'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="submit" class="btn btn-theme box-shadow" value="Update" style="border-radius: 50px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($currentVideo))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Video Display</span></div>
                                                <div class="main-title text-center">
                                                    <h1>{{$currentVideo->title}}</h1>
                                                    <p>{{$currentVideo->description}}</p>
                                                </div>
                                                <div class="service-info">
                                                    <iframe width="100%" height="400"
                                                            src="{{$currentVideo->link}}">
                                                    </iframe>
                                                </div>
                                            </div>
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

@endsection
