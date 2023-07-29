<?php

namespace CoderStudios\Listeners;

use CoderStudios\Events\Registered;

class EmailNewUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param ContactSent $event
     */
    public function handle(Registered $event)
    {
        $data = $event->data;

        \Mail::send(['html' => 'emails.new_user_html', 'text' => 'emails.new_user'], ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'], $data['email'])->subject('Thanks for registering on Electric Autos');
        });
    }
}
