<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\SMTP;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EventCertificate;
use App\Models\AdminNotification;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Log;
use App\Models\OrganizerNotification;
use App\Http\Controllers\EventController;

class EventController extends Controller
{

    function viewEventDescription(){
        $eventDec = Event::all();
        return view('viewEvent' , ['events'=>$eventDec]);
    }

    //
    function deleteeventDec($id){
        $delete = Event::destroy($id);
        return redirect("/admin/eventDec")->with('success', 'Destination deleted successfully!');
    }
    public function approve($id)
{
    $event = Event::findOrFail($id);
    $event->status = 'approved';
    $event->save();

    return back()->with('success', 'Event approved successfully!');
}

public function reject($id)
{
    $event = Event::findOrFail($id);
    $event->status = 'rejected';
    $event->save();

    return back()->with('success', 'Event rejected successfully!');
}


function showMedia(){
        $events = Event::orderBy('start', 'desc')->get();

        return view('admin.mediaUpload', compact('events'));

    }
    
    public function showEvents(Request $request)
    {
        $query = Event::with('organizer')->where('status', 'approved');

        if (!empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                ->orWhere('venue', 'LIKE', '%' . $request->search . '%');
            });
        }

        if (!empty($request->category) && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $events = $query->latest()->get();
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

        return view('student.events', compact('adminnotificationsorg','adminnotificationspar','events','notifications','unreadCount'));
    } else {
        return view('student.events', compact('events'));
    }


        
    }

    public function showEventDetail($id)
    {
        $event = Event::with('organizer')->findOrFail($id);

        $relatedEvents = Event::where('category', $event->category)
                            ->where('id', '!=', $event->id)
                            ->take(3)
                            ->get();

        return view('student.event_detail', compact('event', 'relatedEvents'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:events,code',
            'category' => 'required|string',
            'description' => 'required|string',
            'venue' => 'required|string',
            'can_cancel' => 'required|in:yes,no',
            'max_slots' => 'required|integer|min:1',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'registration_deadline' => 'nullable|date|before:start',
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'eligible_years' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
        ]);
        dd($request->all());

        $event = new Event();
        $event->title = $request->title;
        $event->code = $request->code;
        $event->category = $request->category;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->can_cancel = $request->can_cancel;
        $event->max_slots = $request->max_slots;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->registration_deadline = $request->registration_deadline;
        $event->caption = $request->caption;
        $event->eligible_years = $request->eligible_years;
        
        

        $mediaFileName = null;
        $mediaType = null;
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            $mediaFileName = time() . '_' . Str::slug($request->title) . '.' . $extension;

            // Determine media type
            $imageExtensions = ['jpeg','jpg','png','gif','webp'];
            $videoExtensions = ['mp4','mov','avi','mkv'];

            if (in_array(strtolower($extension), $imageExtensions)) {
                $mediaType = 'image';
            } elseif (in_array(strtolower($extension), $videoExtensions)) {
                $mediaType = 'video';
            }

            $file->move(public_path('images/events'), $mediaFileName);
        }

        $event->media_file = $mediaFileName;
        $event->media_type = $mediaType;

        $event->save();

        OrganizerNotification::create([
        'organizer_id' => auth()->id(), 
        'title' => 'Event Created',
        'message' => "Your event '{$event->title}' has been created successfully!",
        'type' => 'positive', 
        'color' => 'primary', 
        'is_read' => false,
    ]);

        return redirect()->back()->with('successMessage', 'Event created successfully!');
    }

    

public function generateCertificate($id)
{
    $event = Event::findOrFail($id);
    $user = auth()->user();

    $data = [
        'event' => $event,
        'user'  => $user,
        'date'  => now(),
    ];

    $pdf = Pdf::loadView('participant.certificate.dynamic_certificate', $data)
              ->setPaper('A4', 'landscape');

    $fileName = 'event_'.$event->id.'_certificate.pdf';

    $filePath = public_path('certificate/'.$fileName);
    $pdf->save($filePath);

    $certificate = EventCertificate::where('event_id', $event->id)->first();
    if ($certificate) {
        $certificate->update([
            'file_path' => $fileName,
            'issued_at' => now(),
        ]);
    } else {
        EventCertificate::create([
            'event_id' => $event->id,
            'file_path' => $fileName,
            'issued_at' => now(),
        ]);
    }

    return back()->with('successMessage', 'Certificate generated and saved successfully for event: '.$event->title);
}



    public function register(Request $request, Event $event)
{
    $incomingFields = $request->validate([
        'year' => ['required', 'in:1,2,3,4'],
    ]);

    $user = auth()->user();

    $allowedYears = array_map('trim', explode(',', $event->eligible_years));
    if (!in_array($incomingFields['year'], $allowedYears)) {
        return back()->with('errorMessage', 'You are not eligible to register for this event based on year.');
    }

    if ($event->registration_deadline && now()->gt($event->registration_deadline)) {
        return back()->with('errorMessage', 'Registration deadline has passed.');
    }

    if ($event->registrations()->count() >= $event->max_slots) {
        return back()->with('errorMessage', 'No slots available.');
    }

    if ($event->registrations()->where('user_id', $user->id)->exists()) {
        return back()->with('errorMessage', 'You are already registered for this event.');
    }

    DB::beginTransaction();
    try {
        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'year' => $incomingFields['year'],
            'registration_deadline' => $event->registration_deadline,
            'start' => $event->start,
            'venue' => $event->venue,
            'end' => $event->end,
            'status' => 'confirmed',
        ]);

        $user->year = $incomingFields['year'];
        $user->save();
        DB::commit();

        return redirect()->route('participant_dashboard')
            ->with('successMessage', 'Registration successful! Event Code sent to your email.');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Event Registration Failed: " . $e->getMessage());

        return back()->with('errorMessage', 'Something went wrong. Please try again later.');
    }
}

