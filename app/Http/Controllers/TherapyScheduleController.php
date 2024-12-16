<?php
namespace App\Http\Controllers;

use App\Models\TherapySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TherapyScheduleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', TherapySchedule::class);
        $schedules = TherapySchedule::with('therapist')->get()->groupBy('therapist_id');
        return view('therapy.index', compact('schedules'));
    }

    public function manageSchedule()
    {
        $this->authorize('create', TherapySchedule::class);
        $schedules = TherapySchedule::where('therapist_id', Auth::id())->get();
        return view('dashboard.therapy.schedule.index', compact('schedules'));
    }

    public function storeSchedule(Request $request)
    {
        $this->authorize('create', TherapySchedule::class);
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        TherapySchedule::create([
            'therapist_id' => Auth::id(),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'status' => 'available',
        ]);
        return redirect()->route('schedule.manage')->with('success', 'Schedule created successfully.');
    }

    public function createSchedule()
    {
        $this->authorize('create', TherapySchedule::class);
        return view('dashboard.therapy.schedule.create');
    }

    public function editSchedule(TherapySchedule $schedule)
    {
        $this->authorize('update', $schedule);
        return view('dashboard.therapy.schedule.edit', compact('schedule'));
    }

    public function updateSchedule(Request $request, TherapySchedule $schedule)
    {
        $this->authorize('update', $schedule);
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        $schedule->update($request->all());
        return redirect()->route('schedule.manage')->with('success', 'Schedule updated successfully.');
    }

    public function destroySchedule(TherapySchedule $schedule)
    {
        $this->authorize('delete', $schedule);
        $schedule->delete();
        return redirect()->route('schedule.manage')->with('success', 'Schedule deleted successfully.');
    }

    public function toggleScheduleStatus(TherapySchedule $schedule)
    {
        $this->authorize('update', $schedule);
        $schedule->status = $schedule->status === 'available' ? 'unavailable' : 'available';
        $schedule->save();
        return redirect()->route('schedule.manage')->with('success', 'Schedule status updated successfully.');
    }
}