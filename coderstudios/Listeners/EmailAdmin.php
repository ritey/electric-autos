<?php

namespace CoderStudios\Listeners;

class EmailAdmin
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
    public function handle($event)
    {
        $data = $event->data;

        \Mail::send(['text' => 'emails.blank'], ['data' => $data], function ($message) use ($data) {
            $message->to('dave@coderstudios.com', 'dave@coderstudios.com')->subject($data['subject']);
        });
    }
}
