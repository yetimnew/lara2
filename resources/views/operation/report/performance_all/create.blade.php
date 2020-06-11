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
        <a href="{{route('performance_by_driver')}}" class="btn btn-primary pull-right">Back</a>
    </div>

    <div class="table-responsive text-nowrap">
        <h2 class="text-center"> Report From {{ $start}} To {{ $end}} For @if($years > 0){{ $years }} Years @endif
            @if($months > 0){{ $months }} Monthes @endif {{ $days}} days </h2>
        <table class="table table-bordered table-sm table-striped" id="drivers">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Driver Name</th>
                    <th>Plate</th>
                    <th>Model</th>
                    <th>FOnumber</th>
                    <th>DateDispach</th>
                    <th>Origion</th>
                    <th>Destination</th>
                    <th>operationID</th>
                    <th>Trip</th>
                    <th>Tonage</th>
                    <th>TonKM</th>
                    <th>DWC </th>
                    <th>DWOC</th>
                    <th>Total Distance</th>
                    <th>fuel/Birr</th>
                    <th>perdiem</th>
                    <th>Oprating Exp.</th>
                    <th>Other Exp.</th>
                    <th>Total Exp</th>
                    <th>Revenu</th>
                    <th> Op Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0 ?>
                @if ($performances->count()> 0)
                @foreach ($performances as $td)
                <tr>
                    <td class='m-1 p-1 text-center'></td>
                    <td class='m-1 p-1'>{{$td->dname}}</td>
                    <td class='m-1 p-1'>{{$td->plate}}</td>
                    <td class='m-1 p-1'>{{$td->model}}</td>
                    <td class='m-1 p-1'>{{$td->FOnumber}}</td>
                    <td class='m-1 p-1'>{{$td->DateDispach}}</td>
                    <td class='m-1 p-1'>{{$td->orgion->name}}</td>
                    <td class='m-1 p-1'>{{$td->destination->name}}</td>
                    <td class='m-1 p-1'>{{$td->operationid}}</td>
                    <td class='m-1 p-1 text-right'>{{$td->trip}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->CargoVolumMT,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tonkm,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->DistanceWCargo,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->DistanceWOCargo,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format($td->DistanceWOCargo  +  $td->DistanceWCargo ,2)}}
                    </td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->fuelInBirr,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->perdiem,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->workOnGoing,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->other,2)}}</td>
                    <td class='m-1 p-1 text-right'>
                        {{ number_format( $td->fuelInBirr +  $td->perdiem +$td->workOnGoing  + $td->other ,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tonkm * $td->tariff ,2)}}</td>
                    <td class='m-1 p-1 text-right'>
                        {{ number_format( ($td->tonkm * $td->tariff) - ($td->fuelInBirr +  $td->perdiem +$td->workOnGoing  + $td->other) ,2)}}
                    </td>

                </tr>

                @endforeach @else
                <tr>
                    <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                </tr>
                @endif

            </tbody>

            </tbody>
        </table>


        @endsection
        @section('javascript')
        <script>
            $( document ).ready( function () {


			let t =	$( '#drivers' ).DataTable( {
                    dom: 'Bfrtip',
                    "pageLength": 25,
					buttons: [
						'excel', 'print'
					]
				} );
                t.on('order.dt search.dt', function(){
                    t.column(0, {search: 'applied', order: 'applied'}).nodes()
                    .each(function(cell , i){
                    cell.innerHTML = i + 1;
                    })
                }).draw()
			} );
        </script>
        @endsection
