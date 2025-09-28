<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\User;
use App\Models\Feedback;
use App\Models\EventRegistrations;

class ReportsController extends Controller
{
    public function getReport($id)
    {
        $eventCount = event::count();
        $event = event::all();
        $event = DB::table('events')->where('id', $id)->first();

        $participations = DB::table('event_registrations')
            ->where('event_id', $id)
            ->count();

        $totalSlots = $event->max_slots;
        $slotsFulled = $event->slots_fulled;

        $feedbacks = DB::table('feedback')
            ->where('event_id', $id)
            ->get();

        $avgRating = DB::table('feedback')
            ->where('event_id', $id)
            ->avg('rating');

        $userGrowth = DB::table('event_registrations')
            ->where('event_id', $id)
            ->distinct('user_id')
            ->count('user_id');

        return view('admin.makeReports', compact('eventCount', 'totalSlots', 'slotsFulled', 'participations', 'userGrowth', 'userGrowth', 'avgRating', 'feedbacks', 'slotsFulled', 'totalSlots', 'event', 'participations'));
    }
}
