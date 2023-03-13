
{{--/**
 * Created by PhpStorm.
 * User: zahra
 * Date: 4/6/2020
 * Time: 4:10 PM
 */--}}
@extends('web.layouts.partials.app')
@section('page_title')
    Home | Property Management Tool
@endsection


@section('content')

    <body>



    <!-- Sub banner start -->
    {{-- TODO: For future use --}}
    {{-- <div class="sub-banner overview-bgi">
        <div class="container">
            <div class="breadcrumb-area">
                <h1>Ventures</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{url('/home')}}">Home</a></li>
                    <li class="active">New Ventures Listing</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <br><br>
    <!-- Sub Banner end -->
    <div class="blog content-area-3" style="margin-bottom: -4%;">
        <div class="container">
            <!-- Main title -->
            <div class="main-title">
                <h1>New Ventures Listing</h1>
            </div>
          @include('web.layouts.venture.newVentures.partials.feature')

        </div>
    </div>

    <!-- Properties section body start -->
    <div class="properties-section-body content-area" style="margin-top: 5%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <!-- Option bar start -->
                    <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
                        <h4 style="text-align: center;margin-top: 2%;">New Venture Listing Search</h4>
                        <br>
                        <div class="row" id="ventureSearch">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                        <label>Price Range From</label>
                                        <input class="form-control" name="price_range_from" type="number" placeholder="$">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Price Range To</label>
                                    <input name="price_range_to" class="form-control" type="number" placeholder="$">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                        <label>CAP % Rate Range From</label>
                                        <input name="cap_rate_range_from" class="form-control" type="number" placeholder="%">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                <label>CAP % Rate Range To</label>
                                <input name="cap_rate_range_to" class="form-control" type="number" placeholder="%">
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
                        @include('web.layouts.venture.newVentures.partials.venture_row')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

{{--    @include('web.layouts.venture.newVentures.partials.commit_popup')--}}
    <!-- Modal buy now-->
    <div class="modal fade commit-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelSaleLabel">Commit</h5>
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
    </body>
@endsection
@section('script')
    {{--<script type="text/javascript" src="https://static.eversign.com/js/embedded-signing.js"></script>--}}

    <script>
//        eversign.open({
//            url: "https://api.eversign.com/api/document?access_key=c6b278b9311c03c2e2c724382c0f160a&business_id=153222&document_hash=j6yMcaF2gQAIIQ",
//            containerID: "container",
//            width: 600,
//            height: 600,
//            events: {
//                loaded: function () {
//                    console.log("loaded Callback");
//                },
//                signed: function () {
//                    console.log("signed Callback");
//                },
//                declined: function () {
//                    console.log("declined Callback");
//                },
//                error: function () {
//                    console.log("error Callback");
//                }
//            }
//        });


        function scrollDown()
        {
            $('.modal').modal('hide');
            $(document).scrollTop($(document).height());
        }

        $(document).ready(function () {

            $('.commit-button').click(function () {

                @if (Auth::guest())
                   $('.commit-popup .modal-body').html('<p>Thank you for your interest. We are currently in Alpha testing. If you are interested in joining when we go live, please add your email at the bottom of the home screen</p><button onclick="scrollDown()" class="btn btn-sm btn-theme float-right">OK</button>');
                   $('.commit-popup').modal('show');
                @else
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
                @endif
            });
            //****Swal button****
            function  handleResponse(message) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-warning'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Success',
                    text: message,
                    icon: 'success',
                    allowOutsideClick: false,
                    confirmButtonText: 'Continue',
                    reverseButtons: true
                }).then(function(){
                        location.href = "{{ url('portfolio') }}"
                    }
                );
            }

            //****Save Commits****

                $(document).on('click','#save-commit-button', function (e) {
                    e.preventDefault();
                var commit_amount = parseInt($("#commit_amount").val());
                    var form = $(document).find('#commit-form').serialize();
                    var loading = '<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>';
                if(isNaN(commit_amount)){
                    toastr.error('Please Enter Commit amount', 'Error', {timeOut: 5000});
                    return false;
                }
                $(this).html(loading + ' Processing').attr('disabled', 'disabled');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ url('ventureCommit') }}",
                    data:form,
                    success: function (data) {
                        if(data.status == true){
                            $('#save-commit-button').html('Submit').removeAttr('disabled');
                            $('.commit-popup').modal('hide');

                            handleResponse(data.message);

                        }else{
                            toastr.error(data.message, 'Error', {timeOut: 5000});
                            $('#save-commit-button').html('Submit').removeAttr('disabled');
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function (key, item) {
                            toastr.error(item);
                        });
                        $('#save-commit-button').html('Submit').removeAttr('disabled');
                    }
                });
            });

//            ventureSearch method
            $('.commit-button').click(function () {
                $('.v_venture_name').val($(this).attr('data-venture-name'));
                $('.v_first_name').val($(this).attr('data-first-name'));
                $('.v_last_name').val($(this).attr('data-last-name'));
                $('.v_list_id').val($(this).attr('data-list-id'));
                $('.v_email').val($(this).attr('data-email'));
                $('.v_amount').val($(this).attr('data-venture-amount'));
                $('.v_new_venture_list').val($(this).attr('data-new-venture-id'));

//               $('.commit-popup').show();
                $('.commit-popup').modal('show');

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
                    url: "{{ url('ventureSearch') }}",
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

            $('.customInstaIcn').css('color', 'grey');

            $(".customInstaIcn").hover(function () {
                $(this).css("color", "mediumvioletred")
            }).mouseout(function () {
                $(this).css({"color": "grey",});
            });
        })
        function typCheck(e) {
            let id = e.id;
            var lastChar = id[id.length - 1];

            for (let i = 1; i <= 3; i++) {
                if (i == lastChar) {
                    continue
                }
                else {
                    $('#checkbox' + i).attr('checked', false)
                }
            }
        }


    </script>
@endsection
