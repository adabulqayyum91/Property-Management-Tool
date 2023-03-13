<!DOCTYPE html>
<html>
<head>
    <title>Congratulations! You have an offer on Venture {{ $venture->venture->venture_name }}, Listing ID {{ $venture->list_automated_id }}.</title>
</head>
<body>

<p>Congratulations. You have an offer on Venture {{ $venture->venture->venture_name }}, Listing ID {{ $venture->list_automated_id }} . Please click this <a href="{{ url('portfolio') }}">Link</a> to review your offer. If you are happy with the offer, please accept it. We will generate the required documents and you can sign them inside the app under your portfolio.</p>
<p>If you have any questions, please contact us and we would be happy to assist.</p>


<br>
<b>Regards,</b><br>
<b>Property Management Tool</b>

</body>
</html>
