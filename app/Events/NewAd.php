<?php

namespace App\Events;

use Illuminate\Http\Request;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class NewAd extends Event
{
    use SerializesModels;

    public $request;

    /**
     * Create a new event instance.
     *
     * @param  $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}