<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CoderStudios\Commands\Tweets;

class Tweet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet to twitter account';

    public function __construct(Tweets $tweets)
    {
        parent::__construct();
        $this->tweets = $tweets;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->tweets->tweet();
    }
}
