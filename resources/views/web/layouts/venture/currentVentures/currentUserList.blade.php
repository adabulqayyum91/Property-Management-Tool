<div class="card col-md-12 portfolio-card">
    <div class="card-body portfolio-card-body">
        <div class="dashboard-header clearfix">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h5>Your Venture</h5>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list">
                    <div class="dashboard-message bdr clearfix ">
                        <div class="tab-box-2">
                            <table id="example" class="table table-striped table-bordered">
                                <thead class="bg-active">
                                    <tr>
                                        <td class="text-center">Venture Name</td>
                                        <td>Venture ID</td>
                                        <td class="text-center">% of Venture Owned</td>
                                        <td class="text-center">Date of Purchase</td>
                                        <td class="text-center">Amount Paid</td>
                                        <td class="text-center">
                                            Current Approximate Value
                                        </td>
                                        <td class="text-center">
                                            Market CAP
                                        </td>
                                        <td class="text-center">
                                            Estimated CAP
                                        </td>
                                        <td>Action</td>
                                        {{-- TODO --}}
                                    {{-- <td class="text-center">Ownership Sequence</td>
                                    <td class="text-center">Amount Sold</td>
                                    <td class="text-center">Ownership End Date</td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ventureOwnerships as $index => $ventureOwnership)

                                @if(!is_null($ventureOwnership->venture))
                                <tr>
                                    <td class="text-center">
                                        {{!is_null($ventureOwnership->venture)?$ventureOwnership->venture->venture_name:'N/A'}}
                                    </td>
                                    <td class="text-center">
                                        {{$ventureOwnership->venture->venture_automated_id}}
                                    </td>
                                    <td class="text-center">
                                        {{Helper::percentageOwned($ventureOwnership->id)}}%
                                    </td>
                                    <td class="text-center">
                                        {{$ventureOwnership->ownership_begin_date}}
                                    </td>
                                    <td class="text-center">
                                        {{formatCurrency($ventureOwnership->amount_paid)}}
                                    </td>
                                    <td class="text-center">
                                        {{ formatCurrency(Helper::calculateCurrentApproximateValuation($ventureOwnership->id,$ventureOwnership->venture_id))}}
                                    </td>
                                    <td class="text-center">
                                        {{towDecimalNumber($ventureOwnership->venture->initial_cap)}} %
                                        {{-- TODO: Old Formula logic --}}
                                        {{-- {{Helper::calculateOrignalCap($ventureOwnership->id)}} % --}}
                                    </td>
                                    <td class="text-center">
                                        {{towDecimalNumber(Helper::calculateCurrentEstimatedCap($ventureOwnership->venture_id,$ventureOwnership->id))}} %
                                    </td>
                                    <td class="actionButtonCell">
                                        @if(Helper::checkIfSellingExist($ventureOwnership->id))
                                        <button class="btn btn-sm btn-theme sell-modal" data-ventureOwnershipId="{{ encrypt($ventureOwnership->id) }}">Sell</button>
                                        @else
                                        <button class="btn btn-sm btn-theme sell-modal" data-ventureOwnershipId="{{ encrypt($ventureOwnership->id) }}" disabled>Sell</button>
                                        @endif
                                        <a type="button" class="btn btn-primary" href="{{url('venture-documents/'.$ventureOwnership->venture_id)}}">Documents</a>
                                    </td>
                                    {{-- TODO --}}
                                            {{-- <td class="text-center">{{$ventureOwnership->ownership_sequence_start}}:{{$ventureOwnership->ownership_sequence_end}}</td>
                                            <td class="text-center">{{$ventureOwnership->amount_sold}}</td>
                                            <td class="text-center">{{$ventureOwnership->ownership_end_date}}</td> --}}
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-header clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <h5>Selling List</h5>
                    </div>

                </div>
            </div>
            <div class="row">
                {{-- TODO : For futrue use --}}
                <div class="col-lg-12 col-md-12">
                    <div class="dashboard-list">
                        <div class="dashboard-message bdr clearfix ">
                            <div class="tab-box-2">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead class="bg-active">
                                        <tr>
                                            <td class="text-center">Venture Name</td>
                                            <td class="text-center">Venture ID</td>
                                            <td class="text-center">% of your ownership for sale</td>
                                            <td class="text-center">% of total ownership</td>
                                            {{-- <td class="text-center">Date Purchased</td> --}}
                                            <td class="text-center">Asking Price</td>
                                    {{-- <td class="text-center">Current Approximate Valuation</td>
                                    <td class="text-center">Original CAP</td>
                                    <td class="text-center">Current Estimated CAP</td> --}}
                                    <td class="text-center">Sale Status</td>
                                    <td class="text-center">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currentVentureListings as $currentVentureListing)
                                <tr>
                                    <td class="text-center">
                                        {{!is_null($currentVentureListing->venture)?$currentVentureListing->venture->venture_name:'N/A'}}
                                    </td>
                                    <td class="text-center">
                                        {{!is_null($currentVentureListing->venture)?$currentVentureListing->venture->venture_automated_id:'N/A'}}
                                    </td>
                                    <td class="text-center">{{$currentVentureListing->percentage_of_ownership}}%</td>
                                    <td class="text-center">{{Helper::percentageOwnershipForSell($currentVentureListing->ownership_id,$currentVentureListing->percentage_of_ownership)}}%</td>
                                    {{-- <td class="text-center">{{ !is_null($currentVentureListing->venture) ?   \Carbon\Carbon::parse($currentVentureListing->venture->date_of_Purchase)->format('d/m/Y')  : 'N/A'}}</td> --}}
                                    <td class="text-center">
                                        {{ formatCurrency($currentVentureListing->asking_price)}}
                                    </td>
                                    {{-- <td class="text-center">
                                        {{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($currentVentureListing->percentage_of_ownership) ? $currentVentureListing->percentage_of_ownership : '0', 2, ',', '.')}}
                                      </td>
                                    <td class="text-center">{{$currentVentureListing->venture->initial_cap}}%</td>
                                    <td class="text-center">{{$currentVentureListing->cap_rate}}%</td> --}}
                                    <td class="text-center">
                                        {{$currentVentureListing->status}}
                                    </td>
                                    <td class="text-center">
                                        @if($currentVentureListing->status=="Pending") 
                                        @if(Helper::isUnderContract($currentVentureListing->id))
                                        <button type="button" data-toggle="modal" data-target="#cancelSaleConfirmation" class="btn btn-danger cancelBtn" title="cancel" data-listingId="{{ $currentVentureListing->id }}"><i class="fa fa-times"></i></button>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="sell-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Selling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sell-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Selling Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="sellmsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Sale Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center col-sm-12" style="padding: 20px;">
                        <p>Thank you. You will receive a confirmation once your property has been posted - usually in 1 to 2 business days.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="cancelSaleConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Cancel Sale?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body text-center"> Are you sure you want to cancel this sale?
                <div class="link mt-20 mb-20"> 
                    <form method="POST" id="newVentureDelete">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="listingId" value="">
                        <button type="submit" class="btn btn-success btnloop" title="Yes">Yes</button>
                        <a href="" class="btn btn-danger btnloop" data-dismiss="modal">No</a> 
                    </form>
                    {{-- <a href="javascript:void(0)" onClick="saleCanceled()" class="btn btn-success btnloop">Yes</a>  --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="cancelSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelSaleLabel">Cancel Sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body text-center"> Are you sure you want to cancel this sale?
                <div class="link mt-20 mb-20"> <a href="javascript:void(0)" onClick="saleCanceled()" class="btn btn-success btnloop">Yes</a> <a href="" class="btn btn-danger btnloop" data-dismiss="modal">No</a> </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="canceledSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="canceledSaleLabel">Cancel Sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body text-center mt-3 mb-3"> Thank you. Your sale has been cancelled. </div>
        </div>
    </div>
</div>

<!-- Full Page Search -->
<div id="full-page-search">
    <button type="button" class="close">×</button>
    <form action="http://storage.googleapis.com/themevessel-products/neer/index.html#">
        <input type="search" value="" placeholder="type keyword(s) here" />
        <button type="submit" class="btn btn-sm button-theme">Search</button>
    </form>
</div>
