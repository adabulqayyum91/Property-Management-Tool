{{--
 * Created by PhpStorm.
 * User: zahra
 * Date: 4/27/2020
 * Time: 4:13 PM
 --}}
@extends('web.layouts.partials.app')
@section('page_title')
    Buy Now | Property Management Tool
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
                                        <h4>Buy Now</h4>
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
                                                        <th>Listing ID</th>
                                                        <th>Venture Name</th>
                                                        {{--<th>Amount</th>
                                                        <th>Seller OwnerShip</th>--}}
                                                        <th>Status</th>
                                                        <th>Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($buyNow as $buy)
                                                        <tr>
                                                            <td>{{$buy->venture_listing!=''?$buy->venture_listing->list_automated_id:''}}</td>
                                                            <td>{{$buy->venture_listing->venture!=''?$buy->venture_listing->venture->venture_name:''}}</td>

                                                         {{--   <td>
                                                                {{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($buy->amount) ? $buy->amount : '0', 2, ',', '.')}}
                                                            </td>
                                                            <td>
                                                                {{ Config::get('constants.CURRENCY_SIGN').number_format(!is_null($buy->seller_ownership) ? $buy->seller_ownership : '0', 2, ',', '.')}}
                                                            </td>--}}
                                                            <td>{{$buy->status!=''?$buy->status:''}}</td>
                                                            <td>{{$buy->created_at!=''?\Carbon\Carbon::parse($buy->created_at)->format('m-d-Y h:s'):''}}</td>


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
