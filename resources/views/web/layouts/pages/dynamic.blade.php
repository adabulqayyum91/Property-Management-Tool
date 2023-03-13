@extends('web.layouts.partials.app')
@section('page_title')
    {{ isset($currentPage) ? $currentPage->title : '' }} | Property Management Tool
@endsection

@section('css')
    <style>
        .dynamic-content ul li {
            list-style: disc;

        }
        .dynamic-content ul ul li{
            list-style: circle;
            list-style-position: inside;
            padding: 10px 0 10px 20px;
            text-indent: -1em;
        }
        .dynamic-content a { color: blue;}
        blockquote p {
            padding: 15px;
            background: #eee;
            border-radius: 5px;
        }

        blockquote p::before {
            content: '\201C';
        }
        blockquote p::after {
            content: '\201C';
        }

    </style>
    @endsection
@section('content')



    <div class="sub-banner overview-bgi">

        <div class="container">

            <div class="breadcrumb-area">

                <h1>{{ isset($currentPage) ? $currentPage->title : '' }}</h1>

                <ul class="breadcrumbs">

                    <li><a href="{{url('/home')}}">Home</a></li>

                    <li class="active">{{ isset($currentPage) ? $currentPage->title : '' }}</li>

                </ul>

            </div>

        </div>

    </div>

    <!-- Sub Banner end -->



    <!-- Contact 2 start -->


    <div class="faq content-area-9 dynamic-content">

        <div class="container">

            <!-- Main title -->

            <div class="row">

                <div class="col-lg-10 offset-lg-1">

                    <div id="faq" class="faq-accordion">

                        {!! isset($currentPage) ? $currentPage->content : '' !!}

                    </div>

                </div>

            </div>

        </div>

    </div>


@endsection
