<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
Congratulations! Your offer for {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : '' }} Listing ID {{ $venture->list_automated_id }} has been accepted! Please be sure to sign documentation as soon as possible located in your portfolio page under pending transactions. Ownership will transfer on the first business day of next month. Funds will be withdrawn shortly after you sign your documents and placed into an escrow account and ownership transferred to you on the first business day of this next month. 
</p>
@include('email.current_ventures.offers.footer')

</body>
</html>