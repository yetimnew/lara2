@extends( 'master.app' )
@section( 'title', 'TIMS | Performance By Truck' )

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

        <a href="{{route('performance_by_driver')}}" class="btn btn-primary pull-right">Back</a>
    </div>
    <div class="table-responsive text-nowrap">
        <h2 class="text-center"> Report From {{ $start}} To {{ $end}} For @if($years > 0){{ $years }} Years @endif
            @if($months > 0){{ $months }} Monthes @endif {{ $days}} days </h2>
        <table class="table table-bordered table-sm table-striped" id="drivers">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plate</th>
                    <th>D Name</th>
                    <th>Trip</th>
                    <th>Tonage</th>
                    <th>TonKM</th>
                    <th>DWC </th>
                    <th>DWOC</th>
                    <th>fuel/Birr</th>
                    <th>perdiem</th>
                    <th>Oprating Exp.</th>
                    <th>Other Exp.</th>
                    <th>Attached</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 0 ?>
                @if ($tds->count()> 0) @foreach ($tds as $td)
                <tr>
                    <td class='m-1 p-1 text-center'>{{++$no}}</td>
                    <td class='m-1 p-1'>{{$td->td_plate}}</td>
                    <td class='m-1 p-1'>{{$td->driver_name}}</td>
                    <td class='m-1 p-1 text-right'>{{$td->trip}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tone,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tonkm,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->TDWC,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->TDWOC,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->fB,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->perdiem,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->workOnGoing,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->other,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ $td->is_attached ? "yes": "no"}}</td>
                </tr>

                @endforeach @else
                <tr>
                    <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                </tr>
                @endif

            </tbody>

            </tbody>
        </table>

        @endsection @section('javascript')
        <script>
            $( document ).ready( function () {
				$( '#drivers' ).DataTable( {
					dom: 'Bfrtip',
					buttons: [
						'excel', 'print'
					]
				} );
			} );
        </script>
        @endsection
