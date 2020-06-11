@extends( 'master.app' )
@section( 'title', 'TIMS | Region Update' )

@section( 'content' )
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
		</li>
		<li class="breadcrumb-item"><a href="#">Operations</a>
		</li>
		<li class="breadcrumb-item active">Operational Update</li>
	</ol>
<div class="col-md-12">
	@include('master.error') {{-- @include('master.success') --}}
	<div class="card text-left">
		<div class="card-header">
			<h2>Truck Registration</h2>
		</div>
		<div class="card-body">
			<form method="post" action="{{route('region.update',['id'=>$region->id])}}" class="form-horizontal" id="truck_form">
				@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-0 required">
							<label class="control-label">Place Name</label>

							<div class="input-group"> <span class="input-group-addon"></span>
								<input name="name" type="text" autofocus class="form-control" id="name" value="{{ $region->name}}" required>
							</div>
							<small class="form-text text-danger" id="error_oid"></small>
						</div>

						<div class="form-group">
							<label class="control-label">Comments</label>
							<textarea name="comment" rows="5" class="form-control" id="comment">{{ $region->comment}} </textarea>

						</div>
						<div class="form-group required">
							<button type="submit" class="btn btn-primary" name="save">Save</button>


						</div>

					</div>
					<!--                                          the right side begins here-->
				</div>


		</div>
	</div>
	<div class="card-footer">
		the footer
	</div>

	</form>
</div>
</div>

@endsection