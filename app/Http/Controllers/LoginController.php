<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\GoogleLoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $googleLoginService;

    public function __construct(GoogleLoginService $googleLoginService)
    {
        $this->googleLoginService = $googleLoginService;
    }

    /**
     * Display the user's profile form.
     */
    public function redirectToProvider(Request $request)
    {
        dd(Socialite::driver('github')->redirect());
        return Socialite::driver('github')->redirect();
    }

    /**
     * handleProviderCallback
     */
    public function handleProviderCallback(Request $request)
    {
        $githubUser = Socialite::driver('github')->user();
        //dd($githubUser);

        $user = User::where('social_id', $githubUser->id)->first();

        if ($user) {
            $user->update([
                'social_token' => $githubUser->token,
                'social_refresh_token' => $githubUser->refreshToken,
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'social_type' => 'github',
                'social_id' => $githubUser->id,
                'social_token' => $githubUser->token,
                'social_refresh_token' => $githubUser->refreshToken,
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function redirectToGoogle()
    {
        return $this->googleLoginService->redirectToGoogle();
    }

    public function handleGoogleCallback()
    {
        $user = $this->googleLoginService->handleGoogleCallback();
        Auth::login($user);
        return redirect('/dashboard');
    }
}
