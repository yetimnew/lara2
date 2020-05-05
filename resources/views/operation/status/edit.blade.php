@extends( 'master.app' )
@section( 'title', 'TIMS | Status Edit' )

@section( 'content' )
<div class="col-md-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dasboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="#">Statuses</a>
        </li>
        <li class="breadcrumb-item active">Status Edit</li>
    </ol>


    <div class="card text-left">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h2>Status Update </h2>
                @can('status edit')
                <div class="ml-auto">
                    <a href="{{route('status')}}" class="btn btn-outline-primary">
                        <i class="fa fa-caret-left mr-1" aria-hidden="true"></i>
                        Back</a>

                </div>
                @endcan
            </div>

        </div>

        <div class="card-body">
            <form method="post" action="{{route('status.update',['id'=>$status->id])}}" class="form-horizontal"
                id="truck_form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="control-label col-4">Registeration Date</label>

                            <div class="col-8">
                                <input type="date" id="rdate" name="rdate" class="form-control" required
                                    value="{{$status->registerddate}}" disabled>


                            </div>
                        </div>
                        <div class="form-group  row">
                            <label class="control-label col-4"> Id</label>

                            <div class="col-8">
                                <input name="aid" type="text" cass="form-control" id="aid" class="form-control" disabled
                                    value="{{$status->autoid}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-4">Plate</label>

                            <div class="col-8">
                                <input type="text" id="plate" name="plate" class="form-control" disabled
                                    value="{{$status->plate}}">
                            </div>
                        </div>

                        <div class="form-group  row">
                            <label class="control-label col-4">Status Name</label>
                            <div class="col-8">
                                <select name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    id="name" onfocusout="validateName()">

                                    <option class="dropup" value="" selected> Select One</option>
                                    @foreach ($statustypes as $statustype)
                                    <option class="dropup" value="{{$statustype->id}}"
                                        {{ $statustype->id == $status->statustype_id ? 'selected' : '' }}>
                                        {{$statustype->name}}
                                    </option>
                                    @endforeach

                                </select>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

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
</div>


@endsection
