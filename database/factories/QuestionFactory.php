<?php

namespace Database\Factories;

use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = \App\Models\Question::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'story_id' => Story::factory(),  // Automatically creates a story for the question
            'question' => $this->faker->sentence(),
        ];
    }
}
