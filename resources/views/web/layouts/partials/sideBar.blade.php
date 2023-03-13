<div class="col-lg-2 col-md-12 col-sm-12 col-pad">
    <div class="dashboard-nav d-none d-xl-block d-lg-block">
        <div class="dashboard-inner">
            <h4>Main</h4>
            <ul>
                {{-- TODO: For future reference --}}
                {{-- <li><a href="{{url('dashboard')}}"><i class="fa fa-image"></i> Dashboard </a></li> --}}
                <li><a href="{{url('portfolio')}}"><i class="fa fa-file"></i>Portfolio </a></li>
                <li><a href="{{url('profiles')}}"><i class="fa fa-address-book"></i>Profile </a></li>
                {{--<li><a href="{{url('current-venture-listings-offers')}}"><i class="fa fa-address-book"></i>Offers </a></li>--}}
                {{--<li><a href="{{url('current-venture-listings-buy-now')}}"><i class="fa fa-address-book"></i>Buy Now </a></li>--}}
                <li><a href="{{url('refer-friends')}}"><i class="fa fa-users"></i>Referral Friend List</a></li>
                <li><a href="{{url('/communication')}}"><i class="fa fa-users"></i>Communication <span class="notification-icon">{{Helper::unreadMessageCounter()}}</span></a></li>
                <li><a href="{{url('/survey')}}"><i class="fa fa-file"></i>Survey <span class="notification-icon">{{Helper::unfilledSurveyCounter()}}</span></a></li>
                <li><a href="{{url('transaction-hisotry')}}"><i class="fa fa-file"></i>Transaction History</a></li>

            </ul>
        </div>
    </div>
</div>