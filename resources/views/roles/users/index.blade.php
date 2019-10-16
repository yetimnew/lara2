@extends( 'master.app' )
@section( 'title', 'TIMS | Customer' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Customer</li>
</ol>
<div class="col-lg-10 col-lg-offset-1">
	<h1><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}"
			class="btn btn-default pull-right">Roles</a>
		<a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
	<hr>
	<div class="table-responsive">
		<table class="table table-bordered table-striped">

			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Date/Time Added</th>
					<th>User Roles</th>
					<th>Operations</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($users as $user)
				<tr>

					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
					<td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
					{{-- Retrieve array of roles associated to a user and convert to string --}}
					<td>
						<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left"
							style="margin-right: 3px;">Edit</a>

						{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}

					</td>
				</tr>
				@endforeach
			</tbody>

		</table>
	</div>

	<a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>

</div>


@endsection
@section('javascript')
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
	$( document ).ready( function () {
				$( '#customer' ).DataTable();
			} );
</script>
@endsection