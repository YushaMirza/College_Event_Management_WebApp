<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizerNotification;

class OrganizerNotificationController extends Controller
{

public function markAllRead()
{
    $organizerId = auth()->user()->enrollment_id;

    OrganizerNotification::where('organizer_id', $organizerId)
        ->update(['is_read' => true]);

    return back()->with('success', 'All notifications marked as read');
}
}
