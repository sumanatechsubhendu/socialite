<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginService
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $user = User::where('social_id', $user->id)->first();

        if ($user) {
            $user->update([
                'social_token' => $user->token,
                'social_refresh_token' => $user->refreshToken,
            ]);
        } else {
            $user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_type' => 'google',
                'social_id' => $user->id,
                'social_token' => $user->token,
                'social_refresh_token' => $user->refreshToken,
            ]);
        }
        return $user;
    }

    // Add any additional methods you need

    // Optional: Add the helper function to create or find a user
    private function findOrCreateUser($socialiteUser)
    {
        // Your logic to create or update the user from Socialite data
    }
}
