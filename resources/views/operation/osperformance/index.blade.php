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
                @can('performanceos create')
                <div class="ml-auto">
                    <a href="{{route('osperformance.create')}}" class="btn btn-outline-primary"><i
                            class="fafa-plus mr-1"></i>Add OS Performance</a>

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
                            <th>Operation </th>
                            <th>FO</th>
                            <th>Plate </th>
                            <th>Date Dis </th>
                            <th>Origion </th>
                            <th>Destination </th>
                            <th>Tone</th>
                            <th>Ton KM</th>
                            <th>DWC</th>
                            <th>DWOC</th>

                            @can('performanceos view')
                            <th class="text-center" width="4%">Details</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        {{-- {{dd($osperformances)}} --}}
                        @if ($osperformances->count()> 0)
                        @foreach ($osperformances as $pr)

                        <tr>
                            <td class='m-1 p-1'>{{++$no}}</td>
                            <td class='m-1 p-1'>{{$pr->operation->operationid}}</td>
                            <td class='m-1 p-1'>{{$pr->fonumber}}</td>
                            <td class='m-1 p-1'>{{$pr->plate_number}}</td>
                            <td class='m-1 p-1'>{{$pr->DateDispach}}</td>
                            <td class='m-1 p-1'>{{$pr->orgion->name}}</td>
                            <td class='m-1 p-1'>{{$pr->destination->name}}</td>
                            <td class='m-1 p-1'>{{$pr->CargoVolumMT}}</td>
                            <td class='m-1 p-1'>{{number_format($pr->tonkm,2)}}</td>
                            <td class='m-1 p-1'>{{$pr->DistanceWCargo}}</td>
                            <td class='m-1 p-1'>{{$pr->DistanceWOCargo}}</td>

                            @can('performanceos view')
                            <td class='m-1 p-1 text-center'>
                                <a href="{{route('osperformance.show',['id'=> $pr->id])}}"> <i class="fa fa-edit "></i>
                                </a>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class='m-1 p-1 text-center' colspan="19">No Data Avilable</td>
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
		$('#example').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
				$( '#drivers' ).DataTable({
					"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"pageLength": 25,
					'columnDefs': [ {
						// 'targets': [16,17,18], /* column index */
						'orderable': false, /* true or false */

				}]
				});
			} );
</script>

@endsection
