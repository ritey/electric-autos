<?php

namespace App\Listeners;

use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EmailAdmin
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

        Mail::send(['text' => 'emails.new_user'], ['data' => $data], function($message) use ($data)
        {
            $message->to('dave@coderstudios.com', 'dave@coderstudios.com')->subject('New electric autos user : ' . $data['email']);
        });

    }
}