@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Create' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>

<div class="row col-12">
    <h3 class="text-center"> REPORT : Performance By Driver</h3>
    <div class="col-10">
        <form method="post" action="{{route('performanceall.store')}}" class="form-horizontal" id="truck_form">
            @csrf
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-row">


                        <div class="form-group col-md-3">
                            <label for="inputCity">Start Date</label>
                            <input id="startDate" name="startDate" type="date" placeholder="Start Date"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputState">Start Date</label>
                            <input id="endDate" name="endDate" type="date" placeholder="End Date" class="form-control"
                                required>

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip"></label>
                            <button class="btn btn-secondary btn-block" type="submit" name="register"
                                id="register">Search</button>
                        </div>

                    </div>

                </div>
            </div>

    </div>

</div>
<div class="row col-12">
    {{-- {{ dd($performances)}} --}}
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm table-striped" id="performanceall">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Driver Name</th>
                    <th>Plate</th>
                    <th>Model</th>
                    <th>FOnumber</th>
                    <th>DateDispach</th>
                    <th>Destination</th>
                    <th>operationID</th>
                    <th>Trip</th>
                    <th>Tonage</th>
                    <th>TonKM</th>
                    <th>DWC </th>
                    <th>DWOC</th>
                    <th>Total Distance</th>
                    <th>fuel/Litter</th>
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
                    <td class='m-1 p-1 text-center'>{{++$no}}</td>
                    <td class='m-1 p-1'>{{$td->dname}}</td>
                    <td class='m-1 p-1'>{{$td->plate}}</td>
                    <td class='m-1 p-1'>{{$td->model}}</td>
                    <td class='m-1 p-1'>{{$td->FOnumber}}</td>
                    <td class='m-1 p-1'>{{$td->DateDispach}}</td>
                    <td class='m-1 p-1'>{{$td->destination}}</td>
                    {{-- <td class='m-1 p-1'>{{$td->destination->name}}</td> --}}
                    <td class='m-1 p-1'>{{$td->operationid}}</td>
                    <td class='m-1 p-1 text-right'>{{$td->trip}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->CargoVolumMT,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tonkm,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->DistanceWCargo,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->DistanceWOCargo,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format($td->DistanceWOCargo  +  $td->DistanceWCargo ,2)}}
                    </td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->fuelInLitter,2)}}</td>
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
        <script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script>
        <script>
            $( document ).ready( function () {
				$( '#performanceall' ).DataTable();

// $('#startDate').datepicker()
			} );
        </script>
        @endsection
