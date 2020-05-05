@extends( 'master.app' )
@section( 'title', 'TIMS | Customer Create' )

@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item active">Customer Create</li>
</ol>
<div class="col-md-12">
    {{-- @include('master.error') --}} {{-- @include('master.success') --}}
    <div class="card text-left">

        <div class="card-header">

            <div class="d-flex align-items-center">
                <h2>Customer Registration <strong class="blue">{{$customer->name}}</strong></h2>
                @can('customer create')
                <div class="ml-auto">
                    <a href="{{route('customer')}}" class="btn btn-outline-primary">
                        <i class="fa fa-caret-left mr-1" aria-hidden="true"></i>
                        Back</a>

                </div>
                @endcan
            </div>

        </div>

        <div class="card-body">
            <form method="post" action="{{route('customer.store')}}" class="form-horizontal" id="customer_reg">
                @csrf
                @include('operation.customer.form')
                <div class="form-group required pull-right">
                    <button type="submit" class="btn btn-primary" name="save">Save</button>


                </div>


        </div>
    </div>

</div>

</form>
</div>
</div>

{{-- the modal part  --}}


@endsection
