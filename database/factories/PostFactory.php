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
    public function definition(): array
    {
        //  protected $fillable = ['title', 'content', 'is_published', 'created_by', 'updated_by'];

        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->sentence(50),
            'is_published' => rand(0, 1),
            'created_by' => rand(1, 3),
            'updated_by' => rand(2,3)
        ];
    }
}
