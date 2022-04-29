@extends("admin.master")
@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-5">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-7">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalUser }}</h3>

                            <p>{{trans("auth.dashboard.label.1")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{url("/admin/users")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalFile }}</h3>

                            <p>{{trans("auth.dashboard.label.2")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{url("/admin/users")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalPackage }}</h3>

                            <p>{{trans("auth.dashboard.label.3")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{url("/admin/packages")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->

                <!--Circle chart -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Donut Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;" width="334" height="250" class="chartjs-render-monitor"></canvas>
                        </div>

                    </div>
                    <!-- /.card -->
                </section>

                <!--Domain chart -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Area Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;" width="334" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>

                <!--Line chart -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Line Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width="334" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </section>

                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section("custom-js")
<script>
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    $.ajax({
        url: '{{url("/admin/dashboard-donutchart-data")}}',
        type: 'get',
        data: {},
        success: function (response){
            console.log(response);
            const data = response.data;
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
                labels: [
                    data['package1'][0],
                    data['package2'][0],
                    data['package3'][0],
                    data['package4'][0],
                ],
                datasets: [
                    {
                        data: [data['package1'][1],data['package2'][1],data['package3'][1],data['package4'][1]],
                        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                    }
                ]
            }
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            //Create donut chart
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
        }
    })

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    $.ajax({
        url: '{{url("/admin/dashboard-areachart-data")}}',
        type: 'get',
        data: {},
        success: function (response) {
            console.log(response);
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            var areaChartData = {
                labels  : [
                    response.data[6].date,
                    response.data[5].date,
                    response.data[4].date,
                    response.data[3].date,
                    response.data[2].date,
                    response.data[1].date,
                    response.data[0].date,
                ],
                datasets: [
                    {
                        label               : 'Total File Upload',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [
                            response.data[6].total,
                            response.data[5].total,
                            response.data[4].total,
                            response.data[3].total,
                            response.data[2].total,
                            response.data[1].total,
                            response.data[0].total,
                        ]
                    },
                ]
            }
            var areaChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }],
                    yAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }]
                }
            }
            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })
        }
    })

    //-------------
    //- LINE CHART -
    //--------------
    $.ajax({
        url: '{{url("/admin/dashboard-linechart-data")}}',
        type: 'get',
        data: {},
        success: function (response) {
            console.log(response);
            var areaChartData = {
                labels  : [
                    response.data[29].date,
                    response.data[28].date,
                    response.data[27].date,
                    response.data[26].date,
                    response.data[25].date,
                    response.data[24].date,
                    response.data[23].date,
                    response.data[22].date,
                    response.data[21].date,
                    response.data[20].date,
                    response.data[19].date,
                    response.data[18].date,
                    response.data[17].date,
                    response.data[16].date,
                    response.data[15].date,
                    response.data[14].date,
                    response.data[13].date,
                    response.data[12].date,
                    response.data[11].date,
                    response.data[10].date,
                    response.data[9].date,
                    response.data[8].date,
                    response.data[7].date,
                    response.data[6].date,
                    response.data[5].date,
                    response.data[4].date,
                    response.data[3].date,
                    response.data[2].date,
                    response.data[1].date,
                    response.data[0].date,
                ],
                datasets: [
                    {
                        label: 'Total File Upload',
                        data                : [
                            response.data[29].total,
                            response.data[28].total,
                            response.data[27].total,
                            response.data[26].total,
                            response.data[25].total,
                            response.data[24].total,
                            response.data[23].total,
                            response.data[22].total,
                            response.data[21].total,
                            response.data[20].total,
                            response.data[19].total,
                            response.data[18].total,
                            response.data[17].total,
                            response.data[16].total,
                            response.data[15].total,
                            response.data[14].total,
                            response.data[13].total,
                            response.data[12].total,
                            response.data[11].total,
                            response.data[10].total,
                            response.data[9].total,
                            response.data[8].total,
                            response.data[7].total,
                            response.data[6].total,
                            response.data[5].total,
                            response.data[4].total,
                            response.data[3].total,
                            response.data[2].total,
                            response.data[1].total,
                            response.data[0].total,
                        ],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }],
                    yAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }]
                }
            }
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })
        }
    })
</script>
@endsection
