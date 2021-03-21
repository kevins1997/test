@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show User</h2>
            </div>

        </div>
    </div>

    <div class="row" style="max-width: 70%">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group break-word">
                <strong>Name:</strong>
                {{ ucfirst($user->name) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group break-word">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>
        <a class="btn btn-secondary ml-3" href="{{ route('users.index') }}"> Back</a>
    </div>
@endsection
