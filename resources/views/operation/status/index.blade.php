@extends( 'master.app' )
@section( 'title', 'TIMS | Status Registration' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Statuses</a>
    </li>
    <li class="breadcrumb-item active">Status</li>
</ol>

<div class="card col-md-12">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <h2>All Status </h2>
            @can('status create')
            <div class="ml-auto">
                <a href="{{route('status.create')}}" class="btn btn-outline-primary"><i class="fafa-plus mr-1"></i>Add
                    Stauts</a>

            </div>
            @endcan
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm table-striped" id="statuses">
                <thead>
                    <tr>
                        <th class="m-1 p-1">Number</th>
                        <th class="m-1 p-1">ID</th>
                        <th class="m-1 p-1">plateNumber</th>
                        <th class="m-1 p-1">status</th>
                        <th class="m-1 p-1">Registed Date</th>
                        @can('status edit')
                        <th class="m-1 p-1">Edit</th>
                        @endcan

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 ?>
                    @if ($statuses->count() > 0)
                    @foreach ($statuses as $status)
                    <tr>
                        <td class='m-0 p-0'>{{++$no}}</td>
                        <td class='m-0 p-0'>{{$status->autoid}}</td>
                        <td class='m-0 p-0'>{{$status->plate}}</td>
                        <td class='m-0 p-0'>{{$status->statustype->name}} </td>
                        <td class='m-0 p-0'>{{$status->registerddate}}</td>
                        @can('status edit')
                        <td class='m-0 p-0'><a href="{{route('status.edit',['id'=> $status->id])}}"
                                class="btn btn-info btn-sm">Edit</a>
                        </td>
                        @endcan
                    </tr>

                    @endforeach
                    @else
                    <tr>
                        <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>

                    </tr>
                    @endif

                </tbody>
            </table>

            <div class="card-footer">

            </div>
        </div>
    </div>
</div>

@endsection @section('javascript')
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
    $( document ).ready( function () {
				$( '#statuses' ).DataTable( {

				"pageLength": 50,
				// "scrollY": 100,
		        'columnDefs': [ {

				// 'targets': [5], /* column index */

				'orderable': false, /* true or false */

				}]
				});
			} );
</script>


@endsection
