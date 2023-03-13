{{-- =========================================================================================
Description:  New Venture Listing Block
* Created by PhpStorm.
 * User: Transdata
 * Date: 4/7/2020
 * Time: 5:08 PM
----------------------------------------------------------------------------------------
========================================================================================== --}}

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
<div class="col-lg-6 col-md-6 col-sm-12">

    <div class="property-box">
        <div class="property-thumbnail">
            <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}" class="property-img">
                <img src="{{$fileSource}}"
                alt="{{ !is_null($venture->venture) ? $venture->venture->venture_name : ''}}" class="img-responsive image-popup venture-listing-img" >
            </a>
        </div>
        <div class="price-box-center"> 
            Target Amount 
            <span class="price-box-value">
                {{ formatCurrency($venture->venture->target_amount) }}
            </span>
        </div>

        <div class="detail">
            <h1 class="title">
                <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}">{{ !is_null($venture->venture) ? $venture->venture->venture_name : ''}}</a>
            </h1>


            <div class="location">
                <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}">
                    {!! $venture->description !!}
                </a>
            </div>
            <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm customCapBtn">CAP Rate: {{ !is_null($venture->venture) ? $venture->venture->initial_cap : ''}}%</a>
        </div>
        <div class="footer customFooter">
            <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm btn-theme">Details</a>
            <button  class="btn btn-sm btn-theme customComitBtn commit-button"
            data-listId="{{!is_null($venture->list_automated_id) ? $venture->list_automated_id:''}}"
            {{Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount? $venture->venture->target_amount : '0')>=100?'disabled':''}}>Commit </button>
            <div class="progress">
                <div class="progress-barr" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount)}}%;
                background: #376bff; color: white;text-align: center;">{{\App\Helpers\Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount? $venture->venture->target_amount : '0')}}%</div>
            </div>
            <center>
                <span><b>{{formatCurrency(Helper::newVentureRemainingCommitAmount($venture->id))}}</b> needed to be fully funded.</span>
            </center>

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

    $('.commit-button').click(function () {
        var listingId = $(this).attr('data-listId');
        $.ajax({
            type: 'GET',
            url: "{{ url('get-commit-modal') }}/"+listingId,
            headers: {
                'X-CSRF-Token': "{{csrf_token()}}"
            },
            success: function (response) {
                if(response.status == true){
                    $('.commit-popup .modal-body').html(response.data);
                    $('.commit-popup').modal('show');
                }else{
                    $('.commit-popup .modal-body').html('');
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
        });
    });

</script>
