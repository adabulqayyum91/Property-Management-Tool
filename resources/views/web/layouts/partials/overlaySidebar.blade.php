<div id="mySidenav" class="sidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	{{-- TODO: For future reference --}}
	{{-- <a href="{{url('dashboard')}}">Dashboard </a> --}}
	<a href="{{url('portfolio')}}">Portfolio </a>
	<a href="{{url('profiles')}}">Profile </a>
	{{--<a href="{{url('current-venture-listings-offers')}}"><i class="fa fa-address-book"></i>Offers </a>--}}
	{{--<a href="{{url('current-venture-listings-buy-now')}}"><i class="fa fa-address-book"></i>Buy Now </a>--}}
	<a href="{{url('refer-friends')}}">Referral Friend List</a>
	<a href="{{url('/communication')}}">Communication <span class="notification-icon">{{Helper::unreadMessageCounter()}}</span></a>
	<a href="{{url('/survey')}}">Survey <span class="notification-icon">{{Helper::unfilledSurveyCounter()}}</span></a>
	<a href="{{url('transaction-hisotry')}}">Transaction History</a>
</div>