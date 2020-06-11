@extends( 'master.app' )
@section( 'title', 'TIMS | Performance By Driver' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Report</a>
    </li>
    <li class="breadcrumb-item active">Performance By Driver</li>
</ol>

<div class="row col-12">
    <div class="col-12 mb-3">

        {{-- <a href="{{route('performance_by_driver')}}" class="btn btn-primary pull-right">Back</a> --}}
        <a href="{{route('outsource_performance_report')}}" class="btn btn-primary pull-right">Back</a>
    </div>

    <div class="table-responsive text-nowrap">
        <h2 class="text-center"> Report From {{ $start}} To {{ $end}} For @if($years > 0){{ $years }} Years @endif
            @if($months > 0){{ $months }} Monthes @endif {{ $days}} days </h2>
        <h2 class="text-center">{{$oscustomername }} </h2>
        <table class="table table-bordered table-sm table-striped" id="drivers">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Operation </th>
                    <th>OS Name </th>
                    <th>FO</th>
                    <th>Trip</th>
                    <th>D Name</th>
                    <th>Plate </th>
                    <th>Date Dis </th>
                    <th>Origion </th>
                    <th>Destination </th>
                    <th>Tone</th>
                    <th>Ton KM</th>
                    <th>DWC</th>
                    <th>DWOC</th>
                    <th>Total KM</th>
                    <th>Tariff</th>
                    <th>Revenue</th>


                </tr>
            </thead>
            <tbody>
                {{-- {{dd($osperformances)}} --}}
                <?php $no = 0 ?>
                {{-- {{ dd($tds) }} --}}
                @if ($osperformances->count()> 0)
                @foreach ($osperformances as $pr)
                <tr>
                    <td class='m-1 p-1'>{{++$no}}</td>
                    <td class='m-1 p-1'>{{$pr->operation->operationid}}</td>
                    <td class='m-1 p-1'>{{Str::limit($pr->outsource->name,5) }}</td>
                    <td class='m-1 p-1'>{{$pr->fonumber}}</td>
                    <td class='m-1 p-1'>{{$pr->trip}}</td>
                    <td class='m-1 p-1'>{{$pr->driver_name}}</td>
                    <td class='m-1 p-1'>{{$pr->plate_number}}</td>
                    <td class='m-1 p-1'>{{$pr->DateDispach}}</td>
                    <td class='m-1 p-1'>{{$pr->orgion->name}}</td>
                    <td class='m-1 p-1'>{{$pr->destination->name}}</td>
                    <td class='m-1 p-1'>{{$pr->CargoVolumMT}}</td>
                    <td class='m-1 p-1'>{{number_format($pr->tonkm,2)}}</td>
                    <td class='m-1 p-1'>{{number_format($pr->DistanceWCargo,2)}}</td>
                    <td class='m-1 p-1'>{{number_format($pr->DistanceWOCargo,2)}}</td>
                    <td class='m-1 p-1'>{{number_format($pr->totalkm,2)}}</td>
                    <td class='m-1 p-1'>{{$pr->tariff}}</td>
                    <td class='m-1 p-1 text-right'>{{number_format($pr->revenue,2)}}</td>


                </tr>

                @endforeach
                @else
                <tr>
                    <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                </tr>
                @endif

            </tbody>

            </tbody>
        </table>


        @endsection
        @section('javascript') {{--
		<script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script> --}}
        <script>
            $( document ).ready( function () {
				$( '#drivers' ).DataTable( {
					dom: 'Bfrtip',
                    "pageLength": 25,

					buttons: [
						'excel', 'print'
					]
				} );
			} );
        </script>
        @endsection
