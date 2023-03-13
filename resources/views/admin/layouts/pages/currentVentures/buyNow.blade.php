@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
    Buy Now | Admin Panel
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
        .create-plans{display: block !important;}
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

                            @if(count($buyNow) > 0)

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                                <div class="tab-box-2">
                                                    <div class="clearfix mb-30 comments-tr"> <span>Ventures Buy Now Requests <a href="{{ url('admin/export-buy-now') }}" class="pull-right mb-20 btn btn-warning" target="_blank">Export</a></span>
                                                    </div>
                                                    <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                        <thead class="bg-active">
                                                        <tr>
                                                            <th>Listing ID</th>
                                                            <th>Venture Name</th>
                                                            <th>User Name</th>
                                                            <th>Purchase Price</th>
                                                            <th>Received At</th>
                                                            <th>Status</th>
                                                            <th>Signed Document</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($buyNow as $buy)
                                                            <tr>
                                                                <td>{{$buy->venture_listing!=''?$buy->venture_listing->list_automated_id:''}}</td>
                                                                <td>{{$buy->venture_listing->venture!=''?$buy->venture_listing->venture->venture_name:''}}</td>
                                                                <td>{{$buy->user!=''?$buy->user->name:''}}</td>
                                                                <td>{{ !is_null($buy->venture_listing->venture) ? formatCurrency($buy->venture_listing->asking_price):'N/A'}}</td>
                                                                <td>{{$buy->created_at!=''?formatMDYTime($buy->created_at):''}}</td>
                                                                <td><span class="btn btn-sm btn-{{Config::get('constants.VENTURE_BUY_NOW_STATUS_COLOR.'.$buy->status)}}">{{ !is_null($buy) ? $buy->status : ''}}</span></td>
                                                                <td style="width:181px">
                                                                    <a style="text-decoration: none; margin-right: 10px;" download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=c6b278b9311c03c2e2c724382c0f160a&business_id=153222&document_hash={{$buy->document_hash}}" target="_blank" class="btn btn-sm btn-success pull-left"><i class="fa fa-eye"></i> View</a>

                                                                    <form action="{{url('admin/deleteBuyNowRequests',$buy->id)}}" method="POST" class="pull-left" >
                                                                        @csrf
                                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                                                                    </form>
                                                                    @if($buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[2])
                                                                        <br><br>
                                                                        <select class="form-control search-fields" tabindex="-98" data-id="{{$buy->id}}" name="status">
                                                                            <option value="">Select Status</option>
                                                                            <option value="{{Config::get('constants.VENTURE_BUY_NOW_STATUS')[3] }}" {{$buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[3] ? ' selected' : ''}}>{{Config::get('constants.VENTURE_BUY_NOW_STATUS')[3] }}</option>
                                                                        </select>
                                                                    @endif
                                                                    @if($buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[3])
                                                                        <br><br>
                                                                        <select class="form-control search-fields" tabindex="-98" data-id="{{$buy->id}}" name="status">
                                                                            <option value="">Select Status</option>
                                                                            <option value="{{Config::get('constants.VENTURE_BUY_NOW_STATUS')[4] }}" {{$buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[4] ? ' selected' : ''}}>{{Config::get('constants.VENTURE_BUY_NOW_STATUS')[4] }}</option>
                                                                        </select>
                                                                    @endif
                                                                </td>


                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    {!! $buyNow->links() !!}
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
    <script type="text/javascript" defer>
        $("select[name='status']").on('change', function() {
            var status = $('option:selected', this).val();
            var buyId=$(this).attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });
            $.ajax({
                type:'post',
                url: '{{url('admin/venture-listing-status')}}' ,

                data:{status:status, id:buyId,'page':'buyNow'},

                success:function(response){
                    if(response.status)
                    {
                        Swal.fire('Success!',response.message,'success')
                            .then(function(){
                                location.reload();
                            }
                        );
                    }
                    else
                    {
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
                        url: "/admin/plans/"+id,
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
