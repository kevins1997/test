<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimesheetRequest;
use App\Models\Project;
use App\Models\TimeSheet;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class TimeSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $user = auth()->user();
        $query = TimeSheet::with('activityType', 'project', 'user');
        $users = User::query()->where('role_id', 2)->get();
        $projects = Project::with('activityTypes')->get();
        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
            $projects = $user->projects()->with('activityTypes')->get();
            $users = [];
        }
        $timeSheets = $query->paginate(10);

        return view('time-sheets.index', compact('timeSheets', 'projects', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $user = auth()->user();
        $projects = $user->projects()->with('activityTypes')->get();
        return view('time-sheets.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TimesheetRequest $request
     * @return RedirectResponse
     */
    public function store(TimesheetRequest $request)
    {
        $timeSheetData = [
           'date' => $request->date,
           'hours' => $request->hours,
           'description' => $request->description,
           'user_id' => auth()->id(),
           'project_id' => $request->project_id,
           'activity_type_id' => $request->activity_type_id
        ];
        TimeSheet::create($timeSheetData);

        return redirect()->route('time-sheets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param TimeSheet $timeSheet
     * @return Factory|View
     */
    public function show(TimeSheet $timeSheet)
    {
        return view('time-sheets.show', compact('timeSheet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TimeSheet $timeSheet
     * @return Factory|View
     */
    public function edit(TimeSheet $timeSheet)
    {
        $user = auth()->user();

        if ($timeSheet->user_id != $user->id) {
            return redirect()->route('time-sheets.index');
        }

        $projects = $user->projects()->with('activityTypes')->get();
        return view('time-sheets.edit', compact('timeSheet', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TimesheetRequest $request
     * @param TimeSheet $timeSheet
     * @return RedirectResponse
     */
    public function update(TimesheetRequest $request, TimeSheet $timeSheet)
    {
        $user = auth()->user();
        if ($timeSheet->user_id != $user->id) {
            return redirect()->route('time-sheets.index');
        }

        $timeSheet->update($request->all());

        return redirect()->route('time-sheets.index');
    }

    public function filter(){
        $user = auth()->user();
        $query = TimeSheet::with('activityType', 'project', 'user');
        $users = User::query()->where('role_id', 2)->get();

        $projects = Project::with('activityTypes')->get();
        if (! $user->isAdmin()) {
            $users = [];
            $query->where('user_id', $user->id);
            $projects = $user->projects()->with('activityTypes')->get();
        }

        if (request()->get('date_from') && request()->get('date_to')){
            $query->whereBetween('date', [request()->date_from, request()->date_to])->get();
        } else if (request()->get('date_to')){
            $query->whereDate('date', '<=', request()->date_to);
        } else if (request()->get('date_from')) {
            $query->whereDate('date', '>=', request()->date_from);
        }
        if (request()->get('user_id') && $user->isAdmin()) {
            $query->where('user_id', request()->user_id);
        }
        if (request()->get('activity_type_id')) {
            $query->where('activity_type_id', request()->activity_type_id);
        }
        if (request()->get('project_id')) {
            $query->where('project_id', request()->project_id);
        }
        $timeSheets = $query->paginate(10);

        return view('time-sheets.index', compact('timeSheets', 'projects', 'users'));
    }
}
