{{-- =========================================================================================
Description:  New Venture Listing Block
* Created by PhpStorm.
 * User: Transdata
 * Date: 4/7/2020
 * Time: 5:08 PM
----------------------------------------------------------------------------------------
========================================================================================== --}}
<style>
.property-box{min-height: 400px;}
</style>
@if(count($newVentureListing)!=0)
@foreach($newVentureListing as $venture)
@php
$fileSource = getVentureImageSource($venture);
@endphp
<div class="col-lg-6 col-md-6 col-sm-12">

    <div class="property-box">
        <div class="property-thumbnail">
            <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}" class="property-img">

                <img src="{{$fileSource}}"
                alt="{{ !is_null($venture->venture) ? $venture->venture->venture_name : ''}}" class="img-responsive image-popup venture-listing-img">
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
               <br>
               <a href="#"><small>({{$venture->list_automated_id}})</small></a>
           </div>
           <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm customCapBtn">CAP Rate: {{ !is_null($venture->venture) ? $venture->venture->initial_cap : ''}}%</a>
           <br><br>

       </div>
       <div class="footer customFooter">
        <a href="{{route('new-venture-listings.show',$venture->list_automated_id)}}" class="btn btn-sm btn-theme">Details</a>
        <button  class="btn btn-sm btn-theme customComitBtn commit-button"
        data-listId="{{!is_null($venture->list_automated_id) ? $venture->list_automated_id:''}}"
        {{Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount? $venture->venture->target_amount : '0')>=100?'disabled':''}}>Commit </button>
        <div class="progress" style="background-color: #9d9da5">
            <div class="progress-barr" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount)}}%;
            background: #376bff; color: white;text-align: center; font-weight: bolder;">{{\App\Helpers\Helper::newVentureListingPercentage($venture->id,$venture->venture->target_amount? $venture->venture->target_amount : '0')}}%</div>
        </div>
        <center>
            <span><b>{{formatCurrency(Helper::newVentureRemainingCommitAmount($venture->id))}}</b> needed to be fully funded.</span>
        </center>
    </div>
</div>
</div>

@endforeach
@else
<tr><td colspan="6" class="text-center">No, List found!</td></tr>
@endif

