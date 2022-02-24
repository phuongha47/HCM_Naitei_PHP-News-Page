<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'title' => $this->faker->title(),
            'body' => $this->faker->realText(),
            'author_id' => (User::factory()->make())->id,
            'category_id' => (Category::factory()->make())->id,
        ];
    }
}
