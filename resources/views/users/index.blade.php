@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        @if(!auth()->user()->isAdmin())
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Create User</a>
            </div>
        @endif
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ \Str::limit($user->name, 20) }}</td>
                    <td>{{ ($user->email) }}</td>
                    <td class="td-width-5">
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                            <a class="btn btn-success" href="{{ route('users.edit', $user->id) }}">Edit</a>
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
            {!! $users->links() !!}
        </div>
    </div>
@endsection
