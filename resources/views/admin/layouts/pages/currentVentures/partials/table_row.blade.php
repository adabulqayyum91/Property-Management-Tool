{{-- =========================================================================================
Description:  New Venture Listing table Block For Admin Dashboard
* Created by PhpStorm.
 * User: Zahra
 * Date: 4/10/2020
 * Time: 5:08 PM
----------------------------------------------------------------------------------------
========================================================================================== --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
        <div class="option-bar">
            <h6 class="mb-0">There are {{count($currentVentureListing)}} results found.</h6>
        </div>
    </div>
</div>

<table id="example" class="table box-shadow table-bordered" style="width:100%">
    <thead class="bg-active">
    <tr>
        <th>#</th>
        <th>Listing ID</th>
        <th>Ownership Sequence</th>
        <th>Venture Name</th>
        <th>Asking Price</th>
        <th>Seller Email</th>
        <th>Featured Listing</th>
        <th>Date Listed</th>
        <th>Listing Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    @if(count($currentVentureListing)!=0)
        @foreach($currentVentureListing as $venture)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{  !is_null($venture->list_automated_id)?$venture->list_automated_id:''}}</td>
            <td>{{ !is_null($venture->percentage_of_ownership)?$venture->percentage_of_ownership:''}} %</td>
            <td>{{ !is_null($venture->venture)?$venture->venture->venture_name:''}}</td>
            <td>{{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($venture->asking_price) ? $venture->asking_price : '0', 2, ',', '.')}}</td>
            <td>{{ count($venture->users)>=1?$venture->users[0]->email:''}}</td>

            <td>{{ $venture->feature==0?'No':'Yes'}}</td>
            <td>{{ !is_null($venture->venture) ?   \Carbon\Carbon::parse($venture->created_at)->format('m/d/Y') : ''}}</td>
            <td>{{  !is_null($venture->list_status)?$venture->list_status:''}}</td>
            <td>
                <form action="{{url('admin/current-venture-listing/'.$venture->venture->id.'/venture-detail/'.$venture->id.'/edit')}}" method="GET">
                    <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
                </form>
                <form action="{{route('current-venture-listing.destroy',$venture->id)}}" method="POST" id="newVentureDelete">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
                </form>
            </td>

        </tr>
    @endforeach
    @endif

    </tbody>

</table>
{{--=========================================================================================
Description: function for get started pop on home page after plan selection
----------------------------------------------------------------------------------------
========================================================================================== --}}

<script type="text/javascript">
    //delete Vurrent venture list
    $("#newVentureDelete").submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    toastr.success(response.message)
                    $("#ven-id").empty().html(response.view);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr, status, error) {
                $.each(xhr.responseJSON.errors, function (key, item) {
                    toastr.error(item);
                });
            }
        });
    });
</script>
{{--{!! $currentVentureListing->links() !!}--}}
