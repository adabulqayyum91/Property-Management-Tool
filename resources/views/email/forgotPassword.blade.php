<!DOCTYPE html>
<html>
<head>
    <title>Welcome {{$user['first_name']}}  {{$user['last_name']}}</title>
</head>
<body>
<p>

You are receiving this email because we received a password reset request for your account.
Please click on the below Button<br/>
<a href="{{url('password/reset/', $user->token)}}">Verify Email</a></body>
</html>