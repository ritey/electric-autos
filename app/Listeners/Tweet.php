<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thujohn\Twitter\Twitter;

class Tweet
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Twitter $tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Handle the event.
     *
     * @param  ContactSent  $event
     * @return void
     */
    public function handle($event)
    {
        $data = $event->data;
        if (isset($data['tweet']) && strlen($data['tweet']) && env('APP_TWEET',0)) {
            $this->tweet->post('statuses/update', ['status' => $data['tweet'], 'format' => 'json']);
        }
    }
}