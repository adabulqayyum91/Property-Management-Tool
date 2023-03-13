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
            <h6 class="mb-0">There are {{count($VentureListing)}} results found.</h6>
        </div>
    </div>
</div>
<table id="example" class="table box-shadow table-bordered" style="width:100%">
    <thead class="bg-active">
    <tr>
        <th>#</th>
        <th>Listing ID</th>
        <th>Venture Name</th>
        <th>Date Fund By</th>
      {{--  <th>%
            Committed</th>--}}
        <th>Target amount</th>
        <th>Date Listed</th>
        {{--<th>%CAP RATE</th>--}}
        <th>Listing Status</th>
        <th>Commitment Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($VentureListing)!=0)
        @foreach($VentureListing as $venture)
    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ !is_null($venture->list_automated_id) ? $venture->list_automated_id : 'N/A'}}</td>
        <td>{{ !is_null($venture->venture) ? $venture->venture->venture_name : 'N/A'}}</td>
        <td>{{ !is_null($venture->venture) ?   \Carbon\Carbon::parse($venture->venture->date_of_incorporation)->format('m/d/Y') : 'N/A'}}</td>
        <td>{{ formatCurrency(!is_null($venture->venture) ? $venture->venture->target_amount : '0')}}</td>
        <td>{{ !is_null($venture) ?   \Carbon\Carbon::parse($venture->created_at)->format('m/d/Y')  : 'N/A'}}</td>
        {{--<td>{{  !is_null($venture->venture) ?  $venture->venture->initial_cap : 'N/A'}}</td>--}}
    <td>{{ !is_null($venture->list_status) ? $venture->list_status : 'N/A'}}</td>
    <td>{{ !is_null($venture->status) ? $venture->status : 'N/A'}}</td>
        <td>
            <form action="{{url('admin/new-venture-listing/'.$venture->venture->venture_automated_id.'/venture-detail/'.$venture->list_automated_id.'/edit')}}" method="GET">
                <button class="btn btn-linked btn-warning box-shadow"><i class="fa fa-edit"></i></button>
            </form>

            <form action="{{route('new-venture-listing.destroy',$venture->id)}}" method="POST" >
                {{-- TODO: For future reference --}}
                {{-- id="newVentureDelete" --}}
                @method('DELETE')
                @csrf
                <button class="btn btn-linked btn-danger box-shadow"><i  class="fa fa-trash"></i></button>
            </form>

            <form action="{{url('admin/new-venture-listing/'.$venture->list_automated_id.'/userCommit')}}" method="GET">
                <button class="btn btn-linked  btn-primary box-shadow"></i> Commitments <span class="badge" style="background-color: #fff;">{{ $venture->commits()->count() }}</span></button>
            </form>

            {{--@if($venture->whereHas('commits',function ($q){--}}
                {{--$q->where('status', Config::get('constants.VENTURE_COMMIT_STATUS')[2]);--}}
                {{--})->count() == $venture->commits()->count())--}}
            @if(!($venture->status=="Closed" || $venture->status=="Inactive"))
                @if(Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount? $venture->venture->target_amount : '0')>=100)
                    <form action="{{url('admin/change-new-venture-commitment-status')}}" method="POST" id="status-change-form">
                        @csrf
                        <input type="hidden" value="{{ $venture->id }}" name="venture_listing_id">
                        @if($venture->status!="Closing")
                            <select autocomplete="off" class="form-control" name="status" onchange="$(this).parent().submit()" required>
                                <option value="" {{ is_null($venture->status) ? 'selected' : 'N/A'}} disabled>Select Status</option>
                                @foreach(Config::get('constants.NEW_VENTURE_LISTING_STATUS') as $status)
                                    @if($status!="Closed")
                                    <option value="{{ $status }}" {{ $venture->status == $status ? 'selected="selected"' : ''}}>{{ $status }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <div>
                            <input type="number" placeholder="Purchase Price" step="0.01" name="target_amount" required=""/>
                            <input type="hidden" name="status" value="Closed">
                            <button type="submit" style="width: 100%;">Close</button>
                            </div>
                        @endif
                    </form>
                @endif
            @endif
        </td>


    </tr>
    @endforeach
    @endif
    </tbody>

</table>
{{--  =========================================================================================
   Description: Script Delete for New Venture List
   ----------------------------------------------------------------------------------------
   ========================================================================================== --}}

<script type="text/javascript">
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
                    toastr.success(response.message);
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
{{--{!! $newVentureListing->links() !!}--}}
