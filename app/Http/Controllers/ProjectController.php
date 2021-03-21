<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\ActivityType;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View|Response
     */
    public function create()
    {
        $users = User::query()->where('role_id', 2)->get();
        $activityTypes = ActivityType::all();
        return view('projects.create', compact('users', 'activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request)
    {
        $users = $request->get('users');
        $activityTypes = $request->get('activities');

        $project = Project::create($request->all());

        $project->users()->attach($users);
        $project->activityTypes()->attach($activityTypes);

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Factory|View
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Factory|View
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return RedirectResponse
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');

    }
}
