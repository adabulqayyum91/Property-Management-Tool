{{--
 * Created by PhpStorm.
 * User: zahra
 * Date: 4/26/2020
 * Time: 1:43 PM
 --}}
 @extends('web.layouts.partials.app')
 @section('page_title')
 Venture Commit List | Property Management Tool
 @endsection


 @section('content')

 <!-- Dashbord start -->
 <div class="dashboard">
    <div class="container-fluid">
        <div class="row">
            @include('web.layouts.partials.sideBar')
            <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                <div class="content-area5">
                    <div class="dashboard-content">
                        <div class="dashboard-header clearfix">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <h4>Portfolio</h4>
                                </div>

                            </div>
                        </div>
                        @include('web.layouts.venture.currentVentures.currentUserList')
                        <form method="POST" action="{{url('/search-pending-transactions')}}" id="search-pending-transaction">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="user_id" value="{{Auth::User()->id}}">
                                <div class="col-md-6">
                                    <label class="form-label">Created From:</label>
                                    <div class="form-group">
                                        <div class="datepicker0 date input-group p-0 shadow-sm">
                                            <input type="text" placeholder="Date"
                                            class="form-control box-shadow"
                                            name="from"
                                            {{-- value="{{$from}}"  --}}
                                            >
                                            <div class="input-group-append"><span
                                                class="input-group-text"><i
                                                class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Created To:</label>
                                    <div class="form-group">
                                        <div class="datepicker0 date input-group p-0 shadow-sm">
                                            <input type="text" placeholder="Date"
                                            class="form-control box-shadow"
                                            name="to"
                                            {{-- value="{{$to}}"  --}}
                                            >
                                            <div class="input-group-append"><span
                                                class="input-group-text"><i
                                                class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        {{--<input type="text" class="form-control box-shadow" placeholder="Date of Incorporation" name="date_of_incorporation" required>--}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-sm btn-theme float-right"
                                    value="Submit" style="margin-top:35px; border-radius: 50px;">
                                </div>
                            </div>
                        </form>
                        <div id="pending-transaction-block">
                            @include('web.layouts.portfolio.pendingTransactions')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashbord end -->

{{--<!-- Modal -->--}}

{{--<div id="container"></div>--}}

<div id="agreement-document" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 90%;">
        <!-- Modal content-->
        <div class="modal-content" style="max-width: 90%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="container" style="min-height: 680px;">
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="commitCancelConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to cancel commit?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary cancel-commit">Yes</button>
            </div>
        </div>
    </div>
</div>
@endsection
{{--</html>--}}



@section('script')
<script type="text/javascript" src="{{ url('js/document-embedding-api.js') }}"></script>

<script>
    $(document).ready(function(){
        $('.datepicker0').datepicker({
            format: 'mm/dd/yyyy'
        });
        // $('.sell-modal').click(function () {
        //     var venture_listing_id = $(this).attr('data-ventureList');
        //     $.ajax({
        //         type: 'GET',
        //         url: "{{ url('get-sell-modal') }}/"+venture_listing_id,
        //         headers: {
        //             'X-CSRF-Token': "{{csrf_token()}}"
        //         },
        //         success: function (response) {
        //             if(response.status == true){
        //                 $('#sell-modal .modal-body').html(response.data);
        //                 $('#sell-modal').modal('show');
        //             }else{
        //                 $('#sell-modal .modal-body').html('');
        //                 toastr.error(response.message, 'Error', {timeOut: 5000});
        //             }
        //         },
        //     });
        // });
        $('.sell-modal').click(function () {
            var ventureOwnershipId = $(this).attr('data-ventureOwnershipId');
            $.ajax({
                type: 'GET',
                url: "{{ url('get-sell-modal') }}/"+ventureOwnershipId,
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                success: function (response) {
                    if(response.status == true){
                        $('#sell-modal .modal-body').html(response.data);
                        $('#sell-modal').modal('show');
                    }else{
                        $('#sell-modal .modal-body').html('');
                        toastr.error(response.message, 'Error', {timeOut: 5000});
                    }
                },
            });
        });

        $('.cancelBtn').click(function () {
            var listingId = $(this).attr('data-listingId');
            $('input[name=listingId]').val( listingId );
        });
        $("#search-pending-transaction").submit(function(e){
            e.preventDefault();

            var url="{{ url('search-pending-transactions') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        $("#pending-transaction-block").empty().html(response.view);
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        toastr.error(item);
                    });
                }
            });
        });
        //******Delete Current Venture*****
        $("#newVentureDelete").submit(function(e){
            e.preventDefault();
            var listingID = $('input[name=listingId]').val();

            var url="{{ url('cancel-sell') }}/"+listingID;
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == true){
                        toastr.success(response.message);
                        // $("#ven-id").empty().html(response.view);
                        window.location.reload();
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function (key, item) {
                        toastr.error(item);
                    });
                }
            });
        });

        $('.cancel-sell').click(function () {
            var venture_listing_id = $(this).attr('data-ventureList');
            $.ajax({
                type: 'GET',
                url: "{{ url('cancel-sell-listing') }}/"+venture_listing_id,
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                success: function (response) {
                    if(response.status == true){
                        Swal.fire(
                            'Canceled!',
                            'Your venture listing cancelling selling ownership request has been submitted!',
                            'success'
                            ).then(function(){
                                location.reload();
                            }
                            );
                        }else{
                            toastr.error(response.message, 'Error', {timeOut: 5000});
                        }
                    },
                });
        });

        $('.listing-selling-detail').click(function () {
            var venture_listing_id = $(this).attr('data-ventureList');
            $.ajax({
                type: 'GET',
                url: "{{ url('sell-listing-detail') }}/"+venture_listing_id,
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                success: function (response) {
                    if(response.status == true){
                        $('#sell-detail-modal .modal-body').html(response.data);
                        $('#sell-detail-modal').modal('show');
                    }else{
                        $('#sell-detail-modal .modal-body').html('');
                        toastr.error(response.message, 'Error', {timeOut: 5000});
                    }
                },
            });
        });

        $(document).on('change','.ownership-percentage-dropdown',function () {
            if($(this).val() == 'other'){
                $('.toggle-other').show();
                $('.toggle-other input').prop('disabled', false);

            }else{
                $('.toggle-other').hide();
                $('.toggle-other input').prop('disabled', true);
            }
        });

        $(document).on('click','#save-selling-ownership-btn', function (e) {
            e.preventDefault();
            var form = $(document).find('#sell-request-form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('saveSellingOwnershipRequest') }}",
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                data:form,
                success: function (response) {
                    if(response.status == true){
                        $('#sell-modal').modal('hide');
                        Swal.fire(
                            'Submitted!',
                            'You will see your venture listing posted shortly.',
                            'success'
                            ).then(function(){
                                location.reload();
                            }
                            );
                        }else{
                            toastr.error(response.message, 'Error', {timeOut: 5000});
                        }
                    },
                });
        });

        $('.signer-document').click(function () {
            var $this = $(this);
            var commit_id = $this.data('id');
            var percentage_of_ownership = $this.data('percentage-of-ownership');
            var commited_amount = $this.data('commited-amount');
            var n_of_percentage_amount = $this.data('n-of-percentage-amount');
            var total_of_commited_amount = $this.data('total-of-commited-amount');
            var name = $this.data('name');
            var address = $this.data('address');
            $.ajax({
                type: 'POST',
                // url: "https://api.eversign.com/api/document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&type=completed",
                url: '{{url('eversign-api')}}',
                contentType: 'application/json',
                processData: false,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'X-CSRF-Token': "{{csrf_token()}}"

                },
                data:JSON.stringify({
                    "requester_email": "contact@gmail.com",
                    "internal_type":"Commit",
                    "template_id": "{{ Config::get('constants.COMMIT_REQUEST_TEMPLATE_ID_FROM_EVERSIGN') }}",
                    "embedded_signing_enabled":1,
                    "signers": [
                    {
                        "name": "{{ Auth::user()->first_name.' '.Auth::user()->last_name }}",
                        "email": "{{ Auth::user()->email }}",
                        "role": "Member",
                    },
                    ],
                    "fields": [
                    {
                        "identifier": "percent-of-venture_uV7yywT47xLNux",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "percent-of-venture_dfNpuBukAifo4M",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "committed-amount_BNFNLNyPRMeCFs",
                        "value": commited_amount,
                    },
                    {
                        "identifier": "35-of-committed-amount_U2PbqPxLT7kC0U",
                        "value": n_of_percentage_amount,
                    },
                    {
                        "identifier": "total-of-committed-35_eZPLqPHgADUrA7",
                        "value": total_of_commited_amount,
                    },
                    ///////////////////////////
                    // Address & Name Fields //
                    ///////////////////////////
                    {
                        "identifier": "company_9Q0fO79eXFlY41",
                        "value": name,
                    },
                    {
                        "identifier": "company_FkAlcNlPpkIL6u",
                        "value": name,
                    },
                    {
                        "identifier": "company_RWNWmLvvJy1fOy",
                        "value": name,
                    },
                    {
                        "identifier": "company_IVYlKTpNwpc2GA",
                        "value": name,
                    },
                    {
                        "identifier": "company_0zw4yL3Uwe6n8W",
                        "value": name,
                    },
                    {
                        "identifier": "company_pnmHW6UZp6ChPI",
                        "value": name,
                    },
                    {
                        "identifier": "address-of-property_icxq8Vf1OLgEjO",
                        "value": address,
                    },
                    ]
                }),
                beforeSend: function () {
                    $this.html('Loading <i class="fa fa-spinner fa-spin aria-hidden="true"></i>');
                },
                success: function (response) {
                    response = JSON.parse(response);

                    console.log(response);
                    var url = response.signers[0].embedded_signing_url;
                    var document_hash = response.document_hash;
                    $('.signer-document').html('Agreement Sign');
                    $('#agreement-document').modal('show');
                    getCommittmentIframe(url, commit_id, document_hash);
                },
            });
        });

