<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // Access user data using $event->user
        $user = $event->user;

        // Send email using Laravel's Mail facade
        Mail::send('emails.registration', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                    ->subject('Welcome to Your App');
        });
    }
}
