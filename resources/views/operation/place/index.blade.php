@extends( 'master.app' )
@section( 'title', 'TIMS | Place ' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="">Operations</a>
    </li>
    <li class="breadcrumb-item active">Operation Place</li>
</ol>


<div class="row col-md-12">
    <div class="card col-md-12">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Places </h2>
                @can('operation_place create')
                <div class="ml-auto">
                    <a href="{{route('place.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i>Add Place</a>

                </div>
                @endcan
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="place">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Region </th>
                            <th>Zone </th>
                            <th>Woreda </th>
                            <th>Place Name</th>
                            <th>Comment</th>
                            <th>Details</th>
                            {{-- @can('operation_place edit')
                            <th>Edit</th>
                            @endcan
                            @can('operation_place delete')
                            <th>Delete</th>
                            @endcan --}}

                        </tr>
                    </thead>

                </table>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
    $( document ).ready( function () {
				$( '#place' ).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('place') }}',
                    columns: [
                                { data: 'id', name: 'id' },
                                { data: 'regionsaName', name: 'regionsaName' },
                                { data: 'zoneaName', name: 'zoneaName' },
                                { data: 'woredaName', name: 'woredaName' },
                                { data: 'placeName', name: 'placeName' },
                                { data: 'placeComment', name: 'placeComment' },
                                {
                                    data: 'details',
                                    name: 'details',
                                    orderable: false
                                    }
                            ],
                });
			} );
</script>
@endsection
