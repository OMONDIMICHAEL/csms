<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\CheckIn;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\StudentCheckInOutNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Visitor;
use App\Models\Communication;

class SecurityController extends Controller
{
  public function index()
  {
    return view('security.security_dashboard');
  }
  public function showCommunications()
  {
      $communications = Communication::latest()->limit(5)->get();
      return view('security.security_communication', compact('communications'));
  }
  public function checkIn(Request $request)
    {
        $request->validate([
          'role' => 'required|in:student,teacher,accountant,parent,security,cook,librarian',
          'id_number' => 'required', // Can be student_id, teacher_id, etc.
        ]);
        // Find user by their role-specific ID
       $user = User::where($request->role . '_id', $request->id_number)->first();
       if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
        }
        // Prevent multiple check-ins
        if (CheckIn::where('user_id', $user->id)->whereNull('check_out_time')->exists()) {
            return redirect()->back()->with('error', 'User is already checked in.');
        }
        CheckIn::create([
          'user_id' => $user->id,
          'name' => $user->name,
          'role' => $user->role,
          'check_in_time' => now(),
        ]);
        // Send Notification to Parent if User is a Student
        if ($user->role === 'student' && $user->parent_email) {
            Notification::route('mail', $user->parent_email)
                ->notify(new StudentCheckInOutNotification($user, 'check-in', now()));
        }

        return redirect()->back()->with('success', 'Check-in successful.');
    }

    public function checkOut(Request $request)
    {
      $request->validate([
        'role' => 'required|in:student,teacher,accountant,parent,security',
        'id_number' => 'required',
      ]);
      $user = User::where($request->role . '_id', $request->id_number)->first();
      if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
      }
      // Find the check-in record
      $checkIn = CheckIn::where('user_id', $user->id)->whereNull('check_out_time')->first();
      if (!$checkIn) {
        return redirect()->back()->with('error', 'User has not checked in.');
      }
      $checkIn->update(['check_out_time' => now()]);
      // Send Notification to Parent if User is a Student
      if ($user->role === 'student' && $user->parent_email) {
          Notification::route('mail', $user->parent_email)
              ->notify(new StudentCheckInOutNotification($user, 'check-out', now()));
      }
        return redirect()->back()->with('success', 'Check-out successful.');
    }
    // method for checkin history
    public function viewCheckInHistory(Request $request)
    {
        $query = CheckIn::query()->with('user'); // Load user relationship
          // Filtering by Role
         if ($request->filled('role')) {
             $query->whereHas('user', function ($q) use ($request) {
                 $q->where('role', $request->role);
             });
         }

         // Filtering by Name
         if ($request->filled('name')) {
             $query->whereHas('user', function ($q) use ($request) {
                 $q->where('name', 'LIKE', '%' . $request->name . '%');
             });
         }

         // Filtering by Date
         if ($request->filled('date')) {
             $query->whereDate('check_in_time', $request->date);
         }
         $checkIns = $query->latest()->paginate(10); // Paginate results
        return view('security.check_in_history', compact('checkIns'));
    }
    // method for Pdf
    public function exportPDF(Request $request)
    {
        $query = CheckIn::query()->with('user');

        if ($request->filled('role')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('check_in_time', $request->date);
        }

        $checkIns = $query->get();

        $pdf = Pdf::loadView('security.check_in_pdf', compact('checkIns'));

        return $pdf->download('check_in_history.pdf');
      }
      public function getCheckInStats(Request $request)
      {
          $startDate = Carbon::now()->subDays(7); // Last 7 days
          $endDate = Carbon::now();

          $checkIns = CheckIn::whereBetween('check_in_time', [$startDate, $endDate])
              ->selectRaw('DATE(check_in_time) as date, COUNT(*) as count')
              ->groupBy('date')
              ->orderBy('date')
              ->get();

          return response()->json($checkIns);
        }
        // add pie chart
        public function getCheckInByRole()
        {
          $checkInsByRole = CheckIn::selectRaw('users.role, COUNT(*) as count')
              ->join('users', 'check_ins.user_id', '=', 'users.id')
              ->groupBy('users.role')
              ->get();

          return response()->json($checkInsByRole);
        }
        // Show Visitor Registration Form
        public function showVisitorForm()
        {
            return view('security.visitor_register');
        }

        // Handle Visitor Check-In
        public function checkInVisitor(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'id_number' => 'required|string|unique:visitors,id_number',
                'phone' => 'required|string|max:15',
                'purpose' => 'required|string|max:255',
                'whom_to_see' => 'required|string|max:255',
            ]);

            Visitor::create([
                'name' => $request->name,
                'id_number' => $request->id_number,
                'phone' => $request->phone,
                'purpose' => $request->purpose,
                'whom_to_see' => $request->whom_to_see,
                'check_in_time' => now(),
            ]);

            return redirect()->back()->with('success', 'Visitor checked in successfully.');
        }
        // Handle Visitor Check-Out
        public function checkOutVisitor(Request $request)
        {
            $request->validate([
                'id_number' => 'required|string|exists:visitors,id_number',
            ]);

            $visitor = Visitor::where('id_number', $request->id_number)
                ->whereNull('check_out_time')
                ->first();

            if (!$visitor) {
                return redirect()->back()->with('error', 'Visitor not found or already checked out.');
            }

            $visitor->update(['check_out_time' => now()]);

            return redirect()->back()->with('success', 'Visitor checked out successfully.');
        }
        // Show Visitor Log Page
        public function showVisitorLog()
        {
            $visitors = Visitor::latest()->paginate(10);
            return view('security.visitor_log', compact('visitors'));
        }

}
