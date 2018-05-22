<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Post;
use App\View;

class AddRandomViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'views:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding random views to a post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $posts = Post::whereNotNull('published')
                     ->where('hidden', '=', '0')
                     ->inRandomOrder()
                     ->limit(3)
                     ->get();
        $posts->each(function($post) {
            for($i = 0; $i <= rand(1, 10); $i++) {
                View::create([
                    'post_id' => $post->id,
                ]);
            }
        });
    }
}
