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
                        <?php $no = 0 ?>
                        @if ($performances->count()> 0)
                        @foreach ($performances as $pr)

                        <tr>
                            <td class='m-1 p-1'>{{++$no}}</td>
                            <td class='m-1 p-1'>{{$pr->FOnumber}}</td>
                            <td class='m-1 p-1'>{{$pr->plate}} - {{$pr->dname}}</td>
                            <td class='m-1 p-1' data-toggle="tooltip" data-placement="top" title="">{{$pr->DateDispach}}
                            </td>
                            <td class='m-1 p-1'>{{$pr->orgion}}</td>
                            <td class='m-1 p-1 text-right'>{{number_format($pr->tonkm, 2)}}</td>
                            <td class='m-1 p-1 text-center'>{{number_format($pr->CargoVolumMT,2)}}</td>
                            @if($pr->is_returned == 0)
                            <td class='m-1 p-1'><span class="badge badge-danger">Not Returned</span></td>
                            @else
                            <td class='m-1 p-1'> <span class="badge badge-primary"> Returned</span></td>
                            @endif
                            @if($pr->trip == 1)
                            <td class='m-1 p-1'><span class="badge badge-info">Main Trip</span></td>
                            @else
                            <td class='m-1 p-1'> <span class="badge badge-default"> Part of Trip</span></td>
                            @endif
                            @can('performance view')
                            <td class='m-1 p-1 text-center'><a href="{{route('performace.show',['id'=> $pr->id])}}"> <i
                                        class="fa fa-edit "></i>
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
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
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