public function __construct()
{
    $this->checkUpcomingEvents();
}

private function checkUpcomingEvents()
{
    session_start();
    
    $events = Event::whereBetween('start', [now(), now()->addDay()])->get();

    foreach ($events as $event) {
        foreach ($event->registrations as $registration) {
            $user = $registration->user;

            $flagKey = 'email_sent_for_event_' . $event->id . '_' . $user->id;

        if (!isset($_SESSION[$flagKey])) {
            
            $this->sendcode(
                $user->name,
                $event->title,
                $event->code,
                $event->start,
                $user->email
            );

                $_SESSION[$flagKey] = true;
            }
        }
    }
}


protected function sendcode($username, $eventTitle, $eventCode, $eventStart, $toEmail)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; 

        $mail->isSMTP();
        $mail->Host       = config('mail.mailers.smtp.host', 'smtp.gmail.com');
        $mail->SMTPAuth   = true;
        $mail->Username   = config('mail.mailers.smtp.username', 'yousha.mirza328@gmail.com'); 
        $mail->Password   = config('mail.mailers.smtp.password', 'garofwmqaujqwufq');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = config('mail.mailers.smtp.port', 465);

        $mail->setFrom(config('mail.from.address', 'no-reply@example.com'), config('mail.from.name', 'EventSphere'));
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Your EventSphere Registration Code';
        
        $mail->Body = "
            <h1>Hello {$username},</h1>
            <p>🎉 Congratulations! You have successfully registered for the event.</p>
            <p><strong>Event:</strong> {$eventTitle}</p>
            <p><strong>Event Code:</strong> {$eventCode}</p>
            <p><strong>Start Date:</strong> " . Carbon::parse($eventStart)->format('M d, Y • h:i A') . "</p>
            <p>We look forward to seeing you at the event. Please keep this event code safe for future reference.</p>
            <p>Regards,<br> EventSphere Team</p>
        ";
        
        $mail->send();
        
        $mail->SMTPDebug = 0; 
    } catch (PHPMailerException $e) {
        Log::error("Failed to send email: {$mail->ErrorInfo}");
        
        session()->forget('admin_otp');
        session()->flash('errorMessage', 'Failed to send registration email. Please try again later.');
    }
}




    public function showGallery()
    {
        $events = Event::orderBy('start', 'desc')->get();
        $user = auth()->user();

        if(auth()->check()) {

            $notifications = [];
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

            return view('student.gallery', compact('adminnotificationsorg','adminnotificationspar','events','notifications','unreadCount'));
        } else {
            return view('student.gallery', compact('events'));
        }

        
    }

    public function showAbout(){
        $user = auth()->user();

        if(auth()->check()) {

            $notifications = [];
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
            } 
            else {
                $unreadCount = 0;
            }

            return view('student.about', compact('adminnotificationsorg','adminnotificationspar','notifications','unreadCount'));
        }
         else {
            return view('student.about');
        }

    }

    
    public function showContact(){
        $user = auth()->user();

        if(auth()->check()) {

            $notifications = [];
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

            return view('student.contact_us', compact('adminnotificationsorg','adminnotificationspar','notifications','unreadCount'));
        } else {
            return view('student.contact_us');
        }

    }

    
    
    public function showfaqs(){
        $user = auth()->user();

        if(auth()->check()) {

            $notifications = [];
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

            return view('student.faqs', compact('adminnotificationsorg','adminnotificationspar','notifications','unreadCount'));
        } else {
            return view('student.faqs');
        }

    }




    public function checkIn(Request $request, $id)
{
    $request->validate([
        'code' => 'required|string',
    ]);

    $event = Event::findOrFail($id);

    // Code match check
    if ($request->code === $event->code) {
        $registration = EventRegistration::where('event_id', $id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        $registration->attended = 'yes';
        $registration->save();

        return back()->with('successMessage', 'Check In successful! You are marked as attended.');
    }

    return back()->with('errorMessage', 'Invalid event code. Please try again.');
}




    
}
