<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Models\EventRegistration;
use App\Models\OrganizerNotification;

class ParticipantController extends Controller
{
    public function participationHistory()
    {
        $userId = auth()->id();
        
        $user = auth()->user();
        $myEventRegistrations = EventRegistration::with('event')
                                    ->where('user_id', $userId)
                                    ->get();

        $notifications = [];
    if(auth()->check()) {
        if ($user->department === 'participant') {
        $notifications = OrganizerNotification::orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
    }
        $adminnotificationspar = AdminNotification::where('department', 'participant')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        $adminnotificationsorg = AdminNotification::where('department', 'organizer')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();


        if ($user->department === 'participant') {
            $unreadCount = 
                AdminNotification::where('department', 'participant')
                    ->count()
                +
                OrganizerNotification::where('department', 'participant')
                    ->where('is_read', false)
                    ->count();
        } elseif ($user->department === 'organizer') {
            $unreadCount = 
                AdminNotification::where('department', 'organizer')
                    ->count()
                +
                OrganizerNotification::where('department', 'organizer')
                    ->where('is_read', false)
                    ->count();
        } else {
            $unreadCount = 0;
        }
        return view('participant.participation_history', compact('myEventRegistrations','user','notifications','adminnotificationsorg','adminnotificationspar', 'unreadCount'));
    } else {
        return view('participant.participation_history', compact('myEventRegistrations'));
    }
                                    
                                    
        
    }
}
