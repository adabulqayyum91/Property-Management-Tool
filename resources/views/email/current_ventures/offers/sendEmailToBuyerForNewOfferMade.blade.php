<!DOCTYPE html>
<html>
<head>
    <title>
    	You have offered on Listing ID {{ $venture->list_automated_id }}.
    </title>
</head>
<body>

<p>You have offered on Listing ID {{ $venture->list_automated_id }} for a  {{Helper::percentageOwnershipForSell($venture->ownership_id,($venture->percentage_of_ownership*($offer->seller_ownership/100)))}}% ownership in the total venture.</p>
<p>
The seller has 48 hours to respond. If the seller does not respond within 48 hours, the system will automatically cancel your offer and you are free to offer again if you would like.
</p>
@include('email.current_ventures.offers.footer')
{{-- <p>
	If you have any questions, please contact Property Management Tool at <u style="color:blue">contact@gmail.com</u> and we will get back to you as soon as possible.
	<br>
	Property Management Tool
</p>
<p>
	<b>Deadlines for Current Venture Transactions:</b><br>
	Please note that any transaction that occurs after the 23rd of the month may not complete until the 1st day of the following month due to the money transfer process. We will do our best to expedite transactions, but there are no guarantees.
</p> --}}

{{-- TODO: Old Text For future sue --}}
{{-- <p>Congratulations. You have made an offer on Venture {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : '' }}, Listing  ID {{ $venture->list_automated_id }}. Once the seller reviews your offer and responds, we will notify you. They have 3 business days to make a decision.</p>
<p>If you have any questions, please contact us and we would be happy to assist.</p>
<p>Thank you!</p>
<p>Property Management Tool</p> --}}

</body>
</html>
