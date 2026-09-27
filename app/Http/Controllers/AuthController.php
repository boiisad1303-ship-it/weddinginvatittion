<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WeddingSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);
        $credentials['email'] = Str::lower($credentials['email']);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('wedding.edit'));
    }

    public function showRegister(): View|RedirectResponse
    {
        if (User::query()->exists()) {
            return redirect()->route('login')->with('status', 'Admin registration is closed.');
        }

        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        if (User::query()->exists()) {
            abort(403, 'Admin registration is closed.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($validated): User {
            $user = User::query()->create([
                'name' => $validated['name'],
                'email' => Str::lower($validated['email']),
                'password' => $validated['password'],
            ]);

            $unownedSetting = WeddingSetting::query()->whereNull('user_id')->orderBy('id')->first();
            if ($unownedSetting) {
                $unownedSetting->user()->associate($user);
                $unownedSetting->save();
            }

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('wedding.edit');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('wedding.show');
    }
}
