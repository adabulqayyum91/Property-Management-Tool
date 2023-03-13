<!DOCTYPE html>
<html>
<head>
    <title>Offer for Venture {{$venture->venture->venture_name}}, Listing  ID {{$venture->list_automated_id}} was declined</title>
</head>
<body>
    <h2> Dear {{ $user->first_name }},</h2>
    <p>Declined, You have declined documents for {{ $venture->venture->venture_name }}, {{ $venture->list_automated_id}}</p>
    <br>
    <p>Please let us know if you have any questions.</p>

    <b>Regards,</b><br>
    <b>Property Management Tool</b>

</body>
</html>
