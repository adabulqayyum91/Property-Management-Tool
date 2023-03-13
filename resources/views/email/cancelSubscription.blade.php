<!DOCTYPE html>
<html>

<head>
    <title>Welcome Email</title>
</head>

<body>
    <h4>User ({{$user->name}}) has sent a account deletion request.</h4>
    <strong>Reason:</strong><br>
    <p>
        {{ $reason }}
    </p>    
    
</body>

</html>