<div class="col-sm-12 text-center">
    <h4>Pending Transaction</h4>
</div>

<div class="card col-md-12 portfolio-card">
    <div class="card-body portfolio-card-body">
        <div class="dashboard-header clearfix">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h5>Your Commitment To New Ventures</h5>
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
                                        <th>Listing ID</th>
                                        <th>Venture Name</th>
                                        <th>Commit Amount</th>
                                        <th>Esimated Ownerhsip %</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($commits) > 0)
                                    @foreach($commits as $commit)
                                    <tr>
                                        <td>{{$commit->NewVentureListing!=''?$commit->NewVentureListing->list_automated_id:''}}</td>
                                        <td>{{!is_null($commit->NewVentureListing) && !is_null($commit->NewVentureListing->venture)?$commit->NewVentureListing->venture->venture_name:''}}</td>
                                        <td>
                                            {{formatCurrency($commit->amount)}}
                                            {{-- {{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($commit->amount) ? $commit->amount : '0', 2, ',', '.')}} --}}
                                        </td>
                                        <td>
                                            {{ 
                                                percentage($commit->amount,$commit->NewVentureListing->venture->target_amount)}}%
                                            </td>
                                            <td>{{$commit->created_at!='' ?\Carbon\Carbon::parse($commit->created_at)->format('m-d-Y h:i A'):'-- -- --'}}</td>
                                            <td><span class="btn btn-{{Config::get('constants.VENTURE_COMMIT_STATUS_COLOR.'.$commit->status)}}">{{ !is_null($commit) ? $commit->status : ''}}</span></td>
                                            <td>
                                                @if($commit->status == Config::get('constants.VENTURE_COMMIT_STATUS')[0])
                                                <!-- {{--<button class="btn btn-sm btn-info " onclick="sendCommittmentEmails('success',{{$commit->id}})">Agreement Sign</button>--}} -->
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info signer-document" 
                                                    data-id="{{$commit->id}}" 
                                                    data-percentage-of-ownership="{{percentage($commit->amount,$commit->NewVentureListing->venture->target_amount)}}"
                                                    data-commited-amount="{{formatCurrencyWithoutSymbol($commit->amount)}}"
                                                    data-n-of-percentage-amount="{{formatCurrencyWithoutSymbol(amountPercentage($commit->amount, 3.5))}}"
                                                    data-total-of-commited-amount="{{formatCurrencyWithoutSymbol(amountPercentage($commit->amount, 3.5) + $commit->amount)}}"
                                                    data-name = "{{$commit->NewVentureListing->venture->venture_name}}";
                                                    data-address = "{{$commit->NewVentureListing->venture->ventureDetail->property_street}}, {{$commit->NewVentureListing->venture->ventureDetail->property_city}}, {{getState($commit->NewVentureListing->venture->ventureDetail->property_state)}}, {{$commit->NewVentureListing->venture->ventureDetail->property_zip}}"                                            
                                                    >
                                                Agreement Sign</button>
                                                <button class="btn btn-xs btn-danger ml-1" data-toggle="modal" data-target="#commitCancelConfirm" data-id="{{$commit->id}}" id="cancelCommit">Cancel</button>
                                            </div>                                                                                
                                            @else
                                            @if($commit->document_hash)
                                            <a download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&document_hash={{$commit->document_hash}}" target="_blank" class="btn btn-sm btn-warning">Look Signed Document</a>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="8" class="text-center">No, List found!</td></tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card col-md-12 portfolio-card">
    <div class="card-body portfolio-card-body">
        <div class="dashboard-header clearfix">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h5>Offers you have made</h5>
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
                                        <th>Listing ID</th>
                                        <th>Venture Name</th>
                                        <th>Seller's ID</th>
                                        <th>Amount</th>
                                        <th>OwnerShip</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($offers) > 0)
                                    @foreach($offers as $offer)
                                    <tr>
                                        <td>{{$offer->venture_listing!=''?$offer->venture_listing->list_automated_id:''}}</td>
                                        <td>{{$offer->venture_listing->venture!=''?$offer->venture_listing->venture->venture_name:''}}</td>
                                        <td>{{Helper::listingUser($offer->venture_listing->id)}}</td>

                                        <td>
                                            {{formatCurrency($offer->amount) }}
                                            {{-- {{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($offer->amount) ? $offer->amount : '0', 2, ',', '.')}} --}}

                                        </td>
                                        <td>
                                            {{
                                                Helper::percentageOwnershipForSell($offer->venture_listing->ownership_id,($offer->venture_listing->percentage_of_ownership*($offer->seller_ownership/100)))
                                            }}%
                                        </td>
                                        <td>{{$offer->created_at!=''?\Carbon\Carbon::parse($offer->created_at)->format('m-d-Y h:i A'):''}}</td>
                                        <td><span class="btn btn-sm btn-{{Config::get('constants.VENTURE_OFFER_STATUS_COLOR.'.$offer->status)}}">{{ !is_null($offer) ? $offer->status : ''}}</span></td>
                                        <td>
                                            @if($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[0])
                                            Waiting for seller response...
                                            {{-- TODO: OLD LOGIC FOR FUTURE USE --}}
                                            {{-- @elseif($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[1]) --}}
                                            @elseif($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[3])
                                            @if($offer->buyer_document_signing_url)
                                            <button data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[5] }}" data-url="{{$offer->buyer_document_signing_url}}" class="btn btn-sm btn-warning offer-signers-document-iframe" data-user="{{ json_encode($offer->venture_listing->users()->first()) }}" data-id="{{$offer->id}}">Sign Docs</button>
                                            {{-- <button data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[4] }}" data-url="{{$offer->buyer_document_signing_url}}" class="btn btn-sm btn-warning offer-signers-document-iframe" data-user="{{ json_encode($offer->venture_listing->users()->first()) }}" data-id="{{$offer->id}}">Sign Docs</button> --}}
                                            @else
                                            <button data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[5] }}" class="btn btn-sm btn-warning offer-signers-document" data-user="{{ json_encode($offer->venture_listing->users()->first()) }}" data-id="{{$offer->id}}">Sign Docs</button>
                                            {{-- <button data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[4] }}" class="btn btn-sm btn-warning offer-signers-document" data-user="{{ json_encode($offer->venture_listing->users()->first()) }}" data-id="{{$offer->id}}">Sign Docs</button> --}}
                                            @endif
                                            @else
                                            @if($offer->document_hash && in_array($offer->status, ['Funding','Closing','Closed']))
                                            <a download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&document_hash={{$offer->document_hash}}" target="_blank" class="btn btn-sm btn-warning">Look Signed Document</a>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="8" class="text-center">No, List found!</td></tr>
                                    @endif
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
                    <h5>Offers made for your ventures</h5>
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
                                        <th>Listing ID</th>
                                        <th>Venture Name</th>
                                        <th>Buyer's ID</th>
                                        <th>Amount</th>
                                        <th>Total Venture Ownership %</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($receiveOffers) > 0)
                                    @foreach($receiveOffers as $offer)
                                    <tr>
                                        <td>{{$offer->venture_listing!=''?$offer->venture_listing->list_automated_id:''}}</td>
                                        <td>{{$offer->venture_listing->venture!=''?$offer->venture_listing->venture->venture_name:''}}</td>
                                        <td>{{$offer->user!=''?$offer->user->name:''}}</td>

                                        <td>
                                            {{ formatCurrency($offer->amount) }}
                                            {{-- {{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($offer->amount) ? $offer->amount : '0', 2, ',', '.')}} --}}
                                        </td>
                                        <td>
                                            {{-- TODO --}}
                                            {{-- {{!is_null($offer->seller_ownership) ? $offer->seller_ownership : '0'}}% --}}
                                            @if(!is_null($offer->venture_listing))
                                            {{
                                                Helper::percentageOwnershipForSell($offer->venture_listing->ownership_id,($offer->venture_listing->percentage_of_ownership*($offer->seller_ownership/100)))
                                            }}%
                                            @else
                                            N/A
                                            @endif

                                        </td>
                                        <td>{{$offer->created_at!=''?\Carbon\Carbon::parse($offer->created_at)->format('m-d-Y h:i A'):''}}</td>
                                        <td><span class="btn btn-sm btn-{{Config::get('constants.VENTURE_OFFER_STATUS_COLOR.'.$offer->status)}}">{{ !is_null($offer) ? $offer->status : ''}}</span></td>
                                        <td>
                                            @if($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[0])
                                            <button class="btn btn-sm btn-warning offer-review" data-offer="{{json_encode($offer)}}"
                                            data-offerpercent="{{ Helper::percentageOwnershipForSell($offer->venture_listing->ownership_id,($offer->venture_listing->percentage_of_ownership*($offer->seller_ownership/100)))}}">Review</button>
                                            {{-- TODO: OLD LOGIC FOR FUTURE USE --}}
                                            {{-- @elseif($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[4]) --}}
                                            @elseif($offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[4])
                                            @if($offer->seller_document_signing_url)
                                            <button {{ $offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[1] ? 'disabled' : '' }} data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[3] }}" data-url="{{$offer->seller_document_signing_url}}" class="btn btn-sm btn-warning offer-signers-document-iframe" data-user="{{ json_encode($offer->user) }}" data-id="{{$offer->id}}">Sign Docs</button>
                                            @else
                                            <button data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[3] }}" class="btn btn-sm btn-warning offer-signers-document"
                                            data-user="{{ json_encode($offer->user) }}"
                                            data-id="{{$offer->id}}"
                                            data-percentage-of-ownership="{{Helper::percentageOwnershipForSell($offer->venture_listing->ownership_id,($offer->venture_listing->percentage_of_ownership*($offer->seller_ownership/100)))}}"
                                            data-total-amount="{{formatCurrencyWithoutSymbol($offer->amount)}}"
                                            data-n-of-percentage-amount="{{formatCurrencyWithoutSymbol(amountPercentage($offer->amount, 3.5))}}"
                                            data-total-of-total-amount="{{formatCurrencyWithoutSymbol(amountPercentage($offer->amount, 3.5) + $offer->amount)}}"
                                            data-name = "{{$offer->venture_listing->venture->venture_name}}";
                                            data-address = "{{$offer->venture_listing->venture->ventureDetail->property_street}}, {{$offer->venture_listing->venture->ventureDetail->property_city}}, {{getState($offer->venture_listing->venture->ventureDetail->property_state)}}, {{$offer->venture_listing->venture->ventureDetail->property_zip}}"

                                            >Sign Docs</button>
                                            {{-- TODO: OLD LOGIC FOR FUTURE USE --}}
                                            {{-- <button {{ $offer->status == Config::get('constants.VENTURE_OFFER_STATUS')[1] ? 'disabled' : '' }} data-status="{{ Config::get('constants.VENTURE_OFFER_STATUS')[5] }}" class="btn btn-sm btn-warning offer-signers-document" data-user="{{ json_encode($offer->user) }}" data-id="{{$offer->id}}">Sign Docs</button> --}}
                                            @endif
                                            @else
                                            @if($offer->document_hash && in_array($offer->status, ['Funding','Closing','Closed']))
                                            <a download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&document_hash={{$offer->document_hash}}" target="_blank" class="btn btn-sm btn-warning">Look Signed Document</a>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="8" class="text-center">No, List found!</td></tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card col-md-12 portfolio-card">
    <div class="card-body portfolio-card-body">
        <div class="dashboard-header clearfix">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h5>Buy Now You Have Made</h5>
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
                                        <th>Listing ID</th>
                                        <th>Venture Name</th>
                                        <th>Seller's ID</th>
                                        <th>Amount</th>
                                        <th>Total Venture Ownership %</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($buyNow) > 0)
                                    @foreach($buyNow as $buy)
                                    <tr>
                                        <td>{{!is_null($buy->venture_listing)?$buy->venture_listing->list_automated_id:''}}</td>
                                        <td>{{!is_null($buy->venture_listing) && !is_null($buy->venture_listing->venture)?$buy->venture_listing->venture->venture_name:''}}</td>
                                        <td>{{Helper::listingUser($buy->venture_listing->id)}}</td>
                                        <td>{{!is_null($buy->venture_listing)?formatCurrency($buy->venture_listing->asking_price):''}}</td>
                                        <td>
                                            @if(!is_null($buy->venture_listing))
                                            {{
                                                Helper::percentageOwnershipForSell($buy->venture_listing->ownership_id,$buy->venture_listing->percentage_of_ownership)
                                            }}%
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>{{!is_null($buy->created_at) ?\Carbon\Carbon::parse($buy->created_at)->format('m-d-Y h:i A'):'-- -- --'}}</td>
                                        <td><span class="btn btn-sm btn-{{Config::get('constants.VENTURE_BUY_NOW_STATUS_COLOR.'.$buy->status)}}">{{ !is_null($buy) ? $buy->status : ''}}</span></td>
                                        <td>
                                            @if($buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[0])
                                            @if($buy->buyer_document_signing_url)
                                            <button data-status="{{ Config::get('constants.VENTURE_BUY_NOW_STATUS')[1] }}" data-url="{{$buy->buyer_document_signing_url}}" class="btn btn-sm btn-warning buy-now-signers-document-iframe" data-user="{{ json_encode($buy->venture_listing->users()->first()) }}" data-id="{{$buy->id}}">Sign Docs</button>
                                            @else
                                            <button data-status="{{ Config::get('constants.VENTURE_BUY_NOW_STATUS')[1] }}" class="btn btn-sm btn-warning buy-now-signers-document"
                                            data-user="{{ json_encode($buy->venture_listing->users()->first()) }}"
                                            data-id="{{$buy->id}}"
                                            data-percentage-of-ownership="{{Helper::percentageOwnershipForSell($buy->venture_listing->ownership_id,$buy->venture_listing->percentage_of_ownership)}}"
                                            data-total-amount="{{formatCurrencyWithoutSymbol($buy->venture_listing->asking_price)}}"
                                            data-n-of-percentage-amount="{{formatCurrencyWithoutSymbol(amountPercentage($buy->venture_listing->asking_price, 3.5))}}"
                                            data-total-of-total-amount="{{formatCurrencyWithoutSymbol(amountPercentage($buy->venture_listing->asking_price, 3.5) + $buy->venture_listing->asking_price)}}"
                                            data-name = "{{$buy->venture_listing->venture->venture_name}}";
                                            data-address = "{{$buy->venture_listing->venture->ventureDetail->property_street}}, {{$buy->venture_listing->venture->ventureDetail->property_city}}, {{getState($buy->venture_listing->venture->ventureDetail->property_state)}}, {{$buy->venture_listing->venture->ventureDetail->property_zip}}">Sign Docs</button>
                                            @endif
                                            @else
                                            @if($buy->document_hash)
                                            <a download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&document_hash={{$buy->document_hash}}" target="_blank" class="btn btn-sm btn-warning">Look Signed Document</a>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="8" class="text-center">No, List found!</td></tr>
                                    @endif
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
                    <h5>Buy Now Request Received From Others</h5>
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
                                        <th>Listing ID</th>
                                        <th>Venture Name</th>
                                        <th>Buyer's ID</th>
                                        <th>Selling Price</th>
                                        <th>Total Venture Ownership %</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($buyNowReceived) > 0)
                                    @foreach($buyNowReceived as $buy)
                                    <tr>
                                        <td>{{!is_null($buy->venture_listing)?$buy->venture_listing->list_automated_id:''}}</td>
                                        <td>{{!is_null($buy->venture_listing) && !is_null($buy->venture_listing->venture)?$buy->venture_listing->venture->venture_name:''}}</td>
                                        <td>{{!is_null($buy->user)?$buy->user->name:''}}</td>
                                        <td>{{!is_null($buy->venture_listing) ?formatCurrency($buy->venture_listing->asking_price):''}}</td>
                                        <td>
                                            @if(!is_null($buy->venture_listing))
                                            {{
                                                Helper::percentageOwnershipForSell($buy->venture_listing->ownership_id,$buy->venture_listing->percentage_of_ownership)
                                            }}%
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>{{!is_null($buy->created_at) ?\Carbon\Carbon::parse($buy->created_at)->format('m-d-Y h:i A'):'-- -- --'}}</td>
                                        <td><span class="btn btn-sm btn-{{Config::get('constants.VENTURE_BUY_NOW_STATUS_COLOR.'.$buy->status)}}">{{ !is_null($buy) ? $buy->status : ''}}</span></td>
                                        <td>
                                            @if($buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[1])
                                            @if($buy->seller_document_signing_url)
                                            <button data-status="{{ Config::get('constants.VENTURE_BUY_NOW_STATUS')[2] }}" data-url="{{$buy->seller_document_signing_url}}" class="btn btn-sm btn-warning buy-now-signers-document-iframe" data-email="true" data-user="{{ json_encode($buy->user) }}" data-id="{{$buy->id}}">Sign Docs</button>
                                            @else
                                            <button data-status="{{ Config::get('constants.VENTURE_BUY_NOW_STATUS')[2] }}" class="btn btn-sm btn-warning buy-now-signers-document" data-user="{{ json_encode($buy->user) }}" data-email="true" data-id="{{$buy->id}}">Sign Docs</button>
                                            @endif

                                            @else
                                            @if($buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[2] || $buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[3] || $buy->status == Config::get('constants.VENTURE_BUY_NOW_STATUS')[4])
                                            @if($buy->document_hash)
                                            <a download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&document_hash={{$buy->document_hash}}" target="_blank" class="btn btn-sm btn-warning">Look Signed Document</a>
                                            @endif
                                            @endif
                                            @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                    @else
                                    <tr><td colspan="8" class="text-center">No, List found!</td></tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>