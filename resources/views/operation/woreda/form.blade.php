<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-0 required">
            <label class="control-label">Woreda Name</label>

            <div class="input-group"> <span class="input-group-addon"></span>

                <input name="name" type="text" id="name"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    value="{{ old('name') ?? $woreda->name}}" onfocusout="validateName()">
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert">
            </div>
        </div>
        <div class="form-group mb-0 required">
            <label class="control-label">Zone Name</label>

            <select name="zone" id="zone" class="form-control{{ $errors->has('zone') ? ' is-invalid' : '' }}"
                onfocusout="validatezoneo()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($zones as $zone)
                <option class="dropup" value="{{$zone->id}}" {{$zone->id == $woreda->zone_id ? 'selected' : '' }}>
                    {{$zone->name}} </option>
                @endforeach

            </select>
            @if ($errors->has('zone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('zone') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>
        <div class="form-group">
            <label class="control-label">Comments</label>
            <textarea name="comment" rows="5" class="form-control" id="comment">{{ $woreda->comment}} </textarea>

        </div>

        @section( 'javascript' )
        <script>
            const name = document.getElementById( 'name' );

                const region_reg = document.getElementById( 'region_reg' );

                region_reg.addEventListener( 'submit', function ( event ) {
                    event.preventDefault();
                    if (
                          validateName()

                    ) {
                        region_reg.submit();
                    } else {
                        return false;
                    }
                } );

                // Validator functions
                function validateName() {
                    if ( checkIfEmpty( name ) ) {
                        return false;
                    }

                    if(!meetLength( name, 3, 255 )){
                        return false;
                    }
                    else {
                        return true;
                    }
                }

        </script>

        @endsection