$(document).on('click','.buy-now-signers-document-iframe', function () {
    var $this = $(this);
    var buy_now_id = $this.data('id');
    var url = $this.data('url');
    var user = $this.data('user');
    var email = $this.data('email');
    var status = $this.data('status');
    var document_hash = null;
    getBuyNowIframe(url, buy_now_id, document_hash, email, status);
    $('#agreement-document').modal('show');

});

$(document).on('click','.buy-now-signers-document', function () {
    var $this = $(this);
    var buy_now_id = $this.data('id');
    var user = $this.data('user');
    var status = $this.data('status');
    var percentage_of_ownership = $this.data('percentage-of-ownership');
    var total_amount = $this.data('total-amount');
    var n_of_percentage_amount = $this.data('n-of-percentage-amount');
    var total_of_total_amount = $this.data('total-of-total-amount');
    var name = $this.data('name');
    var address = $this.data('address');
    $.ajax({
        type: 'POST',
                // url: "https://api.eversign.com/api/document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&type=completed",
                url: '{{url('eversign-api')}}',
                contentType: 'application/json',
                processData: false,
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'X-CSRF-Token': "{{csrf_token()}}"
                },
                data:JSON.stringify({
                    {{--"requester_email": "contact@gmail.com",--}}
                    "template_id": "{{ Config::get('constants.BUY_NOW_REQUEST_TEMPLATE_ID_FROM_EVERSIGN') }}",
                    "internal_type":"Buy Now",
                    "embedded_signing_enabled":1,
                    "signers": [
                    {
                        "name": user.first_name+' '+user.last_name,
                        "email": user.email,
                        "role": "Seller",
                    },
                    {
                        "name": "{{ Auth::user()->first_name.' '.Auth::user()->last_name }}",
                        "email": "{{ Auth::user()->email }}",
                        "role": "Buyer",
                    },
                    ],
                    "fields": [
                    {
                        "identifier": "percent_ooAoIe7xKrpHB2",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "percent_Hn30Y6Ly5uTY5x",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "purchase-amount_ARBFqn5jnsyCzL",
                        "value": total_amount,
                    },
                    {
                        "identifier": "purchase-amount-x-35_DgF9N61hFvdUqX",
                        "value": n_of_percentage_amount,
                    },
                    {
                        "identifier": "purchase-amount-35_05dRVqWKdU4adL",
                        "value": total_of_total_amount,
                    },
                    {
                        "identifier": "percent_PP6AEu9WutWJ0E",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "percent_vvMSt1JtwLgGCQ",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "percent_tDaS88e4iNEGQS",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "percent_DSk5CcwsjEbqGJ",
                        "value": percentage_of_ownership,
                    },
                    {
                        "identifier": "purchase-amount_CY3VmLEbwTvOxk",
                        "value": total_amount,
                    },
                    {
                        "identifier": "purchase-amount_wK0o8EsehBG3jl",
                        "value": total_amount,
                    },
                    {
                        "identifier": "percent_ULGOwpF4WqZE3s",
                        "value": percentage_of_ownership,
                    },
                    ///////////////////////////
                    // Address & Name Fields //
                    ///////////////////////////
                    {
                        "identifier": "company_APSOyG1HYmEJWo",
                        "value": name,
                    },
                    {
                        "identifier": "company_sm4SHIo20UjXse",
                        "value": name,
                    },
                    {
                        "identifier": "company_P3jXkQ0dAPBKJC",
                        "value": name,
                    },
                    {
                        "identifier": "company_ayMFbvoKqVAOGD",
                        "value": name,
                    },
                    {
                        "identifier": "company_SfpxRnAqQ1hdWC",
                        "value": name,
                    },
                    {
                        "identifier": "company_63gHaANERrXJ2N",
                        "value": name,
                    },
                    {
                        "identifier": "company_sXpXGmTmpmpx75",
                        "value": name,
                    },
                    {
                        "identifier": "address-of-property_Ar3N28UgQbpPHY",
                        "value": address,
                    },
                    ]
                }),
beforeSend: function () {
    $this.html('Loading <i class="fa fa-spinner fa-spin aria-hidden="true"></i>');
},
success: function (response) {
    response = JSON.parse(response);
    var buyerSigningUrl = response.signers[0] ? response.signers[0].embedded_signing_url : null;
    var sellerSigningUrl = response.signers[1] ? response.signers[1].embedded_signing_url : null;
    var document_hash = response.document_hash;
    $this.attr('data-url', buyerSigningUrl).removeClass('buy-now-signers-document').addClass('buy-now-signers-document-iframe');
    UpdateBuyNowDocumentsUrlsInDB(buy_now_id, buyerSigningUrl, sellerSigningUrl, document_hash);

    $this.html('Agreement Sign');
    $('#agreement-document').modal('show');
    getBuyNowIframe(buyerSigningUrl, buy_now_id, document_hash, 'false', status);
},
});
});


