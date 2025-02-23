<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommunicationNotification;
use App\Models\Communication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
  {
    return view('admin.admin_dashboard');
  }
  // Show Communication Management Page
    public function showCommunications()
    {
        $communications = Communication::latest()->paginate(10);
        return view('admin.communications', compact('communications'));
    }

    // Store a new Notice/Circular/Meeting
    public function storeCommunication(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:notice,circular,meeting',
            'scheduled_at' => 'nullable|date',
        ]);

        $communication = Communication::create([
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'scheduled_at' => $request->scheduled_at,
            'admin_id' => Auth::id(),
        ]);
        // Send email notification to all users
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new CommunicationNotification($communication));
        }

        return redirect()->back()->with('success', 'Communication posted successfully.');
    }

    // Delete a Communication
    public function deleteCommunication($id)
    {
        $communication = Communication::findOrFail($id);
        $communication->delete();

        return redirect()->back()->with('success', 'Communication deleted successfully.');
    }
}
