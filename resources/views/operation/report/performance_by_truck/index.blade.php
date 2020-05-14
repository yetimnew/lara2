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
    <h3 class="text-center"> REPORT : Performance By Truck</h3>
    <div class="col-10">
        <form method="post" action="{{route('performance_by_truck.store')}}" class="form-horizontal" id="truck_form">
            @csrf

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="control-label">Plate Number</label>
                            <select name="plate" class="form-control" id="plate" onfocusout="validateDestination()">
                                <option class="dropup" value=""> Select One</option>
                                @foreach ($trucks as $truck)
                                <option class="dropup" value="{{$truck->plate}}"> {{$truck->plate}} </option>
                                @endforeach
                            </select>

                        </div>
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
                            <button class="btn btn-primary btn-block" type="submit" name="register">Search</button>
                        </div>
                    </div>

                </div>
            </div>
    </div>

</div>
<div class="row col-12">
    <div class="table-responsive text-nowrap">
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
            {{-- {{dd($tds)}} --}}
            <tbody>
                <?php $no = 0 ?> {{-- {{ dd($performances->drivers->nam) }} --}}
                @if ($tds->count()> 0)
                @foreach ($tds as $td)
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

                @endforeach
                @else
                <tr>
                    <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                </tr>
                @endif


            </tbody>
        </table>

        @endsection @section('javascript')
        <script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script>
        <script>
            $( document ).ready( function () {
				$( '#drivers' ).DataTable();

			} );
        </script>
        @endsection
