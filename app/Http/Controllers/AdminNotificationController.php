<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Models\OrganizerNotification;

class AdminNotificationController extends Controller
{
    function getDepartment()
    {
        $usermodel = new User();
        $department = User::all();
        $notifications = OrganizerNotification::orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        $adminnotifications = AdminNotification::orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        $user = auth()->user();

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
        return view('admin.addNotification', ['departments' => $department] , compact('adminnotifications','unreadCount','notifications'));

    }

    public function storeNotifications(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:guideline,policy,reminder,other',
            'department' => 'required|string'
        ]);

        $color = match($request->type) {
            'guideline' => 'primary',
            'privacy' => 'warning',
            'success' => 'success',
            default => 'primary'
        };

        AdminNotification::create([
            'admin_id' => auth()->id(),
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'department' => $request->department,
            'color' => $color
        ]);

        return redirect()->back()->with('successMessage', 'Notification added successfully!');
    }
}
