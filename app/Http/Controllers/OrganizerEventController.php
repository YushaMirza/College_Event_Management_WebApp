<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Models\OrganizerNotification;

class OrganizerEventController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $events = Event::withCount('registrations', 'feedbacks')
            ->where('organizer_id', $user->enrollment_id)
            ->orderBy('id', 'desc')
            ->get();

        $now = \Carbon\Carbon::now();

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

        $counts = [
            'upcoming' => $events->where('start', '>', $now)->count(),
            'ongoing' => $events->where('start', '<=', $now)->where('end', '>=', $now)->count(),
            'completed' => $events->where('end', '<', $now)->count(),
            'registrations' => $events->sum('registrations_count'),
            'feedbacks' => $events->sum('feedbacks_count'),
        ];

        return view('organizer.dashboard', compact('adminnotificationsorg', 'adminnotificationspar', 'events', 'counts', 'unreadCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'venue' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'registration_deadline' => 'nullable|date|before_or_equal:start',
            'max_slots' => 'required|integer|min:1',
            'can_cancel' => 'required|in:yes,no',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov|max:10240',
            'caption' => 'nullable|string',
            'eligible_years' => 'nullable|string',
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'code' => 'nullable|string'
        ]);

        $data = $request->all();
        $data['organizer_id'] = auth()->user()->enrollment_id;
        $data['status'] = 'pending';
        $data['is_open'] = 1;
        $data['slots_fulled'] = 0;
        $data['thumbnail'] = null;

        if ($request->hasFile('media')) {
    $file = $request->file('media');
    $mimeType = $file->getMimeType();

    $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $destinationPath = public_path('images/events');

    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }

    // move original media file
    $file->move($destinationPath, $imageName);

    $data['media_file'] = 'images/events/' . $imageName;
    $data['media_type'] = Str::startsWith($mimeType, 'video') ? 'video' : 'image';

    // ✅ agar IMAGE hai → thumbnail auto generate
    if ($data['media_type'] === 'image') {
        $thumbName = time() . '_' . uniqid() . '_thumb.' . $file->getClientOriginalExtension();
        $thumbPath = public_path('images/events/thumbnails');
        if (!file_exists($thumbPath)) mkdir($thumbPath, 0777, true);

        $sourcePath = $destinationPath . '/' . $imageName;
        $thumbFullPath = $thumbPath . '/' . $thumbName;

        $this->createThumbnail($sourcePath, $thumbFullPath, 300, 200);

        $data['thumbnail'] = 'images/events/thumbnails/' . $thumbName;
    }

    // ✅ agar VIDEO hai → sirf manually thumbnail upload karne ki option
    if ($data['media_type'] === 'video') {
        if ($request->hasFile('thumbnail')) {
            $thumbFile = $request->file('thumbnail');
            $thumbName = time() . '_' . uniqid() . '.' . $thumbFile->getClientOriginalExtension();
            $thumbPath = public_path('images/events/thumbnails');
            if (!file_exists($thumbPath)) mkdir($thumbPath, 0777, true);

            $thumbFile->move($thumbPath, $thumbName);
            $data['thumbnail'] = 'images/events/thumbnails/' . $thumbName;
        } else {
            $data['thumbnail'] = null; // video hai par thumbnail upload nahi hua
        }
    }
}



        try {
            $event = Event::create($data);

            OrganizerNotification::create([
                'organizer_id' => auth()->id(),
                'title' => 'Event Created',
                'message' => "Your event '{$event->title}' has been successfully created.",
                'type' => 'positive',
                'department' => 'participant',
                'color' => 'success',
            ]);

            return redirect()->route('organizer_dashbaord')
                ->with('successMessage', 'Event created successfully! Pending for approval.');

        } catch (\Exception $e) {
            \Log::error('Organizer Event Creation Failed: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'data' => $data
            ]);

            return redirect()->back()->with('error', 'Failed to create event. Please try again.');
        }


        return redirect()->route('organizer_dashbaord')->with('successMessage', 'Event created successfully! Pending for approval.');
    }



    private function createThumbnail($src, $dest, $targetWidth, $targetHeight)
{
    $info = getimagesize($src);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($src);
            break;
        case 'image/png':
            $image = imagecreatefrompng($src);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($src);
            break;
        default:
            return false; // unsupported format
    }

    $width = imagesx($image);
    $height = imagesy($image);

    $thumb = imagecreatetruecolor($targetWidth, $targetHeight);

    imagecopyresampled(
        $thumb, $image,
        0, 0, 0, 0,
        $targetWidth, $targetHeight,
        $width, $height
    );

    switch ($mime) {
        case 'image/jpeg':
            imagejpeg($thumb, $dest, 90);
            break;
        case 'image/png':
            imagepng($thumb, $dest, 8);
            break;
        case 'image/gif':
            imagegif($thumb, $dest);
            break;
    }

    imagedestroy($image);
    imagedestroy($thumb);

    return true;
}

public function edit($id)
{
    $event = Event::findOrFail($id);
    return view('organizer.dashboard', compact('event'));
}
public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string',
        'venue' => 'nullable|string',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
        'registration_deadline' => 'nullable|date|before_or_equal:start',
        'max_slots' => 'required|integer|min:1',
        'can_cancel' => 'required|in:yes,no',
        'media_file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi,mkv|max:20480',
        'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
        'caption' => 'nullable|string',
        'eligible_years' => 'nullable|string',
        'code' => 'nullable|string'
    ]);

    $data = $request->except(['_token', '_method']);

    if ($request->hasFile('media_file')) {
    $file = $request->file('media_file');

    if ($file->isValid()) {
        // store file in storage/app/public/events
        $path = $file->store('events', 'public');

        // save relative path for database
        $data['media_file'] = 'storage/' . $path;
        $data['media_type'] = Str::startsWith($file->getMimeType(), 'video') ? 'video' : 'image';
    }
}

    $event->update($data);
    $event->refresh();

        OrganizerNotification::create([
            'organizer_id' => auth()->id(),
            'title' => 'Event Updated',
            'message' => "Your event '{$event->title}' has been updated.",
            'type' => 'positive',
            'department' => 'participant',
            'color' => 'warning',
        ]);

    return redirect()->route('organizer_dashbaord')->with('successMessage', 'Event updated successfully!');
}

    public function cancel(Event $event)
    {
        $title = $event->title;
        $event->delete();

        OrganizerNotification::create([
            'organizer_id' => auth()->id(),
            'title' => 'Event Cancelled',
            'message' => "Your event '{$title}' has been cancelled.",
            'type' => 'negative',
            'department' => 'participant',
            'color' => 'warning',
        ]);

        return redirect()->route('organizer_dashbaord')->with('successMessage', 'Event cancelled successfully!');
    }




    public function registrations()
    {
        $user = auth()->user();

        $events = Event::withCount('registrations')
            ->with(['registrations.user'])
            ->where('organizer_id', $user->enrollment_id)
            ->orderBy('start', 'desc')
            ->get();

        return view('organizer.events_registrations', compact('events'));
    }
}
