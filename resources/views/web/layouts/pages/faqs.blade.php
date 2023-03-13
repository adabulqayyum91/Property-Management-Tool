@extends('web.layouts.partials.app')
@section('page_title')
    Faqs | Property Management Tool
@endsection
@section('content')
<style>

</style>
    <div class="sub-banner overview-bgi">

        <div class="container">

            <div class="breadcrumb-area">

                <h1>FAQs</h1>

                <ul class="breadcrumbs">

                    <li><a href="{{url('/home')}}">Home</a></li>

                    <li class="active">FAQs</li>

                </ul>

            </div>

        </div>

    </div>

    <!-- Sub Banner end -->



    <!-- Contact 2 start -->

    <div class="faq content-area-9">

        <div class="container">

            <!-- Main title -->

            <div class="main-title text-center">

                <h1> Property Management Tool</h1>



            </div>

            <div class="row">

                <div class="col-lg-10 offset-lg-1">

                    <div id="faq" class="faq-accordion">

                        <div class="card m-b-0">
                            @foreach($allFaqs as $faq)

                            <div class="card-header">

                                <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#collapse{{$faq->id}}" aria-expanded="false">

                                    {{$faq->title}}

                                </a>

                            </div>

                            <div id="collapse{{$faq->id}}" class="card-block collapse" style="">

                                <div class="p-text">

                                    {{$faq->description}}

                                </div>

                            </div>
                            @endforeach
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


@endsection
