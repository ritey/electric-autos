<?php

namespace App\Listeners;

use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EmailNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ContactSent  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $data = $event->data;

        Mail::send(['html' => 'emails.new_user_html','text' => 'emails.new_user'], ['data' => $data], function($message) use ($data)
        {
            $message->to($data['email'], $data['email'])->subject('Thanks for registering on Electric Autos');
        });

    }
}