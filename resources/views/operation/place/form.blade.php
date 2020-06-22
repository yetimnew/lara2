{{-- <div class="row"> --}}
<div class="col-md-6 ">

    <div class="form-group mb-0 required">
        <label class="control-label">Woreda</label>

        <select name="woreda" id="woreda" class="form-control{{ $errors->has('woreda') ? ' is-invalid' : '' }}"
            onfocusout="validateworedao()">
            <option class="dropup" value=""> Select One</option>
            @foreach ($woredas as $woreda)
            <option class="dropup" value="{{$woreda->id}}" {{$woreda->id == $place->woreda_id ? 'selected' : '' }}>
                {{$woreda->name}} </option>
            @endforeach

        </select>
        @if ($errors->has('zone'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('zone') }}</strong>
        </span>
        @endif
        <span class="invalid-feedback" role="alert"></span>
    </div>


    <div class="form-group mb-0 required">
        <label class="control-label">Destination Name</label>

        <div class="input-group">
            <input name="name" type="text" id="name"
                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                value="{{ old('name') ?? $place->name}}" onfocusout="validateName()">
            @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
            <span class="invalid-feedback" role="alert">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label">Comments</label>
        <textarea name="comment" rows="5" class="form-control" id="comment">{{$place->comment}}</textarea>

    </div>

</div>
@section( 'javascript' )
<script>
    // const name = document.getElementById( 'name' );
	// const region = document.getElementById( 'region' );
	// const place_reg = document.getElementById( 'place_reg' );

	// place_reg.addEventListener( 'submit', function ( event ) {
	// 	event.preventDefault();
	// 	if (
    //           validateName() &&
    //           validateRegiono()

	// 	) {
	// 		place_reg.submit();
	// 	} else {
	// 		return false;
	// 	}
	// } );
	// // Validator functions
	// function validateName() {
	// 	if ( checkIfEmpty( name ) ) {
	// 		return false;
	// 	} else {
	// 		return true;
	// 	}
	// }

	// function validateRegiono() {
	// 	if ( checkIfEmpty( region ) ) {
	// 		return false;
	// 	}else {
	// 		return true;

	// 	}

	// }


</script>

@endsection
