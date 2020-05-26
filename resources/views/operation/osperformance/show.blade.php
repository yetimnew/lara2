@extends( 'master.app' )
@section( 'title', 'TIMS | Performance show' )

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Outsource Performance</li>
    <li class="breadcrumb-item active">Show</li>
</ol>


<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>Details of FO Number {{$osperformance->fonumber}} </h2>
                <div class="ml-auto">
                    <a href="{{route('osperformance')}}" class="btn btn-outline-primary"> <i class="fa fa-backward mr-1"
                            aria-hidden="true"> Back</i> </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Fo Number</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$osperformance->fonumber}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Is that a Trip?</label>
                        <div class="col-lg-8">
                            @if ($osperformance->trip == 1)
                            <h4 class="col-form-label ">Yes </h4>
                            @endif
                            @if ($osperformance->trip == 0)
                            <h4 class="col-form-label ">No</h4>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Load Type</label>
                        <div class="col-lg-8">
                            @if ($osperformance->LoadType == 0)
                            <h4 class="col-form-label ">commrcial Cargo</h4>
                            @endif
                            @if ($osperformance->LoadType == 1)
                            <h4 class="col-form-label ">Releif Cargo</h4>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Operation ID</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$osperformance->operation->operationid}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Customer Name</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$osperformance->outsource->name}}</h4>
                        </div>
                    </div>


                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Driver Name</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{($osperformance->driver_name)}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Plate Number</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{($osperformance->plate_number)}}</h4>
                        </div>
                    </div>

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Date Dispatch</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$osperformance->DateDispach}} ||
                                {{$osperformance->DateDispach->diffForHumans()}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Origin Place</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0">{{$osperformance->orgion->name}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Destination Place</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{$osperformance->destination->name}}</h4>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Distance with Cargo</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format($osperformance->DistanceWCargo,2)}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Distance without Cargo</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format($osperformance->DistanceWOCargo,2)}}</h4>
                        </div>
                    </div>


                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Total KM</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format(($osperformance->totalkm),2) }}
                            </h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Load by Tone</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format($osperformance->CargoVolumMT,2)}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Tone KM</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format($osperformance->tonkm,2)}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Tariff</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format(($osperformance->tariff ),4 )}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Revenue</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{number_format(($osperformance->revenue ), 2)}}</h4>
                        </div>
                    </div>



                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Created By</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{$osperformance->user->name}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Created In</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{$osperformance->created_at}} ||
                                {{$osperformance->created_at->diffForHumans()}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Updated In</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{$osperformance->updated_at }} ||
                                {{$osperformance->updated_at->diffForHumans()}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4 m-0">Comment</label>
                        <div class="col-lg-8 m-0">
                            <h4 class="col-form-label m-0 ">{{$osperformance->comment}}</h4>
                        </div>
                    </div>
                </div>
                @can('performanceos edit')
                <div class='ml-1 p-1'>
                    <a href="{{route('osperformance.edit',['id'=> $osperformance->id])}}" class="btn btn-info"> <i
                            class="fa fa-edit"></i> Edit </a>
                </div>

                @endcan


                @can('performanceos delete')
                <div class='m-1 p-1'>
                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$osperformance->id}})"
                        data-target="#DeleteModal" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                    <p class="text-center">Are You Sure Want To Delete ? Fo Number <span class="font-weight-bold">
                            {{$osperformance->FOnumber}}</span> </p>
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
         var url = '{{ route("performace.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endsection
