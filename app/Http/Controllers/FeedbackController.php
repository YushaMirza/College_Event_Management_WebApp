<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'rating'   => 'required|integer|min:1|max:5',
            'message'  => 'nullable|string',
        ]);

        Feedback::create([
            'user_id'  => auth()->id(),
            'event_id' => $request->event_id,
            'rating'   => $request->rating,
            'message'  => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    function viewFeedback()
    {
        $feedback = Feedback::all();
        return view('admin.viewfeedback', ['feedbacks' => $feedback]);
    }

    //
   public function deletefeedback($id)
    {
        Feedback::destroy($id);
        return redirect("/admin/feedback")->with('success', 'Feedback deleted successfully!');
    }

    // Approve feedback (add to dashboard)
    public function approve($id)
    {
        $feedbackadd = Feedback::findOrFail($id);
        $feedbackadd->added_to_dashboard = 1;
        $feedbackadd->save();

        return back()->with('success', 'Feedback approved successfully!');
  
}
}
