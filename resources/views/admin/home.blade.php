@extends('admin.layouts.master')
@section('title')
    Home
@endsection
@section('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/chart.js/chart.min.css') }}" />
@endsection

@section('content')
    <div class="page-inner">
        <div class="row row-xs">
            <div class="col-12">
                <div class="card mg-b-20">
                    <div class="d-block d-md-flex justify-content-between align-items-center pd-15">
                        <ul class="nav nav-fill d-block d-md-flex mg-t-15 mg-md-t-0 custom-btn-group" role="tablist">
                            <li class="nav-item">
                                <a class="tx-uppercase tx-center active show waves-effect" data-toggle="pill"
                                    href="#pills-1" role="tab" aria-selected="false">
                                    <h2 class="tx-12 mb-0">Day</h2>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="tx-uppercase tx-12 waves-effect" data-toggle="pill" href="#pills-2" role="tab"
                                    aria-selected="true">
                                    <h2 class="tx-12 mb-0">Week</h2>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="tx-uppercase tx-12 waves-effect" data-toggle="pill" href="#pills-3" role="tab"
                                    aria-selected="false">
                                    <h2 class="tx-12 mb-0">Month</h2>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="tx-uppercase tx-12 waves-effect" data-toggle="pill" href="#pills-4" role="tab"
                                    aria-selected="false">
                                    <h2 class="tx-12 mb-0">Year</h2>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="pills-1" role="tabpanel">
                                <canvas id="audienceOverviewDay" height="80" style="margin: -1px!important"></canvas>
                            </div>
                            <div class="tab-pane fade" id="pills-2" role="tabpanel">
                                <canvas id="audienceOverviewWeek" height="80" style="margin: -1px!important"></canvas>
                            </div>
                            <div class="tab-pane fade" id="pills-3" role="tabpanel">
                                <canvas id="audienceOverviewMonth" height="80" style="margin: -1px!important"></canvas>
                            </div>
                            <div class="tab-pane fade" id="pills-4" role="tabpanel">
                                <canvas id="audienceOverviewYear" height="80" style="margin: -1px!important"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xl-8">
                <div class="row row-xs">
                    <div class="col-md-6 col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <h2 class="tx-15 tx-menium">Order</h2>
                                <span class="tx-20 tx-menium tx-rubik">{{ $order['totalCountOrder'] }}</span>
                                <canvas id="audienceUsers" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <h2 class="tx-15 tx-menium">Price Orders</h2>
                                <span class="tx-20 tx-menium tx-rubik">{{ number_format($order['totalPriceOrder']) }}$</span>
                                <canvas id="audienceNewUsers" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <h2 class="tx-15 tx-menium">Sessions</h2>
                                <span class="tx-20 tx-menium tx-rubik">1,254</span>
                                <canvas id="audienceSessions" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <h2 class="tx-15 tx-menium">Pageviews</h2>
                                <span class="tx-20 tx-menium tx-rubik">2,152</span>
                                <canvas id="audiencePageviews" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <h2 class="tx-15 tx-menium">Avg. Session</h2>
                                <span class="tx-20 tx-menium tx-rubik">00:02:57</span>
                                <canvas id="audienceSessionDuration" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <h2 class="tx-15 tx-menium">Bounce Rate</h2>
                                <span class="tx-20 tx-menium tx-rubik">78.50%</span>
                                <canvas id="audienceBounceRate" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 hidden-md hidden-sm">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <canvas id="sessionsDeviceDount" height="260"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/chart.js/chart.min.js') }}"></script>
    <!-- END: Vendor JS-->
    <!-- BEGIN: Init JS -->
    <!-- END: Init JS-->
    <script>
        var dataOrder = @json($order);
        // data order by days
        let labelsOrderDay = [];
        let dataOrderDay = [];
        $.each(dataOrder.orderDay, function(key, value) {
            labelsOrderDay.push(value.date);
            dataOrderDay.push(value.value);
        });
        // data order by month
        let labelsOrderMonth = [];
        let dataOrderMonth = [];
        $.each(dataOrder.orderMonth, function(key, value) {
            labelsOrderMonth.push(value.date);
            dataOrderMonth.push(value.value);
        });
        // data order by year
        let labelsOrderYear = [];
        let dataOrderYear = [];
        $.each(dataOrder.orderYear, function(key, value) {
            labelsOrderYear.push(value.month);
            dataOrderYear.push(value.value);
        });
        // data order by year
        let labelsOrderLast10Years = [];
        let dataOrderLast10Years= [];
        $.each(dataOrder.orderLast10Years, function(key, value) {
            labelsOrderLast10Years.push(value.year);
            dataOrderLast10Years.push(value.value);
        });
        // data order count by month
        let labelsOrderCount = [];
        let dataOrderCount = [];
        $.each(dataOrder.orderDay, function(key, value) {
            labelsOrderCount.push(value.date);
            dataOrderCount.push(value.count);
        });
        window.onload = function() {
            /*--================================--*/
            // Audience Overview Day Chart
            /*--================================--*/
            var ctx1 = document.getElementById('audienceOverviewDay').getContext('2d');
            window.audienceOverviewDay = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: labelsOrderDay,
                    datasets: [{
                        label: 'Avg. Session',
                        fill: true,
                        backgroundColor: 'rgba(92, 118, 251, 0.15)',
                        borderColor: '#5c76fb',
                        borderWidth: 1,
                        data: dataOrderDay,
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        intersect: true,
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },
                    hover: {
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Order',
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                                beginAtZero: false,
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Overview Week Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceOverviewWeek').getContext('2d');
            window.audienceOverviewWeek = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: labelsOrderMonth,
                    datasets: [{
                        label: 'Avg. Session',
                        fill: true,
                        backgroundColor: 'rgba(76, 175, 80, 0.15)',
                        borderColor: '#4caf50',
                        borderWidth: 1,
                        data: dataOrderMonth,
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        intersect: true,
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },
                    hover: {
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Order by week',
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Overview Month Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceOverviewMonth').getContext('2d');
            window.audienceOverviewMonth = new Chart(ctx1, {

                type: 'bar',
                data: {
                    labels: labelsOrderYear,
                    datasets: [{
                        label: 'Avg. Session',
                        fill: true,
                        backgroundColor: 'rgba(33, 150, 243, 0.15)',
                        borderColor: '#2196f3',
                        borderWidth: 0.5,
                        data: dataOrderYear,
                    }]
                },
                options: {

                    responsive: true,
                    tooltips: {
                        intersect: true,
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },
                    hover: {
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Order by month',
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Overview Year Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceOverviewYear').getContext('2d');
            window.audienceOverviewYear = new Chart(ctx1, {

                type: 'bar',
                data: {
                    labels: labelsOrderLast10Years,
                    datasets: [{
                        label: 'Avg. Session',
                        fill: true,
                        backgroundColor: 'rgba(156, 39, 176, 0.15)',
                        borderColor: '#9c27b0',
                        borderWidth: 0.5,
                        data: dataOrderLast10Years,
                    }]
                },
                options: {

                    responsive: true,
                    tooltips: {
                        intersect: true,
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },
                    hover: {
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Order Last 10 Years',
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 13,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: true,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Users Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceUsers').getContext('2d');
            window.audienceUsers = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: labelsOrderCount,
                    datasets: [{
                        label: 'Order',
                        fill: true,
                        backgroundColor: 'rgba(92, 118, 251, 0.15)',
                        borderColor: '#5c76fb',
                        borderWidth: 1,
                        pointStyle: 'cross',
                        data: dataOrderCount,
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },

                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience New Users Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceNewUsers').getContext('2d');
            window.audienceNewUsers = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: labelsOrderDay,
                    datasets: [{
                        label: 'Price orders',
                        fill: true,
                        backgroundColor: 'rgba(244, 67, 54, 0.15)',
                        borderColor: '#f44336',
                        borderWidth: 1,
                        pointStyle: 'cross',
                        data: dataOrderDay,
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },

                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Sessions Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceSessions').getContext('2d');
            window.audienceSessions = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
                    datasets: [{
                        label: 'Sessions',
                        fill: true,
                        backgroundColor: 'rgba(76, 175, 80, 0.15)',
                        borderColor: '#4caf50',
                        borderWidth: 1,
                        pointStyle: 'cross',
                        data: [680, 450, 560, 530, 590, 520, 690],
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },

                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Pageviews Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audiencePageviews').getContext('2d');
            window.audiencePageviews = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
                    datasets: [{
                        label: 'Pageviews',
                        fill: true,
                        backgroundColor: 'rgba(33, 150, 243, 0.15)',
                        borderColor: '#2196f3',
                        borderWidth: 1,
                        pointStyle: 'cross',
                        data: [2680, 2450, 2160, 2530, 2750, 2520, 2690],
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },

                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Avg. Session Duration Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceSessionDuration').getContext('2d');
            window.audienceSessionDuration = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
                    datasets: [{
                        label: 'Avg. Session',
                        fill: true,
                        backgroundColor: 'rgba(74, 199, 236, 0.15)',
                        borderColor: '#4ac7ec',
                        borderWidth: 1,
                        pointStyle: 'cross',
                        data: [268, 275, 245, 252, 253, 216, 269],
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        bodyFontSize: 13,
                        bodyFontFamily: '"IBM Plex Sans", sans-serif',
                    },

                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Audience Bounce Rate Chart
            /*--================================--*/

            var ctx1 = document.getElementById('audienceBounceRate').getContext('2d');
            window.audienceBounceRate = new Chart(ctx1, {

                type: 'line',
                data: {
                    labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
                    datasets: [{
                        label: 'Bounce Rate',
                        fill: true,
                        backgroundColor: 'rgba(156, 39, 176, 0.15)',
                        borderColor: '#9c27b0',
                        borderWidth: 1,
                        pointStyle: 'cross',
                        data: [252, 275, 253, 268, 245, 216, 300],
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        fontColor: '#868DAA',
                        fontSize: 13,
                        fontStyle: "normal",
                        fontFamily: '"IBM Plex Sans", sans-serif',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue,
                                    currentIndex, array) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);

                                return percentage + "%";
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontColor: '#868DAA',
                                fontSize: 8,
                                fontStyle: "normal",
                                fontFamily: '"IBM Plex Sans", sans-serif',
                            },
                            gridLines: {
                                display: false,
                                color: '#eee',
                            },
                        }],

                    },
                    legend: {
                        display: false,
                    },
                }
            });

            /*--================================--*/
            // Sessions Device Doughnut
            /*--================================--*/

            var value1 = 40;
            var value2 = 85;
            var value3 = 80;
            var value4 = 95;
            var data = {
                labels: [
                    "Desktop",
                    "Tablet",
                    "Mobile",
                    "Others"
                ],
                datasets: [{
                    data: [value1, 100 - value2, 100 - value3, 100 - value4],
                    backgroundColor: [
                        "#3355FF",
                        "#E0E7FD",
                        "#4AC7EC",
                        "#FF6384"
                    ]
                }]
            };

            var sessionsDeviceDount = new Chart(document.getElementById('sessionsDeviceDount'), {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 13,
                            fontColor: '#868DAA',
                            fontSize: 13,
                            fontStyle: "normal",
                            fontFamily: '"IBM Plex Sans", sans-serif',
                        },
                    },
                    cutoutPercentage: 80,
                    tooltips: {
                        fontColor: '#868DAA',
                        fontSize: 13,
                        fontStyle: "normal",
                        fontFamily: '"IBM Plex Sans", sans-serif',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue,
                                    currentIndex, array) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);

                                return percentage + "%";
                            }
                        }
                    }

                }
            });

        }
    </script>
@endsection
