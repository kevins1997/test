@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 offset-xs-4 offset-sm-4 offset-md-2">
            <div class="pull-left">
                <h2>Update TimeSheet</h2>
            </div>
        </div>
    </div>
    <form action="{{ route('time-sheets.update', $timeSheet->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <strong>Choose a Project:</strong>
                <select style="width: 100%" class="form-control" id="project-select" name="project_id">
                    <option>Select</option>
                    @foreach($projects as $project)
                        <option {{$timeSheet->project_id == $project->id ? 'selected' : ''}} value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <strong>Choose an Activity Type:</strong>
                <select style="width: 100%" class="form-control" name="activity_type_id">
                    <option>Select</option>
                    @foreach($projects as $project)
                        @foreach($project->activityTypes as $activityType)
                            <option {{$timeSheet->activity_type_id == $activityType->id ? 'selected' : ''}} {{$timeSheet->project_id == $project->id ? '' : 'hidden'}} class="activities-for-project activities-for-project-{{$project->id}}" value="{{ $activityType->id }}">{{ $activityType->title }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <label for="date"><strong>Date:</strong></label>
                    <br>
                    <input type="date" id="date" name="date" value="{{ $timeSheet->date }}">
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Hours:</strong>
                    <br>
                    <input type="number" id="hours" name="hours" value="{{ $timeSheet->hours }}">
                </div>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 offset-xs-2 offset-sm-2 offset-md-2">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control input {{ $errors->has('description') ? 'is-danger' : ''}}"
                              style="height:150px" name="description"
                              placeholder="Enter Description">{{ $timeSheet->description }}</textarea>
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
        $(document).ready(function() {
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
