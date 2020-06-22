<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-0 required">
            <label class="control-label">Zone Name</label>

            <div class="input-group"> <span class="input-group-addon"></span>

                <input name="name" type="text" id="name"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                    value="{{ old('name') ?? $zone->name}}" onfocusout="validateName()">
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
                <span class="invalid-feedback" role="alert">
            </div>
        </div>
        <div class="form-group mb-0 required">
            <label class="control-label">Region Name</label>

            <select name="region" id="region" class="form-control{{ $errors->has('region') ? ' is-invalid' : '' }}"
                onfocusout="validateregiono()">
                <option class="dropup" value=""> Select One</option>
                @foreach ($regions as $region)
                <option class="dropup" value="{{$region->id}}" {{$region->id == $zone->region_id ? 'selected' : '' }}>
                    {{$region->name}} </option>
                @endforeach

            </select>
            @if ($errors->has('region'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('region') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert"></span>
        </div>
        <div class="form-group">
            <label class="control-label">Comments</label>
            <textarea name="comment" rows="5" class="form-control" id="comment">{{ $zone->comment}} </textarea>

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
