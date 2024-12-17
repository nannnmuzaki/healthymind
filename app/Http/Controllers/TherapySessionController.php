<?php

namespace App\Http\Controllers;

use App\Models\TherapySession;
use App\Models\TherapySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TherapySessionController extends Controller
{
    use AuthorizesRequests;

    // Display all therapy sessions.
    public function viewAll() {
        $this->authorize('viewAll', TherapySession::class);
        $sessions = TherapySession::all();
        return view('therapy.index', compact('sessions'));
    }

    /**
     * Display a listing of the user's therapy sessions.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 1) {
            // Fetch sessions for clients
            $sessions = TherapySession::where('user_id', $user->id)->get();
        } else {
            // Fetch sessions for therapists
            $sessions = TherapySession::where('therapist_id', $user->id)->get();
        }

        return view('dashboard.therapy.session.index', compact('sessions'));
    }

    /**
     * Book a new therapy session.
     */
    public function book($id)
    {
        if (!auth()->check() || !auth()->user()->can('create', TherapySession::class)) {
            return redirect()->route('login');
        }

        $this->authorize('create', TherapySession::class);
        $schedule = TherapySchedule::findOrFail($id);

        $session = new TherapySession();
        $session->user_id = Auth::id(); // Set the user_id
        $session->therapist_id = $schedule->therapist_id;
        $session->therapy_schedule_id = $schedule->id;
        $session->is_paid = false;
        $session->session_link = ''; 
        $session->save();

        return redirect()->back()->with('success', 'Session booked successfully!');
    }

    /**
     * Remove the specified therapy session.
     */
    public function destroy(TherapySession $session)
    {
        $this->authorize('delete', [$session]);

        $session->delete();
        return redirect()->route('session.index')->with('success', 'Therapy session deleted successfully.');
    }

    /**
     * Toggle the is_paid status and add the therapy session link.
     */
    public function toggleIsPaid(Request $request, TherapySession $session)
    {
        $this->authorize('update', [$session]);
        $request->validate([
            'is_paid' => 'required|boolean',
            'session_link' => 'nullable|url',
        ]);

        $session->is_paid = $request->is_paid;
        if ($request->has('session_link')) {
            $session->session_link = $request->session_link;
        }
        $session->save();

        return redirect()->route('session.index')->with('status', 'Session updated successfully!');
    }
}