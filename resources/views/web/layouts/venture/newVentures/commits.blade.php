{{--
 * Created by PhpStorm.
 * User: zahra
 * Date: 4/26/2020
 * Time: 1:43 PM
 --}}
@extends('web.layouts.partials.app')
@section('page_title')
    Venture Commit List | Property Management Tool
@endsection


@section('content')
    <body>

    <!-- Dashbord start -->
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('web.layouts.partials.sideBar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="dashboard-header clearfix">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <h4>Current User Venture</h4>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="dashboard-list">
                                        <div class="dashboard-message bdr clearfix ">
                                            <div class="tab-box-2">
                                                <table id="example" class="table table-striped table-bordered">
                                                    <thead class="bg-active">
                                                    <tr>
                                                        {{--                                                            <th>#</th>--}}
                                                        <th>Listing ID</th>
                                                        {{--                                                            <th>Ownership Sequence</th>--}}
                                                        <th>Venture Name</th>
                                                        <th>Asking Price</th>
                                                        <th>Commit Amount</th>
                                                        <th>Listing Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($commits as $commit)

                                                        <tr>
                                                            <td>{{$commit->NewVentureListing!=''?$commit->NewVentureListing->list_automated_id:''}}</td>
                                                            <td>{{!is_null($commit->NewVentureListing->venture)?$commit->NewVentureListing->venture->venture_name:''}}</td>
                                                            <td>
                                                                {{ formatCurrency($commit->NewVentureListing->venture->purchase_price)}}
                                                            </td>
                                                            <td>
                                                                {{ formatCurrency($commit->amount)}}
                                                            </td>
                                                            <td>{{$commit->status!=''?$commit->status:''}}</td>


                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashbord end -->
    </body>
@endsection
{{--</html>--}}
