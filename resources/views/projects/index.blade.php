@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @if(auth()->user()->isAdmin())
            <div>
                <a href="{{ route('projects.create') }}" class="btn btn-primary mb-2">Create Project</a>
            </div>
        @endif
        <table class="table table-bordered mb-5">
            <thead>
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ \Str::limit($project->title, 20) }}</td>
                    <td class="td-width-5">
                        <a class="btn btn-info" href="{{ route('projects.show',$project->id) }}">Show</a>
                        @if(auth()->user()->isAdmin())
                            <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
                                <a class="btn btn-success" href="{{ route('projects.edit',$project->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--        Pagination--}}
        <div class="d-flex justify-content-center">
            {!! $projects->links() !!}
        </div>
    </div>
@endsection
