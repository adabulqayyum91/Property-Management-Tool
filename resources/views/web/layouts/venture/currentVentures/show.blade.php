{{--*******

 * Created by PhpStorm.
 * User: zahra
 * Date: 4/6/2020
 * Time: 4:11 PM
 ********--}}

 @extends('web.layouts.partials.app')
 @section('page_title')
 Home | Property Management Tool
 @endsection
 @section('css')
 <style>
 .close-modal {
    position: relative;
    top: 0px;
    right: 0px;
    color: #f1f1f1;
    font-size: 60px;
    font-weight: bold;
    transition: 0.3s;
    opacity: 1;
    float: right;
}
</style>
@endsection
@section('content')
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTNPV7L"
        height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>


    <!-- Sub banner start -->
    <div class="sub-banner overview-bgi">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Venture Detail</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{url('/home')}}">Home</a></li>
                    <li class="active">Venture Detail</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sub Banner end -->

    <!-- Properties details page start -->
    <div class="properties-details-page content-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Heading properties 3 start -->
                    <div class="heading-properties-3">
                        {{--<h1><span style="float: right"> <a href="javascript:void(0)"  class="btn btn-sm btn-theme" data-toggle="modal" data-target="#cancelSale">Buy Now</a>--}}
                            {{--<a href="javascript:void(0)"  class="btn btn-sm btn-theme" data-toggle="modal" data-target="#offer">Offer</a></span> </h1>--}}
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Venture Name</label>
                        <input type="text" name="" placeholder="Val Vista 123 LLC" class="form-control" value="{{ !is_null($currentVentureList->venture) ? $currentVentureList->venture->venture_name : ''}}" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label>Venture ID</label>
                        <input type="text" name="" placeholder="12345" class="form-control" value="{{!is_null($currentVentureList->venture) ? $currentVentureList->venture->venture_automated_id : ''}}" readonly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label>Description</label>
                        <textarea class="form-control" name="" rows="5"  readonly>{{$currentVentureList->description}}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <label>CAP Rate</label>
                        <input type="text" name="" placeholder="45%" class="form-control" value="{{towDecimalNumber((Helper::calculateRecent12MonthReveneu($currentVentureList->venture_id)*Helper::percentageOwnershipForSell($currentVentureList->ownership_id,$currentVentureList->percentage_of_ownership))/$currentVentureList->asking_price)}}%" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label>Listing ID </label>
                        <input type="text" name="" placeholder="1212" class="form-control" value="{{$currentVentureList->list_automated_id}}" readonly>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <label>Asking price</label>
                        <input type="text" name="" placeholder="Asking price" class="form-control" value=" {{ !is_null($currentVentureList->venture) ? formatCurrency($currentVentureList->asking_price) : '0.00'}}" readonly>
                    </div>
                {{--  <div class="col-lg-6">
                      <label>% of Total Venture For Sale</label>
                      <input type="text" name="" placeholder="% of Total Venture For Sale" class="form-control">
                  </div>--}}
              </div><br>
              <label class="images-title image-popup">Images <i class="fa fa-image"></i> </label>
              <div class="row">
                @if(!$currentVentureListImages->isEmpty())

                @foreach($currentVentureListImages as $image)
                <div class="col-lg-2">
                    <img src="{{ asset((!is_null($image)?'uploads/ventures/'.$image->file_name:'img/favicon.png')) }}" alt="{{ $currentVentureList->venture->venture_name }}" class="img-responsive mb-4" style="width: 100%;max-height: 100px;">
                </div>
                @endforeach
                @endif
                @if(!$ventureImages->isEmpty())
                @foreach($ventureImages as $image)
                <div class="col-lg-2">
                    <img src="
                    {{ asset((!is_null($image)?'uploads/ventures/'.$image->file_name:'img/favicon.png')) }}
                    " alt="{{ $currentVentureList->venture->venture_name }}" class="img-responsive mb-4" style="width: 100%;max-height: 100px;">
                </div>
                @endforeach
                @endif
                @if($ventureImages->isEmpty() && $currentVentureListImages->isEmpty())
                <div class="col-lg-2"> <img src="{{asset('img/favicon.png')}}" class="img-responsive image-popup mb-4" style="width: 100%;max-height: 100px;"> </div>

                @endif

            </div>
            <br>

            {{-- <div class="row">
                 <div class="col-lg-12">
                     <label>Address</label>
                     <input type="text" name="" placeholder="Address" class="form-control">
                 </div>
             </div>
             <br>--}}
             <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label>Street</label>
                    <input type="text" name="" placeholder="Street" class="form-control" value="{{!is_null($currentVentureList->venture->VentureDetail) ? $currentVentureList->venture->VentureDetail->property_street : ''}}" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label>City</label>
                    <input type="text" name="" placeholder="City" class="form-control" value="{{!is_null($currentVentureList->venture->VentureDetail) ? $currentVentureList->venture->VentureDetail->property_city : ''}}" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <label>State</label>
                    <input type="text" name="" placeholder="State" class="form-control" value="{{!is_null($currentVentureList->venture) ? $currentVentureList->venture->state->name : ''}}" readonly>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label>Zip</label>
                    <input type="text" name="" placeholder="Zip" class="form-control" value="{{!is_null($currentVentureList->venture->VentureDetail) ? $currentVentureList->venture->VentureDetail->property_zip : ''}}" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <iframe src="https://maps.google.com/maps?q={{$streetAddress}}&hl=en&z=15&amp;output=embed"  height="200px" frameborder="0" style="border:0"></iframe>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 text-center">
                    @foreach($currentVentureListDocuments as $document)
                    <input type="hidden" class="documents" value="{{ url((!is_null($document)?'uploads/ventures/'.$document->file_name:'img/favicon.png')) }}">
                    @endforeach
                    @if(count($currentVentureListDocuments) > 0)
                    <button onclick="downloadSelected()" class="btn btn-success btnloop">
                        <i class="fa fa-download"></i>&ensp;
                        Property Details & Financials
                    </button>
                    @endif
                </div>
            </div>
            <br>
        </div>
        <!-- The Modal -->
        <div class="modal fade bd-example-modal-lg" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <!-- The Close Button -->
            <span class="close-modal" onclick="$('#imageModal').modal('hide')">&times;</span>

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner ">
                            @php $counter = 0; @endphp
                            @if(!$currentVentureListImages->isEmpty())
                            @foreach($currentVentureListImages as $index =>$image)
                            <div class="carousel-item  @if($counter == '0'){{'active'}}@endif">
                                <img src="{{ asset((!is_null($image)?'uploads/ventures/'.$image->file_name:'img/favicon.png')) }}"
                                alt="{{ !is_null($currentVentureList->venture) ? $currentVentureList->venture->venture_name : '' }}"
                                class="d-block w-100">
                            </div>
                            @php $counter++; @endphp
                            @endforeach
                            @endif
                            @if(!$ventureImages->isEmpty())
                            @foreach($ventureImages as $index => $image)
                            <div class="carousel-item  @if($counter == '0'){{'active'}}@endif">
                                <img src="{{ asset((!is_null($image)?'uploads/ventures/'.$image->file_name:'img/favicon.png')) }}"
                                alt="{{ $currentVentureList->venture->venture_name }}"
                                class="d-block w-100">
                            </div>
                            @php $counter++; @endphp
                            @endforeach
                            @endif


                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                            <span class="sr-only">Previous</span>

                        </a>

                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

                            <span class="carousel-control-next-icon" aria-hidden="true"></span>

                            <span class="sr-only">Next</span>

                        </a>
                    </div>
                </div>

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
            </div>
        </div>
    </div>

