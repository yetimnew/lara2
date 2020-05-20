@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Edit' )
@section( 'content' )
<div class="col-md-12">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
		</li>
		<li class="breadcrumb-item active">Performance Update</li>
	</ol>

	<div class="card text-left">
		<div class="card-header">
{{-- {{dd($osperformance )}} --}}
			<div class="d-flex align-items-center">
				<h2>OS Performance Update of FO <span class="text blue"> {{$osperformance->fonumber}} </span></h2>
				@can('performance create')
				<div class="ml-auto">
					<a href="{{route('osperformance')}}" class="btn btn-outline-primary">
						<i class="fa fa-caret-left mr-1" aria-hidden="true"></i>Back</a>

				</div>
				@endcan
			</div>
		</div>
		<div class="card-body">
			<form method="POST" action="{{route('osperformance.update',['id'=>$osperformance->id])}}" class="form-horizontal"
				id="performance_edit_form" novalidate>
				@csrf
				@include('operation.osperformance.form')


				<div class="form-group float-right ">
					<button type="submit" class="btn btn-outline-primary btn-lg" name="save">
						<i class="fafa-save    "></i>
						Save</button>

				</div>


		</div>

	</div>
</div>
<div class="card-footer">
</div>

</form>
</div>
</div>

@endsection
@section( 'javascript' )
<script>

</script>

@endsection
