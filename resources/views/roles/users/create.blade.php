@extends( 'master.app' )
@section( 'title', 'TIMS | Customer Create' )

@section( 'content' )
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Customer Create</li>
</ol>

<div class='col-lg-4 col-lg-offset-4'>

	<h1><i class='fa fa-user-plus'></i> Add User</h1>
	<hr>

	{{ Form::open(array('url' => 'users')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', '', array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email', '', array('class' => 'form-control')) }}
	</div>

	<div class='form-group'>
		@foreach ($roles as $role)
		{{ Form::checkbox('roles[]',  $role->id ) }}
		{{ Form::label($role->name, ucfirst($role->name)) }}<br>

		@endforeach
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password') }}<br>
		{{ Form::password('password', array('class' => 'form-control')) }}

	</div>

	<div class="form-group">
		{{ Form::label('password', 'Confirm Password') }}<br>
		{{ Form::password('password_confirmation', array('class' => 'form-control')) }}

	</div>

	{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

</div>

@endsection