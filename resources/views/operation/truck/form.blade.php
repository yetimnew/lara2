<div class="row">
    <div class="col-md-6">

        <div class="form-group required pb-0">
            <label class="control-label">Plate Number</label>
            <div class="input-group">
                <input type="text" name="plate" id="plate"
                    class="form-control {{ $errors->has('plate') ? ' is-invalid' : '' }} "
                    value="{{old('plate') ?? $truck->plate}}" onfocusout="validatePlate()">
                @if ($errors->has('plate'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('plate') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group required pb-0 ">
            <label class="control-label">Vehecle Type</label>
            <select name="vehecle" id="vehecle" class="form-control {{ $errors->has('vehecle') ? ' is-invalid' : '' }}"
                onfocusout="validateVehecle()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($vehcletypes as $vehecletype)
                <option class="dropup" value="{{$vehecletype->id}}"
                    {{$vehecletype->id == $truck->vehecletype_id ? 'selected' : '' }}>{{$vehecletype->name}}</option>
                @endforeach

            </select>
            @if ($errors->has('vehecle'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('vehecle') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>
        <div class="form-group pb-0">
            <label class="control-label">Chassis Number</label>
            <div class="input-group"> <span class="input-group-addon"></span>
                <input name="chan" type="text" id="chan"
                    class="form-control {{ $errors->has('chan') ? ' is-invalid' : '' }}"
                    value="{{old('chan') ?? $truck->chasisNumber}}" onfocusout="validateChan()">

                @if ($errors->has('chan'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('chan') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group pb-0">
            <label class="control-label">Engine Number</label>
            <div class="input-group"> <span class="input-group-addon"></span>
                <input name="engin" type="text" class="form-control" id="engin"
                    class="form-control {{ $errors->has('engin') ? ' is-invalid' : '' }}"
                    value="{{old('engin') ?? $truck->engineNumber}}" onfocusout="validateEngin()">

                @if ($errors->has('engin'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('engin') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group pb-0">
            <label class="control-label">Tyre Size</label>

            <div class="input-group"> <span class="input-group-addon"></span>
                <input name="tyre" type="number" class="form-control {{ $errors->has('tyre') ? ' is-invalid' : '' }}"
                    id="tyre" value="{{old('tyre') ?? $truck->tyreSyze}}" onfocusout="validateTyre()">
                @if ($errors->has('tyre'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tyre') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group pb-0">
            <label class="control-label"> Service In KM</label>
            <div class="input-group">
                <span class="input-group-addon"></span>
                <input name="sik" type="number" step="any"
                    class="form-control {{ $errors->has('sik') ? ' is-invalid' : '' }}" id="sik"
                    value="{{old('sik') ?? $truck->serviceIntervalKM}}" onfocusout="validateSik()">
                @if ($errors->has('sik'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('sik') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group pb-0">
            <label class="control-label"> Purchase Price</label>
            <div class="input-group">
                <span class="input-group-addon"></span>
                <input name="price" type="text" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                    id="price" value="{{old('price') ?? $truck->purchasePrice}}" onfocusout="validatePrice()">
                @if ($errors->has('price'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>

        </div>

        <div class="form-group ">
            <label class="control-label">Poduction Date</label>
            <div class="input-group">
                <input name="pdate" type="text" class="form-control {{ $errors->has('pdate') ? ' is-invalid' : '' }}"
                    id="pdate" value="{{old('pdate') ?? $truck->productionDate}}" onfocusout="validatePdate()">

                <div class="input-group-append">
                    <button type="button" id="toggle" class="input-group-text">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </button>
                </div>
                @if ($errors->has('pdate'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('pdate') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label"> Servie Start Date</label>

            <div class="input-group">
                <input name="ssdate" type="text" class="form-control {{ $errors->has('pdate') ? ' is-invalid' : '' }}"
                    id="ssdate" value="{{old('ssdate') ?? $truck->serviceStartDate}}" onfocusout="validateSsdate()">

                <div class="input-group-append">
                    <button type="button" id="toggle1" class="input-group-text">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </button>
                </div>
                @if ($errors->has('ssdate'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ssdate') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>




        @section( 'javascript' )
        <script>
            jQuery.datetimepicker.setDateFormatter('moment');
                 $("#pdate").datetimepicker({
                timepicker:false,
                datepicker:true,
                // format: "Y-M-d"
                format: "YYYY-MM-DD"
                // autoclose: true,
                // todayBtn: true,
                // startDate: "2013-02-14 10:00",
                // minuteStep: 10
                // step: 30,
            });
            $('#toggle').on('click', function(){
                $("#pdate").datetimepicker('toggle');
            })

            jQuery.datetimepicker.setDateFormatter('moment');
                 $("#ssdate").datetimepicker({
                timepicker:false,
                datepicker:true,
                // format: "Y-M-d"
                format: "YYYY-MM-DD"
                // autoclose: true,
                // todayBtn: true,
                // startDate: "2013-02-14 10:00",
                // minuteStep: 10
                // step: 30,
            });
            $('#toggle1').on('click', function(){
                $("#ssdate").datetimepicker('toggle1');
            })
        </script>
        <script>
            const plate = document.getElementById( 'plate' );
    const vehecle = document.getElementById( 'vehecle' );
    const chan = document.getElementById( 'chan' );
    const engin = document.getElementById( 'engin' );
    const tyre = document.getElementById( 'tyre' );
    const sik = document.getElementById( 'sik' );
    const price = document.getElementById( 'price' );
    const pdate = document.getElementById( 'pdate' );
    const ssdate = document.getElementById( 'ssdate' );
    // const sik = document.getElementById( 'sik' );
    const truck_reg_form = document.getElementById( 'truck_reg_form' );

    truck_reg_form.addEventListener( 'submit', function ( event ) {
        event.preventDefault();
        if ( validatePlate() &&
        validateVehecle() &&
        validateChan() &&
        validateEngin() &&
        validateTyre() &&
        validateSik() &&
        validatePrice()

        ) {
            truck_reg_form.submit();
        } else {
            return false;
        }
    } );

    // Validator functions
    function validatePlate() {
        if ( checkIfEmpty( plate ) ) {
            return false;
        } else {
            return true;
        }
    }
    function validateVehecle() {
        if ( checkIfEmpty( vehecle ) ) {
            return false;
        } else {
            return true;
        }
    }
    function validateChan() {
        if ( !meetLength( chan, 0, 50 ) ) {
            return false;
        } else {
            return true;

        }
    }
    function validateEngin() {
        if ( !meetLength( engin, 0, 50 ) ) {
            return false;
        } else {
            return true;

        }
    }
    function validateTyre() {
        if ( !minmax( tyre, 0, 30 ) ) {
            return false;
        }
         else {
            return true;

        }
    }
    function validateSik() {
        if ( !minmax( sik, 0, 50000000 ) ) {
            return false;
        } else {
            return true;

        }
    }
    function validatePrice() {
        if ( !minmax( price, 0, 50000000 ) ) {
            return false;
        } else {
            return true;

        }
    }


        </script>

        @endsection
