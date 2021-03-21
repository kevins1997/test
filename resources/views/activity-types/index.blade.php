@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <table class="table table-bordered mb-5">
            <thead>

            <div>
                <a href="{{ route('activity-types.create') }}" class="btn btn-primary mb-2">Create Activity Type</a>
            </div>
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody>
            @foreach($activityTypes as $activityType)
                <tr>
                    <th scope="row">{{ $activityType->id }}</th>
                    <td>{{ Illuminate\Support\Str::limit($activityType->title, 20) }}</td>
                    <td class="td-width-5">
                        <form action="{{ route('activity-types.destroy',$activityType->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('activity-types.show',$activityType->id) }}">Show</a>
                            <a class="btn btn-success" href="{{ route('activity-types.edit',$activityType->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{--        Pagination--}}
        <div class="d-flex justify-content-center">
            {!! $activityTypes->links() !!}
        </div>
    </div>
@endsection
