@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="col-xs-10 col-sm-10 col-md-10 offset-xs-4 offset-sm-4 offset-md-3">
                <h2>Edit User</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control input {{ $errors->has('name') ? 'is-danger' : ''}}" type="text"
                           name="name" placeholder="Enter Name" value="{{ $user->name }}">
                    @if($errors->has('name'))
                        <p class="help-is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control input {{ $errors->has('email') ? 'is-danger' : ''}}" type="email"
                           name="email" placeholder="Enter email" value="{{ $user->email }}">
                    @if($errors->has('email'))
                        <p class="help-is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>

    </form>
@endsection