</body>
@endsection

@section('script')
<script>
    $(document).ready(function () {
            //****Image popup****
            $(document).on('click','.image-popup', function () {
                console.log('here');
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
            });

        })
    </script>
    <script>
        function downloadSelected()
        {
            $('.documents').each(function() {
              window.open($(this).val(),'_blank');
          });
            return false;
        }
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-89110077-3', 'auto');
        ga('send', 'pageview');
    </script>
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0N5pbJN10Y1oYFRd0MJ_v2g8W2QT74JE"></script>
    <script>
        function LoadMap(propertes) {
            var defaultLat = 40.7110411;
            var defaultLng = -74.0110326;
            var mapOptions = {
                center: new google.maps.LatLng(defaultLat, defaultLng),
                zoom: 15,
                scrollwheel: false,
                styles: [
                {
                    featureType: "administrative",
                    elementType: "labels",
                    stylers: [
                    {visibility: "off"}
                    ]
                },
                {
                    featureType: "water",
                    elementType: "labels",
                    stylers: [
                    {visibility: "off"}
                    ]
                },
                {
                    featureType: 'poi.business',
                    stylers: [{visibility: 'off'}]
                },
                {
                    featureType: 'transit',
                    elementType: 'labels.icon',
                    stylers: [{visibility: 'off'}]
                },
                ]
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            var infoWindow = new google.maps.InfoWindow();
            var myLatlng = new google.maps.LatLng(40.7110411, -74.0110326);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });
            (function (marker) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent("" +
                        "<div class='map-properties contact-map-content'>" +
                        "<div class='map-content'>" +
                        "<p class='address'>20-21 Kathal St. Tampa City, FL</p>" +
                        "<ul class='map-properties-list'> " +
                        "<li><i class='flaticon-phone'></i>  +0477 8556 552</li> " +
                        "<li><i class='flaticon-phone'></i>  info@themevessel.com</li> " +
                        "<li><a href='index.html'><i class='fa fa-globe'></i>  http://www.example.com</li></a> " +
                        "</ul>" +
                        "</div>" +
                        "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker);
        }
        LoadMap();

    </script>
    <script>
        $(document).ready(function () {
            $('.customInstaIcn').css('color','grey');

            $(".customInstaIcn").hover(function() {
                $(this).css("color","mediumvioletred")
            }).mouseout(function(){
                $(this).css({"color":"grey",});
            });
        })
    </script>
    <script>
        $(document).ready(function () {
            //****Image popup****
            $(document).on('click','.image-popup', function () {
                console.log('here');
                $('#modal-image').attr('src', $(this).attr('src'));
                $('#imageModal').modal('show');
                $('#caption').html($(this).attr('alt'));
            });
            $('.customInstaIcn').css('color','grey');

            $(".customInstaIcn").hover(function() {
                $(this).css("color","mediumvioletred")
            }).mouseout(function(){
                $(this).css({"color":"grey",});
            });
        })
    </script>
    @endsection
