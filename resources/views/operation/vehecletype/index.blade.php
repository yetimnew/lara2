@extends( 'master.app' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<div class="row">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item "><a href="#">Truks</a>
        </li>
        <li class="breadcrumb-item active">Truks Model</li>
    </ol>
</div>

<div class="row col-md-12">
    <div class="card col-md-12">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Truck Models </h2>
                @can('truck_model create')

                <div class="ml-auto">
                    <a href="{{route('vehecletype.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i>Add vehecle Model</a>
                </div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="vehecletypes">
                    <thead>
                        <tr>
                            <th class="m-1 b-1">No</th>
                            <th class="m-1 b-1">Name/Model</th>
                            <th class="m-1 b-1">Company</th>
                            <th class="m-1 b-1">Production Date </th>
                            <th class="m-1 b-1">Comment</th>
                            @can('truck_model edit')
                            <th class="m-1 b-1">Edit</th>
                            @endcan
                            @can('truck_model delete')
                            <th class="m-1 b-1">Delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @if ($vehecletypes->count() > 0)
                        @foreach ($vehecletypes as $vehecletype)
                        <tr>
                            <td class='m-1 p-1'>{{$vehecletype->id}}</td>
                            <td class='m-1 p-1'>{{$vehecletype->name}}</td>
                            <td class='m-1 p-1'>{{$vehecletype->company}}</td>
                            <td class='m-1 p-1'>{{$vehecletype->productiondate}}</td>
                            <td class='m-1 p-1'>{{$vehecletype->comment}}</td>
                            @can('truck_model edit')
                            <td class='m-1 p-1 text-center' data-toggle="tooltip" data-placement="top" title="Edit"><a
                                    href="{{route('vehecletype.edit',['id'=> $vehecletype->id])}}"><i
                                        class="fa fa-edit"> </i></a>
                            </td>
                            @endcan
                            @can('truck_model delete')
                            <td class='m-1 p-1 text-center'>

                                <form action="{{route('vehecletype.destroy',['id'=> $vehecletype->id])}}"
                                    id="detach-form-{{$vehecletype->id}}" style="display: none">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="submit" onclick="if(confirm('Are you sure to Delete this?')){
                                event.preventDefault();
                                document.getElementById('detach-form-{{$vehecletype->id}}').submit();
                            }else{
                                event.preventDefault();
                            }"> <i class="fa fa-trash red"></i>
                                </button>
                            </td>
                            @endcan


                        </tr>

                        @endforeach @else
                        <tr>
                            <td class='m-1 p-1 text-center' colspan="7">No Data Avilable</td>
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
</div>

@endsection
@section('javascript')
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
    $( document ).ready( function () {
				$( '#vehecletypes' ).DataTable({
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"pageLength": 25,

				'columnDefs': [ {

				// 'targets': [5,6], /* column index */

				'orderable': false, /* true or false */

			}]
				});
			} );
</script>
@endsection
