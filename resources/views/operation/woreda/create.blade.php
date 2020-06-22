@extends( 'master.app' )
@section( 'title', 'TIMS | Woreda Create' )

@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Operations</a>
    </li>
    <li class="breadcrumb-item active">Operational Woreda Create</li>
</ol>
<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">
            <h2>Operational Woreda Registration</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('woreda.store')}}" class="form-horizontal" id="Woreda_reg">
                @csrf
                @include('operation.woreda.form')
                <div class="form-group required">
                    <button type="submit" class="btn btn-primary" name="save">Save</button>

                </div>


        </div>
        <!--                                          the right side begins here-->
        <div class="card-footer">
            the footer
        </div>
        </form>
    </div>


</div>




@endsection
