@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Referal  User | Admin Panel
@endsection
@section('css')
    <style>
        .form-control{
            margin: 0;
            width: 100%;
        }
        .search-fields{border-radius: 50px !important;}
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

                                @if(count($referral)!=0)

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>Friend Referals</span></div>
                                                    <table id="example" class="table table-bordered box-shadow" style="width:100%">
                                                        <thead class="bg-active">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Refer By</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($referral as $user)
                                                            <tr>
                                                                <td>{{ $loop->iteration}}</td>
                                                                <td>{{ !is_null($user->name) ? $user->name : ''}}</td>
                                                                <td>{{ !is_null($user->user) ? $user->user->name : ''}}</td>
                                                                <td>{{ !is_null($user->email) ? $user->email : ''}}</td>
                                                                <td>{{ !is_null($user->phone) ?  $user->phone : ''}}</td>
                                                                <td>
                                                                    <select class="form-control search-fields" tabindex="-98" data-id="{{$user->id}}" name="plan">
                                                                        <option value="">Select Status</option>
                                                                        <option value="Pending" {{$user->status=='Pending' ? ' selected' : ''}}>Pending</option>
                                                                        <option value="Approval" {{$user->status=='Approval' ? ' selected' : ''}}>Approval</option>
                                                                    </select>
                                                                <td>

                                                                    <meta name="csrf-token" content="{{ csrf_token() }}">

                                                                    <button class="btn btn-linked btn-danger box-shadow deleteRecord" data-id="{{ $user->id }}" id="plan-destroy" ><i  class="fa fa-trash"></i></button>

                                                                    <form action="{{route('refer-friend.show',$user->id)}}" method="GET">
                                                                        <button class="btn btn-linked btn-info box-shadow"><i class="fa fa-eye"></i></button>
                                                                    </form>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    {!! $referral->links() !!}
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
@section('javaScript')
<script>
    $("select[name='plan']").on('change', function() {
        var status = $('option:selected', this).val();
        var referralId=$(this).attr('data-id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            }
        });
        $.ajax({
            type:'post',
            url: '{{url('admin/refer-friend/referralStatus')}}' ,

            data:{status:status, id:referralId},
            success:function(response){
                if(response.status){
                    Swal.fire(
                        'Success!',
                        response.message,
                        'success'
                    )
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
            error: function(xhr, status, error) {
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toastr.error(item);
                });
            }

        });
    });
    $(".deleteRecord").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
            $.ajax(
                {
                    url: "/admin/refer-friend/"+id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token
                    },
                    success: function (response){
                        if(response.status == true){
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            )
                            location.reload(true);
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
        }
    })

    });

</script>
@endsection
