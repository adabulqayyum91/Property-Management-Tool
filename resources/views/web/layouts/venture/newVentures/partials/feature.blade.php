<!-- Slick slider area start -->
@if(count($featureVentures)!=0)
<div class="slick-slider-area">
    <div class="row slick-carousel" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
        @foreach($featureVentures as $featureVenture)              
            @php
                $fileSource = getVentureImageSource($featureVenture);
            @endphp
            <div class="slick-slide-item">                
                <div class="blog-3">
                    <div class="blog-photo">
                        <a href="{{route('new-venture-listings.show',$featureVenture->list_automated_id)}}"> <div class="listing-badges">
                                <span class="featured">Featured</span>
                            </div>

                            <img src="{{$fileSource}}"
                                 alt="{{ !is_null($featureVenture->venture) ? $featureVenture->venture->venture_name : '' }}" class="img-fluid" >
                        </a>
                    </div>
                    <div class="detail">
                        <h3>
                            <a href="{{route('new-venture-listings.show',$featureVenture->list_automated_id)}}">CAP Rate: {{!is_null($featureVenture->venture) ? $featureVenture->venture->initial_cap : ''}}%</a>
                        </h3>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <div class="slick-prev slick-arrow-buton">
        <i class="fa fa-angle-left"></i>
    </div>
    <div class="slick-next slick-arrow-buton">
        <i class="fa fa-angle-right"></i>
    </div>
</div>
@endif
