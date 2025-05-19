<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\RegistrationKey;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'regex:/^\d{10,15}$/'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'access_key' => ['required', 'exists:registration_keys,key'], // ✅ Fix here
            'access_key' => [
            'required',
                Rule::exists('registration_keys', 'key')->where('used', false),
        ],
        ]);

        $key = RegistrationKey::where('key', $validated['access_key'])
            ->where('used', false)
            ->first();

        if (!$key) {
            return redirect()->back()->withErrors([
                'access_key' => 'Invalid or already used registration key.',
            ]);
        }

        $key->update(['used' => true]);

        $user = User::create([
            'first_name' => $validated['firstname'],
            'last_name' => $validated['lastname'],
            'username' => $validated['username'],
            'email' => $validated['email'] ?? null,
            'mobile_number' => $validated['mobile'],
            'user_type' => 1, // Admin role
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
