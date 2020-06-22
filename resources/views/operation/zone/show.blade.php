@extends( 'master.app' )
@section( 'title', 'TIMS | zone show ' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="">Operations</a>
    </li>
    <li class="breadcrumb-item active">zone show</li>
</ol>


<div class="row col-md-12">
    <div class="card col-md-12">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>Details of zone {{$zone->name}} </h2>
                <div class="ml-auto">
                    <a href="{{route('zone')}}" class="btn btn-outline-primary"> <i class="fa fa-backward mr-1"
                            aria-hidden="true"> Back</i> </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    {{-- {{dd($place)}} --}}


                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Region</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$zone->region->name}}</h4>
                        </div>
                    </div>

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">zone</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$zone->name}}</h4>
                        </div>
                    </div>


                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Created In</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$zone->created_at}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Updated at</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$zone->updated_at}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Number Of Woredas</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$woredas->count()}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-3">Name Of Woreda</label>

                        <div class="col-lg-9">
                            <ol>
                                @foreach ($woredas as $woreda)
                                <li>{{ $woreda->name}}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                @can('zone edit')
                <div class='m-1 p-1'>
                    <a href="{{route('zone.edit',['id'=> $zone->id])}}" class="btn btn-info btn-xs"><i
                            class="fa fa-edit">
                        </i>Edit </a>
                </div>
                @endcan
                @can('zone delete')
                <div class='m-1 p-1'>


                    <td class='p-1 text-center' data-toggle="tooltip" data-zonement="top" title="Delete">

                        <form action="{{route('zone.destroy', $zone->id)}}" id="delete-form-{{$zone->id}}"
                            style="display: none" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-danger" type="submit" onclick="if(confirm('Are you sure to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{$zone->id}}').submit();
                            }else{
                                event.preventDefault();
                            }">
                            <i class="fa fa-trash"></i> Delete </button>
                    </td>

                </div>
                @endcan

            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')

@endsection
