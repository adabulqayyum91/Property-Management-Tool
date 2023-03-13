@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Edit Page | Admin Panel
@endsection
@section('content')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Edit Page</span></div>
                                                <form action="{{route('pages.update',$currentPage->id)}}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Title:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Title" value="{{!is_null($currentPage->title) ? $currentPage->title : ''}}" name="title" required>
                                                                @if($errors->has('title'))
                                                                    <div class="error" style="color: red">{{ $errors->first('title') }}</div>
                                                                @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label>Content:</label>
                                                                <div class="form-group">
                                                                <textarea id="editor"  name="content" class="col-md-12 box-shadow" style="height: 300px" >{!! !is_null($currentPage->content) ? $currentPage->content : '' !!}  </textarea>
                                                                @if($errors->has('content'))
                                                                    <div class="error" style="color: red">{{ $errors->first('content') }}</div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mt-3">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javaScript')
    <script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
    <script type="text/javascript" defer>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',


            extraPlugins: 'embed,autoembed,image2',
            height: 500,

            // Load the default contents.css file plus customizations for this sample.
            contentsCss: [
                'http://cdn.ckeditor.com/4.14.0/full-all/contents.css',
                'https://ckeditor.com/docs/vendors/4.14.0/ckeditor/assets/css/widgetstyles.css'
            ],
            // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
            embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

            // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
            // resizer (because image size is controlled by widget styles or the image takes maximum
            // 100% of the editor width).
            image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
            image2_disableResizer: true


        });
    </script>
@endsection
