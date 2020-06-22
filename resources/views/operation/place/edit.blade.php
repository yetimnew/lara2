@extends( 'master.app' )
@section( 'title', 'TIMS | Place Edit ' )
@section( 'content' )
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
		</li>
		<li class="breadcrumb-item"><a href="">Operations</a>
		</li>
		<li class="breadcrumb-item active">Operation Place Edit</li>
	</ol>

<div class="col-md-12">
	{{-- @include('master.error') --}}
	{{-- @include('master.success') --}}
	<div class="card text-left">
		<div class="card-header">
			<h2>Edit Operational Place </h2>
		</div>
		<div class="card-body">
			<form method="post" action="{{route('place.update',['id'=>$place->id])}}" class="form-horizontal" id="place_reg">
				@csrf
				@include('operation.place.form')

						<div class="form-group required">
							<button type="submit" class="btn btn-primary" name="save">Save</button>


						</div>

					</div>
                </form>


                <div class="card-footer">
                    the footer
                </div>
		</div>
	</div>




@endsection
