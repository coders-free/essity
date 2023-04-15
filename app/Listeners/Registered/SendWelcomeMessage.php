<?php

namespace App\Listeners\Registered;

use App\Mail\WelcomeMessage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;

class SendWelcomeMessage
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
    public function handle(Registered $event): void
    {

        $user = $event->user;

        Mail::to($user)->send(new WelcomeMessage);
    }
}
