@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Create' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>

{{-- {{dd($statuslist[0])}} --}}

<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Performances </h2>
                @can('performance create')

                <div class="ml-auto">
                    <a href="{{route('performace.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i>Add Performance</a>

                </div>
                @endcan
            </div>
        </div>


        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="drivers">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>FO</th>
                            <th>Driver_truck</th>
                            <th>Date Dispach</th>
                            <th>Origion </th>
                            <th>Ton KM</th>
                            <th>VolumMT</th>
                            <th>Is Returned?</th>
                            <th>Type of Trip</th>
                            @can('performance view')
                            <th class="text-center" width="4%">Details</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

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
				$( '#drivers' ).DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "ajax": "{{ route('performace.allperformance')}}",

                    "columns": [
                        { "data": "plate" },
                        { "data": "FOnumber" },
                        { "data": "dname" },
                        { "data": "DateDispach" },
                        { "data": "orgion" },
                        { "data": "tonkm" },
                        { "data": "CargoVolumMT" },
                        { "data": "is_returned" },
                        { "data": "trip" }

                    ]

				});
			} );
</script>

@endsection
