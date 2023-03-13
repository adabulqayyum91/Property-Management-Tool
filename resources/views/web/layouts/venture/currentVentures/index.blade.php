
{{--
 * Created by PhpStorm.
 * User: zahra
 * Date: 4/20/2020
 * Time: 1:43 PM
 --}}
@extends('web.layouts.partials.app')
@section('page_title')
    Home | Property Management Tool
@endsection


@section('content')
    {{-- TODO: For future use --}}
    {{-- <div class="sub-banner overview-bgi">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Current Venture</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{url('/home')}}">Home</a></li>
                    <li class="active">Current Venture</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <br>
    <br>
    <!-- Sub Banner end -->
    <div class="blog content-area-3" style="margin-bottom: -4%;">
        <div class="container">
            <!-- Main title -->
            <div class="main-title">
                <h1>Current Ventures Listing</h1>
            </div>
          @include('web.layouts.venture.currentVentures.partials.feature')
        </div>
    </div>



    <!-- Properties section body start -->
    <div class="properties-section-body content-area" style="margin-top: 5%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <!-- Option bar start -->
                    <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                        <h4 style="text-align: center;margin-top: 2%;">Current Venture Listing Search</h4>
                        <br>
                        <div class="row" id="ventureSearch">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">

                                    <label>Price Range From</label>
                                    <input class="form-control" name="price_range_from" type="text" placeholder="$">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Price Range To</label>
                                    <input name="price_range_to" class="form-control" type="text" placeholder="$">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>CAP % Rate Range From</label>
                                    <input name="cap_rate_range_from" class="form-control" type="text" placeholder="%">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>CAP % Rate Range To</label>
                                    <input name="cap_rate_range_to" class="form-control" type="text" placeholder="%">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Venture Type</label>
                                    <select class="form-control search-fields" tabindex="-98" id="venture_state" name="venture_state">
                                            <option value="Any">Any</option>
                                            @foreach($types as $type)
                                                <option value="{{$type}}">{{$type}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input class="btn btn-sm btn-theme float-right" id="listSearch" type="button" value="Submit" style="height: 42px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- grid properties start -->
                    <div class="row ventureList" id="ventureList">
                        @include('web.layouts.venture.currentVentures.partials.current_venture_row')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Properties details page end -->
    <div class="modal fade" id="cancelSale" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelSaleLabel">Buy Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal offer now-->
    <div class="modal fade" id="offer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelSaleLabel">Offer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

@endsection

@section('script')
    <script>

        function scrollDown()
        {
            $('.modal').modal('hide');
            $(document).scrollTop($(document).height());
        }

        $(document).ready(function () {

            $('.offer-modal').click(function () {
                @if (Auth::guest())
                   $('#offer .modal-body').html('<p>Thank you for your interest. We are currently in Alpha testing. If you are interested in joining when we go live, please add your email at the bottom of the home screen</p><button onclick="scrollDown()" class="btn btn-sm btn-theme float-right">OK</button>');
                   $('#offer').modal('show');
                @else
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
                @endif
            });

            $('.buy-now-modal').click(function () {
                @if (Auth::guest())
                   $('#cancelSale .modal-body').html('<p>Thank you for your interest. We are currently in Alpha testing. If you are interested in joining when we go live, please add your email at the bottom of the home screen</p><button onclick="scrollDown()" class="btn btn-sm btn-theme float-right">OK</button>');
                   $('#cancelSale').modal('show');
                @else
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
                @endif
            });

            $(document).on('click','#save-offer-request', function (e) {
                e.preventDefault();
                var form = $(document).find('#offer-form').serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('saveOfferRequest') }}",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    data:form,
                    success: function (response) {
                        if(response.status == true){
                            $('#offer').modal('hide');
                            Swal.fire(
                                'Submitted!',
                                'You offer request has been sent!',
                                'success'
                            ).then(function(){
                                    location.href = "{{ url('portfolio') }}"
                                }
                            );
                        }else{
                            toastr.error(response.message, 'Error', {timeOut: 5000});
                        }
                    },
                });
            });

            $(document).on('click','#save-buy-now-request', function (e) {
                e.preventDefault();
                var form = $(document).find('#buy-now-form').serialize();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('saveBuyNowRequest') }}",
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    data:form,
                    success: function (response) {
                        if(response.status == true){
                            $('#cancelSale').modal('hide');
                            Swal.fire(
                                'Submitted!',
                                'Your buy now request has been sent!',
                                'success'
                            ).then(function(){
                                    location.href = "{{ url('portfolio') }}"
                                }
                            );
                        }else{
                            toastr.error(response.message, 'Error', {timeOut: 5000});
                        }
                    },
                });
            });

            $('#listSearch').click(function () {
                var ventureData;
                $.each($("#venture_state option:selected"), function () {
                    ventureData=$(this).val();
                });
                var propertyType = ventureData;
                var priceRangeFrom = $('#ventureSearch input[name="price_range_from"]').val();
                var priceRangeTo = $('#ventureSearch input[name="price_range_to"]').val();
                var capRateFrom = $('#ventureSearch input[name="cap_rate_range_from"]').val();
                var capRateTo = $('#ventureSearch input[name="cap_rate_range_to"]').val();
                var otherOption = $('#ventureSearch input[name="other_option"]').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    /*
                     beforeSend: function () {
                     $('.register_now').html(loading + ' Processing').attr('disabled', 'disabled');
                     },*/
                    type: 'POST',
                    url: "{{ url('currentVentureSearch') }}",
                    data: {
                        'propertyType': propertyType,
                        'priceRangeFrom': priceRangeFrom,
                        'priceRangeTo': priceRangeTo,
                        'capRateFrom': capRateFrom,
                        'capRateTo': capRateTo,
                        'otherOption': otherOption

                    },
                    success: function (data) {
                        $(".ventureList").empty().html(data.view);
                    },
                });

            });
        });

    </script>
@endsection


