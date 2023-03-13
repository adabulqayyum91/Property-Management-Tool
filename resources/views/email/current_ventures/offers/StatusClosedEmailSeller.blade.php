<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
	Congratulations! Your transaction is complete and we have transferred your ownership in venture {{$venture->venture->venture_name}}.  We have also transferred your funds to your account on file. This change is now reflecting in your portfolio. 
</p>
@include('email.contact')

</body>
</html>