<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AdminNotification;
use App\Models\EventRegistration;
use App\Models\ReceivedCertificate;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Concerns\Events;
use App\Models\OrganizerNotification;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalEventsRegistered = EventRegistration::where('user_id', $userId)->count();

        $certificatesEarned = ReceivedCertificate::where('user_id', $userId)->count();;

        $upcomingEvents = EventRegistration::where('user_id', $userId)->where('start', '>', now())->count();

        $feedbackSubmitted = Feedback::where('user_id', $userId)->count();

        $eventIds = EventRegistration::where('user_id', $userId)
             ->where('attended', 'yes')
             ->pluck('event_id');

        $events = Event::whereIn('id', $eventIds)->get();

        $todayNotifications = OrganizerNotification::where('organizer_id', auth()->id())
    ->whereDate('created_at', now())
    ->orderBy('created_at', 'desc')
    ->get();
    $user = auth()->user();

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
                    ->count();
        } else {
            $unreadCount = 0;
        }


        $myEventRegistrations = EventRegistration::with('event')->where('user_id', $userId)->get();

        $favourites = Favourite::where('user_id', $userId)->get();

        return view('participant.dashboard', compact(
            'totalEventsRegistered',
            'certificatesEarned',
            'upcomingEvents',
            'feedbackSubmitted',
            'events',
            'myEventRegistrations',
            'favourites',
            'notifications',
            'adminnotificationspar',
            'adminnotificationsorg',
            'unreadCount'
        ));
    }
    public function cancelRegistration(EventRegistration $registration)
    {
        $user = auth()->user();

        if ($registration->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $event = $registration->event;

        if ($event->start <= now() || $event->can_cancel !== 'yes') {
            return redirect()->back()->with('errorMessage', 'You cannot cancel this event.');
        }

        $registration->delete();

        $event->decrement('slots_fulled', 1);

        return redirect()->back()->with('successMessage', 'Event registration cancelled successfully.');
    }
    public function downloadCertificate($registrationId)
{
    $user = auth()->user();

    $registration = EventRegistration::with('event')
        ->where('id', $registrationId)
        ->where('user_id', $user->id)
        ->where('attended', 'yes')
        ->firstOrFail();

    $event = $registration->event;

    $alreadyDownloaded = ReceivedCertificate::where('user_id', $user->id)
        ->where('event_id', $event->id)
        ->exists();

    if (!$alreadyDownloaded) {
        ReceivedCertificate::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'received',
            'certificate_file' => null,
            'downloaded_at' => now(),
        ]);
    }

    $certificateRecord = DB::table('event_certificates')
        ->where('event_id', $event->id)
        ->where('file_path', '!=', 'pending')
        ->first();

    if(!$certificateRecord){
        return back()->with('errorMessage', 'Certificate not available yet.');
    }

    $filePath = public_path('certificates/'.$certificateRecord->file_path);
    if(file_exists($filePath)){
        return response()->download($filePath);
    }

    $data = [
        'user' => $user,
        'event' => $event,
        'downloaded_at' => now(),
    ];

    $pdf = Pdf::loadView('participant.certificate.dynamic_certificate', $data)
              ->setPaper('A4', 'landscape');

    return $pdf->download('certificate_'.$event->id.'_user_'.$user->id.'.pdf');
}



}
