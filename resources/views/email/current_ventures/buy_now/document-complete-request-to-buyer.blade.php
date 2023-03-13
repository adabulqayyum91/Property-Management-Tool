<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
	Congratulations on your new purchase! If you have not done so, please sign the documents on your portfolio page as soon as possible. Ownership will transfer on the first business day of next month. Funds will be withdrawn shortly after you sign your documents and placed into an escrow account until funds are released to the seller on the first business day of this next month.
</p>

@include('email.current_ventures.offers.footer')

{{-- TODO: OLD TEXT For future use --}}
{{-- <h2> Dear {{ $user->name }},</h2>
<p>Thank you for your “Buy Now” offer on {{ $venture->venture->venture_name }} {{ $venture->list_automated_id }}. If you have not already, please click on the link below to sign your docs or you can go to your portfolio and click on the “sign docs” button. Once you have signed your required docs, we will move your funds into an escrow account. The funds will remain in escrow until the end of the month at which point, funds will be pushed to the seller and your account will reflect your new venture</p>
<p>As always, please let us know if you have any questions.</p>

<br>
<b>Regards,</b><br>
<b>Property Management Tool</b> --}}

</body>
</html>
