@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Create' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
 @endsection
  @section('content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Performance</li>
</ol>

<div class="row col-12">
	<h3 class="text-center"> REPORT : Performance By Driver</h3>
	<div class="col-10">
		<form method="post" action="{{route('performance_by_driver.store')}}" class="form-horizontal" id="truck_form">
			@csrf

			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					<div class="form-row">
						<div class="form-group col-md-5">
							<label for="inputCity">Start Date</label>
							<input id="startDate" name="startDate" type="date" placeholder="Start Date"
								class="form-control" required>
						</div>
						<div class="form-group col-md-5">
							<label for="inputState">Start Date</label>
							<input id="endDate" name="endDate" type="date" placeholder="End Date" class="form-control"
								required>

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
{{dd($dt)}}
<div class="row col-12">
	<div class="table-responsive text-nowrap">
		<table class="table table-bordered table-sm table-striped" id="drivers">
			<thead>
				<tr>
					<th>No</th>
					<th>Driver Name</th>
					<th>Trip</th>
					<th>Tonage</th>
					<th>Tone K/m</th>
					<th>D without cargo </th>
					<th>VolumMT</th>
					<th>fuel/Litter</th>
					<th>fuel/Birr</th>
					<th>perdiem</th>
					<th>work On Going</th>
					{{--
					<th>Detail</th> --}}

				</tr>
			</thead>
			<tbody>
				<?php $no = 0 ?> {{-- {{ dd($performances->drivers->nam) }} --}} @if ($tds->count()> 0) @foreach ($tds
				as $td)
				<tr>
					<td class='m-1 p-1 text-center'>{{++$no}}</td>
					<td class='m-1 p-1 text-center'>{{$td->name}}</td>
					<td class='m-1 p-1 text-center'>{{$td->fo}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->CargoVolumMT,2)}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->tonkm,2)}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->TDWC,2)}}</td>

					<td class='m-1 p-1 text-center'>{{ number_format( $td->TDWOC,2)}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->fB,2)}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->perdiem,2)}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->workOnGoing,2)}}</td>
					<td class='m-1 p-1 text-center'>{{ number_format( $td->other,2)}}</td>

				</tr>

				@endforeach @else
				<tr>
					<td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
				</tr>
				@endif

			</tbody>

			</tbody>
		</table>

		@endsection @section('javascript')
		<script src="{{ asset('js/jquery.dataTables.min.js') }}">
		</script>
		<script>
			$( document ).ready( function () {
				$( '#drivers' ).DataTable();

			} );
		</script>
		@endsection
