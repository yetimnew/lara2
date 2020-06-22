@extends( 'master.app' )
@section( 'title', 'TIMS | Permission' )
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Customer</li>
</ol>

<div class="row col-12">
    <div class="card col-md-12">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Permissions </h2>
                @can('truck_model create')
                <div class="ml-auto">
                    <a href="{{ route('permission.create') }}" class=" btn btn-outline-primary">Add Permission</a></h1>

                </div>
                @endcan
            </div>
        </div>
        <div class=" card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-striped" id="permmission">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Permissions</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td class='p-1'>{{++$no }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class='m-1 p-1 text-center'><a
                                    href="{{route('permission.edit',['id'=> $permission->id])}}">
                                    <i class="fa fa-edit "></i> </a>
                            </td>
                            <td class='m-1 p-1 text-center '>
                                <form action="{{route('permission.destroy',['id'=> $permission->id])}}"
                                    id="delete-form-{{$permission->id}}" style="display: none">
                                    @csrf @method('DELETE')
                                </form>

                                <button type="submit" onclick="if(confirm('Are you sure to delete this?')){
		   event.preventDefault();
		   document.getElementById('delete-form-{{$permission->id}}').submit();
		 }else{
		  event.preventDefault();
		 }"> <i class="fa fa-trash red"></i>
                            </td>
                        </tr>
                        @endforeach
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
				$( '#permmission' ).DataTable({
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
