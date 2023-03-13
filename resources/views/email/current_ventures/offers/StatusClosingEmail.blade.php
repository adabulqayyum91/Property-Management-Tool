<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
	This transaction for Listing ID {{$venture->list_automated_id}} is in closing status. On the first business day of this coming month, the venture will move from the seller's portfolio to the buyer's portfolio and the buyers money will be moved from escrow into the seller's account
</p>
@include('email.contact')

</body>
</html>