<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Models\OrganizerNotification;

class HomeController
{
    public function showHome()
    {

        
        $query = Event::with('organizer')->where('status', 'approved');
        $events = $query->latest()->take(5)->get();
        
        $user = auth()->user();
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
        return view('student.home', compact('events','notifications','adminnotificationsorg','adminnotificationspar', 'unreadCount'));
    } else {
        return view('student.home', compact('events'));
    }


    }
}