$(document).on('click','.offer-review', function () {
    var offer = $(this).data('offer');
    var offerpercent = $(this).data('offerpercent');
    var offer_id = offer.id;

    var html = '<table class="offer-popup-table">';
    html += '<tr><th>Listing ID</th><th>Amount $</th><th>% of the total venture</th></tr>';
    html += '<tr><td>'+offer.venture_listing.list_automated_id+'</td>';
    html += '<td>'+offer.amount+'</td>';
    html += '<td>'+offerpercent+'</td>';
    html += '</tr></table>';


    Swal.fire({
        title: '<u>Would you like to accept this offer?</u>',
        html: html,
        icon: 'info',
        showCancelButton: true,
//                confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: '<i class="fa fa-thumbs-up"></i> Accept',
cancelButtonText: '<i class="fa fa-thumbs-down"></i> Reject',
}).then((result) => {
    if (result.value) {
        saveOfferResponse("{{Config::get('constants.VENTURE_OFFER_STATUS')[1]}}", offer_id)
    }else if (result.dismiss === Swal.DismissReason.cancel) {
        saveOfferResponse("{{Config::get('constants.VENTURE_OFFER_STATUS')[2]}}", offer_id)
    }
})
});

$(document).on('click','.offer-signers-document-iframe', function () {
    var $this = $(this);
    var offer_id = $this.data('id');
    var url = $this.data('url');
    var user = $this.data('user');
    var email = $this.data('email');
    var status = $this.data('status');
    var document_hash = null;
    getOfferIframe(url, offer_id, document_hash, status );
    $('#agreement-document').modal('show');

});

