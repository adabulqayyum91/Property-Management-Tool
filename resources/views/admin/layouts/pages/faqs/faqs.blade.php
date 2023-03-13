@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Faqs | Admin Panel
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
        .faqs-form{
            display:block !important;
        }
        form {
            display: inherit !important;
            margin-top: 0em;
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Create FAQS</span></div>
                                                <form action="{{route('faqs.store')}}" method="POST" class="faqs-form">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Title:</label>
                                                                <div class="form-group">
                                                                <input type="text" class="form-control box-shadow" placeholder="Question...?" name="title" required>
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
                                                                <textarea class="form-control box-shadow" name="description" required></textarea>
                                                                @if($errors->has('description'))
                                                                    <div class = "alert alert-danger">
                                                                        {{ $errors->first('description') }}
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="submit" class="btn btn-sm btn-theme box-shadow" value="Save" required style="border-radius: 50px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($allFaqs))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>FAQS</span></div>
                                                <table id="example" class="table table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($allFaqs as $faq)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ !is_null($faq->title) ? $faq->title : ''}}</td>
                                                        <td>{{ !is_null($faq->description) ? $faq->description : ''}}</td>
                                                        <td>
                                                            <form action="{{route('faqs.edit',$faq->id)}}" method="GET">
                                                                <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            <form action="{{route('faqs.destroy',$faq->id)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $allFaqs->links() !!}
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
