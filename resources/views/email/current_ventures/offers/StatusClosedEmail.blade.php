<!DOCTYPE html>
<html>
<head>
    <title>Transaction for Venture {{$venture->venture->venture_name}}, Listing  ID {{$venture->list_automated_id}}  has been completed</title>
</head>
<body>
    <h2> Dear {{ $user->first_name }},</h2>
    <p>We are happy to report that the transaction for Venture {{$venture->venture->venture_name}}, Listing  ID {{$venture->list_automated_id}} has been completed. Please let us know if you have any questions. </p>
    <br>
    <b>Happy Venturing!</b><br>
    <b>Regards,</b>
    <b>Property Management Tool</b>

</body>
</html>
