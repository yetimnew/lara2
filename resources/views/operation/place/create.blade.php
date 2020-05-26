@extends( 'master.app' )
@section( 'title', 'TIMS | Place Create ' )
@section( 'content' )
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item"><a href="">Operations</a>
	</li>
	<li class="breadcrumb-item active">Operation Place Create</li>
</ol>

<div class="col-md-12">
	<div class="card text-left">
		<div class="card-header">
			<div class="d-flex">
				<h2>Operational Place Registration</h2>
				<div class="ml-auto">
					<a href="{{route('place')}}" class="btn btn-outline-primary"> <i class="fa fa-backward mr-1"
							aria-hidden="true"> Back</i> </a>
				</div>
			</div>
		</div>

		<div class="card-body">
			<form method="post" action="{{route('place.store')}}" class="form-horizontal" id="place_reg">
				@csrf
				@include('operation.place.form')
				<div class="form-group required">
					<button type="submit" class="btn btn-primary" name="save">Save</button>


				</div>

		</div>
		<div class="card-footer">
			the footer
		</div>

	</div>
	</form>
</div>

@endsection
