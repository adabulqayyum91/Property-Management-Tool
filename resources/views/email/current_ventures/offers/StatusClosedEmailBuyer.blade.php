<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
	Congratulations! Your transaction is complete and you are now the owner of {{$ownershipPercentage}}% of venture {{$venture->venture->venture_name}}. This change is now reflecting in your portfolio. 
</p>
@include('email.contact')

</body>
</html>