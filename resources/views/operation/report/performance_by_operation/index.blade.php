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
        <form method="post" action="{{route('performance_by_opration.store')}}" class="form-horizontal" id="truck_form">
            @csrf

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputCity">Start Date</label>
                            <input id="startDate" name="startDate" type="date" placeholder="Start Date"
                                class="form-control" required>
                        </div>
                        <div class="form-group col-md-5">
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
        <table class="table table-bordered table-sm table-striped table-hover" id="operation_performance">
            <thead>
                <tr>
                    <th>S/No</th>
                    <th>Operation ID</th>
                    <th>Clinate Name</th>
                    <th>Start Date</th>
                    <th>Cargo Volume</th>
                    <th>Tone KM</th>
                    <th>Lifted Tone ERTE </th>
                    <th>Remaining Tone</th>
                    <th>Cargo Type</th>
                    <th>Tariff</th>
                    <th>Revenue</th>
                    <th>%</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($operationsReport)}} --}}
                <?php $no = 0 ?> @if ($operationsReport->count()> 0)
                @foreach ($operationsReport as $td)
                <tr>
                    <td class='m-1 p-1'>{{++$no}}</td>
                    <td class='m-1 p-1'>{{$td->operationid}} <span class="pull-right"><a href="#"> <i
                                    class="fa fa-info-circle" aria-hidden="true"></i></a></span>
                    </td>
                    <td class='m-1 p-1'>{{$td->name}}</td>
                    <td class='m-1 p-1'>{{$td->stratdate}}</td>
                    <td class='m-1 p-1 text-right'>{{number_format($td->Tone_Given,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{number_format($td->tonkm,2)}}</td>
                    <td class='m-1 p-1 text-right'>{{number_format($td->Tone,2)}}</td>

                    <td class='m-1 p-1 text-right'>{{number_format($td->Tone_Given - $td->Tone  ,2)}}
                    </td>
                    @if ($td->cargotype == 1)
                    <td class='m-1 p-1 text-center'>Relief</td>
                    @else
                    <td class='m-1 p-1 text-center'>Commercial</td>

                    @endif
                    <td class='m-1 p-1'>{{$td->tariff}}</td>
                    <td class='m-1 p-1'>{{number_format($td->tariff * $td->tonkm ,2)}}</td>
                    <td class='m-1 p-1'>{{number_format($td->Tone/$td->Tone_Given ,2)*100}}%</td>
                    @if ($td->closed == 1)
                    <td class='m-1 p-1'> <label class='badge badge-success'>Active </label> || {{$td->enddate}} </td>
                    @else
                    <td class='m-1 p-1'> <label class='badge badge-danger'>Finished </label> || {{$td->enddate}}</td>

                    @endif

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
        @section('javascript')
        <script>
            $( document ).ready( function () {

                $( '#operation_performance' ).DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ]
                } );
                } );
        </script>
        </script>
        @endsection
