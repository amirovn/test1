<?php

namespace App\Console\Commands;

use App\Models\Posts\Post;
use Illuminate\Console\Command;
use Faker;

class ArticleSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $faker = Faker\Factory::create();

        $posts = [];

        for ($i = 0; $i < 100; $i++) {
            $posts[] = [
                "name" => $faker->name,
                "description" => $faker->text,
                "image" => "/img/www.jpg",
                "created_at" => $faker->date,
            ];
        }

        Post::insert($posts);
    }
}
