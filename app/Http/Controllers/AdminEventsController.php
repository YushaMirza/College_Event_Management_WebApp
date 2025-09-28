<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventsController extends Controller
{
    function viewEventDescription(){
        $eventDec = Event::all();
        return view('admin.viewEvent' , ['events'=>$eventDec]);
    }

    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'approved';
        $event->save();

        return back()->with('successMessage', 'Event approved successfully!');
    }

    public function reject($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'rejected';
        $event->save();

        return back()->with('successMessage', 'Event rejected successfully!');
    }
}
