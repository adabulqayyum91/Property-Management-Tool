
@if(count($currentVentureListings)!=0)
@foreach($currentVentureListings as $venture)
@php
$fileSource = getVentureImageSource($venture);
@endphp
<div class="col-lg-6 col-md-6 col-sm-12" >
    <div class="property-box">
        <div class="property-thumbnail">
            @if(!Auth::guest() && !is_null($venture->BuyNow()->first()))
            {{-- @if($venture->users()->first()->id != Auth::user()->id) --}}
            <div class="centered" style="position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(324deg);
            color: red;
            font-size: 40px;
            font-weight: bold;
            white-space: nowrap;">Under Contract</div>
            {{-- @endif --}}
            @endif
            <a href="{{route('current-venture-listings.show',$venture->list_automated_id)}}" class="property-img">
                <img src="{{ $fileSource }}"
                alt="{{ !is_null($venture->venture) ? $venture->venture->venture_name : ''}}" class="img-responsive image-popup venture-listing-img">
            </a>
        </div>
        <div class="price-box-center"> 
            Offered at 
            <span class="price-box-value">
                {{ formatCurrency($venture->asking_price)}}
            </span>
            For
            <span class="price-box-value"> 
                {{ Helper::percentageOwnershipForSell($venture->ownership_id,$venture->percentage_of_ownership)}}%
            </span> 
            Ownership
        </div>
        <div class="detail">

            <h1 class="title">
                <a href="{{route('current-venture-listings.show',$venture->list_automated_id)}}">{{ !is_null($venture->venture) ? $venture->venture->venture_name : ''}}</a>
            </h1>
            <div class="location">
                <a href="{{route('current-venture-listings.show',$venture->list_automated_id)}}">
                    {!! $venture->description !!}
                </a>
                <br>
                <a href="#"><small>({{$venture->list_automated_id}})</small></a>
            </div>
            <a href="{{route('current-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm customCapBtn">CAP Rate: {{towDecimalNumber((Helper::calculateRecent12MonthReveneu($venture->venture_id)*Helper::percentageOwnershipForSell($venture->ownership_id,$venture->percentage_of_ownership))/$venture->asking_price)}}%
                {{-- TODO --}}
                {{-- {{ !is_null($venture->venture) ? $venture->venture->initial_cap : ''}}% --}}
            </a>
        </div>

        <div class="footer customFooter">
            <a href="{{route('current-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm btn-theme">Details</a>
            @if (Auth::guest())
            <button class="btn btn-sm btn-theme buy-now-modal" {{ !is_null($venture->BuyNow()->first()) ? 'disabled' :  'data-ventureList='.$venture->list_automated_id }}>Buy Now</button>
            <button class="btn btn-sm btn-theme offer-modal" {{ !is_null($venture->BuyNow()->first()) ? 'disabled' :  'data-ventureList='.$venture->list_automated_id }}>Offer</button>
            @elseif(!is_null($venture->users()->first()) && $venture->users()->first()->id != Auth::user()->id)
            <button class="btn btn-sm btn-theme buy-now-modal" {{ !is_null($venture->BuyNow()->first()) ? 'disabled' :  'data-ventureList='.$venture->list_automated_id }}>Buy Now</button>
            @if(!is_null($venture->BuyNow()->first()))
            <button class="btn btn-sm btn-theme offer-modal" disabled>Offer</button>
            @else
            <button class="btn btn-sm btn-theme offer-modal" {{ !(Helper::checkOfferExist($venture->id,auth()->user()->id)) ? 'disabled' :  'data-ventureList='.$venture->list_automated_id }}>Offer</button>
            @endif
            @endif
        </div>
    </div>
</div>
@endforeach
@endif
