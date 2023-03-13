<!DOCTYPE html>
<html>
<head>
    <title>Closing on {{ $venture->venture->venture_name }}, {{ $venture->list_automated_id }}.</title>
</head>
<body>
    <h2> Dear {{ $user->first_name }},</h2>
    <p>We are pleased to announce that documentation has been signed.</p>
    <p>You can view these documents by clicking below.</p>
    <p>
        We will be initiating the payment process shortly. Funds will remain in escrow until the end of this month at which time, we will initiate the payment of the venture to the seller and the venture ownership will transfer to the buyer.
    </p>
    @if(!is_null($document_hash))
    <a style="width: 200px;height: 35px;display: block;text-decoration: none;background-color: red;color: #fff;padding: 10px 10px 0;text-align: center;" download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=c6b278b9311c03c2e2c724382c0f160a&business_id=153222&document_hash={{$document_hash}}">Get Signed Document</a>
    @endif

    <p>Thank you for your time and please let us know if you have any questions. </p>
    <br>
    <b>Regards,</b><br>
    <b>Property Management Tool</b>

</body>
</html>
