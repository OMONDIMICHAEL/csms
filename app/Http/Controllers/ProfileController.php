<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
      $user = Auth::user();

      // Role-specific customizations
      if ($user->role === 'admin') {
          return view('profile.admin_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'teacher') {
          return view('profile.teacher_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'student') {
          return view('profile.student_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'parent') {
          return view('profile.parent_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'security') {
          return view('profile.security_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'librarian') {
          return view('profile.librarian_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'cook') {
          return view('profile.cook_edit', [
              'user' => $request->user(),
          ]);
      } elseif ($user->role === 'accountant') {
            return view('profile.accountant_edit', [
                'user' => $request->user(),
            ]);
      } else {
          // Default profile data if no specific role matched
      }
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not authenticated.');
        }
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            // 'RetailPhone' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // 'RetailLogo' => ['nullable', 'image', 'max:2048'],
        ];
        // Role-specific validation
        if ($user->role === 'admin') {
            $rules['admin_code'] = ['nullable', 'string'];
        } elseif ($user->role === 'teacher') {
            $rules['teacher_id'] = ['nullable', 'string'];
        } elseif ($user->role === 'student') {
            $rules['student_id'] = ['nullable', 'string'];
        } elseif ($user->role === 'parent') {
            $rules['parent_i'] = ['nullable', 'string'];
        }elseif ($user->role === 'security') {
            $rules['security_badge_number'] = ['nullable', 'string'];
        }
        $validatedData = $request->validate($rules);
        // Base profile updates
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        // Role-specific updates
        if ($user->role === 'admin') {
            $user->admin_code = $validatedData['admin_code'] ?? null;
        } elseif ($user->role === 'teacher') {
            $user->teacher_id = $validatedData['teacher_id'] ?? null;
        } elseif ($user->role === 'student') {
            $user->student_id = $validatedData['student_id'] ?? null;
        } elseif ($user->role === 'parent') {
            $user->parent_id = $validatedData['parent_id'] ?? null;
        } elseif ($user->role === 'security') {
            $user->security_badge_number = $validatedData['security_badge_number'] ?? null;
        }
        // Save the user
        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');

        // $request->user()->fill($request->validated());
        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }
        // $request->user()->save();
        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('register');
    }
}
