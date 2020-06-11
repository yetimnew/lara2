@extends( 'master.app' )
@section( 'title', 'TIMS | Distance' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Driver</li>
</ol>

<div class="col-md-12">
	<div class="card text-left col-md-12">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h2>City and There distance </h2>
				@can('distance create')
				<div class="ml-auto">

					<a href="{{route('distance.create')}}" class="btn btn-outline-primary"><i
							class="fafa-plus mr-1"></i>Add Distance</a>
				</div>
				@endcan
			</div>
		</div>

		<div class="card-body">
			<div class="table-responsive text-nowrap">
				<table class="table-sm table table-bordered table-sm table-striped" id="distances">
					<thead>
						<tr>
							<th class="m-1 b-1" width="3%">No</th>
							{{-- <th class="m-1 b-1">Origin ID </th> --}}
							<th class="m-1 b-1">Origin Name </th>
							{{-- <th class="m-1 b-1"> Destination ID</th> --}}
							<th class="m-1 b-1"> Destination Name</th>
							<th class="m-1 b-1"> Distance KM</th>

							@can('distance edit')
							<th class="m-1 b-1" width="3%">Edit</th>
							@endcan
							@can('distance delete')
							<th class="m-1 b-1" width="3%">Delete</th>
							@endcan


						</tr>
					</thead>
					<tbody>
						<?php $no = 0 ?>
						@if ($distances->count()> 0)
						@foreach ($distances as $distance)
						<tr>

							<td class='p-1'>{{++$no}}</td>
							{{-- <td class='p-1'>{{$distance->origin_id}}</td> --}}
							<td class='p-1'>{{$distance->origin_name}}</td>
							{{-- <td class='p-1'>{{$distance->destination_id}}</td> --}}
							<td class='p-1'>{{$distance->destination_name}}</td>
							<td class='p-1 text-center'>{{$distance->km}}</td>

							@can('distance edit')
							<td class='p-1 text-center' data-toggle="tooltip" data-placement="top" title="Edit"><a
									href="{{route('distance.edit',['id'=> $distance->id])}}"><i
										class="fa fa-edit"></i></a>
							</td>
							@endcan
							@can('distance delete')

							<td class='p-1 text-center' data-toggle="tooltip" data-placement="top" title="Delete">

								<form action="{{route('distance.destroy',['id'=> $distance->id])}}"
									id="delete-form-{{$distance->id}}" style="display: none">
									@csrf
									@method('DELETE')
								</form>
								<button class="btn btn-sm" type="submit" onclick="if(confirm('Are you sure to delete this?')){
								event.preventDefault();
								document.getElementById('delete-form-{{$distance->id}}').submit();
									}else{
										event.preventDefault();
									}"> <i class="fa fa-trash red"></i>
								</button>
							</td>
							@endcan


						</tr>
						{{-- @endcan --}}
						@endforeach
						@else
						<tr>
							<td class='m-1 p-1 text-center' colspan="15">No Data Avilable</td>
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
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
	$(document).ready( function () {
				$('#distances').DataTable();
			} );
</script>
@endsection