$(document).on('click','.offer-signers-document', function () {
    var $this = $(this);
    var offer_id = $this.data('id');
    var user = $this.data('user');
    var status = $this.data('status');
    var percentage_of_ownership = $this.data('percentage-of-ownership');
    var total_amount = $this.data('total-amount');
    var n_of_percentage_amount = $this.data('n-of-percentage-amount');
    var total_of_total_amount = $this.data('total-of-total-amount');
    var name = $this.data('name');
    var address = $this.data('address');
    $.ajax({
        type: 'POST',
                    // url: "https://api.eversign.com/api/document?access_key=64d93fee391111089f3b33e2e0b98922&business_id=153222&type=completed",
                    url: '{{url('eversign-api')}}',
                    contentType: 'application/json',
                    processData: false,
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'X-CSRF-Token': "{{csrf_token()}}"
                    },
                    data:JSON.stringify({
                        {{--"requester_email": "contact@gmail.com",--}}
                        "template_id": "{{Config::get('constants.OFFER_REQUEST_TEMPLATE_ID_FROM_EVERSIGN')}}",
                        "internal_type":"Offer",
                        "embedded_signing_enabled":1,
                        "signers": [
                        {
                            "name": user.first_name+' '+user.last_name,
                            "email": user.email,
                            "role": "Buyer",
                        },
                        {
                            "name": "{{ Auth::user()->first_name.' '.Auth::user()->last_name }}",
                            "email": "{{ Auth::user()->email }}",
                            "role": "Seller",
                        },
                        ],
                        "fields": [
                        {
                            "identifier": "percent_su3eO0v5V329RL",
                            "value": percentage_of_ownership,
                        },
                        {
                            "identifier": "percent_3NAx5tBbisjx9v",
                            "value": percentage_of_ownership,
                        },
                        {
                            "identifier": "amount_9QKtwvB9P8WdWy",
                            "value": total_amount,
                        },
                        {
                            "identifier": "amount-x-35_ztvTRQ4DEfHyiK",
                            "value": n_of_percentage_amount,
                        },
                        {
                            "identifier": "amount-35_3PavSeb9dTNdz9",
                            "value": total_of_total_amount,
                        },
                        {
                            "identifier": "percent_y4NBc3FNgZmVmL",
                            "value": percentage_of_ownership,
                        },
                        {
                            "identifier": "percent_3AtoNHkqMpTgZX",
                            "value": percentage_of_ownership,
                        },
                        {
                            "identifier": "percent_vV15Dg4OQuOoJq",
                            "value": percentage_of_ownership,
                        },
                        {
                            "identifier": "percent_FoUQNPwdggMZMF",
                            "value": percentage_of_ownership,
                        },
                        {
                            "identifier": "purchase-amount_mTyCXIlRl0WHFn",
                            "value": total_amount,
                        },
                        {
                            "identifier": "purchase-amount_cUO6moO0NpO6h1",
                            "value": total_amount,
                        },
                        {
                            "identifier": "percent_YlxhHXnfjfoztU",
                            "value": percentage_of_ownership,
                        },
                        ///////////////////////////
                        // Address & Name Fields //
                        ///////////////////////////
                        {
                            "identifier": "company_RAk7QCXXfJyjfE",
                            "value": name,
                        },
                        {
                            "identifier": "company_zijmIe0stbaIMg",
                            "value": name,
                        },
                        {
                            "identifier": "company_RIWWhMkoOwbeko",
                            "value": name,
                        },
                        {
                            "identifier": "company_2c9oRIqYugkG02",
                            "value": name,
                        },
                        {
                            "identifier": "company_O8X50PqoAQm4Np",
                            "value": name,
                        },
                        {
                            "identifier": "company_aVLbrbxmtuBI6R",
                            "value": name,
                        },
                        {
                            "identifier": "company_GIYarUFuMtZ2Rs",
                            "value": name,
                        },
                        {
                            "identifier": "address-of-property_g3kYaxJCo6siGE",
                            "value": address,
                        },

                        ]
                    }),
beforeSend: function () {
    $this.html('Loading <i class="fa fa-spinner fa-spin aria-hidden="true"></i>');
},
success: function (response) {
    response = JSON.parse(response);
    console.log(response);

    var buyerSigningUrl = response.signers[1] ? response.signers[1].embedded_signing_url : null;
    var sellerSigningUrl = response.signers[0] ? response.signers[0].embedded_signing_url : null;
    var document_hash = response.document_hash;
    $this.attr('data-url', buyerSigningUrl).removeClass('buy-now-signers-document').addClass('buy-now-signers-document-iframe');
    UpdateOfferDocumentsUrlsInDB(offer_id, buyerSigningUrl, sellerSigningUrl, document_hash);

    $this.html('Agreement Sign');
    $('#agreement-document').modal('show');
    getOfferIframe(sellerSigningUrl, offer_id, document_hash, status);
},
});
});
});

