@extends( 'master.app' )
@section( 'title', 'TIMS | Performance Create' )

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Performance</li>
</ol>

<div class="col-md-12">
    <div class="card text-left">
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <h2 class="text-center"> Report From {{ $start}} To {{ $end}} For @if($years > 0){{ $years }} Years
                    @endif
                    @if($months > 0){{ $months }} Monthes @endif {{ $days}} days </h2>
                <table class="table table-bordered table-sm table-striped" id="drivers1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>FO</th>
                            <th>Plate</th>
                            <th>Origion</th>
                            <th>Destination</th>
                            <th>Toatl KM</th>
                            <th>Dispach Date</th>
                            <th>Returnded Date</th>
                            <th>Differance </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @if ($performances->count()> 0)
                        @foreach ($performances as $pr)

                        <tr>
                            <td class='m-1 p-1'>{{++$no}}</td>
                            <td class='m-1 p-1'>{{$pr->FOnumber}}</td>
                            <td class='m-1 p-1'>{{$pr->driver_truck->plate}} : {{$pr->driver_truck->driverid}}</td>
                            <td class='m-1 p-1'>{{$pr->orgion->name}}</td>
                            <td class='m-1 p-1'>{{$pr->destination->name}}</td>
                            <td class='m-1 p-1 text-right'>{{number_format($pr->totalkm,2)}}</td>
                            <td class='m-1 p-1'>{{$pr->DateDispach}}</td>
                            <td class='m-1 p-1'>{{$pr->returned_date}}</td>
                            @if($pr->is_returned == 0)
                            <td class='m-1 p-1'><span class="badge badge-danger">Not Returned</span></td>
                            @else
                            <td class='m-1 p-1'>{{$pr->datedifference}}</td>
                            @endif

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
				$( '#drivers1' ).DataTable( {
                    "pageLength": 25,
                    dom: 'Bfrtip',
					buttons: [
						'excel', 'print'
					]
				} );
            } );
</script>

@endsection
