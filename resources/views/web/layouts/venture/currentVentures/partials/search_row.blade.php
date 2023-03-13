
@if(count($ventureList)!=0)
<div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-5">
    <div class="option-bar">
        <h6 class="mb-0">There are {{ $ventureList->count() }} results.</h6>
    </div>
</div>
@foreach($ventureList as $venture)
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
                <img src="{{$fileSource}}"
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
            </div>
            <a href="{{route('current-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm customCapBtn">CAP Rate: {{towDecimalNumber((Helper::calculateRecent12MonthReveneu($venture->venture_id)*Helper::percentageOwnershipForSell($venture->ownership_id,$venture->percentage_of_ownership))/$venture->asking_price)}}%
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
@else
<div class="col-lg-12 col-md-12 col-sm-12 mt-4 mb-5">
    <div class="option-bar">
        <h6 class="mb-0">No matching records found</h6>
    </div>
</div>
@endif
<script>
    $('.offer-modal').click(function () {
        var venture_listing_id = $(this).attr('data-ventureList');
        $.ajax({
            type: 'GET',
            url: "{{ url('get-offer-modal') }}/"+venture_listing_id,
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            success: function (response) {
                if(response.status == true){
                    $('#offer .modal-body').html(response.data);
                    $('#offer').modal('show');
                }else{
                    $('#offer .modal-body').html('');
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
        });
    });

    $('.buy-now-modal').click(function () {
        var venture_listing_id = $(this).attr('data-ventureList');
        $.ajax({
            type: 'GET',
            url: "{{ url('get-buy-now-modal') }}/"+venture_listing_id,
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            success: function (response) {
                if(response.status == true){
                    $('#cancelSale .modal-body').html(response.data);
                    $('#cancelSale').modal('show');
                }else{
                    $('#cancelSale .modal-body').html('');
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
        });
    });

</script>
