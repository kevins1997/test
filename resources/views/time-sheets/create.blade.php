@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 margin-tb">
            <div class="pull-left">
                <h2>Create New TimeSheet</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('time-sheets.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 mt-2">
                <strong>Choose a Project:</strong>
                <select style="width: 100%" class="form-control" id="project-select" name="project_id">
                    <option>Select</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 mt-2">
                <strong>Choose an Activity Type:</strong>
                <select style="width: 100%" class="form-control" name="activity_type_id">
                    <option>Select</option>
                    @foreach($projects as $project)
                        @foreach($project->activityTypes as $activityType)
                            <option hidden class="activities-for-project activities-for-project-{{$project->id}}"
                                    value="{{ $activityType->id }}">{{ $activityType->title }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 row mt-2">
                <div class="form-group col-xs-6 col-sm-6 col-md-6 pl-0">
                    <strong>Date:</strong>
                    <br>
                    <input class="form-control" type="date" id="date" name="date" value="{{ old('date') }}">
                </div>
                <div class="form-group col-xs-6 col-sm-6 col-md-6 pr-0">
                    <strong>Hours:</strong>
                    <br>
                    <input class="form-control" type="number" id="hours" name="hours" value="{{ old('hours') }}">
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 mt-2">
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

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2 text-center mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary" href="{{ route('time-sheets.index') }}"> Back</a>
            </div>
        </div>

    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#project-select').on('change', function () {
                const selectedProjectId = $(this).val();
                $('.activities-for-project').attr('hidden', true);

                if (!selectedProjectId) {
                    return;
                }

                $('.activities-for-project-' + selectedProjectId).removeAttr('hidden');
            });
        });
    </script>
@endsection
