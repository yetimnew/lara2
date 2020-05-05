@extends( 'master.app' )
@section( 'title', 'TIMS | Status Type Create ' )
@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Statuses</a>
    </li>
    <li class="breadcrumb-item active">Status Create</li>
</ol>
<div class="col-md-12">
    @include('master.error') {{-- @include('master.success') --}}
    <div class="card text-left">
        <div class="card-header">
            <h2>Status Catgory Registration</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('statustype.store')}}" class="form-horizontal" id="stauts_group">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="control-label">Status Type</label>

                            <div class="input-group"> <span class="input-group-addon"></span>
                                <input name="name" type="text" class="form-control" id="name"
                                    onfocusout="validateName()">
                                @if ($errors->has('tone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tone') }}</strong>
                                </span>
                                @endif
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label class="control-label">Status Group</label>

                            <select name="type" class="form-control select" id="type" onfocusout="validateName()">
                                <option class="dropup" value="0"> Operational </option>
                                <option class="dropup" value="1"> Graje </option>
                                <option class="dropup" value="2"> Other - </option>

                            </select>

                            @if ($errors->has('type'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                            @endif
                            <span class="invalid-feedback" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Comments</label>
                            <textarea name="comment" rows="5" class="form-control" id="comment"></textarea>

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

<script>
    const name = document.getElementById( 'name' );
	const type = document.getElementById( 'type' );

		const stauts_group = document.getElementById( 'stauts_group' );

		stauts_group.addEventListener( 'submit', function ( event ) {
			event.preventDefault();
			if (
				validateName() && validateType()


			) {
				stauts_group.submit();
			} else {
				return false;
			}
		} );



		function validateName() {
			if ( checkIfEmpty( name ) ) {
				return false;
			} else {
				return true;
			}
		}

		function validateType() {
			if ( checkIfEmpty( type ) ) {
				return false;
			} else {
				return true;
			}
		}


</script>
@endsection
