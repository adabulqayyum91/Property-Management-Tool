<div class="pricing-tables pt-5 pb-3">
    <div class="container">
        <!-- Main title -->
        <div class="main-title text-center">
            <h1>Pricing Tables</h1>
            <p>Finding your perfect plan.</p>
        </div>
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-xl-4 col-lg-4 col-md-12">
                <div class="pricing-1 plan">
                    <div class="plan-header">
                        <h5>{{$plan->name}}</h5>
                        <p>{!!isset($plan->description) ? $plan->description : ''!!}</p>

                        <div class="plan-price"><sup>$</sup>{{$plan->price}}<span>/month</span> </div>
                    </div>
                    <div class="plan-list">

                        <div class="plan-button text-center">
                            <button class="btn btn-outline pricing-btn button-theme planModal {{$plan->price =='0'?'register-form':'getStarted'}}" data-id="{{ encrypt($plan->id)}}">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
