@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="pull-left">
                <h2>Create New Project</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input class="form-control input {{ $errors->has('title') ? 'is-danger' : ''}}" type="text"
                           name="title" placeholder="Enter Title" value="{{ old('title') }}">
                    @if($errors->has('title'))
                        <p class="help-is-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control input {{ $errors->has('description') ? 'is-danger' : ''}}"
                              style="height:150px" name="description"
                              placeholder="Enter Description">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <p class="help-is-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <strong>Choose a User:</strong>
                <select style="width: 100%" class="users-multiple" name="users[]" multiple="multiple">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <strong>Choose an Activity Type:</strong>
                <select style="width: 100%" class="activities-multiple" name="activities[]" multiple="multiple">
                    @foreach($activityTypes as $activityType)
                        <option value="{{ $activityType->id }}">{{ $activityType->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 text-center mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
            </div>
        </div>

    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.users-multiple').select2();
            $('.activities-multiple').select2();
        });
    </script>
@endsection
