@extends( 'master.app' )
@section( 'title', 'TIMS | User Create' )

@section('content')

<div class="col-lg-12 bg-white">
    <div class="card">
        <div class="card-header text-center"><strong> User Registration Form</strong>
        </div>

        <div class="col-6">
            <div class="card-body">
                <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group required">
                        <label class="control-label">Full Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" value="{{ old('name') }}" required autofocus>
                        @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group required">
                        <label for="email"
                            class="control-label col-form-label text-md-right">{{ __('E-Mail Address') }}</label>


                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class='form-group form-check form-check-inline'>
                        <label for="roles">Role </label>
                        @foreach ($roles as $role)
                        <div class="form-check">

                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="roles[]" id=""
                                    value="{{$role->id}}">
                                {{$role->name}}
                            </label>

                        </div>
                        @endforeach
                    </div>

                    <div class='form-group'>
                        <label for="permissions">Permission </label>
                        @foreach ($permissions as $permission)
                        <div class="form-check">

                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="permissions[]" id=""
                                    value="{{ old('permissions[]') ?? $permission->id}}">
                                {{$permission->name}}
                            </label>

                        </div>
                        @endforeach
                    </div>



                    <div class="form-group required">
                        <label for="password"
                            class="control-label  col-form-label text-md-right">{{ __('Password') }}</label>

                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required> @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group required">
                        <label for="password-confirm"
                            class="control-label  col-form-label text-md-right">{{ __('Confirm Password') }}</label>


                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>

                        </div>
                    </div>
            </div>
        </div>
        </form>


    </div>



    @endsection
