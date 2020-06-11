<div class="row">
    {{-- {{dd($operation2->all())}} --}}

    <div class="col-md-6">
        <div class="form-group mb-0 required">
            <label class="control-label">Operation Id</label>

            <div class="input-group">
                <input name="oid" type="text" id="oid" autofocus
                    class="form-control select {{ $errors->has('oid') ? ' is-invalid' : '' }}"
                    value="{{old('oid') ?? $operation->operationid}}" onfocusout="validateOid()">
                @if ($errors->has('oid'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('oid') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group mb-0 required">
            <label class="control-label" for="customer">Customer Name</label>
            <div class="input-group">
                <select name="customer" id="customer"
                    class="form-control {{ $errors->has('customer') ? ' is-invalid' : '' }}"
                    onfocusout="validateCustomer()">
                    <option class="dropup" value="" selected> Select One</option>

                    @foreach ($customers as $customer)
                    <option class="dropup" value="{{$customer->id}}"
                        {{$customer->id == $operation->customer_id ? 'selected' : '' }}> {{$customer->name}} </option>
                    @endforeach

                </select>
                @if ($errors->has('customer'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('customer') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group required">
            <label class="control-label" for="sdate">Starting Date</label>

            <div class="input-group">
                <input type="datetime" id="sdate" name="sdate"
                    class="form-control {{ $errors->has('sdate') ? ' is-invalid' : '' }}"
                    value="{{ old('sdate') ??  $operation->startdate}}" onfocusout="validateSdate()">
                @if ($errors->has('sdate'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('sdate') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>

            </div>
        </div>
        {{-- if({{$errors)}} --}}
        <div class="form-group required">
            <label class="control-label">Region Name</label>
            <div class="input-group">

                <select name="region" id="region" class="form-control {{ $errors->has('region') ? ' is-invalid' : '' }}"
                    onfocusout="validateRegion()">
                    <option class="dropup" value="" selected> Select One</option>
                    @foreach ($regions as $region)
                    <option class="dropup" value="{{$region->id}}"
                        {{ $region->id == $operation->region_id ? 'selected' : '' }}> {{$region->name}}
                    </option>
                    @endforeach

                </select>
                @if ($errors->has('region'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('region') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Cargo volume in Tone</label>
            <div class="input-group">
                <input type="number" name="volume" id="volume"
                    class="form-control {{ $errors->has('volume') ? ' is-invalid' : '' }}"
                    value="{{ old('volume') ??  $operation->volume }}" onfocusout="validateVolume()">
                @if ($errors->has('volume'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('volume') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>

        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group mb-0 required">
            <label class="control-label">Cargo Type</label>
            <select name="ctype" class="form-control select" id="ctype"
                class="form-control {{ $errors->has('ctype') ? ' is-invalid' : '' }}" onfocusout="validateCtype()">
                <option class="dropup" value="1" {{$operation->cargotype == 1 ? 'selected' : '' }}> Relief Cargo
                </option>
                <option class="dropup" value="0" {{$operation->cargotype == 0 ? 'selected' : '' }}> Commercial Cargo
                </option>

            </select>
            @if ($errors->has('ctype'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ctype') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>

        <div class="form-group required">
            <label class="control-label">Tone KM</label>
            <div class="input-group">
                <input name="tone" type="number" class="form-control" id="tone"
                    class="form-control {{ $errors->has('tone') ? ' is-invalid' : '' }}"
                    value="{{ old('tone') ?? $operation->km }}" onfocusout="validateTone()">
                @if ($errors->has('tone'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tone') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        <div class="form-group required">
            <label class="control-label"> Triff per Ton KM</label>
            <div class="input-group">
                <input name="tariff" type="text" id="tariff"
                    class="form-control {{ $errors->has('tariff') ? ' is-invalid' : '' }}"
                    value="{{ old('tariff') ?? $operation->tariff}}" onfocusout="validateTariff()">
                @if ($errors->has('tariff'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('tariff') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>
        @section( 'javascript' )
        <script>
                        jQuery.datetimepicker.setDateFormatter('moment');
                 $("#sdate").datetimepicker({
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
            const oid = document.getElementById( 'oid' );
                    const customer = document.getElementById( 'customer' );
                    const sdate = document.getElementById( 'sdate' );
                    const region = document.getElementById( 'region' );
                    const volume = document.getElementById( 'volume' );
                    const ctype = document.getElementById( 'ctype' );
                    const tone = document.getElementById( 'tone' );
                    const operation_reg_form = document.getElementById( 'operation_reg_form' );

                    operation_reg_form.addEventListener( 'submit', function ( event ) {
                        event.preventDefault();
                        if (
                            validateOid() &&
                            validateCustomer() &&
                            validateSdate() &&
                            validateRegion() &&
                            validateVolume() &&
                            validateCtype() &&
                            validateTone() &&
                            validateTariff()

                        ) {
                            operation_reg_form.submit();
                        } else {
                            return false;
                        }
                    } );


                    function validateOid() {
                        if ( checkIfEmpty( oid ) ) {
                            return false;
                        } else {
                            return true;
                        }
                    }

                    function validateCustomer() {
                        if ( checkIfEmpty( customer ) ) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    function validateSdate() {
                        if ( checkIfEmpty( sdate ) ) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    function validateRegion() {
                        if ( checkIfEmpty( region ) ) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    function validateVolume() {
                        if ( checkIfEmpty( volume ) ) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    function validateCtype() {
                        if ( checkIfEmpty( ctype ) ) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                    function validateTone() {
                        if ( checkIfEmpty( tone ) ) {
                            return false;
                        }
                        if ( !minmax( tone, 100, 10000000 ) ) {
                            return false;
                        } else {
                            return true;

                        }
                    }
                    function validateTariff() {
                        if ( checkIfEmpty( tariff ) ) {
                            return false;
                        }
                        if ( !minmax( tariff, 0.25, 6.00 ) ) {
                            return false;
                        } else {
                            return true;

                        }
                    }

        </script>

        @endsection
