<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityTypeRequest;
use App\Models\ActivityType;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $activityTypes = ActivityType::paginate(10);
        return view('activity-types.index', compact('activityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('activity-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ActivityTypeRequest $request
     * @return RedirectResponse
     */
    public function store(ActivityTypeRequest $request)
    {
        ActivityType::create($request->all());

        return redirect()->route('activity-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param ActivityType $activityType
     * @return Factory|View
     */
    public function show(ActivityType $activityType)
    {
        return view('activity-types.show', compact('activityType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ActivityType $activityType
     * @return Factory|View
     */
    public function edit(ActivityType $activityType)
    {
        return view('activity-types.edit', compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ActivityTypeRequest $request
     * @param ActivityType $activityType
     * @return RedirectResponse
     */
    public function update(ActivityTypeRequest $request, ActivityType $activityType)
    {
        $activityType->update($request->all());

        return redirect()->route('activity-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ActivityType $activityType
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ActivityType $activityType)
    {
        $activityType->delete();

        return redirect()->route('activity-types.index');
    }
}
