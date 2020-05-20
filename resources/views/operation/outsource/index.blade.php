@extends( 'master.app' )
@section( 'title', 'TIMS | Outsource Customer' )
@section( 'styles' )
<link rel="stylesheet" href="{{asset('/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Outsource Customer</li>
</ol>

<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>All Outsource Customers </h2>
                @can('oursource create')

                <div class="ml-auto">
                    <a href="{{route('outsource.create')}}" class="btn btn-outline-primary"> <i class="fafa-plus"></i>
                        Add OutSource Customer</a>

                </div>
                @endcan
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-sm table-striped" id="customer">
                    <thead>
                        <tr>
                            <th width="3%">Number</th>
                            <th class="text-center">Customer Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Office No</th>
                            <th class="text-center">Mobile </th>
                            <th class="text-center">Remark</th>
                            {{-- @can('outsource edit') --}}
                            <th width="5%">Edit</th>
                            {{-- @endcan --}}
                            {{-- @can('outsource delete') --}}
                            <th width="5%">Delete</th>
                            {{-- @endcan --}}

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0 ?>
                        @if ($outsources->count()> 0)
                        @foreach ($outsources as $outsource)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$outsource->name}}</td>
                            <td>{{$outsource->address}}</td>
                            <td>{{$outsource->officenumber}}</td>
                            <td>{{$outsource->mobile}}</td>
                            <td>{{$outsource->remark}}</td>
                            {{-- @can('outsource edit') --}}
                            <td class='m-1 p-1 text-center'><a
                                    href="{{route('outsource.edit',['id'=> $outsource->id])}}">
                                    <i class="fa fa-edit "></i> </a>
                            </td>
                            {{-- @endcan
                            @can('outsource delete') --}}
                            <td class='m-1 p-1 text-center '>
                                <form action="{{route('outsource.destroy',['id'=> $outsource->id])}}"
                                    id="delete-form-{{$outsource->id}}" style="display: none" method="POST">
                                    @csrf

                                    @method('DELETE')
                                </form>

                                <button type="submit" onclick="if(confirm('Are you sure to delete this?')){
									event.preventDefault();
									document.getElementById('delete-form-{{$outsource->id}}').submit();
								}else{
								event.preventDefault();
								}"> <i class="fa fa-trash red"></i>
                                </button>
                            </td>
                            {{-- @endcan --}}

                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td class='m-1 p-1 text-center' colspan="12">No Data Avilable</td>
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
    $(document).ready( function () {
				$('#customer').DataTable();
			} );
</script>
@endsection
