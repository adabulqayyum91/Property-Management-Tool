@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
User Commits | Admin Panel
@endsection
@section('css')
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
form {
    display: inline-block !important;
    margin-top: 0em;
}
.btn-linked {
    margin: 0px 10px 0px 0px !important;
    /*padding: 0px !important;*/
    /*background: #fff;*/
}
</style>
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
                                <div class="dashboard-list">
                                    <div class="dashboard-message bdr clearfix ">
                                        <div class="tab-box-2">
                                            <h4 style="border-bottom: none">User Commits <a class="mb-20 btn btn-info pull-right" href="{{ url('admin/new-venture-listing') }}"><i class="fa fa-arrow-left"></i> New Venture Listing</a> </h4>
                                            <table id="example" class="table table-bordered box-shadow" style="width:100%">
                                                <thead class="bg-active">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>List ID</th>
                                                        <th>Venture Name</th>
                                                        <th>User Name</th>
                                                        <th>Commit Amount</th>
                                                        <th>Venture Price</th>
                                                        <th>Ownership  Sequence</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($userCommits)> 0)
                                                    @foreach($userCommits as $commit)
                                                    <tr>
                                                        <td>{{ $loop->iteration}}</td>
                                                        <td>{{ !is_null($commit->NewVentureListing) ? $commit->NewVentureListing->list_automated_id : ''}}</td>
                                                        <td>{{ !is_null($commit->NewVentureListing) ? $commit->NewVentureListing->venture->venture_name : ''}}</td>
                                                        <td>{{ !is_null($commit->user) ? $commit->user->name.'('.$commit->user->member_automated_id.')' : ''}}</td>
                                                        <td>{{ !is_null($commit->amount) ? formatCurrency($commit->amount) : 'N/A'}}
                                                            <td>{{ !is_null($commit->NewVentureListing->venture) ? formatCurrency($commit->NewVentureListing->venture->target_amount) : 'N/A'}}</td>
                                                            <td>{{$commit->unitStart.':'.$commit->unitEnd}}</td>
                                                            <td><span class="btn btn-{{Config::get('constants.VENTURE_COMMIT_STATUS_COLOR.'.$commit->status)}}">{{ !is_null($commit) ? $commit->status : ''}}</span></td>
                                                            @if($commit->NewVentureListing && !($commit->NewVentureListing->status=="Closed" || $commit->NewVentureListing->status=="Inactive"))
                                                            <td class="nowrap">

                                                                <div class="form-check pl-0">

                                                                    <input autocomplete="off"  id="toggle-event" class="verfied toggle-event" commitId="{{$commit->id}}" data-off="{{ !is_null($commit) ? $commit->status : ''}}" data-on="{{ Config::get('constants.VENTURE_COMMIT_STATUS')[2] }}" userstatus="{{$commit->status}}" type="checkbox" data-toggle="toggle" {{ $commit->status == Config::get('constants.VENTURE_COMMIT_STATUS')[2] ? 'checked disabled' : ''}}>
                                                                    <a href="{{url('admin/new-venture-listing/removeUserCommit',$commit->id)}}"class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></a>
                                                                    <div id="console-event"></div>
                                                                </div>
                                                            </td>
                                                            @else
                                                            <td>N/A</td>
                                                            @endif

                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr><td class="text-center" colspan="8">No, Commitment found yet!</td></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                                {!! $userCommits->links() !!}

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
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* =========================================================================================
            Description: function for update Commit status
            ----------------------------------------------------------------------------------------
            ========================================================================================== */
            $('.toggle-event').change(function() {
                var status = $(this).prop('checked');
                var commit_id = $(this).attr('commitId');
                $.ajax({

                    type:'post',

                    url: '{{url('admin/new-venture-listing/userCommitStatus')}}' ,

                    data:{_token: CSRF_TOKEN,status:status, commit_id: commit_id},

                    success:function(response){

                        if(response.status){
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                                )
                            .then(function(){
                                location.reload();
                            }
                            );
                        }else{
                            toastr.error(response.message, 'Error', {timeOut: 5000});
                        }

                    }

                });
            });
        })

    </script>
    @endsection

