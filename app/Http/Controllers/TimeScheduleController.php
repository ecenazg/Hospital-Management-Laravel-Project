<?php

namespace App\Http\Controllers;

use App\Models\TimeSchedule;
use Illuminate\Http\Request;

class TimeScheduleController extends Controller
{
    public function index()
    {
        $timeSchedules = TimeSchedule::all();
        return view('time_schedules.index', compact('timeSchedules'));
    }

    public function create()
    {
        return view('time_schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'week_day' => 'required',
            'week_num' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required',
            'user_id' => 'required',
        ]);

        TimeSchedule::create($request->all());

        // Flash message
        session()->flash('success', 'Time Schedule Created Successfully.');

        return redirect(route('time_schedules.index'));
    }

    public function edit(TimeSchedule $timeSchedule)
    {
        return view('time_schedules.edit', compact('timeSchedule'));
    }

    public function update(Request $request, TimeSchedule $timeSchedule)
    {
        $request->validate([
            'week_day' => 'required',
            'week_num' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required',
            'user_id' => 'required',
        ]);

        $timeSchedule->update($request->all());

        // Flash message
        session()->flash('success', 'Time Schedule Updated Successfully.');

        return redirect(route('time_schedules.index'));
    }

    public function destroy(TimeSchedule $timeSchedule)
    {
        $timeSchedule->delete();

        // Flash message
        session()->flash('success', 'Time Schedule Deleted Successfully.');

        return redirect(route('time_schedules.index'));
    }
}
