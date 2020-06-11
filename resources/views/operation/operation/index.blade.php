@extends( 'master.app' )
@section( 'title', 'TIMS | Operation' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Operation</li>
</ol>

<div class="row col-md-12">
    <div class="card text-left col-md-12">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Oprations </h2>
                @can('operation create')

                <div class="ml-auto">
                    <a href="{{route('operation.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i>Add Operation</a>

                </div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="operations">
                    <thead>
                        <tr>
                            <th width="5%">no</th>
                            <th width="5%">Operation Id</th>
                            <th width="10%">Client Name</th>
                            <th width="10%">start Date</th>
                            <th width="10%">Region </th>
                            <th width="10%">Volum MT</th>
                            <th width="10%">Cargo Type</th>
                            <th width="10%">TonKM</th>
                            <th width="10%">Tarif</th>
                            <th width="10%">Status</th>
                            @can('operation view')
                            <th width="3%">Details</th>
                            @endcan


                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @if ($operations->count()> 0)
                        @foreach ($operations as $operation)
                        <tr>
                            <td class='m-1 p-1'>{{$no ++}}</td>
                            <td class='m-1 p-1'>{{$operation->operationid}}</td>
                            <td class='m-1 p-1'>{{$operation->customer->name}}</td>
                            <td class='m-1 p-1'>{{Date($operation->startdate)}}</td>
                            <td class='m-1 p-1'>{{$operation->region->name}}</td>
                            <td class='m-1 p-1 text-right'>{{number_format($operation->volume,2)}}</td>
                            @if($operation->cargotype == 1)
                            <td class='m-1 p-1'>Relief</td>
                            @else
                            <td class='m-1 p-1'>Commercial</td>
                            @endif
                            <td class='m-1 p-1 text-right'>{{number_format($operation->km,0)}}</td>
                            <td class='m-1 p-1 text-right'>{{$operation->tariff}}</td>
                            @if ($operation->closed == 0)
                            <td class='m-1 p-1'><span class="badge badge-danger">closed
                                    {{$operation->enddate->diffForHumans()}}</span></td>
                            @else
                            <td class='m-1 p-1'><span class="badge badge-info">Opened </span></td>
                            @endif
                            @can('operation view')
                            <td class='m-1 p-1 text-center' data-toggle="tooltip" data-placement="top" title="show">
                                <a href="{{route('operation.show',['id'=> $operation->id])}}"> <i
                                        class="fa fa-edit    "></i>
                            </td>
                            @endcan


                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class='m-1 p-1 text-center' colspan="14">No Data Avilable</td>
                        </tr>
                        @endif

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
				$( '#operations' ).DataTable({

				"pageLength": 25,
				// "scrollY": 100,
				'columnDefs': [ {

				// 'targets': [10,11,12], /* column index */

				'orderable': false, /* true or false */

				}]
				});
			} );


</script>
@endsection
