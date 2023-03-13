<!DOCTYPE html>
<html>
<head>
    <title>Buy Now Transaction Report.</title>
</head>
<body>

<p>Admin: Please see the below attachment.</p>
<p>This report generated at {{ date('d-m-Y h:i A') }}</p>
{{$path}}
<br>

@if(!is_null($path))
    <a style="width: 200px;height: 35px;display: block;text-decoration: none;background-color: red;color: #fff;padding: 10px 10px 0;text-align: center;" download="Document File" href="{{$path}}">Download File</a>
@endif
<br>
<b>Regards,</b><br>
<b>Property Management Tool</b>

</body>
</html>
