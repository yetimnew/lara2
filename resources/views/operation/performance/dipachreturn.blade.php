@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Create' )

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>

<div class="row col-12">
    <h3 class="text-center"> REPORT : Performances By Dispach and Retun Date</h3>
    <div class="col-10">
        <form method="post" action="{{route('performace.datediffstore')}}" class="form-horizontal" id="truck_form">
            @csrf

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCity">Start Date</label>
                            <input id="startDate" name="startDate" type="date" placeholder="Start Date"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">Start Date</label>
                            <input id="endDate" name="endDate" type="date" placeholder="End Date" class="form-control"
                                required>

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputState">How Mnay Records want</label>
                            <input id="number" name="number" type="number" min="1" placeholder="25"
                                class="form-control">

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip"></label>
                            <button class="btn btn-primary btn-block" type="submit" name="register">Search</button>
                        </div>
                    </div>

                </div>
            </div>
    </div>

</div>

<div class="col-md-12">
    <div class="card text-left">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="drivers">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>FO</th>
                            <th>Plate</th>
                            <th>Origion</th>
                            <th>Destination</th>
                            <th>Toatl KM</th>
                            <th>Dispach Date</th>
                            <th>Returnded Date</th>
                            <th>Differance </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @if ($performances->count()> 0)
                        @foreach ($performances as $pr)

                        <tr>
                            <td class='m-1 p-1'>{{++$no}}</td>
                            <td class='m-1 p-1'>{{$pr->FOnumber}}</td>
                            <td class='m-1 p-1'>{{$pr->driver_truck->plate}} : {{$pr->driver_truck->driverid}}</td>
                            <td class='m-1 p-1'>{{$pr->orgion->name}}</td>
                            <td class='m-1 p-1'>{{$pr->destination->name}}</td>
                            <td class='m-1 p-1 text-right'>{{number_format($pr->totalkm,2)}}</td>
                            <td class='m-1 p-1'>{{$pr->DateDispach}}</td>
                            <td class='m-1 p-1'>{{$pr->returned_date}}</td>
                            @if($pr->is_returned == 0)
                            <td class='m-1 p-1'><span class="badge badge-danger">Not Returned</span></td>
                            @else
                            <td class='m-1 p-1'>{{$pr->datedifference}}</td>
                            @endif

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
						'orderable': false, /* true or false */

				}]
				});
			} );
</script>

@endsection
