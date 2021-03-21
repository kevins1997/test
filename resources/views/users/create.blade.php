@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="pull-left">
                <h2>Create New User</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control input {{ $errors->has('name') ? 'is-danger' : ''}}" type="text"
                           name="name" placeholder="Enter Name" value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <p class="help-is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control input {{ $errors->has('email') ? 'is-danger' : ''}}" type="email"
                           name="email" placeholder="Enter email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <p class="help-is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input class="form-control input {{ $errors->has('password') ? 'is-danger' : ''}}" type="password"
                           name="password" placeholder="Enter Password">
                    @if($errors->has('password'))
                        <p class="help-is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input type="password"
                           class="form-control input {{ $errors->has('password') ? 'is-danger' : ''}}"
                           name="password_confirmation"  autocomplete="new-password"
                    placeholder="Confirm Password">
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>

    </form>
@endsection
