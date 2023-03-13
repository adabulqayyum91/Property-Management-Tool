<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
	Your buyer has completed the purchasing documents for your Listing  {{$venture->list_automated_id}}.  
</p>
<p>
	Please go to your portfolio page and sign the required documents. Once you have signed and funding is in escrow, we begin the closing process.	
</p>
<p>
	Your ownership will be transferred to the new owner and your account on file will be funded on the first business day of this next month.
</p>


@include('email.current_ventures.offers.footer')

</body>
</html>