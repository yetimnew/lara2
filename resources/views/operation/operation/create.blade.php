@extends( 'master.app' )
@section( 'title', 'TIMS | Operation Create ' )
@section( 'content' )
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
		</li>
		<li class="breadcrumb-item ">Operations</li>
		<li class="breadcrumb-item active">Operation</li>
	</ol>


<div class="col-md-12">
	{{-- @include('master.error')  --}}
	{{-- @include('master.success') --}}
	<div class="card text-left">
		<div class="card-header">
			<h2>Operation Registration</h2>
		</div>
		<div class="card-body">
		
			<form method="post" action="{{route('operation.store')}}" class="form-horizontal" id="operation_reg_form" novalidate>
				@csrf
				@include('operation.operation.form')

						<div class="form-group required pull-right">
							<button type="submit" class="btn btn-primary" name="save" >Save</button>
						</div>

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

@section( 'javascript' )
@endsection