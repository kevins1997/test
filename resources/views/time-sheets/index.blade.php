@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <form action="{{route('filter')}}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-2">
                    <strong>Date From</strong>
                    <input class="form-control mr-2" value="{{request()->get('date_from')}}" type="date" id="date_from" name="date_from"/>
                </div>
                <div class="form-group col-2">
                    <strong>Date To</strong>
                    <input class="form-control" value="{{request()->get('date_to')}}" type="date" id="date_to" name="date_to"/>
                </div>
                <div class="form-group col-3">
                    <strong>Choose a Project:</strong>
                    <select style="width: 100%" class="form-control" id="project-select" name="project_id">
                        <option value="0">Select</option>
                        @foreach($projects as $project)
                            <option {{request()->project_id == $project->id ? 'selected' : ''}} value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-3">
                    <strong>Choose an Activity Type:</strong>
                    <select style="width: 100%" class="form-control" id="activity-type-select" name="activity_type_id">
                        <option value="0">Select</option>
                        @foreach($projects as $project)
                            @foreach($project->activityTypes as $activityType)
                                <option {{request()->activity_type_id == $activityType->id ? 'selected' : ''}} {{request()->project_id == $project->id ? '' : 'hidden'}} class="activities-for-project activities-for-project-{{$project->id}}" value="{{ $activityType->id }}">{{ $activityType->title }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                @if(auth()->user()->isAdmin())
                    <div class="form-group col-3">
                        <strong>Choose a User:</strong>
                        <select style="width: 100%" class="form-control" id="user-select" name="user_id">
                            <option value="0">Select</option>
                            @foreach($users as $user)
                                <option {{ request()->user_id == $user->id ? 'selected' : '' }} value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-info">Search</button>
            <button class="btn btn-warning" id="clear-form">Clear</button>
        </form>

        @if(!auth()->user()->isAdmin())
            <div class="mt-4">
                <a href="{{ route('time-sheets.create') }}" class="btn btn-primary mb-2">Create Time Sheet</a>
            </div>
        @endif
        <table class="table table-bordered mb-5">
            <thead>
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Project</th>
                <th scope="col">User</th>
                <th scope="col">Activity Type</th>
                <th scope="col">Date</th>
                <th scope="col">Hours</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($timeSheets as $timeSheet)
                <tr>
                    <th scope="row">{{ $timeSheet->id }}</th>
                    <td>{{ $timeSheet->project->title }}</td>
                    <td>{{ $timeSheet->user->name }}</td>
                    <td>{{ $timeSheet->activityType->title }}</td>
                    <td>{{ $timeSheet->date }}</td>
                    <td>{{ $timeSheet->hours }}</td>
                    <td class="td-width-5">
                        <a class="btn btn-info" href="{{ route('time-sheets.show', $timeSheet->id) }}">Show</a>
                        @if(!auth()->user()->isAdmin())
                            <a class="btn btn-success" href="{{ route('time-sheets.edit', $timeSheet->id) }}">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--        Pagination--}}
        <div class="d-flex justify-content-center">
            {!! $timeSheets->links() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#clear-form').on('click', function (e) {
                e.preventDefault();
                $('#date_from').val('');
                $('#date_to').val('');
                $('#project-select').val(0);
                $('#user-select').val(0);
                $('#activity-type-select').val(0);
            });
            $('#project-select').on('change', function () {
                const selectedProjectId = $(this).val();
                $('.activities-for-project').attr('hidden', true);

                if (!selectedProjectId) {
                    return;
                }

                $('.activities-for-project-' + selectedProjectId).removeAttr('hidden');
            });
        })
    </script>
@endsection
