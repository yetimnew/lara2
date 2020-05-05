@extends( 'master.app' )
@section( 'title', 'TIMS | Status Type ' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Statuses</a>
    </li>
    <li class="breadcrumb-item active">Status Type</li>
</ol>
<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Status Groups </h2>
                @can('status_type create')

                <div class="ml-auto">
                    <a href="{{route('statustype.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i> Add Status Group </a>

                </div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="operations">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Name</th>
                            <th>statusGroup</th>
                            <th>Comment</th>
                            @can('status_type edit')
                            <th>Edit</th>
                            @endcan
                            @can('status_type delete')
                            <th>Delete</th>
                            @endcan


                        </tr>
                    </thead>
                    <tbody>
                        @if ($statustypes->count()> 0) @foreach ($statustypes as $statustype)
                        <tr>
                            <td class='m-1 p-1'>{{$statustype->id}}</td>
                            <td class='m-1 p-1'>{{$statustype->name}}</td>
                            @if ($statustype->statusgroup == 1)
                            <td class='m-1 p-1'>Operational</td>

                            @else

                            <td class='m-1 p-1'>Garage</td>
                            @endif
                            <td class='m-1 p-1'>{{$statustype->comment}}</td>
                            @can('status_type edit')
                            <td class='m-1 p-1 text-center'><a
                                    href="{{route('statustype.edit',['id'=> $statustype->id])}}"><i class="fa fa-edit">
                                    </i></a>
                            </td>
                            @endcan
                            @can('status_type delete')
                            <td class='m-1 p-1 text-center'>

                                <form action="{{route('statustype.destroy',['id'=> $statustype->id])}}"
                                    id="detach-form-{{$statustype->id}}" style="display: none" method="POST">
                                    @csrf @method('DELETE')
                                </form>
                                <button type="submit" onclick="if(confirm('Are you sure to Delete this?')){
                            event.preventDefault();
                            document.getElementById('detach-form-{{$statustype->id}}').submit();
                        }else{
                            event.preventDefault();
                        }"> <i class="fa fa-trash red"> </i>
                                </button>
                            </td>
                            @endcan

                        </tr>

                        @endforeach @else
                        <tr>
                            <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                        </tr>
                        @endif

                    </tbody>
                </table>

                @endsection @section('javascript')
                <script src="{{ asset('js/jquery.dataTables.min.js') }}">
                </script>
                <script>
                    $( document ).ready( function () {
				$( '#operations' ).DataTable();
			} );
                </script>
                @endsection
