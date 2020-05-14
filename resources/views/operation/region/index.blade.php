@extends( 'master.app' )
@section( 'title', 'TIMS | Region ' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Operations</a>
    </li>
    <li class="breadcrumb-item active">Operational Region</li>
</ol>
<div class="row col-12">
    <div class="col-10">
    </div>
    <div class="col-2">
        <a href="{{route('region.create')}}" class="btn btn-primary">Add Region</a>
        {{-- <button class="btn btn-default pull-right" onclick="exportTableToExcel('region', 'members-data')"><img src="../img/xls.png" width="24" class="mr-2">Export To Excel</button> --}}
    </div>
</div>
<div class="row col-12">
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm table-striped" id="region">
            <thead>
                <tr>
                    <th class="m-1 b-1">Number</th>
                    <th>Region Name</th>
                    <th>Comment</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                @if ($regions->count()> 0)
                @foreach ($regions as $region)
                <tr>
                    <td class='m-1 p-1'>{{$region->id}}</td>
                    <td class='m-1 p-1'>{{$region->name}}</td>
                    <td class='m-1 p-1'>{{$region->comment}}</td>

                    <td class='m-1 p-1'><a href="{{route('region.edit',['id'=> $region->id])}}"
                            class="btn btn-info btn-xs"><i class="fa fa-edit"> </i></a>
                    </td>
                    <td class='m-1 p-1'>


                        <form action="{{route('region.destroy',['id'=> $region->id])}}" id="detach-form-{{$region->id}}"
                            method="POST" style="display: none">
                            @csrf @method('DELETE')
                        </form>
                        <button type="submit" class="btn btn-danger btn-xs" onclick="if(confirm('Are you sure to Delete this?')){
                            event.preventDefault();
                            document.getElementById('detach-form-{{$region->id}}').submit();
                        }else{
                            event.preventDefault();
                        }"> <i class="fa fa-trash"> </i>
                        </button>
                    </td>
                </tr>

                @endforeach @else
                <tr>
                    <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                </tr>
                @endif

            </tbody>
        </table>

        @endsection
        @section('javascript')
        <script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script>
        <script>
            $( document ).ready( function () {
				$( '#region' ).DataTable();
			} );
        </script>
        @endsection
