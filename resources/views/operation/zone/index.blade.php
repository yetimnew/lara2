@extends( 'master.app' )
@section( 'title', 'TIMS | zone ' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
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
        @can('zone create')
        <a href="{{route('zone.create')}}" class="btn btn-primary">Add zone</a>
        @endcan
    </div>
</div>
<div class="row col-12">
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm table-striped" id="zone_table">
            <thead>
                <tr>
                    <th class="m-1 b-1">Number</th>
                    <th>Zone Name</th>
                    <th>Region</th>
                    <th>Comment</th>
                    <th>Details</th>

                </tr>
            </thead>

        </table>

        @endsection
        @section('javascript')

        <script>
            $( document ).ready( function () {
                        $( '#zone_table' ).DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{{ url('zone') }}',
                            columns: [
                                        { data: 'id', name: 'id' },
                                        { data: 'zoneName', name: 'zoneName' },
                                        { data: 'regionsaName', name: 'regionsaName' },
                                        { data: 'zoneComment', name: 'zoneComment' },
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
