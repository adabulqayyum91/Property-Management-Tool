@extends('web.layouts.partials.app')
@section('page_title')
    Company | Property Management Tool
@endsection
@section('content')
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTNPV7L"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Company</h1>
            <ul class="breadcrumbs">
                <li><a href="{{url('/home')}}">Home</a></li>
                <li class="active">Company</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub Banner end -->

<!-- Contact 2 start -->
<div class="contact-2 content-area-5">
    <div class="container">
        <!-- Contact info -->
        <div class="contact-info">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <p>
                        Property Management Tool was born out of frustration with the current offerings
                        available for a low risk short term return
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact 2 end -->


    @endsection
