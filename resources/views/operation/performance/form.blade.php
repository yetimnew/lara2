<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6 m-0 p-0">
                <div class="form-group required">
                    <label class="control-label">Is that A trip?</label>
                    <select name="trip" class="form-control select  {{ $errors->has('trip') ? ' is-invalid' : '' }}"
                        id="trip" onfocusout="validateTrip()">
                        @if ($performance->trip == 0)
                        <option class="dropup" value="0" selected> No, I is not </option>
                        <option class="dropup" value="1">Yes, Trip </option>
                        @endif
                        @if ($performance->trip == 1)
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
                    <label class="control-label">Load Type</label>
                    <select name="chinet" class="form-control select  {{ $errors->has('chinet') ? ' is-invalid' : '' }}"
                        id="chinet" onfocusout="validateChinet()">
                        @if ($performance->LoadType == 0)
                        <option class="dropup" value="0" selected> Return Load </option>
                        <option class="dropup" value="1"> Main Load</option>
                        @endif
                        @if ($performance->LoadType == 1)
                        <option class="dropup" value="1" selected> Main Load</option>
                        <option class="dropup" value="0">Return Load</option>
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
            <label class="control-label">FO Number</label>
            <div class="input-group">
                <input name="fo" type="text" required class="form-control {{ $errors->has('fo') ? ' is-invalid' : '' }}"
                    id="fo" placeholder="Fright order number" value="{{ old('fo') ?? $performance->FOnumber }}"
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
                    {{ $operation->id == $performance->operation_id ? 'selected' : '' }}> {{ $operation->operationid}}
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
            <label class="control-label">Driver and Truck</label>
            <select name="truck" class="form-control {{ $errors->has('truck') ? ' is-invalid' : '' }} select" id="truck"
                onfocusout="validateTruck()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($driver_truck as $dt)
                <option class="dropup" value="{{$dt->id}}"
                    {{$dt->id == $performance->driver_truck_id ? 'selected' : '' }}>
                    {{$dt->plate}}-{{$dt->name}} {{$dt->is_attached ? '-- Att.-- ': '--Dett.--'}}
                </option>
                @endforeach
            </select>
            @if ($errors->has('truck'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('truck') }}</strong>
            </span>
            @endif

            <span class="invalid-feedback" role="alert"></span>
        </div>

        <div class="form-group required">
            <label class="control-label">Date Dispach</label>
            <div class="input-group">
                <input name="ddate" type="text" class="form-control {{ $errors->has('ddate') ? ' is-invalid' : '' }}"
                    id="ddate" value="{{ old('ddate' ) ?? $performance->DateDispach}}" onfocusout="validateDdate()">
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
            <label class="control-label">Cargo Volume In Tone</label>
            <div class="input-group">

                <input name="cargovol" type="number"
                    class="form-control {{ $errors->has('cargovol') ? ' is-invalid' : '' }}" id="cargovol"
                    value="{{ old('cargovol') ?? $performance->CargoVolumMT}}" min="1" onfocusout="validateCargovol()">
                @if($errors->has('cargovol'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cargovol') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label">Origion Place</label>
            <select name="origion" class="form-control{{ $errors->has('origion') ? ' is-invalid' : '' }} select"
                id="origion" onfocusout="validateOrigion()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($place as $operation)
                <option class="dropup"
                    value="{{ $operation->id}}  @if(old('origion') == $operation->id) {{ 'selected' }} @endif"
                    {{$operation->id == $performance->orgion_id ? 'selected' : '' }}> {{ $operation->name}} </option>
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
                    {{$operation->id == $performance->destination_id ? 'selected' : '' }}> {{$operation->name}}
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
                    id="diswc" value="{{ old('diswc') ?? $performance->DistanceWCargo}}" min="1"
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
                    value="{{ old('diswoc') ?? $performance->DistanceWOCargo}}" min="1" onfocusout="validateDiswoc()">
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
                    id="tonkm" value="{{ old('tonkm') ?? $performance->tonkm}}" min="1" onfocusout="calculatedTonkm()">
                @if($errors->has('tonkm'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tonkm') }}</strong>
                </span>
                @endif'
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <button type="button" id="calculateTonkm" class="btn btn-outline-dark btn-sm">calculate</button>
    </div>

    <div class="col-md-6">
        <legend> Expenses</legend>
        <div class="form-group">
            <label class="control-label"> Fuel In Litter</label>
            <div class="input-group">
                <input name="fuell" type="number" class="form-control {{ $errors->has('fuell') ? ' is-invalid' : '' }}"
                    id="fuell" value="{{ old('fuell') ?? $performance->fuelInLitter}}" min="1"
                    onfocusout="validateFuell()">
                @if($errors->has('fuell'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fuell') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label"> Fuel In Birr</label>
            <div class="input-group">
                <input name="fuelb" type="number" class="form-control{{ $errors->has('fuelb') ? ' is-invalid' : '' }}"
                    id="fuelb" value="{{ old('fuelb') ?? $performance->fuelInBirr}}" min="1"
                    onfocusout="validateFuelb()">
                @if($errors->has('fuelb'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('fuelb') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label"> Perdiem</label>
            <div class="input-group">
                <input name="perdiem" type="number"
                    class="form-control {{ $errors->has('perdiem') ? ' is-invalid' : '' }}" id="perdiem"
                    value="{{ old('perdiem') ?? $performance->perdiem}}" min="1" onfocusout="validatePerdiem()">
                @if($errors->has('perdiem'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('perdiem') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label">Operational Expense</label>
            <div class="input-group">
                <input name="wog" type="number" class="form-control {{ $errors->has('wog') ? ' is-invalid' : '' }}"
                    id="wog" value="{{ old('wog') ?? $performance->workOnGoing}}" min="1" onfocusout="validateWog()">
                @if($errors->has('wog'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('wog') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label"> Other Expences</label>
            <div class="input-group">
                <input name="other" type="number" class="form-control {{ $errors->has('other') ? ' is-invalid' : '' }}"
                    id="other" value="{{ old('other') ?? $performance->other}}" min="1" onfocusout="validatOther()">
                @if($errors->has('other'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('other') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <fieldset>
            <div class="form-group">
                <label class="control-label">Comment</label>
                <textarea name="comment" rows="5"
                    class="form-control {{ $errors->has('comment') ? ' is-invalid' : '' }}"
                    id="comment">{{$performance->comment}}</textarea>
                @if ($errors->has('comment'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </fieldset>

        @section( 'javascript' )
        <script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script>
        <script>
            $( document ).ready( function () {
                $('#origion').select2();
            });
            jQuery.datetimepicker.setDateFormatter('moment');
                 $("#ddate").datetimepicker({
                timepicker:true,
                datepicker:true,
                // format: "Y-M-d"
                format: "YYYY-MM-DD H:mm:ss"
                // autoclose: true,
                // todayBtn: true,
                // startDate: "2013-02-14 10:00",
                // minuteStep: 10
                // step: 30,
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
		// autoclose: true,
		// todayBtn: true,
		// startDate: "2013-02-14 10:00",
		// minuteStep: 10
		// step: 30,
	});
            $('#toggle2').on('click', function(){
                $("#r_date").datetimepicker('toggle');
            })



        </script>
        <script>
            const chinet = document.getElementById( 'chinet' );
                const trip = document.getElementById( 'trip' );
                const fo = document.getElementById( 'fo' );
                const operation = document.getElementById( 'operation' );
                const truck = document.getElementById( 'truck' );
                const ddate = document.getElementById( 'ddate' );
                const origion = document.getElementById( 'origion' );
                // const orgionIndex = origion.options[origion.selectedIndex].value;

                const destination = document.getElementById( 'destination' );
                // const destinationIndex = destination.options[destination.selectedIndex].value;

                const diswc = document.getElementById( 'diswc' );
                const diswoc = document.getElementById( 'diswoc' );
                const cargovol = document.getElementById( 'cargovol' );
                const fuell = document.getElementById( 'fuell' );
                const fuelb = document.getElementById( 'fuelb' );
                const perdiem = document.getElementById( 'perdiem' );
                const wog = document.getElementById( 'wog' );
                const other = document.getElementById( 'other' );
                const comment = document.getElementById( 'comment' );
                const tonkm = document.getElementById( 'tonkm' );
                const performance_edit_form = document.getElementById( 'performance_edit_form' );


	performance_edit_form.addEventListener( 'submit', function ( event ) {
		event.preventDefault();
		if ( validateTrip() &&
		    validateChinet() &&
			validateFo() &&
			validateOperation() &&
			validateTruck() &&
			validateDdate() &&
			validateOrigion() &&
			validateDestination() &&
			validateDisw() &&
			validateDiswoc() &&
			validateCargovol() &&
			validateFuell() &&
			validateFuelb() &&
			validatePerdiem() &&
			validateWog() &&
			validatOther()
		) {
			performance_edit_form.submit();
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

	function validateOperation() {
		if ( checkIfEmpty( operation ) ) {
			return false;
		} else {
			return true;
		}
	}

	function validateTruck() {
		if ( checkIfEmpty( truck ) ) {
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


	function validateFuell() {

		if ( !minmax( fuell, 0, 2000 ) ) {
			return false;
		} else {
			return true;

		}
	}

	function validateFuelb() {

		if ( !minmax( fuelb, 0, 50000 ) ) {
			return false;
		} else {
			return true;

		}
	}

	function validatePerdiem() {

		if ( !minmax( perdiem, 0, 10000 ) ) {
			return false;
		} else {
			return true;

		}
	}

	function validateWog() {

		if ( !minmax( wog, 0, 10000 ) ) {
			return false;
		} else {
			return true;

		}
	}

	function validatOther() {

		if ( !minmax( other, 0, 10000 ) ) {
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
