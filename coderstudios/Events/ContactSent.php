<?php

namespace CoderStudios\Events;

use CoderStudios\Requests\ContactRequest;
use Illuminate\Queue\SerializesModels;

class ContactSent extends Event
{
    use SerializesModels;

    public $request;

    /**
     * Create a new event instance.
     */
    public function __construct(ContactRequest $request)
    {
        $this->request = $request;
    }
}
