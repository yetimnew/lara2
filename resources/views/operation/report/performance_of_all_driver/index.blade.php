@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Create' )

@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item ">Report</li>
    <li class="breadcrumb-item active">Performance Of All Drivers</li>
</ol>

<div class="row col-12">
    <h3 class="text-center"> REPORT : Performance Of All Drivers</h3>
    <div class="col-10">
        <form method="post" action="{{route('performance_of_all_driver.store')}}" class="form-horizontal"
            id="truck_form">
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
                        <div class="form-group pt-2 col-md-3">
                            <label class="font-weight-semibold">View in Details </label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <div class="uniform-choice"><span class="">
                                            <input type="radio" class="form-check-input-styled" name="in_details"
                                                checked="" value="1" data-fouc=""></span>
                                    </div>
                                    Yes
                                </label>
                            </div>

                            <div class="form-check">
                                <label class="form-check-label">
                                    <div class="uniform-choice"><span class="checked"><input type="radio"
                                                class="form-check-input-styled" name="in_details" data-fouc=""
                                                value="0"></span></div>
                                    No
                                </label>
                            </div>

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
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm table-striped" id="drivers">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Driver Name</th>
                    <th>Plate</th>
                    <th>Trip</th>
                    <th>Tonage</th>
                    <th>TonKM</th>
                    <th>DWC </th>
                    <th>DWOC</th>
                    <th>fuel/Birr</th>
                    <th>perdiem</th>
                    <th>Oprating Exp.</th>
                    <th>Other Exp.</th>
                    <th>Revenu</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 0 ?> {{-- {{ dd($performances->drivers->nam) }} --}}
                @if ($tds->count()> 0)
                @foreach ($tds as $td)
                <tr>
                    <td class='m-1 p-1 text-center'>{{++$no}}</td>
                    <td class='m-1 p-1'>{{$td->driver_name}}</td>
                    <td class='m-1 p-1'>{{$td->td_plate}}</td>
                    <td class='m-1 p-1 text-right'>{{$td->trip}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tone,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->tonkm,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->TDWC,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->TDWOC,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->fB,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->perdiem,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->workOnGoing,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->other,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{ number_format( $td->revenu,2)}}</td>


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

        @endsection @section('javascript')
        <script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script>
        <script>
            $( document ).ready( function () {
				$( '#drivers' ).DataTable({
                    "pageLength": 25,
                });

$('#startDate').datepicker()
			} );
        </script>
        @endsection
