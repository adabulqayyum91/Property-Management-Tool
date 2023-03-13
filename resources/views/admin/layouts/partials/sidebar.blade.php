<div class="col-lg-2 col-md-12 col-sm-12 col-pad">
    <div class="dashboard-nav d-none d-xl-block d-lg-block">
        <div class="dashboard-inner">
            <h4>Main</h4>
            <ul>
                <li hidden><a href="currentVentures.html"><i class="fa fa-users"></i>Ventures</a></li>
                <li class="{{ (request()->is('admin/home')) || (request()->is('admin')) ? 'active' : '' }}">
                    <a href="{{ url('admin/home')}}"><i class="fa fa-dashboard"></i>
                        Dashboard
                    </a>
                </li>
                <li hidden><a href="portfolio.html"><i class="fa fa-image"></i>Portfolio</a></li>
                <li hidden><a href="documents.html"><i class="fa fa-file"></i>Documents</a></li>
                <li hidden><a href="contact.html"><i class="fa fa-envelope"></i>Contact</a></li>

                <li  class="{{ (request()->is('admin/plans') ? 'active' : '' || request()->is('admin/plans/create')) ? 'active' : '' }}">
                    <a style="color: #c5c5c5;" data-toggle="collapse" data-target="#demoCms-outer">
                        <i class="fa fa-home"></i>CMS
                    </a>
                    <div id="demoCms-outer" style="background-color: #5a5858;color: black;" class="collapse">

                    <a href="{{url('admin/sliders')}}"><i class="fa fa-sliders" aria-hidden="true"></i>Slider</a>

                    <a href="{{url('admin/videos')}}"><i class="fa fa-video-camera"></i>Video</a>

                <a href="{{url('admin/faqs')}}"><i class="fa fa-question-circle" aria-hidden="true"></i>FAQS</a>
                <a href="{{url('admin/pages/create')}}"><i class="fa fa-plus"></i>Add Page</a>
                        <a href="{{url('admin/pages')}}"><i class="fa fa-eye"></i>View Pages</a>
                        {{--<a href="{{url('admin/referrals/create')}}"><i class="fa fa-plus"></i>Add Referral</a>
                        <a href="{{url('admin/referrals')}}"><i class="fa fa-eye"></i>View Referral</a>--}}
                        <a href="{{url('admin/follows/create')}}"><i class="fa fa-plus"></i>Add Follow</a>
                        <a href="{{url('admin/follows')}}"><i class="fa fa-eye"></i>View Follow</a>
                    </div>
                </li>

                <li >
                    <a style="color: #c5c5c5;" data-toggle="collapse" data-target="#demoUsers-outer">
                        <i class="fa fa-home"></i>Users


                    </a>
                    <div id="demoUsers-outer" style="background-color: #5a5858;color: black;" class="collapse">
                        <a href="{{url('admin/plans/create')}}"><i class="fa fa-plus"></i>Add Plan</a>
                        <a href="{{url('admin/plans')}}"><i class="fa fa-eye"></i>View Plans</a>

                        <a href="{{url('admin/users')}}"><i class="fa fa-users" aria-hidden="true"></i>Users</a>                      
               <a href="{{url('admin/billing-info')}}"><i class="fa fa-users" aria-hidden="true"></i>Billing Detail</a>

                <a href="{{url('admin/refer-friend')}}"><i class="fa fa-address-book "></i>Refer A Friend List</a>


                    </div>
                </li>

                <li class="{{ (request()->is('admin/ventures') ? 'active' : '' || request()->is('admin/ventures/create')) ? 'active' : '' }}">
                    <a style="color: #c5c5c5;" data-toggle="collapse" data-target="#ventures-outer">
                        <i class="fa fa-money" aria-hidden="true"></i>Ventures <span class="notification-icon">{{Helper::allFundingCount()}}</span>
                    </a>
                    <div id="ventures-outer" style="background-color: #5a5858;color: black;" class="collapse">
                        <a href="{{url('admin/ventures/create')}}"><i class="fa fa-plus"></i>Add Venture</a>
                        <a href="{{url('admin/ventures')}}"><i class="fa fa-eye"></i>View Ventures</a>
                        <a href="{{url('admin/new-venture-listing')}}"><i class="fa fa-users" aria-hidden="true"></i> New Venture Listing <span class="notification-icon">{{Helper::commitFundingCount()}}</span></a>
                          <a href="{{url('admin/current-venture-listing')}}"><i class="fa fa-users" aria-hidden="true"></i> Current Venture Listing</a>
                          <a href="{{url('admin/venture-listing/buy-now')}}"><i class="fa fa-users" aria-hidden="true"></i> Venture Buy Now <span class="notification-icon">{{Helper::buyNowFundingCount()}}</span></a>
                          <a href="{{url('admin/venture-listing/offer')}}"><i class="fa fa-users" aria-hidden="true"></i> Venture Offer <span class="notification-icon">{{Helper::offerFundingCount()}}</span></a>
                          <a href="{{url('admin/selling-ownership-listing')}}"><i class="fa fa-users" aria-hidden="true"></i> Selling Ownership Request</a>

                    </div>
                </li>

                <li class="{{ (request()->is('admin/imports') ? 'active' : '' || request()->is('admin/imports')) ? 'active' : '' }}">
                    <a style="color: #c5c5c5;" data-toggle="collapse" data-target="#imports-outer">
                        <i class="fa fa-money" aria-hidden="true"></i>Imports
                    </a>
                    <div id="imports-outer" style="background-color: #5a5858;color: black;" class="collapse">
                        <a href="{{url('admin/ownership-import-page')}}"><i class="fa fa-file"></i>Ownership import</a>
                        <a href="{{url('admin/venture-rental-import-page')}}"><i class="fa fa-file"></i>Venture Rental import</a>
                    </div>
                </li>


                <li class="active">
                    <a style="color: #c5c5c5;" data-toggle="collapse" data-target="#settings-outer">
                        <i class="fa fa-money" aria-hidden="true"></i>Setting
                    </a>
                    <div id="settings-outer" style="background-color: #5a5858;color: black;" class="collapse">
                        <a href="{{url('admin/states/create')}}"><i class="fa fa-plus"></i>Add States</a>
                        <a href="{{url('admin/states')}}"><i class="fa fa-eye"></i>View States</a>
                        <a href="{{url('admin/cities/create')}}"><i class="fa fa-plus"></i>Add Cities</a>
                        <a href="{{url('admin/cities')}}"><i class="fa fa-eye"></i>View Cities</a>

                    </div>
                </li>


            </ul>
        </div>
    </div>
</div>
