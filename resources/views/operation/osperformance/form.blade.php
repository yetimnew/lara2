<div class="row">
    <div class="col-md-6">
        <div class="row">

            <div class="col-md-6 m-0 p-0">
                <div class="form-group required">
                    <label class="control-label">Is that A trip?</label>
                    <select name="trip" class="form-control select  {{ $errors->has('trip') ? ' is-invalid' : '' }}"
                        id="trip" onfocusout="validateTrip()">
                        @if ($osperformance->trip == 0)
                        <option class="dropup" value="0" selected> No, I is not </option>
                        <option class="dropup" value="1">Yes, Trip </option>
                        @endif
                        @if ($osperformance->trip == 1)
                        <option class="dropup" value="0"> No, I is not </option>
                        <option class="dropup" value="1" selected>Yes, Trip </option>
                        @endif
                    </select>
                    @if ($errors->has('trip'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('trip') }}</strong>
                    </span>
                    @endif
                    <span class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="col-md-6 m-0">
                <div class="form-group required">
                    <label class="control-label">Cargo Type</label>
                    <select name="chinet" class="form-control select  {{ $errors->has('chinet') ? ' is-invalid' : '' }}"
                        id="chinet" onfocusout="validateChinet()">
                        @if ($osperformance->LoadType == 0)
                        <option class="dropup" value="0" selected> Commercial Cargo </option>
                        <option class="dropup" value="1"> Relief Cargo</option>
                        @endif
                        @if ($osperformance->LoadType == 1)
                        <option class="dropup" value="1" selected> Relief Cargo</option>
                        <option class="dropup" value="0">Commercial Cargo</option>
                        @endif
                    </select>
                    @if ($errors->has('chinet'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('chinet') }}</strong>
                    </span>
                    @endif
                    <span class="invalid-feedback" role="alert"></span>
                </div>
            </div>

        </div>
        <div class="form-group required">
            {{-- {{ dd( $cusotmers)}} --}}
            <label class="control-label" for="customer">OS Customer Name</label>
            <select name="custormer" class="form-control {{ $errors->has('custormer') ? ' is-invalid' : '' }} select"
                id="custormer" value="" onfocusout="validatecustormer()">
                <option class="dropup" value=""> Select One</option>

                @foreach ($cusotmers as $os)
                <option class="dropup" value="{{$os->id}}"
                    {{ $os->id == $osperformance->outsource_id ? 'selected' : '' }}>
                    {{ $os->name}}
                </option>

                @endforeach
            </select>
            @if ($errors->has('custormer'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('custormer') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>

        </div>
        <div class="form-group required">
            <label class="control-label">FO Number</label>
            <div class="input-group">
                <input name="fo" type="text" required class="form-control {{ $errors->has('fo') ? ' is-invalid' : '' }}"
                    id="fo" placeholder="Fright order number" value="{{ old('fo') ?? $osperformance->fonumber }}"
                    onfocusout="validateFo()">
                @if ($errors->has('fo'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fo') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>

        </div>
        <div class="form-group required">
            <label class="control-label">Operation ID</label>
            <select name="operation" class="form-control {{ $errors->has('operation') ? ' is-invalid' : '' }} select"
                id="operation" value="" onfocusout="validateOperation()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($operations as $operation)
                <option class="dropup" value="{{$operation->id}}"
                    {{ $operation->id == $osperformance->operation_id ? 'selected' : '' }}> {{ $operation->operationid}}
                </option>

                @endforeach
            </select>
            @if ($errors->has('operation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('operation') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>


        </div>



        <div class="form-group required">
            <label class="control-label" for="driver_name">Driver Name</label>
            <div class="input-group">
                <input name="driver_name" type="text"
                    class="form-control {{ $errors->has('driver_name') ? ' is-invalid' : '' }}" id="driver_name"
                    value="{{ old('driver_name' ) ?? $osperformance->driver_name}}" onfocusout="validatedriver_name()">

                @if($errors->has('driver_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('driver_name') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group required">
            <label class="control-label" for="plate_number">Plate Number</label>
            <div class="input-group">
                <input name="plate_number" type="text"
                    class="form-control {{ $errors->has('plate_number') ? ' is-invalid' : '' }}" id="plate_number"
                    value="{{ old('plate_number' ) ?? $osperformance->plate_number}}"
                    onfocusout="validateplate_number()">

                @if($errors->has('plate_number'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('plate_number') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group required">
            <label class="control-label">Date Dispach</label>
            <div class="input-group">
                <input name="ddate" type="text" class="form-control {{ $errors->has('ddate') ? ' is-invalid' : '' }}"
                    id="ddate" value="{{ old('ddate' ) ?? $osperformance->DateDispach}}" onfocusout="validateDdate()">
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
        <div class="row ">
            <div class="col-md-6">
                <div class="form-group required">
                    <label class="control-label">Cargo Volume In Tone</label>
                    <div class="input-group">

                        <input name="cargovol" type="number"
                            class="form-control {{ $errors->has('cargovol') ? ' is-invalid' : '' }}" id="cargovol"
                            value="{{ old('cargovol') ?? $osperformance->CargoVolumMT}}" min="1"
                            onfocusout="validateCargovol()">
                        @if($errors->has('cargovol'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cargovol') }}</strong>
                        </span>
                        @endif
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group required">
                    <label class="control-label">Tariff</label>
                    <div class="input-group">
                        <input name="tariff" type="text"
                            class="form-control {{ $errors->has('tariff') ? ' is-invalid' : '' }}" id="tariff"
                            value="{{ old('tariff') ?? $osperformance->tariff}}" onfocusout="validateTariff()">
                        @if($errors->has('tariff'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tariff') }}</strong>
                        </span>
                        @endif
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">



        <div class="form-group required">
            <label class="control-label">Origion Place</label>
            <select name="origion" class="form-control{{ $errors->has('origion') ? ' is-invalid' : '' }} select"
                id="origion" onfocusout="validateOrigion()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($place as $operation)
                <option class="dropup"
                    value="{{ $operation->id}}  @if(old('origion') == $operation->id) {{ 'selected' }} @endif"
                    {{$operation->id == $osperformance->orgion_id ? 'selected' : '' }}> {{ $operation->name}} </option>
                @endforeach
            </select>
            @if ($errors->has('origion'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('origion') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>
        <div class="form-group required">
            <label class="control-label">Destination Place</label>
            <select name="destination"
                class="form-control {{ $errors->has('destination') ? ' is-invalid' : '' }} select" id="destination"
                onfocusout="validateDestination()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($place as $operation)
                <option class="dropup" value="{{$operation->id}}"
                    {{$operation->id == $osperformance->destination_id ? 'selected' : '' }}> {{$operation->name}}
                </option>
                @endforeach
            </select>
            @if ($errors->has('destination'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('destination') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>

        <button type="button" id="viewDistance">Calculate Distance</button> <span class="badge badge-dark"
            id="something"></span>
        <div class="form-group required">
            <label class="control-label">Distance with cargo</label>
            <div class="input-group">
                <input name="diswc" type="number" class="form-control {{ $errors->has('diswc') ? ' is-invalid' : '' }}"
                    id="diswc" value="{{ old('diswc') ?? $osperformance->DistanceWCargo}}" min="1"
                    onfocusout="validateDisw()">
                @if ($errors->has('diswc'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('diswc') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Distance without cargo</label>
            <div class="input-group">
                <input name="diswoc" type="number"
                    class="form-control {{ $errors->has('diswoc') ? ' is-invalid' : '' }}" id="diswoc"
                    value="{{ old('diswoc') ?? $osperformance->DistanceWOCargo}}" min="1" onfocusout="validateDiswoc()">
                @if($errors->has('diswoc'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('diswoc') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Tone KM </label>
            <div class="input-group">
                <input name="tonkm" type="number" class="form-control {{ $errors->has('tonkm') ? ' is-invalid' : '' }}"
                    id="tonkm" value="{{ old('tonkm') ?? $osperformance->tonkm}}" min="1"
                    onfocusout="calculatedTonkm()">
                @if($errors->has('tonkm'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tonkm') }}</strong>
                </span>
                @endif'
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <button type="button" id="calculateTonkm" class="btn btn-outline-dark btn-sm">calculate</button>

        <div class="form-group">
            <label class="control-label">Comment</label>
            <textarea name="comment" rows="5" class="form-control {{ $errors->has('comment') ? ' is-invalid' : '' }}"
                id="comment">{{$osperformance->comment}}</textarea>
            @if ($errors->has('comment'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('comment') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>


        @section( 'javascript' )

        <script>
            jQuery.datetimepicker.setDateFormatter('moment');
                 $("#ddate").datetimepicker({
                timepicker:true,
                datepicker:true,
                format: "YYYY-MM-DD H:mm:ss"
            });
            $('#toggle').on('click', function(){
                $("#ddate").datetimepicker('toggle');
            })
            jQuery.datetimepicker.setDateFormatter('moment');
		 $("#r_date").datetimepicker({
		timepicker:true,
		datepicker:true,
		// format: "Y-M-d"
		format: "YYYY-MM-DD H:mm:ss"

	});
            $('#toggle2').on('click', function(){
                $("#r_date").datetimepicker('toggle');
            })



        </script>
        <script>
            const chinet = document.getElementById( 'chinet' );
                const trip = document.getElementById( 'trip' );
                const fo = document.getElementById( 'fo' );
                const custormer = document.getElementById( 'custormer' );
                const operation = document.getElementById( 'operation' );
                const driver_name = document.getElementById( 'driver_name' );
                const plate_number = document.getElementById('plate_number' );
                const ddate = document.getElementById( 'ddate' );
                const cargovol = document.getElementById('cargovol' );
                const tariff = document.getElementById('tariff' );
                const origion = document.getElementById( 'origion' );
                const destination = document.getElementById( 'destination' );
                const diswc = document.getElementById( 'diswc' );
                const diswoc = document.getElementById( 'diswoc' );
                const osperformance_edit_form = document.getElementById( 'osperformance_edit_form' );


	osperformance_edit_form.addEventListener( 'submit', function ( event ) {
		event.preventDefault();
		if ( validateTrip() &&
		    validateChinet() &&
			validatecustormer() &&
			validateFo() &&
			validateOperation() &&
			validatedriver_name() &&
			validateplate_number() &&
			validateDdate() &&
			validateCargovol() &&
			validateTariff() &&
			validateOrigion() &&
			validateDestination() &&
			validateDisw() &&
			validateDiswoc()

		) {
			osperformance_edit_form.submit();
		} else {
			return false;
		}
    } );


	// Validator functions
	function newTonkm() {

  let loadedkm =  diswc.value;
  let toneage=   tonkm.cargovol;
  let totla = loadedkm  * toneage;
  console.log(loadedkm)
	}
	function validateTrip() {
		if ( checkIfEmpty( trip ) ) {
			return false;
		} else {
			return true;
		}
	}
	function calculatedTonkm() {
		if ( checkIfEmpty( tonkm ) ) {
			return false;
		} else {
			return true;
		}
	}
	function validateChinet() {
		if ( checkIfEmpty( chinet ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateFo() {
        if ( checkIfEmpty( fo ) ) {
            return false;
		}
		if ( !meetLength( fo, 2, 50 ) ) {
            return false;
		} else {
            return true;

		}

	}

	function validateTariff() {
        if ( checkIfEmpty( tariff ) ) {
            return false;
		}
		if ( !meetLength( tariff, 0.255, 8.0000 ) ) {
            return false;
		} else {
            return true;

		}

	}
    function validatecustormer() {
        if ( checkIfEmpty( custormer ) ) {
            return false;
        } else {
            return true;
        }
    }


	function validateOperation() {
		if ( checkIfEmpty( operation ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateplate_number() {
		if ( checkIfEmpty( plate_number ) ) {
			return false;
		} else {
			return true;
		}
    }

	function validatedriver_name() {
		if ( checkIfEmpty( driver_name ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateDriver() {
		if ( checkIfEmpty( driver ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateDdate() {
		if ( checkIfEmpty( ddate ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateOrigion() {
		if ( checkIfEmpty( origion ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateDestination() {
		if ( checkIfEmpty( destination ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateDisw() {

		if ( !minmax( diswc, 0, 3000 ) ) {
			return false;
		} else {
			return true;

		}

	}

	function validateDiswoc() {

		if ( !minmax( diswoc, 0, 3000 ) ) {
			return false;
		} else {
			return true;

		}

	}

	function validateCargovol() {

		if ( !minmax( cargovol, 0, 80 ) ) {
			return false;
		} else {
			return true;

		}
	}


        </script>
        <script>
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });



            $("#viewDistance").click(function(e){

                // const origionval = document.getElementById('origion').value;
                const destinationval = document.getElementById( 'destination').value;
                const origionval = document.getElementById('origion').value;
                // console.log(origionval )

                var urlPath = '{{ route("performace.distance") }}';
            // console.log(urlPath)
                e.preventDefault();



                $.ajax({
                   type:'POST',
                   url: urlPath,
                   data:{
                    origion: origionval,
                    destination: destinationval
                    },
            // console.log(data)
                   success:function(data){
                    $('#diswc').val(data);
                    $('#diswoc').val(data);
                    // return data;
                    // console.log(data)

                   },
                   error: function() {
            alert('Error occured');
        },
        dataType:'text'
                });



            });
            $("#calculateTonkm").click(function(e){
                const diswccal = document.getElementById( 'diswc' ).value;
                // console.log(diswccal)
                const toncal = document.getElementById( 'cargovol' ).value;
                const tonkmcal = diswccal * toncal;
                $('#tonkm').val(tonkmcal);

            });

        </script>

        @endsection
