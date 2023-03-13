@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Pages List | Admin Panel
@endsection
@section('content')
    <style>
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
        form {
            display: inline-block !important;
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
                            @if(isset($allPages))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <div class="clearfix mb-30 comments-tr"> <span>Page</span></div>
                                                <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>URL</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if(isset($allPages))
                                                    @foreach($allPages as $page)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{!is_null($page->title) ? $page->title : ''}}</td>
                                                            <td>
                                                                <a target="_blank" href="{{ url('/pages/').'/'.$page->slug }}">
                                                                    {{ url('/pages/').'/'.$page->slug }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <form action="{{route('pages.edit',$page->id)}}" method="GET">
                                                                    <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                                                                </form>
                                                                <form action="{{route('pages.destroy',$page->id)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                {!! $allPages->links() !!}
                                                @endif
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
