<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // protected $fillable = ['post_id', 'comment', 'commented_by', 'is_approved', 'approved_by'];

        return [
            'post_id'=>rand(1,50),
            'comment'=> $this->faker->sentence(10),
            'commented_by'=> rand(1,3),

        ];
    }
}
