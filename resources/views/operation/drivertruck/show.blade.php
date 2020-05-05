@extends( 'master.app' )
@section( 'title', 'TIMS |Driver Truck' )

@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Driver And Truck </li>
</ol>
<div class="col-md-12">
    @include('master.error')
    {{-- @include('master.success') --}}
    <div class="card text-left">
        <div class="card-header">

            <div class="d-flex align-items-center">
                <h2>Truck And Driver Registration</h2>
                <div class="ml-auto">
                    <a href="{{route('drivertruck')}}" class="btn btn-outline-primary">
                        <i class="fa fa-caret-left mr-1" aria-hidden="true"></i>Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                {{-- {{  dd($td)}} --}}
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Plate Number</label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label ">{{$td->plate}}</h4>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Driver ID</label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label "> {{$td->driverid}}</h4>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Driver Name</label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label "> {{$driver->name}}</h4>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Date Recived</label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label ">{{$td->date_recived}} || {{$td->date_recived->diffForHumans()}}</h4>
                    </div>
                </div>
                @if ($td->is_attached == 0)
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Date Detached</label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label ">{{$td->date_detach}}</h4>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Drive for </label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label ">{{$difinday }} days or <span>{{$diffinhour}} hours</h4>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4">Reason</label>
                    <div class="col-lg-8">
                        <h4 class="col-form-label ">{{$td->reason}}</h4>
                    </div>
                </div>
                @endif

                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4 m-0">Created In</label>
                    <div class="col-lg-8 m-0">
                        <h4 class="col-form-label m-0 ">{{$td->created_at}} || {{$td->created_at->diffForHumans()}}</h4>
                    </div>
                </div>
                <div class="form-group row m-0">
                    <label class="col-form-label col-lg-4 m-0">Updated In</label>
                    <div class="col-lg-8 m-0">
                        <h4 class="col-form-label m-0 ">{{$td->updated_at }} || {{$td->updated_at->diffForHumans()}}
                        </h4>
                    </div>
                </div>


            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">


            </div>
            @can('truck_driver edit')
            <div class='m-1 p-1'><a href="{{route('drivertruck.edit',['id'=> $td->id])}}" class="btn btn-info btn-xs"><i
                        class="fa fa-edit"> </i>Edit </a>
            </div>
            @endcan

            @if ($td->is_attached == 1)
            @can('truck_driver detach')
            <div class='m-1 p-1'>
                <a href="javascript:;" data-toggle="modal" onclick="detachData({{$td->id}})" data-target="#detachModal"
                    class="btn btn-xs btn-info"><i class="fa fa-trash"></i>Detach </a>
            </div>
            @endcan
            @endif

            @can('truck_driver delete')
            <div class='m-1 p-1'>
                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$td->id}})" data-target="#DeleteModal"
                    class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
            </div>
            @endcan
        </div>
        <div class="card-footer">
            the footer
        </div>

    </div>
</div>

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
                    <p class="text-center">Are You Sure Want To Delete ? <span class="font-weight-bold"> </span> </p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                            onclick="formSubmitdelete()">Yes, Delete</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Detach Modal -->
<div id="detachModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="detachForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-center text-white">DETACH CONFIRMATION</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('GET')
                    <p class="text-center">Are You Sure To detach ?<br> <span class="font-weight-bold">
                            {{$driver->name}} </span> from plate <span class="font-weight-bold"> {{$td->plate}} </span>
                    </p>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                        onclick="formSubmit()">Yes, Detach</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section( 'javascript' )
<script>
    function deleteData(id)
     {
         var id = id;
         var url = '{{ route("drivertruck.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmitdelete()
     {
         $("#deleteForm").submit();
     }
     function detachData(id)
     {
         var id = id;
         var url = '{{ route("drivertruck.detach", ":id") }}';
         url = url.replace(':id', id);
         $("#detachForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#detachForm").submit();
     }
</script>

@endsection
