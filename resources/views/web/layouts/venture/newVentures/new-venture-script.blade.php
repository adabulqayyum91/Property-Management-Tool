<script>
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