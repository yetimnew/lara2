@extends( 'master.app' )
@section( 'title', 'TIMS | Truck Registration' )
@section( 'content' )
<div class="col-md-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item ">Trucks</li>
        <li class="breadcrumb-item active">Truck Registration</li>
    </ol>
    {{-- @include('master.error') --}}

    <div class="card text-left">
        <div class="card-header">

            <div class="d-flex align-items-center">
                <h2>Truck Registration</h2>
                @can('driver create')
                <div class="ml-auto">
                    <a href="{{route('truck')}}" class="btn btn-outline-primary">
                        <i class="fa fa-caret-left mr-1" aria-hidden="true"></i>Back</a>

                </div>
                @endcan
            </div>

        </div>
        <div class="card-body">
            <form method="post" action="{{route('truck.store')}}" id="truck_reg_form" novalidate>
                @csrf
                @include('operation.truck.form')
                <div class="form-group required pull-right">
                    <button type="submit" class="btn btn-outline-primary btn-lg" name="save">
                        <i class="fafa-save"></i>
                        Save</button>
                </div>

        </div>
        <div class="card-footer">
        </div>
        </form>

    </div>
</div>

@endsection
