@extends('web.layouts.partials.app')
@section('page_title')
    Communication Detail | Member Panel
@endsection
@section('content')
    <style>
        label{
            font-weight: bold;
        }
    </style>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('web.layouts.partials.sideBar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session()->has('success'))
                                      <div class="alert alert-success">
                                          <strong>SUCCESS :</strong> {{ session('success') }}
                                      </div>
                                    @endif
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <button data-toggle="modal" data-target="#reply-email" style="margin-top:-10px" class="btn btn-warning float-right">Reply</button>
                                            <div class="clearfix mb-30 comments-tr">
                                                <span>Message Details</span>
                                            </div>
                                            <label>From:</label> {{$communication->fromUser->first_name}} {{$communication->fromUser->last_name}}
                                            <br>
                                            <label>Venture:</label> {{$communication->venture->venture_name}}
                                            <br>
                                            <label>Subject:</label> {{$communication->subject}}
                                            <br>
                                            <label>Body:</label> {{$communication->body}}
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
    <div class="modal fade" id="reply-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('/user/communication/reply')}}">
                    @csrf
                    <div class="modal-body">
                        <label>Venture:</label>
                        <input class="form-control" type="text" value="{{$communication->venture->venture_name}}" name="venture_name" readonly required/>
                        <input class="form-control" type="hidden" value="{{$communication->venture_id}}" name="venture_id" required/>
                        <input class="form-control" type="hidden" value="{{$communication->from_user}}" name="to_user" required/>

                        <br><br>
                        <label>Subject:</label>
                        <input class="form-control" type="text" value="Reply: {{$communication->subject}}" name="subject" readonly required/>
                        <br><br>
                        <label>Body:</label>
                        <textarea class="form-control" name="body" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary cancel-commit">Send</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
@endsection
