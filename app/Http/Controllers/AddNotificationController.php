<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AddNotificationController extends Controller
{
    function getDepartment()
    {
        $usermodel = new User();
        $department = User::all();
        return view('admin.addNotification', ['departments' => $department]);

    }
    public function storeNotifications(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'type' => 'required',
            'department' => 'required',
        ]);
        if ($request->type == 'system-wide') {
            $targetRole = null;
        } else {
            $targetRole = $request->target_role;
        }
        AddNotification::create([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'department' => $request->$department,
        ]);

        return redirect()->back()->with('success', 'Notification sent!');

    }
}
