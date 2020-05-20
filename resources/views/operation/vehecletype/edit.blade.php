@extends( 'master.app' )

@section( 'title', 'TIMS | Edit Vehecle Model' )
@section( 'content' )
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
    </li>
    <li class="breadcrumb-item ">Trucks</li>
    <li class="breadcrumb-item active">Trucks Model Edit</li>
</ol>
<div class="col-md-12">
    <div class="card text-left">
        <div class="card-header">

            <div class="d-flex align-items-center">
                <h2>Vehecletype Updation</h2>

                <div class="ml-auto">
                    <a href="{{route('vehecletype')}}" class="btn btn-outline-primary"><i
                            class="fa fa-caret-left mr-1"></i>Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('vehecletype.update',['id'=>$vehecletype->id])}}"
                class="form-horizontal" id="truck_form">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group required pb-0">
                            <label class="control-label">Type/Model Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" name="name" id="name" class="form-control" required
                                    value="{{$vehecletype->name}}">
                            </div>
                            <small class="form-text text-danger" id="error_plate"></small>

                        </div>

                        <div class="form-group pb-0">
                            <label class="control-label">Company</label>
                            <div class="input-group"> <span class="input-group-addon"></span>
                                <input name="company" type="text" class="form-control" id="company"
                                    value="{{$vehecletype->company}}">
                            </div>

                        </div>
                        <div class="form-group pb-0">
                            <label class="control-label">Production Date</label>
                            <div class="input-group"> <span class="input-group-addon"></span>
                                <input name="pdate" type="date" class="form-control" id="pdate"
                                    value="{{$vehecletype->productiondate}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea class="form-control" name="comment" id="comment"
                                rows="3">{{$vehecletype->comment}}</textarea>
                        </div>
                        <span class="help-block"></span>

                        <div class="form-group pb-0 text-right">
                            <input type="submit" class="btn btn-primary btn-lg" name="save" id="mangeBtn" value="Save">
                        </div>
                        <!--                                          the right side begins here-->
                    </div>




                </div>
        </div>
        <div class="card-footer">
            the footer
        </div>

        </form>
    </div>

</div>



@endsection
