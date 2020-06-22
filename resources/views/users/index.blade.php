@extends( 'master.app' )
@section( 'title', 'TIMS | Users' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Customer</li>
</ol>

<div class="row col-12">
	<div class="col-10">
	</div>
	<div class="col-2">
		<a href="{{route('user.create')}}" class="btn btn-primary"> <i class="fafa-plus    "></i> Add User</a>
		{{-- <button class="btn btn-default pull-right" onclick="exportTableToExcel('user', 'members-data')"><img src="../img/xls.png" width="24" class="mr-2">Export To Excel</button> --}}
	</div>
</div>



<div class="row col-12">
	<table class="table table-bordered table-sm table-striped" id="user">
		<thead>
			<tr>
				<th width="1%">Number</th>
				<th width="3%">Image</th>
				{{-- <th class="text-center">Users Name</th> --}}
				<th class="text-center" width="5%">Namel</th>
				<th class="text-center" width="5%">Email</th>
				{{-- <th>Date/Time Added</th> --}}
				<th width="5%">Is admin</th>
				<th width="5%"> Roles</th>
				<th>Roles </th>
				<th>is Online </th>
				<th width="5%">Edit</th>
				<th width="5%">Delete</th>

			</tr>
		</thead>
		<tbody>
			{{-- {{ dd($users)}} --}}
			<?php $no = 0 ?>
			@if ($users->count()> 0)
            @foreach ($users as $user)
         	<tr>
				<td>{{++$no}}</td>

				<td> <img src="{{asset($user->profile->image)}}" alt="" width="50" height="50" class="rounded-circle"
						alt="{{$user->name}}"></td>
				{{-- <td>{{$user->profile->id}}</td> --}}
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->active}}</td>
				<td>{{$user->roles()->pluck('name')->implode(' ')}}</td>
                <td>{{$user->permissions()->pluck('name')->implode(' , ')}}</td>

                <td>
               @if ($user->isOnline())
               <p class="text-success">Online</p>
               @else
               <p class="text-danger">Offline</p>
               @endif
                </td>
				<td class='m-1 p-1 text-center'><a href="{{route('user.edit',['id'=> $user->id])}}"><i
							class="fa fa-edit "></i> </a>
				</td>

				<td class='m-1 p-1 text-center' data-toggle="tooltip" data-placement="top" title="Delete">

					<form action="{{route('user.destroy',['id'=> $user->id])}}" id="detach-form-{{$user->id}}"
						style="display: none">
						@csrf
						@method('DELETE')
					</form>

					<button type="submit" class="btn btn-sm" id="first" onclick="if(confirm('Are you sure to Delete this?')){
						event.preventDefault();
						document.getElementById('detach-form-{{$user->id}}').submit();
					}else{
						event.preventDefault();
					}"> <i class="fa fa-trash red"> </i>
					</button>
				</td>

			</tr>

			@endforeach @else
			<tr>
				<td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
			</tr>
			@endif

		</tbody>
	</table>

	@endsection
	@section('javascript')

	<script>
		$( document ).ready( function () {
				$( '#user' ).DataTable();
			} );


	</script>

	@endsection
