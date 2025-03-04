<x-guest-layout>
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

          <!-- roles -->
          <div class="mt-4">
            <x-input-label for="role">Select Role</x-input-label>
            <select name="role" id="role" class="form-control" required onchange="toggleFields()">
                <option value="" selected>Select Role.</option>
                <option value="accountant">Accountant</option>
                <option value="librarian">Librarian</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
                <option value="parent">Parent</option>
                <option value="security">Security</option>
                <option value="cook">Cook</option>
            </select>
        </div>
            {{-- Common Fields --}}
        <div id="common-fields">
            <x-input-label for="phone_number"  class="mt-4" :value="__('Phone Number')" />
            <x-text-input name="phone_number" required/>

            <x-input-label for="address" class="mt-4" :value="__('Address')" />
            <x-text-input name="address" required/>
        </div>

        {{-- Accountant Fields --}}
        <div id="accountant-fields" style="display: none;" class="mt-4">
            <x-input-label for="accountant_id" :value="__('Accountant ID')" />
            <x-text-input name="accountant_id"/>
        </div>

        {{-- Librarian Fields --}}
        <div id="librarian-fields" style="display: none;" class="mt-4">
            <x-input-label for="librarian_id" class="mt-4" :value="__('Librarian ID')" />
            <x-text-input name="librarian_id"/>
        </div>

        {{-- Cook Fields --}}
        <div id="cook-fields" style="display: none;" class="mt-4">
            <x-input-label for="cook_id" class="mt-4" :value="__('Cook ID')" />
            <x-text-input name="cook_id"/>
        </div>

        {{-- Teacher Fields --}}
        <div id="teacher-fields" style="display: none;">
            <x-input-label for="teacher_id" class="mt-4" :value="__('Teacher ID')" />
            <x-text-input name="teacher_id"/>

            <x-input-label for="subject" class="mt-4" :value="__('Subject')"/>
            <x-text-input name="subject"/>
        </div>

        {{-- Student Fields --}}
        <div id="student-fields" style="display: none;">
            <x-input-label for="student_id" class="mt-4" :value="__('Student ID')" />
            <x-text-input name="student_id"/>
            <x-input-label for="class" class="mt-4" :value="__('Class Level')" />
            <select name="class" class="form-control" required>
                <option value="" disabled selected>Select Class Level</option>
                <option value="Form 1">Form 1</option>
                <option value="Form 2">Form 2</option>
                <option value="Form 3">Form 3</option>
                <option value="Form 4">Form 4</option>
            </select>
            <x-input-label for="parent_contact" class="mt-4" :value="__('Parent Contact')" />
            <x-text-input name="parent_contact"/>
            <x-input-label for="email" :value="__('Parent Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="parent_email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Parent Fields --}}
        <div id="parent-fields" style="display: none;">
            <x-input-label for="parent_id" class="mt-4" :value="__('Parent ID')" />
            <x-text-input name="parent_id"/>

            <x-input-label for="number_of_children" class="mt-4" :value="__('Number of Children')" />
            <x-text-input type="number" name="number_of_children" />
        </div>

        {{-- Security Fields --}}
        <div id="security-fields" style="display: none;">
            <x-input-label for="security_id" class="mt-4" :value="__('Security ID')" />
            <x-text-input name="security_id"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <!-- <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}"> -->
                <!-- {{ __('Already registered?') }} -->
            <!-- </a> -->

            <x-primary-button type="submit" class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
function toggleFields() {
    let role = document.getElementById('role').value;

    // Hide all fields first
    document.getElementById('accountant-fields').style.display = 'none';
    document.getElementById('librarian-fields').style.display = 'none';
    document.getElementById('cook-fields').style.display = 'none';
    document.getElementById('teacher-fields').style.display = 'none';
    document.getElementById('student-fields').style.display = 'none';
    document.getElementById('parent-fields').style.display = 'none';
    document.getElementById('security-fields').style.display = 'none';

    // Show specific fields based on role
    if (role === 'accountant') document.getElementById('accountant-fields').style.display = 'block';
    if (role === 'librarian') document.getElementById('librarian-fields').style.display = 'block';
    if (role === 'cook') document.getElementById('cook-fields').style.display = 'block';
    if (role === 'teacher') document.getElementById('teacher-fields').style.display = 'block';
    if (role === 'student') document.getElementById('student-fields').style.display = 'block';
    if (role === 'parent') document.getElementById('parent-fields').style.display = 'block';
    if (role === 'security') document.getElementById('security-fields').style.display = 'block';
}
</script>
</x-guest-layout>
