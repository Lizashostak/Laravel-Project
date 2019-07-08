@extends('cms.cmsmaster')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">New Customers From Last Week</div>
                                <div class="stat-digit">{{$weekly_new_users}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib"><i class="ti-user text-muted"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">All Customers</div>
                                <div class="stat-digit">{{$all_users}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-stats-up text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Orders Made Today</div>
                                    <div class="stat-text">{{$daily_orders}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
            </div>

            <div class="col-lg-5 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Monthly Sales </h4>
                        <canvas id="sales-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Monthly Income </h4>
                        <canvas id="income-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    (function () {
    "use strict";
    //Orders chart
    var ctx = document.getElementById("sales-chart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
    type: 'line',
            data: {
            labels: {!!$date!!},
                    type: 'line',
                    defaultFontFamily: 'Montserrat',
                    datasets: [{
                    label: "Orders",
                            data: {{$num_orders}},
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(220,53,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(220,53,69,0.75)',
                    },
                    ]
            },
            options: {
            responsive: true,
                    tooltips: {
                    mode: 'index',
                            titleFontSize: 12,
                            titleFontColor: '#000',
                            bodyFontColor: '#000',
                            backgroundColor: '#fff',
                            titleFontFamily: 'Montserrat',
                            bodyFontFamily: 'Montserrat',
                            cornerRadius: 3,
                            intersect: false,
                    },
                    legend: {
                    display: false,
                            labels: {
                            usePointStyle: true,
                                    fontFamily: 'Montserrat',
                            },
                    },
                    scales: {
                    xAxes: [{
                    display: true,
                            gridLines: {
                            display: false,
                                    drawBorder: false
                            },
                            scaleLabel: {
                            display: false,
                                    labelString: 'Month'
                            }
                    }],
                            yAxes: [{
                            display: true,
                                    gridLines: {
                                    display: false,
                                            drawBorder: false
                                    },
                                    scaleLabel: {
                                    display: true,
                                            labelString: 'Orders'
                                    }
                            }]
                    },
                    title: {
                    display: false,
                            text: 'Normal Legend'
                    }
            }
    });
    var ctx = document.getElementById("income-chart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
    type: 'bar',
            data: {
            labels:{!!$income_date!!},
                    type: 'line',
                    defaultFontFamily: 'Montserrat',
                    datasets: [{
                    label: "Sales",
                            data:{!!$income!!},
                            backgroundColor: "rgba(0, 123, 255, 0.5)",
                            backgroundColor: "rgba(0, 123, 255, 0.5)",
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                            pointBackgroundColor: 'rgba(220,53,69,0.75)',
                    },
                    ]
            },
            options: {
            responsive: true,
                    tooltips: {
                    mode: 'index',
                            titleFontSize: 12,
                            titleFontColor: '#000',
                            bodyFontColor: '#000',
                            backgroundColor: '#fff',
                            titleFontFamily: 'Montserrat',
                            bodyFontFamily: 'Montserrat',
                            cornerRadius: 3,
                            intersect: false,
                    },
                    legend: {
                    display: false,
                            labels: {
                            usePointStyle: true,
                                    fontFamily: 'Montserrat',
                            },
                    },
                    scales: {
                    xAxes: [{
                    display: true,
                            gridLines: {
                            display: false,
                                    drawBorder: false
                            },
                            scaleLabel: {
                            display: false,
                                    labelString: 'Month'
                            }
                    }],
                            yAxes: [{
                            display: true,
                                    gridLines: {
                                    display: false,
                                            drawBorder: false
                                    },
                                    scaleLabel: {
                                    display: true,
                                            labelString: 'EUR'
                                    }
                            }]
                    },
                    title: {
                    display: false,
                            text: 'Normal Legend'
                    }
            }
    });
    }
    )();
</script>
@endsection('content')