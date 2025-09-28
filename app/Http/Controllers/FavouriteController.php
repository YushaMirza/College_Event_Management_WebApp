<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'media_file' => 'required|string',
            'media_type' => 'required|in:image,video',
            'media_title' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        Favourite::updateOrCreate(
            [
                'user_id' => $userId,
                'event_id' => $request->event_id,
                'media_file' => $request->media_file
            ],
            [
                'media_type' => $request->media_type,
                'media_title' => $request->media_title
            ]
        );

        return redirect()->back()->with('successMessage', 'Added to favourites!');
    }

    public function index()
    {
        $favourites = Favourite::with('event')
                        ->where('user_id', Auth::id())
                        ->get();

        return view('participant.favourites', compact('favourites'));
    }

    public function destroy(Favourite $favourite)
    {
        if ($favourite->user_id != Auth::id()) {
            abort(403);
        }

        $favourite->delete();

        return redirect()->back()->with('successMessage', 'Removed from favourites!');
    }
}
