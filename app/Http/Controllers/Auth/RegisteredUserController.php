<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:accountant,librarian,teacher,student,parent,security,cook'], // Restrict roles
            'phone_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            // 'admin_code' => ['nullable', 'string'],
            'accountant_id' => ['nullable', 'string'],
            'librarian_id' => ['nullable', 'string'],
            'cook_id' => ['nullable', 'string'],
            'teacher_id' => ['nullable', 'string'],
            'subject' => ['nullable', 'string'],
            'student_id' => ['nullable', 'string'],
            'class' => ['nullable', 'string'],
            'parent_contact' => ['nullable', 'string'],
            'parent_email' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'string'],
            'number_of_children' => ['nullable', 'integer'],
            'security_id' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            // 'admin_code' => $request->admin_code,
            'accountant_id' => $request->accountant_id,
            'librarian_id' => $request->librarian_id,
            'cook_id' => $request->cook_id,
            'teacher_id' => $request->teacher_id,
            'subject' => $request->subject,
            'student_id' => $request->student_id,
            'class' => $request->class,
            'parent_contact' => $request->parent_contact,
            'parent_email' => $request->parent_email,
            'parent_id' => $request->parent_id,
            'number_of_children' => $request->number_of_children,
            'security_id' => $request->security_id,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));

      // Instead of logging in the user, redirect to the login page
      return redirect(route('admin.register'))->with('success', 'Account created successfully. Please check your email for verification.');
    }
}