function saveOfferResponse(status, offer_id) {
    $.ajax({
        type: 'GET',
        url: "{{ url('send-venture-offers-emails') }}",
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        data:{offer_id:offer_id,status:status},
        success: function (response) {
            Swal.fire(
                'Response!',
                response.message,
                'info'
                ).then(function(){
                    location.reload();
                }
                );

            },
        });
}

function UpdateBuyNowDocumentsUrlsInDB(buy_now_id, buyerSigningUrl, sellerSigningUrl, document_hash){
    $.ajax({
        type: 'POST',
        url: "{{ url('update-buy-now-request-signers-url') }}/"+buy_now_id,
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        data:{buyerSigningUrl:buyerSigningUrl,sellerSigningUrl:sellerSigningUrl, document_hash:document_hash },
        success: function (response) {
            console.log(response);
        },
    });
}

function UpdateOfferDocumentsUrlsInDB(offer_id, buyerSigningUrl, sellerSigningUrl, document_hash){
    $.ajax({
        type: 'POST',
        url: "{{ url('update-offer-request-signers-url') }}/"+offer_id,
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        data:{buyerSigningUrl:buyerSigningUrl,sellerSigningUrl:sellerSigningUrl, document_hash:document_hash },
        success: function (response) {
            console.log(response);
        },
    });
}

