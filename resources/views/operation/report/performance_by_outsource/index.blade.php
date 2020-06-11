@extends( 'master.app' )
@section( 'title', 'TIMS | OS Performance Create' )


@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>
<div class="row col-12">
    <h3 class="text-center"> REPORT : Performance By Outsource</h3>
    <div class="col-10">
        <form method="post" action="{{route('outsource_performance_report.store')}}" class="form-horizontal"
            id="truck_form">
            @csrf
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="control-label">Customer Name</label>
                            <select name="customer" class="form-control" id="customer" required
                                onfocusout="validateDestination()">
                                <option class="dropup" value="-1"> Select All</option>
                                @foreach ($oursources as $oursource)
                                <option class="dropup" value="{{$oursource->id}}"> {{$oursource->name}} </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputCity">Start Date</label>
                            <input id="startDate" name="startDate" type="date" placeholder="Start Date"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputState">End Date</label>
                            <input id="endDate" name="endDate" type="date" placeholder="End Date" class="form-control"
                                required>

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip"></label>
                            <button class="btn btn-secondary btn-block" type="submit" name="register"
                                id="register">Search</button>
                        </div>

                    </div>

                </div>
            </div>

    </div>

</div>
<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Outsource Performances </h2>

            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="drivers">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Operation </th>
                            <th>FO</th>
                            <th>Plate </th>
                            <th>Date Dis </th>
                            <th>Origion </th>
                            <th>Destination </th>
                            <th>Tone</th>
                            <th>Ton KM</th>
                            <th>DWC</th>
                            <th>DWOC</th>
                            <th>Total KM</th>
                            <th>Tariff</th>
                            <th>Revenue</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        {{-- {{dd($osperformances)}} --}}
                        @if ($osperformances->count()> 0)
                        @foreach ($osperformances as $pr)

                        <tr>
                            <td class='m-1 p-1'>{{++$no}}</td>
                            <td class='m-1 p-1'>{{$pr->operation->operationid}}</td>
                            <td class='m-1 p-1'>{{$pr->fonumber}}</td>
                            <td class='m-1 p-1'>{{$pr->plate_number}}</td>
                            <td class='m-1 p-1'>{{$pr->DateDispach}}</td>
                            <td class='m-1 p-1'>{{$pr->orgion->name}}</td>
                            <td class='m-1 p-1'>{{$pr->destination->name}}</td>
                            <td class='m-1 p-1'>{{$pr->CargoVolumMT}}</td>
                            <td class='m-1 p-1'>{{number_format($pr->tonkm,2)}}</td>
                            <td class='m-1 p-1'>{{$pr->DistanceWCargo}}</td>
                            <td class='m-1 p-1'>{{$pr->DistanceWOCargo}}</td>
                            <td class='m-1 p-1'>{{number_format($pr->totalkm,2)}}</td>
                            <td class='m-1 p-1'>{{$pr->tariff}}</td>
                            <td class='m-1 p-1 text-right'>{{number_format($pr->revenue,2)}}</td>


                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class='m-1 p-1 text-center' colspan="19">No Data Avilable</td>
                        </tr>
                        @endif

                    </tbody>

                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>

    </div>
</div>
@endsection
@section('javascript')

<script>
    $( document ).ready( function () {
		$('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
				$( '#drivers' ).DataTable({
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"pageLength": 25,
					'columnDefs': [ {
						// 'targets': [16,17,18], /* column index */
						'orderable': false, /* true or false */

				}]
				});
			} );
</script>

@endsection
