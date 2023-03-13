@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Create Follows | Admin Panel
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
        textarea{
            height: 150px;
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
                                                <div class="clearfix mb-30 comments-tr"> <span>Create Follow</span></div>
                                                <form action="{{route('follows.store')}}" method="POST">
                                                    @csrf
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Referral:</label>
                                                                <div class="form-group">
                                                                    <select name="referral_id" class="form-control">
                                                                        @if(isset($allReferral))
                                                                            @foreach($allReferral as $refer)
                                                                                <option value="{{$refer->id}}">{{$refer->first_name}} {{$refer->last_name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Date Referral First Contact:</label>
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control box-shadow"
                                                                           name="date_referral_first_contact" required>
                                                                    @if($errors->has('date_referral_first_contact'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('date_referral_first_contact') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">Date Last Contact:</label>
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control box-shadow" name="date_last_Contact" required>
                                                                    @if($errors->has('date_last_Contact'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('date_last_Contact') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label">Date Next Follow:</label>
                                                                <div class="form-group">
                                                                    <input type="date" class="form-control box-shadow" name="date_next_follow" required>
                                                                    @if($errors->has('date_next_follow'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('date_next_follow') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Follow Up Comment:</label>
                                                                <div class="form-group">
                                                                    <textarea name="comment" class="form-control" placeholder="Comment" required></textarea>
                                                                    @if($errors->has('comment'))
                                                                        <div class = "alert alert-danger">
                                                                            {{ $errors->first('comment') }}
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
