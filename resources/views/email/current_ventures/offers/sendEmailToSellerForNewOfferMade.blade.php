<!DOCTYPE html>
<html>
<head>
    <title>Great news! Someone has offered on {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : ''}}, Listing  ID {{ $venture->list_automated_id }}!</title>
</head>
<body>

<p>
	Great news! Someone has offered on {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : ''}} Listing {{ $venture->list_automated_id }}.
</p>
<p>
Go to your portfolio under “Offers made for your ventures” and review as soon as possible. If you don’t respond within 48 hours, the system will automatically cancel this offer.
</p>
<p>
	If you are not interested, reject the offer. If the offer is acceptable, please accept and the system will generate the paperwork for you to sign and the documents will then be sent to the member who has offered for their final signatures.
</p>
@include('email.current_ventures.offers.footer')

{{-- TODO: Old Text For future sue --}}
{{-- <p>Congratulations! Please click this link to review your offer. If you are happy with the offer, please accept it. We will generate the required documents and you can sign them inside the app under your portfolio.</p>
<p>Please let us know if you have any questions.</p>
<p>Thank you!</p>
<p>Property Management Tool</p> --}}

</body>
</html>
