@extends( 'master.app' )
@section( 'title', 'TIMS | Truck Update' )
@section( 'content' )

<div class="col-md-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item ">Trucks</li>
        <li class="breadcrumb-item active">Truck Update</li>
    </ol>
    {{-- @include('master.error') --}}
    {{-- @include('master.success') --}}
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>Truck Update <strong class="blue">{{$truck->name}}</strong></h2>
                @can('truck edit')
                <div class="ml-auto">
                    <a href="{{route('truck')}}" class="btn btn-outline-primary">
                        <i class="fa fa-caret-left mr-1" aria-hidden="true"></i>
                        Back</a>

                </div>
                @endcan
            </div>

        </div>

        <div class="card-body">
            <form method="post" action="{{route('truck.update',['id'=>$truck->id])}}" class="form-horizontal"
                id="truck_form">
                @csrf
                @include('operation.truck.form')
                <div class="form-group required pull-right">
                    <button type="submit" class="btn btn-primary" name="save">Save Update</button>
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
