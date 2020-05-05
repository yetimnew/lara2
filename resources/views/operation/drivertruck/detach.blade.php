@extends( 'master.app' )
@section( 'title', 'TIMS | Driver Truck Edit ' )

@section( 'content' )
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
	</li>
	<li class="breadcrumb-item active">Driver And Truck Edit</li>
</ol>
<div class="col-md-12">
	{{-- @include('master.error') --}}
	{{-- @include('master.success') --}}
	<div class="card text-left">
		<div class="card-header">

		</div>


		<div class="card-header">

			<div class="d-flex align-items-center">
				<h2>Driver Truck Dettach</h2>
				<div class="ml-auto">
					<a href="{{route('drivertruck')}}" class="btn btn-outline-primary">
						<i class="fa fa-caret-left mr-1" aria-hidden="true"></i>Back</a>


				</div>
			</div>
		</div>

		<div class="card-body">
			<form method="post" action="{{route('drivertruck.update_dt',['id'=>$dts->id])}}" class="form-horizontal"
				id="driver_truck_create">
				@csrf
				<div class="row">
					<div class="col-md-6">

						<div class="form-group ">
							<label class="control-label">Plate Number</label>
							<select name="plate" class="form-control select" id="plate" readonly>
								<option class="dropup" value="{{$dts->truck_id}}|{{$dts->plate}}" selected>
									{{$dts->plate}} </option>
							</select>

							<small class="form-text text-danger" id="error_region"></small>
						</div>
						<div class="form-group ">
							<label class="control-label">Driver Name</label>

							<select name="dname" class="form-control select" id="dname" readonly>
								<option class="dropup" value="{{$dts->driver_id}}|{{$dts->driverid}}" selected>
									{{$dts->NAME}} </option>

							</select>

							<small class="form-text text-danger" id="error_region"></small>
						</div>

						<div class="form-group ">
							<label class="control-label">Recived Date</label>

							<div class="input-group"> <span class="input-group-addon"></span>
								<input name="rdate" type="date" class="form-control" id="rdate"
									value="{{$dts->date_recived }}" readonly>
							</div>

						</div>


						<div class="form-group required">
							<label class="control-label">Dettach Date</label>
							<div class="input-group">
								<input name="ddate" type="text"
									class="form-control {{ $errors->has('ddate') ? ' is-invalid' : '' }}" id="ddate"
									value="{{ old('ddate' ) }}" onfocusout="validateDdate()" required>
								<div class="input-group-append">
									<button type="button" id="toggle" class="input-group-text">
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</button>
								</div>
								@if($errors->has('ddate'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('ddate') }}</strong>
								</span>
								@endif
								<span class="invalid-feedback" role="alert"></span>
							</div>
						</div>

						<div class="form-group required">
							<label class="control-label">Reson for Detach</label>
							<div class="">
								<textarea name="comment" rows="5" class="form-control" id="comment"
									onfocusout="validateComment()" required> {{ old('comment')}}</textarea>

							</div>
						</div>

						<div class="form-group required">
							<button type="submit" class="btn btn-primary" name="save">Save</button>

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
<script type="text/javascript">
	jQuery.datetimepicker.setDateFormatter('moment');
		  $("#ddate").datetimepicker({
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
		$("#ddate").datetimepicker('toggle');
	})

</script>


@endsection
