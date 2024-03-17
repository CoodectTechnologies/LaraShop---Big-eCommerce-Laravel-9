<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();
        return [
            'user_id' => 1,
            'name' => $name,
            'fragment' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'slug' => Str::slug($name),
            'status' => 1
        ];
    }
}
