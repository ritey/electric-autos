<?php

namespace CoderStudios\Listeners;

use CoderStudios\Events\ContactSent;

class EmailContactDetails
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(ContactSent $event)
    {
        $data = $event->request->all();

        $files = $event->request->files->all();
        if (count($files['contact'])) {
            foreach ($files['contact'] as $file) {
                if (!empty($file)) {
                    $file->move(storage_path('app').'/contact_attachment/', date('Ymd').'-'.$file->getClientOriginalName());
                }
            }
        }

        \Mail::send(['text' => 'emails.contact_form'], ['data' => $data], function ($message) use ($files) {
            $message->to('dave@coderstudios.com', 'dave@coderstudios.com')->subject('New contact form details from Electric Autos');
            if (count($files['contact'])) {
                foreach ($files['contact'] as $file) {
                    if (!empty($file)) {
                        $message->attach(storage_path('app').'/contact_attachment/'.date('Ymd').'-'.$file->getClientOriginalName());
                    }
                }
            }
        });
    }
}
