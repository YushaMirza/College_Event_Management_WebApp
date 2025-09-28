<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizerNotification;

class AdminDashboardController extends Controller
{




    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->status === 'active') {
            $user->status = 'suspend';
        } else {
            $user->status = 'active';
        }

        $user->save();

        return redirect()->back()->with('successMessage', 'User status updated successfully!');
    }

    function viewuserdata(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });
        }

        if ($department = $request->input('department')) {
            $query->where('department', $department);
        }

        $sort = $request->input('sort', 'first_name');
        $direction = $request->input('direction', 'asc');
        $query->orderBy($sort, $direction);

        $users = $query->get();
        $departments = User::select('department')->distinct()->pluck('department');

        return view("admin.users", [
            'users' => $users,
            'departments' => $departments,
            'currentDepartment' => $request->input('department'),
            'currentSort' => $sort,
            'currentDirection' => $direction
        ]);
    }

    function deleteUserData($id)
    {
        User::destroy($id);
        return redirect("/viewUsers")->with('successMessage', 'User deleted successfully!');
    }

    function deletemedia($id)
    {
        Event::destroy($id);
        return redirect("/admin/media")->with('successMessage', 'User deleted successfully!');
    }
    public function CardsCalc()
    {
        $userCount = User::count();

        $students = DB::table('users')
            ->where('users.status', 'active')
            ->count();
        $organizers = user::where('department', 'organizer')->count();
        $admins = user::where('department', 'admin')->count();


        $eventCount = event::count();
        $approved = event::where('status', 'approved')->count();
        $pending = event::where('status', 'pending')->count();
        $rejected = event::where('status', 'rejected')->count();

        $activeParticipants = DB::table('event_registrations')
            ->join('users', 'event_registrations.user_id', '=', 'users.id')
            ->where('users.status', 'active')
            ->distinct('event_registrations.user_id')
            ->count('event_registrations.user_id');

        $certificateCount = DB::table('event_certificates')->count();

        $pendingparticipents = User::where('department', 'organizer')
            ->where('status', 'pending')
            ->get();


        $eventsByCategory = DB::table('events')
            ->select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->get();

        $slotsData = DB::table('events')
            ->select('title', 'slots_fulled')
            ->orderBy('id')
            ->get();

        $pendingEvents = DB::table('events')
            ->orderBy('created_at', 'desc')
            ->where('status', 'pending')
            ->get();

        $feedbacks = Feedback::with(['user', 'event'])
            ->latest()
            ->take(5)
            ->get();

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

        return view('admin.dashboard', compact('adminnotifications', 'certificateCount', 'unreadCount', 'notifications', 'pendingparticipents', 'activeParticipants', 'userCount', 'eventCount', 'students', 'organizers', 'admins', 'approved', 'rejected', 'pending', 'eventsByCategory', 'slotsData', 'pendingEvents', 'feedbacks'));

    }

    public function approve($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'approved';
        $event->rejection_reason = null;
        $event->save();

        return back()->with('successMessage', 'Event approved successfully!');
    }

    public function reject($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'rejected';
        $event->rejection_reason = 'Not suitable'; // yahan reason dynamically bhi dal sakte ho
        $event->save();

        return back()->with('errorMessage', 'Event rejected.');
    }
    public function userapprove($id)
    {
        $organizer = User::findOrFail($id);
        $organizer->status = 'active';
        $organizer->save();

        return back()->with('successMessage', 'Event approved successfully!');
    }
    public function userreject($id)
    {
        $organizer = User::findOrFail($id);
        $organizer->status = 'suspend';
        $organizer->save();

        return back()->with('errorMessage', 'Event rejected.');
    }
}
