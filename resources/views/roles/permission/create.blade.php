@extends( 'master.app' )
@section( 'title', 'TIMS | Permmsion Registration' )

@section( 'content' )

<div class="col-md-12">
    @include('master.error')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dasboard')}}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Truck</a>
            </li>
            <li class="breadcrumb-item active"><a href="{{ route('truck')}}">Driver Reg</a>
            </li>
            {{--
			<li class="breadcrumb-item active" aria-current="page">Data</li> --}}
        </ol>
    </nav>
    <div class="card text-left">
        <div class="card-header">
            <h2>Permission Registration</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('permission.store')}}" class="form-horizontal" id="driver_reg"
                novalidate>
                @csrf
                <div class="form-group">
                    <label for="name"></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Permmsion Name"
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Help text</small>
                </div>
                @if(!$roles->isEmpty())
                {{-- //If no roles?? exist yet --}}
                <h4>Assign Permission to Roles</h4>

                @foreach ($roles as $role)
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="roles[]" id="" value="{{$role->id}}">
                        {{$role->name}}
                    </label>
                </div>

                @endforeach
                @endif
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

@endsection
