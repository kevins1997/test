@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="col-xs-10 col-sm-10 col-md-10 offset-xs-4 offset-sm-4 offset-md-3">
                <h2>Edit Activity Type</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('activity-types.update',$activityType->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input class="form-control input {{ $errors->has('title') ? 'is-danger' : ''}}" type="text"
                           name="title" placeholder="Enter Title" value="{{ $activityType->title }}">
                    @if($errors->has('title'))
                        <p class="help-is-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('activity-types.index') }}"> Back</a>
            </div>
        </div>

    </form>
@endsection
