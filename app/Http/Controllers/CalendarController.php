<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
{
    if (request()->ajax()) {
        $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
        $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

        // Get events
        $events = Event::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)
            ->get(['id', 'title', 'start', 'end']);

        // Get reminders
        $reminders = Reminder::whereDate('start', '>=', $start)->whereDate('start', '<=', $end)
            ->get(['id', 'title', 'start']);

        // Combine events and reminders
        $allData = $events->concat($reminders);

        return response()->json($allData);
    }

    $userRole = Auth::user()->role;

    return view('calendar', ['userRole' => $userRole]);
}

    public function createEvent(Request $request)
    {
        $data = $request->except('_token');
        $events = Event::insert($data);
        return response()->json($events);
    }

    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->id);
        return $event->delete();
    }

    public function addReminder(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'start' => 'required|date',
        ]);

        // Create a new reminder in your database
        $reminder = new Reminder;
        $reminder->title = $request->input('title');
        $reminder->start = $request->input('start');
        $reminder->save();

        // You can return a response if needed
        return response()->json(['message' => 'Reminder added successfully']);
    }

    public function deleteReminder(Request $request)
    {
        $reminder = Reminder::find($request->id);
        return $reminder->delete();
    }

}
