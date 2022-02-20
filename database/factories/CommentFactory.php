<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
<<<<<<< HEAD
            'user_id' => (User::factory()->make())->id,
            'post_id' => (Post::factory()->make())->id,
=======
            'user_id' => (User::factory()->create())->id,
            'post_id' => (Post::factory()->create())->id,
>>>>>>> master
            'content' => $this->faker->realText(),
            'parent_id' => rand(1, 10),
        ];
    }
}

