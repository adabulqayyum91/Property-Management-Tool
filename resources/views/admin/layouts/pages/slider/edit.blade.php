@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit Slider | Admin Panel
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Edit Slider</span></div>
                                                <form action="{{route('sliders.update',$currentSlider->id)}}" method="post" enctype="multipart/form-data" >
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Title:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Title" name="title" value="{{!is_null($currentSlider->title) ? $currentSlider->title : ''}}" required>
                                                                @if($errors->has('title'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('title') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Description:</label>
                                                                <div class="form-group">
                                                                <textarea class="form-control box-shadow" placeholder="Description" name="description" required>{{!is_null($currentSlider->description) ? $currentSlider->description : ''}}</textarea>
                                                                @if($errors->has('description'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Image:</label>
                                                                <div class="form-group">
                                                                <input  type="file" class="form-control box-shadow" name="photo" placeholder="image">
                                                                <img class="d-block w-100" src="{{ asset('img/banner/'.$currentSlider->photo)}}" style="height: 200px;width: 100%;" alt="banner">
                                                                @if($errors->has('photo'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('photo') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="submit" class="btn btn-sm btn-theme box-shadow" value="Update" style="border-radius: 50px;">
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
