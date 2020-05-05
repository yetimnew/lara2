@extends('master.app')
@section('content')

<div class="col-md-12">
    <section class="dashboard-counts no-padding-bottom">
        <div class="container-fluid">
            <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-violet"><i class="icon-user"></i>
                        </div>
                        <div class="title"><span>Avilable<br>Trucks</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                            </div>
                        </div>

                        <div class="number">
                            <strong>{{$number_of_trucks}}</strong>
                        </div>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-red"><i class="icon-padnote"></i>
                        </div>
                        <div class="title"><span>Number of<br>Drivers</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                            </div>
                        </div>
                        <div class="number">
                            <strong>{{$number_of_drivers}}</strong>
                        </div>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-green"><i class="icon-bill"></i>
                        </div>
                        <div class="title"><span>Active<br>Operation</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                            </div>
                        </div>
                        <div class="number">
                            <strong>{{$operations}}</strong>
                        </div>
                    </div>
                </div>
                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                    <div class="item d-flex align-items-center">
                        <div class="icon bg-orange"><i class="icon-check"></i>
                        </div>
                        <div class="title"><span>Total<br>Tonage</span>
                            <div class="progress">
                                <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                            </div>
                        </div>
                        <div class="number">
                            <strong>{{number_format($totalTone,2)}}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Header Section    -->
    <section class="dashboard-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Statistics -->
                <div class="statistics col-lg-3 col-12">
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-red"><i class="fa fa-tasks"></i>
                        </div>
                        <div class="text">
                            <strong id="totalTone">{{number_format($totalTone,2)}}</strong><br>
                            <lead>Avilable Tone</lead>
                        </div>
                    </div>
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-green"><i class="fa fa-calendar-o"></i>
                        </div>
                        <div class="text">
                            <strong id="totalTone">{{number_format($upliftedTone,2)}}</strong><br>
                            <lead>Uplifted Tone</lead>
                        </div>
                    </div>
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i>
                        </div>

                        <div class="text">
                            <strong id="totalTone">{{number_format($totalTone - $upliftedTone,2)}}</strong><br>
                            <lead>Remaining Tone</lead>
                        </div>
                    </div>
                </div>
                <!-- Line Chart            -->
                <div class="chart col-lg-6 col-12">
                    <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">

                        <div class="table-responsive m-3">
                            <div class="text"><strong>Dayily Truck Status</strong>
                                <small class="pull-right text-muted ">{{$maxDate}}</small>
                            </div>
                            <table class="table  table-hover table-sm">
                                <thead>
                                    <tr class="bg-info text-white">
                                        <th>#</th>
                                        <th>Status </th>
                                        <th>Numbe</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0 ?>

                                    @if ($tds->count()> 0)
                                    @foreach ($tds as $td)
                                    <tr>
                                        <td class='m-1 p-1'>{{++$no}}</td>
                                        <td class='m-1 p-1'>{{$td->name}}</td>
                                        <td class='m-1 p-1'>{{$td->Number}}</td>
                                        <td class='m-1 p-1'>
                                            {{number_format((($td->Number/$number_of_trucks) * 100),2)}}%</td>

                                    </tr>

                                    @endforeach
                                    @else
                                    <tr>
                                        <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="chart col-lg-3 col-12">
                    <!-- Bar Chart   -->
                    <div class="bar-chart has-shadow bg-white">
                        <div class="title"><strong class="text-violet">95%</strong><br><small>Current Server
                                Uptime</small>
                        </div>
                        <canvas id="barChartHome">

                        </canvas>
                    </div>
                    <!-- Numbers-->
                    <div class="statistic d-flex align-items-center bg-white has-shadow">
                        <div class="icon bg-green"><i class="fa fa-line-chart"></i>
                        </div>
                        <div class="text"><strong>99.9%</strong><br><small>Success Rate</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Section-->
    <section class="client no-padding-top">
        <div class="container-fluid">
            <div class="row">
                <!-- Work Amount  -->
                <div class="col-lg-7">
                    <div class="work-amount card">
                        <div class="card-body">
                            <div class="text-justify">
                                <h4 class="text-center" m-2>Operational Status </h4>
                            </div>
                            <div class="table-responsive">
                                <table id="trucks" class="table table-hover table-bordered">
                                    <thead class="p-0">
                                        <tr class="bg-info text-white p-0">
                                            <th>S/No</th>
                                            <th>Operation ID</th>
                                            <th>Customer Name</th>
                                            <th>Cargo Volume</th>
                                            <th>Lifted Tone </th>
                                            <th>Remaining Tone</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0 ?>

                                        @if ($operationsReport->count()> 0)
                                        @foreach ($operationsReport as $td)
                                        <tr>
                                            <td class='m-1 p-1'>{{++$no}}</td>
                                            <td class='m-1 p-1'>{{$td->operationid}}</td>
                                            <td class='m-1 p-1'>{{$td->name}}</td>
                                            <td class='m-1 p-1'>{{number_format($td->Tone_Given,2)}}</td>
                                            <td class='m-1 p-1'>{{number_format($td->Tone,2)}}</td>
                                            <td class='m-1 p-1'>{{number_format($td->Tone_Given - $td->Tone,2)}}</td>
                                            <td class='m-1 p-1'>{{number_format($td->Tone/$td->Tone_Given ,2)*100}}%
                                            </td>

                                        </tr>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Total Overdue             -->
                <div class="col-lg-5">
                    <div class="overdue card">

                        <div class="card-body">
                            <div class="text-justify">
                                <h4>Truck stutus of <span class="pull-right text-muted small"><em>2018-10-19</em>
                                    </span>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status Name</th>
                                            <th>Number of Vehecle</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0 ?>

                                        @if ($statuses->count()> 0)
                                        @foreach ($statuses as $td)
                                        <tr>
                                            <td class='m-1 p-1'>{{++$no}}</td>
                                            @if ($td->statusgroup == 0)
                                            <td class='m-1 p-1'>Operational Statuse</td>
                                            @else
                                            <td class='m-1 p-1'>Garage Statuse</td>

                                            @endif
                                            <td class='m-1 p-1'>{{$td->status}}</td>
                                            <td class='m-1 p-1'>
                                                {{number_format((($td->status/$number_of_trucks) * 100),2)}}%</td>

                                        </tr>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                                        </tr>
                                        @endif


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
