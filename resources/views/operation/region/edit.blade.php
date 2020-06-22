@extends( 'master.app' )
@section( 'title', 'TIMS | Region Update' )

@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Operations</a>
    </li>
    <li class="breadcrumb-item active">Region Update</li>
</ol>
<div class="col-md-12">
    @include('master.error') {{-- @include('master.success') --}}
    <div class="card text-left">
        <div class="card-header">
            <h2>Region Edit</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('region.update',['id'=>$region->id])}}" class="form-horizontal"
                id="region_reg">
                @csrf
                @include('operation.region.form')

                <div class="form-group required">
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                </div>
        </div>
    </div>
</div>
<div class="card-footer">
    the footer
</div>

</form>
</div>


@endsection