function getCommittmentIframe(url, commit_id, document_hash) {
    $('#agreement-document.modal #container').empty();
    eversign.open({
        url: url,
        containerID: "container",
        width: 1000,
        height: 680,
        events: {
            loaded: function () {
                console.log("loaded Callback");
            },
            signed: function () {
                sendCommittmentEmails('success', commit_id, document_hash);
                $('#agreement-document').modal('hide');
                console.log("signed Callback");
            },
            declined: function () {
                sendCommittmentEmails('declined', commit_id, document_hash);
                $('#agreement-document').modal('hide');
                console.log("declined Callback");
            },
            error: function () {
                console.log("error Callback");
            }
        }
    });
}

function getOfferIframe(url, offer_id, document_hash, status) {
    $('#agreement-document.modal #container').empty();
    eversign.open({
        url: url,
        containerID: "container",
        width: 1000,
        height: 680,
        events: {
            loaded: function () {
                console.log("loaded Callback");
            },
            signed: function () {
                sendOffersEmails('success', offer_id, document_hash, status);
                $('#agreement-document').modal('hide');
                console.log("signed Callback");
            },
            declined: function () {
                sendOffersEmails('declined', offer_id, document_hash, status);
                $('#agreement-document').modal('hide');
                console.log("declined Callback");
            },
            error: function () {
                console.log("error Callback");
            }
        }
    });
}

