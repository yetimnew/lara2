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
            <li class="breadcrumb-item active">Show</li>
        </ul>

    </div>
</div>

{{-- {{dd($truck)}} --}}
<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>Truck Plate No {{$truck->plate}} </h2>
                <div class="ml-auto">
                    <a href="{{route('truck')}}" class="btn btn-outline-primary"> <i class="fa fa-backward mr-1"
                            aria-hidden="true"> Back</i> </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Plate Number</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->plate}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Vehecle Type</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->vehecletype->name}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Chassis Number</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->chasisNumber}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Engine Number</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->engineNumber}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Tyre Size</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->tyreSyze}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Service In KM</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->serviceIntervalKM}}</h4>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Purchase Price</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->purchasePrice}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Poduction Date</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->productionDate}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Servie Start Date</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->serviceStartDate}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Stauts</label>

                        <div class="col-lg-8">
                            @if ($truck->status == 1)
                            <h4 class="col-form-label ">Active </h4>
                            @else
                            <h4 class="col-form-label ">Deleted </h4>

                            @endif


                        </div>
                    </div>

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Created In</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->created_at}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Updated at</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$truck->updated_at}}</h4>
                        </div>
                    </div>

                </div>
                @can('truck edit')
                <div class='m-1 p-1'>
                    <a href="{{route('truck.edit',['id'=> $truck->id])}}" class="btn btn-info btn-xs"><i
                            class="fa fa-edit"> </i>Edit </a>
                </div>
                @endcan
                @can('truck delete')
                <div class='m-1 p-1'>
                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$truck->id}})"
                        data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
                @endcan

            </div>


        </div>
    </div>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center text-white">DELETE CONFIRMATION</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <p class="text-center">Are You Sure Want To Delete ? Plate Number <span class="font-weight-bold">
                            {{$truck->plate}}</span> </p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                            onclick="formSubmit()">Yes, Delete</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('javascript')
<script>
    function deleteData(id)
     {
         var id = id;
         var url = '{{ route("truck.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endsection
