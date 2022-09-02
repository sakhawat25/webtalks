<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'category_id' => 1,           
            'slug' => 'some-post-slug',
            'description' => fake()->paragraph(5),
            'tags' => 'Laravel, PHP, HTML, JS',
            'image' => 'no_image.jpg'
        ];
    }
}
