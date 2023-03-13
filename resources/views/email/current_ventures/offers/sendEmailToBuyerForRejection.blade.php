<!DOCTYPE html>
<html>
<head>
    <title>Offer for Venture {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : '' }}, Listing  ID {{ $venture->list_automated_id }} was declined by the seller</title>
</head>
<body>

<p>
Your offer for {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : '' }} Listing ID {{ $venture->list_automated_id }} has not been accepted. Your offer in the system has been cancelled. You are free to make another offer if you like.
</p>
@include('email.current_ventures.offers.footer')

{{-- <p>Dear {{ $user->name }},</p>
<p>Unfortunately your offer was declined by the seller for Venture {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : ''}}, Listing  ID {{ $venture->list_automated_id }}. If the venture is still listed, please feel free to offer again.</p>
<p>Thank you again and we wish you the best in your future ventures!</p> --}}


{{-- <p>Thank you!</p>
<p>Property Management Tool</p> --}}

</body>
</html>
