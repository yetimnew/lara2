@extends( 'master.app' )
@section( 'title', 'TIMS | Place ' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item"><a href="">Operations</a>
	</li>
	<li class="breadcrumb-item active">Operation Place</li>
</ol>


<div class="row col-md-12">
	<div class="card col-md-12">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h2>All Places </h2>
				@can('operation_place create')
				<div class="ml-auto">
					<a href="{{route('place.create')}}" class="btn btn-outline-primary"><i
							class="fas fa-plus mr-1"></i>Add Place</a>

				</div>
				@endcan
			</div>
		</div>

		<div class="card-body">
			<div class="table-responsive text-nowrap">
				<table class="table table-bordered table-sm table-striped" id="place">
					<thead>
						<tr>
							<th>no</th>
							<th>Place Name</th>
							<th>Region Name</th>
							<th>Comment</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tbody>
						@if ($places->count()> 0)
						@foreach ($places as $place)
						<tr>
							<td class='m-1 p-1'>{{$place->id}}</td>
							<td class='m-1 p-1'>{{$place->name}}</td>
							<td class='m-1 p-1'>{{$place->region->name}}</td>
							<td class='m-1 p-1'>{{$place->comment}}</td>
							<td class='m-1 p-1'><a href="{{route('place.edit',['id'=> $place->id])}}"
									class="btn btn-info btn-sm"><i class="fas fa-edit"> </i></a>
							</td>
							<td class='m-1 p-1'>


								<form action="{{route('place.destroy',['id'=> $place->id])}}"
									id="detach-form-{{$place->id}}" style="display: none">
									@csrf @method('DELETE')
								</form>
								<button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure to Delete this?')){
                            event.preventDefault();
                            document.getElementById('detach-form-{{$place->id}}').submit();
                        }else{
                            event.preventDefault();
                        }"> <i class="fas fa-trash"> </i>
							</td>
							</button>



						</tr>

						@endforeach @else
						<tr>
							<td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
						</tr>
						@endif

					</tbody>
				</table>
				<div class="card-footer">

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('javascript')
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
	$( document ).ready( function () {
				$( '#place' ).DataTable();
			} );
</script>
@endsection