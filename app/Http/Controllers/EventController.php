<?php
// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display all events
    public function index(Request $request)
    {
        $search = $request->get('search');
        $events = Event::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', "%$search%")
                         ->orWhere('date', 'like', "%$search%");
        })->paginate(10);

        return view('dashboard.events.index', compact('events'));
    }

    // Show form to create new event
    public function create()
    {
        return view('dashboard.events.index');
    }

    // Store new event
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Added description

            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number_of_attendees' => 'required|integer',
        ]);
    
        $validated['church_name'] = auth()->user()->church_name; // Attach church_name
    
        Event::create($validated);
    
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }
    

    // Show form to edit existing event
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Added description

            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number_of_attendees' => 'required|integer',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    // Delete event
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    // Export events (optional, if you want this feature)
    public function export()
    {
        // Export logic, e.g., to CSV, Excel, or PDF
        // Return a response with the exported file
    }
}
