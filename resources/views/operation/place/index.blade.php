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
							class="fafa-plus mr-1"></i>Add Place</a>

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
                            @can('operation_place edit')
                            <th>Edit</th>
                            @endcan
                            @can('operation_place delete')
                            <th>Delete</th>
                            @endcan

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
                            @can('operation_place edit')
							<td class='m-1 p-1 text-center'><a href="{{route('place.edit',['id'=> $place->id])}}"
									><i class="fa fa-edit"> </i></a>
                            </td>
                            @endcan
                            @can('operation_place delete')
							<td class='m-1 p-1 text-center'>
                                <form action="{{route('place.destroy',['id'=> $place->id])}}"
									id="detach-form-{{$place->id}}" style="display: none" method="POST">
									@csrf @method('DELETE')
								</form>
								<button type="submit"  onclick="if(confirm('Are you sure to Delete this?')){
                            event.preventDefault();
                            document.getElementById('detach-form-{{$place->id}}').submit();
                        }else{
                            event.preventDefault();
                        }"> <i class="fa fa-trash red"> </i>
							</button>
                        </td>
                        @endcan



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
