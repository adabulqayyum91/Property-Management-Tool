<!DOCTYPE html>
<html>
<head>
</head>
<body>

<p>
Congratulations on selling  {{ !is_null($venture) && !is_null($venture->venture) ? $venture->venture->venture_name : '' }} Listing ID {{ $venture->list_automated_id }}. If you have not done so, please be sure to sign your documents as soon as possible. Please note that ownership will transfer on the first business day of next month. At that time, funds will also be deposited into your account.

</p>
@include('email.current_ventures.offers.footer')

</body>
</html>