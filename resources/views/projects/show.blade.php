@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Show Project</h2>
            </div>

        </div>
    </div>

    <div class="row" style="max-width: 70%">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group break-word">
                <strong>Title:</strong>
                {{ ucfirst($project->title) }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group break-word">
                <strong>Description:</strong>
                {{ ucfirst($project->description) }}
            </div>
        </div>
        <a class="btn btn-secondary ml-3" href="{{ route('projects.index') }}"> Back</a>
    </div>
@endsection
