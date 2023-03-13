@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Slider | Admin Panel
@endsection
@section('content')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
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
        .btn-linked {
            margin: 0px 10px 0px 0px !important;
            /*padding: 0px !important;*/
            /*background: #fff;*/
        }
        .action-form {
            display: inherit !important;
            margin-top: 0em;
        }
        .slider-form{display:block;}
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Add Slider</span></div>
                                                <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data" class="slider-form">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Title:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Title" name="title" required>
                                                                @if($errors->has('title'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('title') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Image:</label>
                                                                <div class="form-group">
                                                                <input type="file" class="form-control box-shadow" placeholder="Photo" name="photo" required>
                                                                @if($errors->has('photo'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('photo') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label>Description:</label>
                                                                <div class="form-group">
                                                                <textarea class="form-control box-shadow" placeholder="Description" name="description" required></textarea>
                                                                @if($errors->has('description'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <input type="submit" class="btn btn-theme box-shadow" value="Save" style="border-radius: 50px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($allSliders))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Sliders</span></div>
                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($allSliders as $slider)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{!is_null($slider) ? $slider->title : ''}}</td>
                                                            <td>{{!is_null($slider) ? $slider->description : ''}}</td>
                                                            <td style="width: 50%;"><img class="d-block w-100" src="{{ asset('img/banner/'.$slider->photo)}}" style="height: 200px;width: 100%;" alt="banner"></td>
                                                            <td>
                                                                <form action="{{route('sliders.edit',$slider->id)}}" method="GET" class="action-form">
                                                                    <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                                </form>
                                                                <form action="{{route('sliders.destroy',$slider->id)}}" method="POST" class="action-form">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $allSliders->links() !!}
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
