<div class="col-lg-2 col-md-12 col-sm-12 col-pad">
    <div class="dashboard-nav d-none d-xl-block d-lg-block">
        <div class="dashboard-inner">
            <h4>Main</h4>
            <ul>                               
                <li><a href="{{url('/manager/communication')}}"><i class="fa fa-users"></i>Communication <span class="notification-icon">{{Helper::unreadMessageCounter()}}</span></a></li>                           
                <li><a href="{{url('/manager/survey')}}"><i class="fa fa-file"></i>Survey</span></a></li>                           
            </ul>
        </div>
    </div>
</div>
