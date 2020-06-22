@extends( 'master.app' )
@section( 'title', 'TIMS | OS Performance Create' )

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>

<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Outsource Performances </h2>
                @can('osperformance creat')
                <div class="ml-auto">
                    <a href="{{route('osperformance.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i>Add OS Performance</a>

                </div>
                @endcan
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="osperformance">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>OS Name </th>
                            <th>Operation </th>
                            <th>FO</th>
                            <th>Date Dis </th>
                            <th>Plate </th>
                            <th>Destination </th>
                            <th>Tone</th>
                            <th>Ton KM</th>
                            <th>Trip</th>
                            {{-- @can('osperformance view') --}}
                            <th class="text-center" width="4%">Details</th>
                            {{-- @endcan --}}
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>

    </div>
</div>
@endsection
@section('javascript')
<script>
    $( document ).ready( function () {
                $( '#osperformance' ).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('osperformance') }}',
                    columns: [
                                { data: 'id', name: 'id' },
                                { data: 'osname', name: 'osname' },
                                { data: 'operationid', name: 'operationid' },
                                { data: 'fo', name: 'fo' },
                                { data: 'ddate', name: 'ddate' },
                                { data: 'plate', name: 'plate' },
                                { data: 'orgion', name: 'orgion' },
                                { data: 'tonkm', name: 'tonkm' },
                                { data: 'tone', name: 'tone' },
                                { data: 'trip', name: 'trip' },
                                // { data: 'trip', name: 'trip' },
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
