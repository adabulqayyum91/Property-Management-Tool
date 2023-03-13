<!DOCTYPE html>
<html>
<head>
    <title>Document Signed Successfully.</title>
</head>
<body>
    <h2> Dear {{ $user->first_name }},</h2>
    <p>Thank you for completing your commitment. We will be pushing your committed funds over to an escrow account shortly. Once we have 100% commitment on the property you have just committed on, we will begin the negotiations and you will be notified once negotiations have been completed. If the seller accepts our offer, we will notify you and your status will change from “Negotiating” to “ Closing”.  In the “Closing” phase, we will complete the acquisition of your desired property. As soon as it is purchased, you will receive a notification from us. Please allow three business days to update your portfolio. Once we have updated your portfolio, the status on the property acquisition will change to “Closed”.</p>
    <p>We look forward to securing your interest.</p>
    <p>Please let us know if you have any questions.</p>

    @if(!is_null($document_hash))
    <a style="width: 200px;height: 35px;display: block;text-decoration: none;background-color: red;color: #fff;padding: 10px 10px 0;text-align: center;" download="Document PDF" href="https://api.eversign.com/api/download_final_document?access_key=c6b278b9311c03c2e2c724382c0f160a&business_id=153222&document_hash={{$document_hash}}">Get Signed Document</a>
    @endif
    <br>
    <b>Regards,</b><br>
    <b>Property Management Tool</b>

</body>
</html>
