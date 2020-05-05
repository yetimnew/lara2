@extends( 'master.app' )
@section( 'title', 'TIMS | Status Create' )


@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Statuses</a>
    </li>
    <li class="breadcrumb-item active">Status Create</li>
</ol>
<div class="col-md-12">
    @include('master.error')

    <div class="card">

        <div class="card-header">

            <div class="d-flex align-items-center">
                <h2>Daily Status Registration</h2>

                @can('status create')
                <div class="ml-auto">
                    <a href="{{route('status')}}" class="btn btn-outline-primary">
                        <i class="fa fa-caret-left mr-1" aria-hidden="true"></i>Back</a>


                </div>
                @endcan
            </div>

        </div>

        <div class="card-body">
            <form method="post" action="{{route('status.store')}}" class="form-horizontal" id="status_create">
                @csrf
                <div class="row">

                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="form-control-label col-4 text-right"> <strong>Registeration
                                    Date</strong></label>
                            <div class="input-group col-sm-8 ">
                                <input name="today" type="text"
                                    class="form-control {{ $errors->has('today') ? ' is-invalid' : '' }}" id="today"
                                    onfocusout="validateToday()" placeholder="Enter The date">

                                <div class="input-group-append">
                                    <button type="button" id="toggle" class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </button>
                                </div>

                                @if ($errors->has('today'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('today') }}</strong>
                                </span>
                                @endif

                            </div>
                            <span class="invalid-feedback" role="alert">
                        </div>

                    </div>
                </div>
                <div class="row ">
                    @foreach ($trucks as $truck)
                    <div class="col-lg-2 col-md-3 col-sm-4  p-2">
                        <input type="text" name="plate[]"
                            style="font-size: 15px; background-color: #796AEE; font-weight: 800; color: white" readonly
                            class="form-control text-center" value="{{$truck->plate}}" id="plate_id">
                        <select name="status[]" class="form-control select" id="status_{{$truck->plate}}" required>
                            <option value="" id="instatus" class="inclass"> --Select one-- </option>
                            @foreach ($statustypes as $type)
                            <option value="{{$type->id}}" id="instatus" class="inclass"> {{$type->name}}</option>
                            @endforeach
                        </select>

                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="row">

                    <div class="form-group col-md-4 mx-auto">
                        <button type="submit" class="btn btn-lg btn-outline-primary btn-block "
                            name="save">Save</button>
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
<script>
    jQuery.datetimepicker.setDateFormatter('moment');
$("#today").datetimepicker({
timepicker:false,
datepicker:true,
format: "Y-M-D"

});
$('#toggle').on('click', function(){
$("#today").datetimepicker('toggle');
})
</script>
<script>
    const today = document.getElementById( 'today' );

	// const today = document.getElementById( 'today' );
	const status_create = document.getElementById( 'status_create' );

		status_create.addEventListener( 'submit', function ( event ) {
			event.preventDefault();
			if (
				validateToday()

			) {
				status_create.submit();
			} else {
				return false;
			}
		} );


		function validateToday() {
			if ( checkIfEmpty( today ) ) {
				return false;
			} else {
				return true;
			}
		}

</script>

@endsection
