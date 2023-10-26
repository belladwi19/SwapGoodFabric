<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Method to show login view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): View
    {
        return view('auth.login');
    }

    /**
     * Method to authenticate login
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login.show')
                    ->with('error', Lang::get('auth.error_email_password'))
                    ->withInput();
            }

            if ($user->role == Role::Admin) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('member.index');
            }
        }

        return redirect()->route('login.show')
            ->with('error', Lang::get('auth.error_email_password'))
            ->withInput();
    }

    /**
     * Method to logout user from session
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show')
            ->with('success', Lang::get('auth.logout_success'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
  
  
    public function handleGoogleCallback(Request $request)
    {
        try {
            $user_google = Socialite::driver('google')->user();
            $user = User::where('email', $user_google->getEmail())->first();

            if ($user != null) {
                Auth::login($user);
                $request->session()->put('user', $user);
                return redirect()->route('member.index'); 
            } else {
                User::create([
                    'email' => $user_google->getEmail(),
                    'name' => $user_google->getName(),
                    'password' => 0,
                ]);

                $user = Auth::user();
                $request->session()->put('user', $user);
                return redirect()->route('member.index'); 
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
            $user_facebook = Socialite::driver('facebook')->user();
            $user = User::where('email', $user_facebook->getEmail())->first();

            if ($user != null) {
                Auth::login($user);
                $request->session()->put('user', $user);
                return redirect()->route('member.index');
            } else {
                User::create([
                    'email'             => $user_facebook->getEmail(),
                    'name'              => $user_facebook->getName(),
                    'password'          => 0,
                    'email_verified_at' => now(),
                    'telepon'           => 0,
                    'alamat'            => "-",
                    'status'            => "Aktif",
                ]);

                $user = Auth::user();
                $request->session()->put('user', $user);
                return redirect()->route('member.index');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
