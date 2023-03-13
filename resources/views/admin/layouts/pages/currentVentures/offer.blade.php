@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
Offers | Admin Panel
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

                        @if(isset($offers))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dashboard-list">
                                    <div class="dashboard-message bdr clearfix ">
                                        <div class="tab-box-2">
                                            <div class="clearfix mb-30 comments-tr"> <span>Ventures Offer <a href="{{ route('exportOffers') }}" class="pull-right mb-20 btn btn-warning">Export Offers</a></span></div>
                                            <table id="example" class="table box-shadow table-bordered" style="width:100%">
                                                <thead class="bg-active">
                                                    <tr>
                                                        <th>Listing ID</th>
                                                        <th>Venture Name</th>
                                                        <th>Buyer ID</th>
                                                        <th>Seller ID</th>
                                                        <th>Amount</th>
                                                        <th>OwnerShip</th>
                                                        <th>Created At</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($offers as $offer)
                                                    <tr>
                                                        <td>{{$offer->venture_listing!=''?$offer->venture_listing->list_automated_id:''}}</td>
                                                        <td>{{$offer->venture_listing->venture!=''?$offer->venture_listing->venture->venture_name:''}}</td>
                                                        <td> {{ !is_null($offer->user) ? $offer->user->member_automated_id : ''  }}</td>
                                                        <td> {{ !is_null($offer->venture_listing) && !is_null($offer->venture_listing->users()->first()) ? $offer->venture_listing->users()->first()->member_automated_id : ''  }}</td>
                                                        <td>
                                                            {{ !is_null($offer->amount) ? formatCurrency($offer->amount):'N/A'}}
                                                        </td>
                                                        <td>
                                                            {{!is_null($offer->seller_ownership) ? $offer->seller_ownership : '0'}}%
                                                        </td>
                                                        <td>{{$offer->created_at!=''?formatMDYTime($offer->created_at):''}}</td>
                                                        <td><span class="btn btn-sm btn-{{Config::get('constants.VENTURE_OFFER_STATUS_COLOR.'.$offer->status)}}">{{ !is_null($offer) ? $offer->status : ''}}</span></td>
                                                        <td style="text-align:center;">
                                                            <div>
                                                                @if($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[5])
                                                                <select class="form-control search-fields" tabindex="-98" data-id="{{$offer->id}}" name="status">
                                                                    <option value="">Select Status</option>
                                                                    <option value="{{Config::get('constants.VENTURE_OFFER_STATUS')[6] }}" {{$offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[6] ? ' selected' : ''}}>{{Config::get('constants.VENTURE_OFFER_STATUS')[6] }}</option>
                                                                </select>
                                                                <br>
                                                                @endif
                                                                @if($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[6])
                                                                <select class="form-control search-fields" tabindex="-98" data-id="{{$offer->id}}" name="status">
                                                                    <option value="">Select Status</option>
                                                                    <option value="{{Config::get('constants.VENTURE_OFFER_STATUS')[7] }}" {{$offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[7] ? ' selected' : ''}}>{{Config::get('constants.VENTURE_OFFER_STATUS')[7] }}</option>
                                                                </select>
                                                                <br>
                                                                @endif
                                                                @if($offer->status != Config::get('constants.VENTURE_OFFER_STATUS')[7])
                                                                <span style="cursor: pointer;" onclick="deleteOffer({{$offer->id}})"><u>Remove</u></span>
                                                                @endif
                                                            </div>
                                                        </td>


                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {!! $offers->links() !!}
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
    function deleteOffer(offer_id) {

        Swal.fire(
        {
            title: '<u>Are you sure?</u>',
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes',
            cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/delete-venture-offer') }}",
                    data:{offer_id:offer_id},
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    success: function (response) {
                        if(response.status == true){
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                                ).then(function(){
                                    location.reload();
                                }
                                );
                            }else{
                                toastr.error(response.message, 'Error', {timeOut: 5000});
                            }
                        },
                    });
            }else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
    }

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

            data:{status:status, id:buyId,'page':'offer'},

            success:function(response){
                if(response.status){
                    Swal.fire(
                        'Success!',
                        response.message,
                        'success'
                        ).then(function(){
                            location.reload();
                        }
                        );
                    }else{
                        toastr.error(response.message, 'Error', {timeOut: 5000});
                    }
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
