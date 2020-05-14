<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-0 required">
            <label class="control-label" for="customer">Origin Place</label>
            <div class="input-group">
                <select name="origin" id="origin" class="form-control {{ $errors->has('origin') ? ' is-invalid' : '' }}"
                    onfocusout="validateCustomer()">
                    <option class="dropup" value=""> Select One</option>
                    @foreach ($places as $place)
                    <option class="dropup" value="{{$place->id}}"
                        {{ $place->id == $distance->origin_id ? 'selected' : '' }}>
                        {{$place->name}} </option>
                    @endforeach

                </select>
                @if ($errors->has('origin'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('origin') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>

        <div class="form-group mb-2 required">
            <label class="control-label" for="customer">Destination Place</label>
            <div class="input-group">
                <select name="destination" id="destination"
                    class="form-control {{ $errors->has('destination') ? ' is-invalid' : '' }}"
                    onfocusout="validateCustomer()">
                    <option class="dropup" value=""> Select One</option>
                    @foreach ($places as $place)
                    <option class="dropup" value="{{$place->id}}"
                        {{ $place->id == $distance->destination_id ? 'selected' : '' }}>
                        {{$place->name}} </option>
                    @endforeach

                </select>
                @if ($errors->has('destination'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('destination') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>


        <div class="form-group mb-2 required">
            <label class="control-label">Distance In KM</label>

            <div class="input-group">
                <input name="km" type="text" id="km"
                    class="form-control select {{ $errors->has('km') ? ' is-invalid' : '' }}"
                    value="{{old('km') ?? $distance->km}}" onfocusout="validateZone()">
                @if ($errors->has('km'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('km') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert"></span>
            </div>
        </div>


        @section( 'javascript' )

        <script>
            //     const did = document.getElementById( 'did' );
    //     const name = document.getElementById( 'name' );
    //     const bdate = document.getElementById( 'bdate' );


    //     const driver_reg = document.getElementById( 'driver_reg' );

    //     driver_reg.addEventListener( 'submit', function ( event ) {
    //     event.preventDefault();
    //     if (
    //     validateDid() &&
    //     validateName() &&
    //     validateBdate() &&
    //     validateMob() &&
    //     validateHd()
    //     ) {
    //     driver_reg.submit();
    //     } else {
    //     return false;
    //     }
    //     } );


    //     function validateDid() {
    //     if ( checkIfEmpty( did ) ) {
    //     return false;
    //     } else {
    //     return true;
    //     }
    //     }
    //     function validateName() {
    //     if ( checkIfEmpty( name ) ) {
    //     return false;
    //     } else {
    //     return true;
    //     }
    //     }

    //     function validateBdate() {
    //     if ( checkIfEmpty( bdate ) ) {
    //     return false;
    //     } else {
    //     return true;
    //     }
    //     }

    //     function validateMob() {
    //     if ( checkIfEmpty( mob ) ) {
    //     return false;
    //     }
    //     if ( !meetLength( mob, 10, 11 ) ) {
    //     return false;
    //     } else {
    //     return true;

    //     }
    //     }
    //     function validateHd() {
    //     if ( checkIfEmpty( hd ) ) {
    //     return false;
    //     }else {
    //     return true;

    //     }
    //     }

    //     //*******************************************************************
    //     // Validator functions
    //     //*******************************************************************

    //
        </script>

        @endsection
