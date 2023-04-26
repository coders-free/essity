<?php

namespace App\Listeners\Login;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TwoFactorVerification
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
    public function handle(Login $event): void
    {
        if($event->user->hasRole(['farmacia', 'ortopedia'])){

            //Si el usuario ha sido creado hace menos de 10 seg, no se envía el correo

            if ($event->user->created_at->diffInSeconds(now()) > 10) {
                
                $code = Str::random(6);

                session(['auth.2fa.code' => $code]);

                Mail::to($event->user->email)
                    ->send(new \App\Mail\TwoFactorVerification($code));

            }
        }
    }
}
