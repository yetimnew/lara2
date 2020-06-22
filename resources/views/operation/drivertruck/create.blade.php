@extends( 'master.app' )
@section( 'title', 'TIMS |Driver Truck' )

@section( 'content' )
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Driver And Truck </li>
</ol>
<div class="col-md-12">
	@include('master.error') {{-- @include('master.success') --}}
	<div class="card text-left">
		<div class="card-header">

			<div class="d-flex align-items-center">
				<h2>Truck And Driver Registration</h2>
				<div class="ml-auto">
					<a href="{{route('drivertruck')}}" class="btn btn-outline-primary">
						<i class="fa fa-caret-left mr-1" aria-hidden="true"></i>Back</a>


				</div>
			</div>
		</div>

{{-- {{dd($drivers)}} --}}
		<div class="card-body">
			<form method="post" action="{{route('drivertruck.store')}}" class="form-horizontal"
				id="driver_truck_create">
				@csrf
				<div class="row">
					<div class="col-md-6">
						<div class="form-group required">
							<label class="control-label">Plate Number</label>

							<select name="plate" id="plate"
								class="form-control {{ $errors->has('plate') ? ' is-invalid' : '' }}"
								onfocusout="validatePlate()">
								<option class="dropup" value=""> Select One</option>
								@foreach ($trucks as $truck)
								<option class="dropup" value="{{$truck->id}}|{{$truck->plate}}"> {{$truck->plate}} </option>

								@endforeach

							</select>
							@if ($errors->has('plate'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('plate') }}</strong>
							</span>
							@endif
							<span class="invalid-feedback" role="alert"></span>
						</div>

						<div class="form-group required">

							<label class="control-label">Driver Name</label>

							<select name="dname" class="form-control {{ $errors->has('dname') ? ' is-invalid' : '' }}"
								id="dname" onfocusout="validateDname()">
								<option class="dropup" value=""> Select One</option>
								@foreach ($drivers as $dr)
							<option class="dropup" value="{{$dr->id}}|{{$dr->driverid}}"> {{$dr->name}} </option>
								@endforeach

							</select>
							@if ($errors->has('dname'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('dname') }}</strong>
							</span>
							@endif
							<span class="invalid-feedback" role="alert"></span>
						</div>


						<div class="form-group required">
							<label class="control-label">Date Recived</label>
							<div class="input-group">
								<input name="rdate" type="text"
									class="form-control {{ $errors->has('rdate') ? ' is-invalid' : '' }}" id="rdate"
									value="{{ old('rdate' ) }}" onfocusout="validateRdate()">
								<div class="input-group-append">
									<button type="button" id="toggle" class="input-group-text">
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</button>
								</div>
								@if($errors->has('rdate'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('rdate') }}</strong>
								</span>
								@endif
								<span class="invalid-feedback" role="alert"></span>
							</div>
						</div>


						<div class="form-group ">
							<button type="submit" class="btn btn-primary" name="save">Save</button>

						</div>

					</div>

			</form>

		</div>
	</div>
	<div class="card-footer">
		the footer
	</div>

</div>
</div>

@endsection

@section( 'javascript' )
<script type="text/javascript">
	jQuery.datetimepicker.setDateFormatter('moment');
		  $("#rdate").datetimepicker({
		timepicker:false,
		datepicker:true,
		format: "Y-M-D"
		// format: "YYYY-MM-DD H:mm a"
		// autoclose: true,
		// todayBtn: true,
		// startDate: "2013-02-14 10:00",
		// minuteStep: 10
		// Step: 30,
	});
	$('#toggle').on('click', function(){
		$("#rdate").datetimepicker('toggle');
	})

</script>
<script>
const plate = document.getElementById( 'plate' );
const dname = document.getElementById( 'dname' );
const rdate = document.getElementById( 'rdate' );

// const rdate = document.getElementById( 'rdate' );

const driver_truck_create = document.getElementById( 'driver_truck_create' );

driver_truck_create.addEventListener( 'submit', function ( event ) {
event.preventDefault();
if (
validatePlate() &&
validateDname() &&
validateRdate()
) {
driver_truck_create.submit();
} else {
return false;
}
} );


function validatePlate() {
if ( checkIfEmpty( plate ) ) {
return false;
} else {
return true;
}
}
function validateDname() {
if ( checkIfEmpty( dname ) ) {
return false;
} else {
return true;
}
}

function validateRdate() {
if ( checkIfEmpty( rdate ) ) {
return false;
} else {
return true;
}
}

</script>

@endsection
