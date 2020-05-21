@extends( 'master.app' )
@section( 'content' )

<div class="col-md-12">
    {{-- @include('master.success') --}}

    <section class="dashboard-counts no-padding-bottom">
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-3 col-sm-6">
                <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-trucks"></i>
                    </div>
                    <div class="title"><span>Avilable<br>Trucks</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25"
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
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="70"
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
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="40"
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
                            <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                        </div>
                    </div>
                    <div class="number">
                        <strong>{{number_format($totalTone,2)}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Header Section    -->
    <section class="dashboard-header">
        <div class="row">
            <!-- Statistics -->
            <div class="statistics col-lg-3 col-12">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-red"><i class="fa fa-tasks"></i>
                    </div>
                    <div class="text">
                        <strong id="totalTone">{{number_format($totalTone,2)}}</strong><br>
                        Avilable Tone
                    </div>
                </div>
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-calendar-o"></i>
                    </div>
                    <div class="text">
                        <strong id="totalTone">{{number_format($upliftedTone,2)}}</strong><br>
                        Uplifted Tone
                    </div>
                </div>
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i>
                    </div>

                    <div class="text">
                        <strong id="totalTone">{{number_format($totalTone - $upliftedTone,2)}}</strong><br>
                        Remaining Tone
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
                                {{-- {{dd($tds)}} --}}
                                @foreach ($tds as $td)
                                <tr>
                                    <td class='m-1 p-1'>{{++$no}}</td>
                                    <td class='m-1 p-1'>{{$td->name}}</td>
                                    <td class='m-1 p-1'>{{$td->Number}}</td>
                                    <td class='m-1 p-1'>{{number_format((($td->Number/$number_of_trucks) * 100),2)}}%
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
            {{-- {{dd($statuslist)}} --}}
            <div class="chart col-lg-3 col-12">
                <!-- Bar Chart   -->
                <div class="bar-chart has-shadow bg-white">
                    <div class="title"><strong class="text-violet">Truck current Status</strong>
                    </div>

                    <div class="p-3">

                        @foreach ($statuslist as $key => $value )
                        <p> {{$key}}<span class="pull-right"> {{$value}}</span></p>
                        @endforeach
                    </div>

                </div>
                <!-- Numbers-->
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <strong>Today Status</strong>
                    {{-- {{dd($daylyupliftedtonage)}} --}}

                </div>
            </div>
        </div>

    </section>
    <!-- Client Section-->
    <section class="client no-padding-top">
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
                                        <th>Trip</th>
                                        <th>Cargo Volume</th>
                                        <th>Lifted Tone </th>
                                        <th>Remaining Tone</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0 ?> @if ($operationsReport->count()> 0) @foreach ($operationsReport as
                                    $td)
                                    <tr>
                                        <td class='m-1 p-1'>{{++$no}}</td>
                                        <td class='m-1 p-1'>{{$td->operationid}}</td>
                                        <td class='m-1 p-1'>{{$td->name}}</td>
                                        <td class='m-1 p-1'>{{$td->fo}}</td>
                                        <td class='m-1 p-1 text-right'>{{number_format($td->Tone_Given,2)}}</td>
                                        <td class='m-1 p-1 text-right'>{{number_format($td->Tone,2)}}</td>
                                        <td class='m-1 p-1 text-right'>{{number_format($td->Tone_Given - $td->Tone,2)}}
                                        </td>
                                        <td class='m-1 p-1'>{{number_format($td->Tone/$td->Tone_Given ,2)*100}}%</td>

                                    </tr>

                                    @endforeach @else
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
                        <h4>Truck stutus of <span class="pull-right text-muted small"><em>{{$maxDate}}</em></span></h4>

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

    </section>
    <section class="client no-padding-top">
        <div class="container-fluid">
            <div class="row">
                <!-- Work Amount  -->
                <div class="col-lg-4">
                    <div class="work-amount card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="dropdown-toggle"><i
                                        class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow">
                                    <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a
                                        href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Todays Status</h3><small></small>
                            @foreach ($daylyupliftedtonage as $today)
                            <div class="text">
                                <strong> 1. Uplifted Ton: {{number_format($today->ton,2)}}</strong>
                            </div>
                            <div class="text">
                                <strong> 2. Number Of Trips: {{number_format($today->trip,2)}}</strong>
                            </div>
                            <div class="text">
                                <strong> 3. Ton KMe: {{number_format($today->tonkm,2)}}</strong>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <!-- Total Overdue             -->
                <div class="col-lg-8">
                    <div class="overdue card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="dropdown-toggle"><i
                                        class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow">
                                    <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a
                                        href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>Monthly Performance by TonKM </h3>
                            <br>
                            <canvas id="myChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @section('javascript')
    <script src="{{ asset('js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    {{-- <script src="{{ asset('js/create-charts.js') }}"></script> --}}
    <script>
        (function ($) {

var charts = {
	init: function () {
		// -- Set new default font family and font color to mimic Bootstrap's default styling
		Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#292b2c';

		this.ajaxGetPostMonthlyData();

	},

	ajaxGetPostMonthlyData: function () {
		var urlPath = '{{ route("dashboard.show") }}';

		var request = $.ajax({
			method: 'GET',
			url: urlPath
		});

		request.done(function (response) {
			// console.log(response);
			charts.createCompletedJobsChart(response);
		});
	},

	/**
	 * Created the Completed Jobs Chart
	 */
	createCompletedJobsChart: function (response) {

		var ctx = document.getElementById("myChart");
		var myLineChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: response.months, // The response got from the ajax request containing all month names in the database
				datasets: [{
					label: "Performance",
					lineTension: 0.3,
					backgroundColor: "rgba(2,117,216,0.2)",
					borderColor: "rgba(2,117,216,1)",
					pointRadius: 5,
					pointBackgroundColor: "rgba(2,117,216,1)",
					pointBorderColor: "rgba(255,255,255,0.8)",
					pointHoverRadius: 5,
					pointHoverBackgroundColor: "rgba(2,117,216,1)",
					pointHitRadius: 20,
					pointBorderWidth: 2,
					data: response.post_count_data, // The response got from the ajax request containing data for the completed jobs in the corresponding months
					// data: [20, 80, 32] // The response got from the ajax request containing data for the completed jobs in the corresponding months
				}],
			},
			options: {
				scales: {
					xAxes: [{
						time: {
							unit: 'date'
						},
						gridLines: {
							display: false
						},
						ticks: {
							maxTicksLimit: 7
						}
					}],
					yAxes: [{
						ticks: {
							min: 0,
							max: response.max, // The response got from the ajax request containing max limit for y axis
							maxTicksLimit: 5
						},
						gridLines: {
							color: "rgba(0, 0, 0, .125)",
						}
					}],
				},
				legend: {
					display: true
				}
			}
		});
	}
};

charts.init();

})(jQuery);
    </script>
    @endsection
