<?php

namespace CoderStudios\Events;

use Illuminate\Queue\SerializesModels;

class Registered extends Event
{
    use SerializesModels;

    public $request;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
