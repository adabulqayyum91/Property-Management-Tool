@extends('admin.layouts.partials.dashboardApp')
@section('page_title')
  Dashboard | Admin Panel
@endsection
@section('content')
<div class="dashboard">
    <div class="container-fluid">
      <div class="row">
          @include('admin.layouts.partials.sidebar')
        <div class="col-lg-10 col-md-12 col-sm-12 col-pad">
          <div class="content-area5">
            <div class="dashboard-content">
              <div class="dashboard-header clearfix">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <h4>Dashboard Account Summary</h4>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="dashboard-list">
                    <div class="dashboard-message bdr clearfix ">
                      <div class="tab-box-2">
                        <div class="clearfix mb-30 comments-tr"> <span>Members & Ventures Statistics</span></div>
                        <table class="table table-bordered box-shadow">
                          <thead class="bg-active">
                              <tr>
                                <th class="text-center">Metric</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Today</th>
                                <th class="text-center">Last 7 Days</th>
                                <th class="text-center">Last 30 Days</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="text-center">Members</td>
                                <td class="text-center">{{$counters['totalUsers']}}</td>
                                <td class="text-center">{{$counters['todayUsers']}}</td>
                                <td class="text-center">{{$counters['sevenDayUsers']}}</td>
                                <td class="text-center">{{$counters['thirtyDayUsers']}}</td>
                              </tr>
                              <tr>
                                <td class="text-center">Ventures</td>
                                <td class="text-center">{{$counters['totalVentures']}}</td>
                                <td class="text-center">{{$counters['todayVentures']}}</td>
                                <td class="text-center">{{$counters['sevenDayVentures']}}</td>
                                <td class="text-center">{{$counters['thirtyDayVentures']}}</td>
                              </tr>
                              <tr>
                                <td class="text-center">New Venture Listings</td>
                                <td class="text-center">{{$counters['totalNewVentures']}}</td>
                                <td class="text-center">{{$counters['todayNewVentures']}}</td>
                                <td class="text-center">{{$counters['sevenDayNewVentures']}}</td>
                                <td class="text-center">{{$counters['thirtyDayNewVentures']}}</td>
                              </tr>
                              <tr>
                                <td class="text-center">Current Venture Listings</td>
                                <td class="text-center">{{$counters['totalCurrentVentures']}}</td>
                                <td class="text-center">{{$counters['todayCurrentVentures']}}</td>
                                <td class="text-center">{{$counters['sevenDayCurrentVentures']}}</td>
                                <td class="text-center">{{$counters['thirtyDayCurrentVentures']}}</td>
                              </tr>
                            </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="dashboard-list">
                    <div class="dashboard-message bdr clearfix ">
                      <div class="tab-box-2">
                        <div class="clearfix mb-30 comments-tr"> <span>Valuation Statistics</span></div>
                            <table class="table table-bordered box-shadow">
                                <thead class="bg-active">
                                    <tr>
                                        <th class="text-center">Metric</th>
                                        <th class="text-center">Values</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Total Original Price combined of all ventures</td>
                                        <td class="text-center">
                                            {{formatCurrency($counters['totalPurchasePrice'])}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Estimated Value for all Ventures</td>
                                        <td class="text-center">
                                            {{formatCurrency($counters['estimatedValue'])}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Total Rental Income This Month</td>
                                        <td class="text-center">
                                            {{formatCurrency($counters['monthRentalIncome'])}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Total Rental Income Overall</td>
                                        <td class="text-center">
                                            {{formatCurrency($counters['totalRentalIncome'])}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Average Portfolio Value</td>
                                        <td class="text-center">
                                            {{formatCurrency($counters['averagePortfolioValue'])}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="dashboard-message bdr clearfix ">
                <p class="footer-text text-center"> <a href="faqs.html">FAQS</a> <a href="company.html">Company</a> <a href="terms.html">Terms</a> <a href="privacy-policy.html">Privacy Policy</a> <a href="contact.html">Contact</a> <br>
                  © 2019 Property Management Tool Inc. All Rights Reserved.</p>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
