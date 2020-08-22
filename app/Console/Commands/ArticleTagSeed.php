<?php

namespace App\Console\Commands;

use App\Models\Posts\PostTag;
use Illuminate\Console\Command;
use Faker;

class ArticleTagSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:tag:seed';

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

        $tags = [];

        for ($i = 0; $i < 100; $i++) {
            $tags[] = [
                "name" => $faker->name,
                "post_id" => $i + 1,
            ];

        }

        PostTag::insert($tags);
    }
}
