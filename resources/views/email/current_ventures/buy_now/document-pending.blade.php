<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
	Great news! You have a buyer for Listing {{$venture->list_automated_id}}.
	<br>
	The buyer still needs to sign their documents. Once they have signed them, we will notify you of your need to sign.
</p>

@include('email.current_ventures.offers.footer')

{{-- TODO: OLD TEXT For future use --}}
{{-- <p>Congratulations {{ $user->name }}! You have a buyer for {{ $venture->venture->venture_name }} {{ $venture->list_automated_id }} that you have listed for sale.</p>
<p>Please use this link and sign all required documentations or go to your portfolio and click on the link provided to sign your docs to process this transaction. Once both you and the buyer have submitted your signed documents, we will begin the closing process. The ownership will be transferred from you to the new owner on the 1st day of this coming month. Funds for the venture will be transferred to your account on that day as well.</p>
<p>Please let us know if you have any question.</p>

<br>
<b>Regards,</b><br>
<b>Property Management Tool</b> --}}

</body>
</html>
