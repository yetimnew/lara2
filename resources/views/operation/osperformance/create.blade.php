@extends( 'master.app' )
@section( 'title', 'TIMS | OS Performance Create' )
@section( 'content' )
<div class="col-md-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">Outsource Performance Reg</li>
    </ol>
    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex">
                <h2>Outsource Performance Registration</h2>
                <div class="ml-auto">
                    <a href="{{route('osperformance')}}" class="btn btn-outline-primary"> <i class="fa fa-backward mr-1"
                            aria-hidden="true"> Back</i> </a>
                </div>
            </div>
        </div>
        {{-- @include('master.error')
        @include('master.success') --}}
        <div class="card-body">

            <form method="post" action="{{route('osperformance.store')}}" id="osperformance_edit_form" novalidate>
                @csrf
                @include('operation.osperformance.form')
                <div class="form-group required">
                    <button type="submit" class="btn btn-primary" name="save">Save</button>

                </div>

        </div>
    </div>

    {{-- end of card body --}}
</div>
<div class="card-footer">
    the footer
</div>


</form>
</div>
</div>

@endsection
