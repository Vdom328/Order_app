@extends('admin.layouts.master')
@section('title')
Home
@endsection
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/chart.js/chart.min.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/d3/cal-heatmap/cal-heatmap.css')}}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jquery-jvectormap-2.0.2.css')}}">
@endsection

@section('content')
            <div class="page-inner">
                <div class="row row-xs">
                    <!--================================-->
                    <!-- Audience Overview Start -->
                    <!--================================-->
                    <div class="col-xl-8">
                        <div class="card mg-b-20">
                            <ul class="nav nav-fill d-block d-md-flex audience-overview-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="active show" data-toggle="pill" href="#pills-1" role="tab"
                                        aria-controls="pills-1" aria-selected="false">
                                        <h2 class="tx-15 ">Users</h2>
                                        <h1 class="tx-20">25.5k</h1>
                                        <div class="d-flex align-items-center justify-content-center ">
                                            <span data-feather="arrow-up" class="tx-success wd-16 ht-10"></span>
                                            <span class="tx-12 tx-normal ">05.55%</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2"
                                        aria-selected="true">
                                        <h2 class="tx-15 ">Sessions</h2>
                                        <h1 class="tx-20">55.6k</h1>
                                        <div class="d-flex align-items-center justify-content-center ">
                                            <span data-feather="arrow-down" class="tx-danger wd-16 ht-10"></span>
                                            <span class="tx-12 tx-normal ">02.15%</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3"
                                        aria-selected="false">
                                        <h2 class="tx-15 ">Bounce Rate</h2>
                                        <h1 class="tx-20">67.89%</h1>
                                        <div class="d-flex align-items-center justify-content-center ">
                                            <span data-feather="arrow-up" class="tx-success wd-16 ht-10"></span>
                                            <span class="tx-12 tx-normal ">03.65%</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab"
                                        aria-controls="pills-3" aria-selected="false">
                                        <h2 class="tx-15 ">Session Duration</h2>
                                        <h1 class="tx-20">5m:53s</h1>
                                        <div class="d-flex align-items-center justify-content-center ">
                                            <span data-feather="arrow-down" class="tx-danger wd-16 ht-10"></span>
                                            <span class="tx-12 tx-normal ">05.14%</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="pills-1" role="tabpanel">
                                        <canvas id="usersLineChart"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="pills-2" role="tabpanel">
                                        <canvas id="sessionsLineChart"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="pills-3" role="tabpanel">
                                        <canvas id="bounceRateLineChart"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="pills-4" role="tabpanel">
                                        <canvas id="sessionDurationLineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <button id="audienceOverviewDatePicker"
                                            class="btn btn-light waves-effect dropdown-toggle mr-2 d-none d-md-block pd-y-8-force"></button>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="analytic-audience.html" target="_blank"
                                            class="btn btn-light waves-effect">Audience Overview<span
                                                data-feather="chevron-right" class="wd-16 ht-16 ml-1"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Audience Overview End -->
                    <!--================================-->
                    <!-- Top Traffic Source Start -->
                    <!--================================-->
                    <div class="col-xl-4">
                        <div class="card mg-b-20">
                            <div class="card-header d-flex justify-content-between">
                                <h2 class="tx-15 mb-0">Top Traffic Source</h2>
                                <a href="" class=""><span data-feather="refresh-cw"
                                        class="wd-16 ht-16"></span></a>
                            </div>
                            <div class="card-body tx-center">
                                <h4 class="tx-normal tx-36 mg-b-0 tx-rubik">30,583</h4>
                                <p class="tx-uppercase tx-medium ">Organic Search</p>
                                <p class="tx-12 mg-b-0">Measures your user's sources that generate traffic metrics to
                                    your website for this month.</p>
                                <button class="btn btn-primary btn-uppercase mg-t-10 waves-effect">Learn More</button>
                            </div>
                        </div>
                        <div class="card mg-b-20">
                            <div class="card-header d-flex justify-content-between">
                                <h2 class="tx-15 mb-0">Sessions Device</h2>
                                <a href="" class=""><span data-feather="refresh-cw"
                                        class="wd-16 ht-16"></span></a>
                            </div>
                            <div class="card-body">
                                <canvas id="sessionsDeviceDount" height="195"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/ Top Traffic Source End -->
                    <!--================================-->
                    <!-- Click & View Through Start -->
                    <!--================================-->
                    <div class="col-xl-8 pd-x-15-force">
                        <div class="row row-xs">
                            <div class="col-md-6 col-xl-6">
                                <div class="card mg-b-20">
                                    <div class="card-body">
                                        <h2 class="tx-15 tx-menium">Users</h2>
                                        <span class="tx-20 tx-menium tx-rubik">780</span>
                                        <canvas id="audienceUsers" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card mg-b-20">
                                    <div class="card-body">
                                        <h2 class="tx-15 tx-menium">New Users</h2>
                                        <span class="tx-20 tx-menium tx-rubik">690</span>
                                        <canvas id="audienceNewUsers" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card mg-b-20">
                                    <div class="card-body">
                                        <h2 class="tx-15 tx-menium">Sessions</h2>
                                        <span class="tx-20 tx-menium tx-rubik">1,254</span>
                                        <canvas id="audienceSessions" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card mg-b-20">
                                    <div class="card-body">
                                        <h2 class="tx-15 tx-menium">Pageviews</h2>
                                        <span class="tx-20 tx-menium tx-rubik">2,152</span>
                                        <canvas id="audiencePageviews" height="125"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Click & View Through End -->
                    <!--================================-->
                    <!-- Users Location Start -->
                    <!--================================-->
                    <div class="col-xl-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div id="world-map" style="height: 285px;"></div>
                                <canvas id="countryBaseHorizontalBar"></canvas>
                            </div>
                        </div>
                    </div>
                    <!--/ Users Location End -->
                    <!--================================-->
                    <!-- Acquisition Report Start -->
                    <!--================================-->
                    <div class="col-xl-6">
                        <div class="card">
                            <ul class="nav nav-fill d-block d-md-flex audience-overview-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="active show" data-toggle="pill" href="#acquire-pills-1"
                                        role="tab" aria-controls="pills-1" aria-selected="false">
                                        <h2 class="tx-15  mb-0">Traffic Channel</h2>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#acquire-pills-2" role="tab"
                                        aria-controls="pills-2" aria-selected="true">
                                        <h2 class="tx-15  mb-0">Source / Medium</h2>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#acquire-pills-3" role="tab"
                                        aria-controls="pills-3" aria-selected="false">
                                        <h2 class="tx-15  mb-0">Referrals</h2>
                                    </a>
                                </li>
                            </ul>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="acquire-pills-1" role="tabpanel"
                                        aria-labelledby="acquire-pills-1">
                                        <canvas id="acquireTrafficChannel" height="170"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="acquire-pills-2" role="tabpanel"
                                        aria-labelledby="acquire-pills-2">
                                        <canvas id="acquireTrafficSource" height="170"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="acquire-pills-3" role="tabpanel"
                                        aria-labelledby="acquire-pills-3">
                                        <canvas id="acquireTrafficReferral" height="170"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <button id="acquireOverviewDatePicker"
                                            class="btn btn-light waves-effect dropdown-toggle mr-2 d-none d-md-block pd-y-8-force"></button>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="analytic-acquisition.html" target="_blank"
                                            class="btn btn-light waves-effect">Acquisition Report<span
                                                data-feather="chevron-right" class="wd-16 ht-16 ml-1"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Acquisition Report End -->
                    <!--================================-->
                    <!-- Users Visit Pages Start -->
                    <!--================================-->
                    <div class="col-md-12 col-xl-6 mg-t-20 mg-xl-t-0">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h2 class="tx-15 mb-0">What pages do your users visit?</h2>
                                <a href="" class=""><span data-feather="refresh-cw"
                                        class="wd-16 ht-16"></span></a>
                            </div>
                            <div class="card-body pd-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="wd-35 tx-center">&nbsp;</th>
                                                <th colspan="1">Active Page</th>
                                                <th class="wd-35 tx-center">Pageview</th>
                                                <th colspan="2" class="tx-center">Active Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="tx-center">1</td>
                                                <td><a href=""
                                                        class="text-truncate">/item/metrical...shboard-template/24250418</a>
                                                </td>
                                                <td class="tx-center">9,543</td>
                                                <td class="wd-50 tx-center">351</td>
                                                <td class="wd-50 tx-center">50.10%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">2</td>
                                                <td><a href="">/item/avesta...shboard-template/24731537</a>
                                                </td>
                                                <td class="tx-center">8,458</td>
                                                <td class="tx-center">417</td>
                                                <td>30.60%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">3</td>
                                                <td><a
                                                        href="">/https://wrapcoders.xyz/adata/user/WRAPCODERS/portfolio</a>
                                                </td>
                                                <td class="tx-center">7,658</td>
                                                <td class="tx-center">325</td>
                                                <td>22.40%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">4</td>
                                                <td><a href="">/item/avesta...shboard-template/24731537</a>
                                                </td>
                                                <td class="tx-center">6,543</td>
                                                <td class="tx-center">417</td>
                                                <td>30.60%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">5</td>
                                                <td><a href="">/user/WRAPCODERS/portfolio</a></td>
                                                <td class="tx-center">5,158</td>
                                                <td class="tx-center">244</td>
                                                <td>18.24%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">6</td>
                                                <td><a href="">/item/metrical-multi...een_preview/24250418</a>
                                                </td>
                                                <td class="tx-center">4,358</td>
                                                <td class="tx-center">155</td>
                                                <td>10.95%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">7</td>
                                                <td><a href="">/item/avesta...shboard-template/24731537</a>
                                                </td>
                                                <td class="tx-center">3,584</td>
                                                <td class="tx-center">417</td>
                                                <td>30.60%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">8</td>
                                                <td><a
                                                        href="">/https://wrapcoders.xyz/adata/user/WRAPCODERS/portfolio</a>
                                                </td>
                                                <td class="tx-center">2,258</td>
                                                <td class="tx-center">325</td>
                                                <td>22.40%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">9</td>
                                                <td><a href="">/user/WRAPCODERS/portfolio</a></td>
                                                <td class="tx-center">2,543</td>
                                                <td class="tx-center">244</td>
                                                <td>18.24%</td>
                                            </tr>
                                            <tr>
                                                <td class="tx-center">10</td>
                                                <td><a href="">/item/metrical-multi...een_preview/24250418</a>
                                                </td>
                                                <td class="tx-center">2,356</td>
                                                <td class="tx-center">155</td>
                                                <td>10.95%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Users Visit Pages End -->
                </div>
            </div>

@endsection
@section('js')
<!-- BEGIN: Vendor JS -->
<script src="{{ asset('assets/plugins/chart.js/chart.min.js')}}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('assets/plugins/d3/d3.min.js')}}"></script>
<script src="{{ asset('assets/plugins/d3/cal-heatmap/cal-heatmap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('assets/plugins/flot/sampledata.js')}}"></script>
<script src="{{ asset('assets/plugins/jqvmap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jqvmap/gdp-data.js')}}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- END: Vendor JS-->
<!-- BEGIN: Init JS -->
<script src="{{ asset('assets/lib/dashboard/analytic/dashboard-home-init.js')}}"></script>
<!-- END: Init JS-->

@endsection