function getBuyNowIframe(url, buy_now_id, document_hash, sendEmails, status) {
    $('#agreement-document.modal #container').empty();
    eversign.open({
        url: url,
        containerID: "container",
        width: 1000,
        height: 680,
        events: {
            loaded: function () {
                console.log("loaded Callback");
            },
            signed: function () {
                sendBuyNowEmails('success', buy_now_id, document_hash, sendEmails, status);
                $('#agreement-document').modal('hide');
                console.log("signed Callback");
            },
            declined: function () {
                sendBuyNowEmails('declined', buy_now_id, document_hash, 'true', status);
                $('#agreement-document').modal('hide');
                console.log("declined Callback");
            },
            error: function () {
                console.log("error Callback");
            }
        }
    });
}

function sendCommittmentEmails(type, commit_id, document_hash) {
    $.ajax({
        type: 'GET',
        url: "{{ url('send-venture-commit-emails') }}",
        data:{commit_id:commit_id, type:type, document_hash:document_hash},
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        success: function (response) {
            if(response.status == true){
                Swal.fire(
                    'Success!',
                    response.message,
                    'success'
                    ).then(function(){
                        location.reload();
                    }
                    );
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
        });
}

function sendBuyNowEmails(type, buy_now_id, document_hash, sendEmails, status) {
    $.ajax({
        type: 'GET',
        url: "{{ url('send-venture-buy-now-emails') }}",
        data:{buy_now_id:buy_now_id, type:type, document_hash:document_hash, sendEmails: sendEmails, status:status},
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        success: function (response) {
            if(response.status == true){
                Swal.fire(
                    'Success!',
                    response.message,
                    'success'
                    ).then(function(){
                        location.reload();
                    }
                    );
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
        });
}

function sendOffersEmails(type, offer_id, document_hash, status) {
    $.ajax({
        type: 'GET',
        url: "{{ url('send-venture-offers-emails') }}",
        data:{offer_id:offer_id, type:type, document_hash:document_hash, status:status},
        headers: {
            'X-CSRF-Token': "{{csrf_token()}}"
        },
        success: function (response) {
            if(response.status == true){
                Swal.fire(
                    'Success!',
                    response.message,
                    'success'
                    ).then(function(){
                        location.reload();
                    }
                    );
                }else{
                    toastr.error(response.message, 'Error', {timeOut: 5000});
                }
            },
        });
}
var commitId;
$("#cancelCommit").click(function (){
    var $this = $(this);
    commitId =  $this.data('id');
});

$('.cancel-commit').click(function () {

    var $this = $(this);
    var commit_id = commitId;

    $.ajax({
        type: 'POST',
        url: "{{ url('cancelCommit') }}",
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}"
        },
        contentType: 'application/json',
        processData: false,
        data: commit_id,
        beforeSend: function () {
            $this.html('Loading <i class="fa fa-spinner fa-spin aria-hidden="true"></i>');
        },
        success: function (response) {
            location.reload();
        },
    });
});

function saleCanceled(){
    $("#cancelSale").hide();
    $("#canceledSale").modal();
}
</script>
@endsection
{{--</html>--}}
