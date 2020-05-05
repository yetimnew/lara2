@extends( 'master.app' )
@section( 'title', 'TIMS | Status By Date' )

@section( 'styles' )
	<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}"> @endsection @section('content')
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
		</li>
		<li class="breadcrumb-item active">Performance</li>
	</ol>
<div class="row col-12">
	<h3 class="text-center"> REPORT : Status By Date</h3>
	<div class="col-10">
		<form method="post" action="{{route('performance_by_status.view')}}" class="form-horizontal" id="truck_form">
			@csrf
				<div class="row">
			
					<div class="col-md-12">
						<div class="form-row">
							
							<div class="col-md-3 mb3">
								<label class="control-label">Truck Plate</label>
									<select name="plate" class="form-control " id="plate" >
										<option class="dropup" value=""  selected> Select One</option>       
										@foreach ($plate as $p)
										<option class="dropup" value="{{$p->plate}}">{{$p->plate}} </option>  
									@endforeach
									</select>

								<span class="invalid-feedback" role="alert"></span>
							</div>

							<div class="col-md-3 mb3 ">
								<label for="inputCity">From </label>
									<input id="startdate" name="startdate" type="date" placeholder="Start Date" class="form-control" required>
							</div>
							<div class="col-md-3 mb3 ">
								<label for="inputCity">To</label>
									<input id="enddate" name="enddate" type="date" placeholder="Start Date" class="form-control" required>
							</div>
							<div class="col-md-3 mb3">
								<label for="inputZip"></label>
									<button class="btn btn-primary btn-block" type="submit" name="register">Search</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
		</div>
		<div class="pull-right text-center">

			<h1 class="pl-5 pull-center">Performance of  <span class="badge badge-secondary">{{$maxDate}}</span><span>{{$newDate}}</span></h1>
		</div>

<div class="row col-12">

	<?php $no = 0 ?>

	 @if ($tds->count()> 0) 
	 @foreach ($tds as $td)
	<div class="col-lg-2 col-md-3 col-sm-4  p-2">
		<button class='btn btn-outline-success btn-sm btn-block' type='button'> <span class='badge badge-danger float-right'>{{$td->number}}</span> 
    <span class='lead'> {{$td->name}}</span> </button>

	</div>
	@endforeach
	</div>
@else
<div class="alert alert-primary " role="alert">
	<strong>No Data Avilable</strong>
</div>
@endif


<div class="row">
	<?php $no = 0 ;?> 
	@foreach ($tdss as $item)
	
	<div class="col-lg-2 col-md-3 col-sm-4  p-2">
		<ul class='list-group'>
			<li class='list-group-item p-1'>
				<span class='badge badge-success'>{{++$no}}</span>
				 <span class="bold"></span>{{$item->targa}}
				  <span class="float-right">{{$item->name}}</span>
			</li>
		</ul>
	</div>
	@endforeach
</div>

@endsection @section('javascript') @endsection