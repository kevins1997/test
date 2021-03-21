@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2> Time Sheet for project {{$timeSheet->project->title}}</h2>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <table class="table">
                <tbody>
                    <tr>
                        <td>User:</td>
                        <td>{{$timeSheet->user->name}}</td>
                    </tr>
                    <tr>
                        <td>Project:</td>
                        <td>{{$timeSheet->project->title}}</td>
                    </tr>
                    <tr>
                        <td>Activity:</td>
                        <td>{{$timeSheet->activityType->title}}</td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td>{{$timeSheet->date}}</td>
                    </tr>
                    <tr>
                        <td>Hours:</td>
                        <td>{{$timeSheet->hours}}</td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>{{$timeSheet->description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a class="btn btn-secondary ml-3" href="{{ route('time-sheets.index') }}"> Back</a>
    </div>
@endsection
