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

<div class="row col-12">
    <div class="col-12 mb-3">

        <a href="{{route('performance_by_status')}}" class="btn btn-primary pull-right">Back</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-sm table-striped" id="drivers">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Plate</th>
                    <th>Status Name</th>
                    <th>Registed Date</th>


                </tr>
            </thead>
            <tbody>
                <?php $no = 0 ?>
                {{-- {{ dd($status_date) }} --}}
                @if ($status_summery->count()> 0)
                @foreach ($status_summery as $td)
                <tr>
                    <td class='m-1 p-1 text-center'>{{++$no}}</td>
                    <td class='m-1 p-1'>{{$td->plate}}</td>
                    <td class='m-1 p-1 text-right'>{{$td->name}}</td>
                    <td class='m-1 p-1 text-right'>{{ $td->registerddate}}</td>

                </tr>
                @endforeach

                @else
                <tr>
                    <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
                </tr>
                @endif

            </tbody>

        </table>
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center active">
                        Status Name
                        <span class="badge badge-secondary badge-pill">Number</span>
                        <span class="badge badge-secondary badge-pill">%</span>
                    </li>
                    <?php $total = $status_summery->count()?>
                    @foreach ($status_date as $key =>$td)

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $td->name}}
                        <span class="badge badge-secondary badge-pill">{{ $td->number}}</span>
                        <span
                            class="badge badge-secondary badge-pill">{{ number_format(($td->number/$total)*100,2)}}</span>
                    </li>

                    @endforeach
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Total
                        <span class="badge badge-secondary badge-pill">{{ $total}}</span>
                        <span class="badge badge-secondary badge-pill">100%</span>
                    </li>
                </ul>
            </div>
        </div>


        @endsection
        @section( 'javascript' ) {
        {
        --
        <script src="{{ asset('js/jquery.dataTables.min.js') }}">
        </script>
        <script>
            $( document ).ready( function () {
					$( '#drivers' ).DataTable();

				} );
        </script>--
        }
        }
        @endsection
