<?php

namespace CoderStudios\Commands;

use CoderStudios\Libraries\PostsLibrary;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class TailwindRebuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cs:tailwind_build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build dynamic content';

    /**
     * Create a new command instance.
     */
    public function __construct(PostsLibrary $posts)
    {
        parent::__construct();
        $this->posts = $posts;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $html = '';

        $posts = $this->posts->get();
        foreach ($posts as $post) {
            $html .= $post->content;
        }
        \File::put(base_path('storage/framework/views/posts.php'), $html);

        $process = Process::fromShellCommandline('npm install');
        $process->run();

        $process = Process::fromShellCommandline('npm run build');
        $process->run();

        if (\File::exists(base_path('storage/framework/views/posts.php'))) {
            \File::delete(base_path('storage/framework/views/posts.php'));
        }
        $this->info('Rebuilt CSS');
    }
}
