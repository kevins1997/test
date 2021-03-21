@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show Activity Type</h2>
            </div>

        </div>
    </div>

    <div class="row" style="max-width: 70%">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group break-word">
                <strong>Title:</strong>
                {{ ucfirst($activityType->title) }}
            </div>
        </div>

        <a class="btn btn-secondary ml-3" href="{{ route('activity-types.index') }}"> Back</a>
    </div>
@endsection
