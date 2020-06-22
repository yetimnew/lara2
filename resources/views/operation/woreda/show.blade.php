@extends( 'master.app' )
@section( 'title', 'TIMS | Woreda show ' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="">Operations</a>
    </li>
    <li class="breadcrumb-item active">Woreda show</li>
</ol>


<div class="row col-md-12">
    <div class="card col-md-12">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>Details of Woreda {{$woreda->name}} </h2>
                <div class="ml-auto">
                    <a href="{{route('woreda')}}" class="btn btn-outline-primary"> <i class="fa fa-backward mr-1"
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
                            <h4 class="col-form-label ">{{$woreda->zone->region->name}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Zone</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$woreda->zone->name}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Woreda</label>
                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$woreda->name}}</h4>
                        </div>
                    </div>



                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Created In</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$woreda->created_at}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4"> Updated at</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$woreda->updated_at}}</h4>
                        </div>
                    </div>
                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-4">Number Of Places</label>

                        <div class="col-lg-8">
                            <h4 class="col-form-label ">{{$places->count()}}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="form-group row m-0">
                        <label class="col-form-label col-lg-3">Name Of Places</label>

                        <div class="col-lg-9">
                            <ol>
                                @foreach ($places as $place)
                                <li>{{ $place->name}}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                @can('woreda edit')
                <div class='m-1 p-1'>
                    <a href="{{route('woreda.edit',['id'=> $woreda->id])}}" class="btn btn-info btn-xs"><i
                            class="fa fa-edit"> </i>Edit </a>
                </div>
                @endcan
                @can('woreda delete')
                <div class='m-1 p-1'>


                    <td class='p-1 text-center' data-toggle="tooltip" data-woredament="top" title="Delete">

                        <form action="{{route('woreda.destroy', $woreda->id)}}" id="delete-form-{{$woreda->id}}"
                            style="display: none" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button class="btn btn-danger" type="submit" onclick="if(confirm('Are you sure to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{$woreda->id}}').submit();
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
