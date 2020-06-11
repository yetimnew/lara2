@extends( 'master.app' )
@section( 'title', 'TIMS | Truck Registration' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="breadcrumb breadcrumb-style ">

            <li class="breadcrumb-item"><a href="{{route('dasboard')}}"><i class="fa fa-home"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="#">Trucks</a></li>
            <li class="breadcrumb-item active">Main</li>
        </ul>

    </div>
</div>

<div class="conteiner col-12">
    <div class="row">
    <div class="row col-6">
        <div class="card text-left ">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h2>All Free Trucks </h2>

                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($free_trucks as $key => $truck)
                    <li class="list-group-item">{{$key + 1}} , {{ $truck->plate}}</li>

                    @endforeach
                  </ul>


            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    <div class="row col-6">
        <div class="card text-left ">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h2>All Free Drivers </h2>

                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach ($free_drivers as $key => $truck)
                    <li class="list-group-item">{{$key + 1}} , {{ $truck->name}}</li>

                    @endforeach
                  </ul>


            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('javascript')

@endsection
