<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\Auth;
use App\Models\OrganizerNotification;

class ProfileController extends Controller
{
    public function showprofile() {
    $adminnotificationspar = AdminNotification::where('department', 'participant')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        $adminnotificationsorg = AdminNotification::where('department', 'organizer')
                        ->orderBy('created_at', 'desc')
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

    $notifications = OrganizerNotification::orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

    return view('participant.profile', compact('adminnotificationspar','adminnotificationsorg','unreadCount', 'notifications'));

}

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($user->image && $user->image !== 'default.png') {
            $oldImagePath = public_path('images/profile_icons/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images/profile_icons'), $imageName);

        $user->image = $imageName;
        $user->save();

        return back()->with('successMessage', 'Profile picture updated successfully.');
    }

    public function updateDetails(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'phone'      => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->phone      = $request->phone;
        $user->save();

        return back()->with('successMessage', 'Profile details updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with(['errorMessage' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('successMessage', 'Password changed successfully.');
    }
}
