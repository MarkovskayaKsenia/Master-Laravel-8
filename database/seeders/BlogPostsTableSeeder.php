<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postsCount = (int)$this->command->ask("How many blog posts would you like?", 50);
        $allUsers = User::all();

        BlogPost::factory()->count($postsCount)->make()->each(function ($post) use ($allUsers) {
            $post->user_id = $allUsers->random()->id;
            $post->save();
        });
    }
}
