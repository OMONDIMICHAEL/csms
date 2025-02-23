<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\SecurityController;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
      $credentials = $request->only('email', 'password');

      if (Auth::attempt($credentials)) {
          $user = Auth::user(); // Get authenticated user

          // Redirect based on user role
          switch ($user->role) {
              case 'admin':
                  return redirect()->route('admin.admin_dashboard');
              case 'teacher':
                  return redirect()->route('teacher.teacher_dashboard');
              case 'student':
                  return redirect()->route('student.student_dashboard');
              case 'parent':
                  return redirect()->route('parent.parent_dashboard');
              case 'security':
                  return redirect()->route('security.security_dashboard');
              case 'accountant':
                  return redirect()->route('accountant.accountant_dashboard');
              case 'librarian':
                  return redirect()->route('librarian.librarian_dashboard');
              case 'cook':
                  return redirect()->route('cook.cook_dashboard');
              default:
                  return redirect()->route('dashboard');
          }
        }

      return back()->withErrors(['email' => 'Invalid login credentials.']);
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
