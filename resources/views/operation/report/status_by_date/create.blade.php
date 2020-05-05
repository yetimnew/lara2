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
    <div class="row">
        <a class="btn btn-primary" href="{{route('performance_by_status')}}">Back</a>
    </div>

    <?php $no = 0 ?> @if ($tds->count()> 0)

    @foreach ($tds as $td)
    <div class="col-lg-2 col-md-3 col-sm-4  p-2">
        <button class='btn btn-outline-success btn-sm btn-block' type='button'> <span
                class='badge badge-danger float-right'>{{$td->number}}</span>
            <span class='lead'> {{$td->name}}</span></button>

    </div>dash

    @endforeach
    <div class="row">

        <h1 class="pl-5">Performance of <span class="badge badge-secondary">{{$td->registerddate}}</span></h1>
    </div>
</div>
@else
<div class="alert alert-primary " role="alert">
    <strong>No Data Avilable</strong>
</div>
@endif
<div class="row">
    <?php $no = 0 ?>
    @foreach ($tdss as $item)
    <div class="col-lg-2 col-md-3 col-sm-4  p-2">
        <ul class='list-group'>
            <li class='list-group-item p-1'>
                <span class='badge badge-success'>{{++$no}}</span> <span class="bold"></span>{{$item->targa}} <span
                    class="float-right">{{$item->name}}</span>
            </li>
        </ul>
    </div>
    @endforeach
</div>


@endsection
@section( 'javascript' ) {
{
<script src="{{ asset('js/jquery.dataTables.min.js') }}">
</script>
<script>
    $( document ).ready( function () {
					$( '#drivers' ).DataTable();

				} );
</script>
}
}
@endsection
