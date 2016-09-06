<?php

namespace App\Listeners;

use App\Events\ContactSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Session;
use Mail;

class EmailContactDetails
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
    public function handle(ContactSent $event)
    {
        $data = $event->request->all();

        $files = $event->request->files->all();
        if (count($files['contact'])) {
            foreach($files['contact'] as $file) {
                if (!empty($file)) {
                    $file->move(storage_path('app') . '/contact_attachment/',date('Ymd') . '-' . $file->getClientOriginalName());
                }
            }
        }

        Mail::send(['text' => 'emails.contact_form'], ['data' => $data], function($message) use ($data,$files)
        {
            $message->to('dave@coderstudios.com', 'dave@coderstudios.com')->subject('New contact form details from Electric Autos');
            if (count($files['contact'])) {
                foreach($files['contact'] as $file) {
                    if (!empty($file)) {
                        $message->attach(storage_path('app') . '/contact_attachment/' . date('Ymd') . '-' . $file->getClientOriginalName());
                    }
                }
            }
        });

    }
}