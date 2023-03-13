{{--
 * Created by PhpStorm.
 * User: zahra
 * Date: 4/26/2020
 * Time: 1:43 PM
 --}}
@extends('web.layouts.partials.app')
@section('page_title')
    Member Dashboard| Property Management Tool
@endsection


@section('content')
    <style>
        .my-card
        {
            position:absolute;
            left:40%;
            top:-20px;
            border-radius:50%;
        }
    </style>
    <!-- Dashbord start -->
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('web.layouts.partials.sideBar')
                <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
                    <div class="content-area5">
                        <div class="dashboard-content">
                            <div class="dashboard-header clearfix">
                                <h4 class="mb-30">Dashboard</h4>
                                {{-- TODO: For Future Use --}}
                                {{-- <div class="row w-100">
                                    <div class="col-md-3">
                                        <div class="card border-info mx-sm-1 p-3">
                                            <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-quote-left" aria-hidden="true"></span></div>
                                            <div class="text-info text-center mt-4"><h6>Offer Requests Made</h6></div>
                                            <div class="text-info text-center mt-2"><h1>{{ $offersCount }}</h1></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-success mx-sm-1 p-3">
                                            <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-quote-right" aria-hidden="true"></span></div>
                                            <div class="text-success text-center mt-4"><h6>Offer Requests Received</h6></div>
                                            <div class="text-success text-center mt-2"><h1>{{ $receiveOffersCount }}</h1></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-danger mx-sm-1 p-3">
                                            <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-buysellads" aria-hidden="true"></span></div>
                                            <div class="text-danger text-center mt-4"><h6>BuyNow Requests Made</h6></div>
                                            <div class="text-danger text-center mt-2"><h1>{{ $buyNowCount }}</h1></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card border-warning mx-sm-1 p-3">
                                            <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-lastfm" aria-hidden="true"></span></div>
                                            <div class="text-warning text-center mt-4"><h6>BuyNow Requests Received</h6></div>
                                            <div class="text-warning text-center mt-2"><h1>{{ $buyNowReceivedCount }}</h1></div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row w-100 mt-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                        <div class="dashboard-list">
                                          <div class="dashboard-message bdr clearfix ">
                                            <div class="card-header">
                                              <h5>Your Ventures</h5>
                                            </div>
                                            <table class="table table-striped table-bordered">
                                              <thead class="bg-active">
                                                <th>Venture ID</th>
                                                <th>Venture Name</th>
                                              </thead>
                                              <tbody>
                                                @foreach($ventures as $v)
                                                <tr>
                                                  <td>{{$v->venture_automated_id}}</td>
                                                  <td>{{$v->venture_name}}</td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                    </div>
                                    @if(count($lineChart->datasets)>0)
                                      <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                          <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                              <div class="card-header">
                                                <h5>Monthly Rental Income</h5>
                                              </div>
                                              <div id="line-area3" class="lineAreaDashboard" style="height:auto;">
                                                  <div style="width: 80%;margin: 0 auto;">
                                                      {!! $lineChart->container() !!}
                                                  </div>
                                                  {!! $lineChart->script() !!}
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                    @endif
                                    @if(count($percentages)>0)
                                      <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                          <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                              <div class="card-header">
                                                <h5>Portfolio Share</h5>
                                              </div>
                                              <div id="chart-percent" class="chart-percent" style="height:auto;">
                                                  <div style="width: 80%;margin: 0 auto;">
                                                      {!! $userBarChart->container() !!}
                                                  </div>
                                                  {!! $userBarChart->script() !!}

                                              </div>
                                              {{-- <div class="row mb-3">
                                                <div class="col"> <span class="mb-1 text-muted d-block">23%</span>
                                                  <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar progress-c-green" role="progressbar"
                                                                                     style="width: 23%;" aria-valuenow="23" aria-valuemin="0"
                                                                                     aria-valuemax="100"></div>
                                                  </div>
                                                </div>
                                                <div class="col"> <span class="mb-1 text-muted d-block">14%</span>
                                                  <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar progress-c-yellow" role="progressbar"
                                                                                     style="width: 14%;" aria-valuenow="14" aria-valuemin="0"
                                                                                     aria-valuemax="100"></div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row mb-2">
                                                <div class="col"> <span class="mb-1 text-muted d-block">35%</span>
                                                  <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar progress-c-purple" role="progressbar"
                                                                                     style="width: 35%;" aria-valuenow="35" aria-valuemin="0"
                                                                                     aria-valuemax="100"></div>
                                                  </div>
                                                </div>
                                                <div class="col"> <span class="mb-1 text-muted d-block">28%</span>
                                                  <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar progress-c-blue" role="progressbar"
                                                                                     style="width: 28%;" aria-valuenow="28" aria-valuemin="0"
                                                                                     aria-valuemax="100"></div>
                                                  </div>
                                                </div>
                                              </div> --}}
                                            </div>
                                          </div>
                                      </div>
                                    @endif
                                    @if(count($lineChart2->datasets)>0)
                                      <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                          <div class="dashboard-list">
                                            <div class="dashboard-message bdr clearfix ">
                                              <div class="card-header">
                                                <h5>Estimated Property Valuation</h5>
                                              </div>
                                              <div id="line-area2" class="lineAreaDashboard" style="height:auto;">
                                                  <div style="width: 80%;margin: 0 auto;">
                                                      {!! $lineChart2->container() !!}
                                                  </div>
                                                  {!! $lineChart2->script() !!}
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>



                </div>



            </div>
        </div>
    </div>
    <!-- Dashboard end -->
@endsection
