<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    protected $model = \App\Models\Answer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'question_id' => Question::factory(),  // Automatically creates a question for the answer
            'answer' => $this->faker->sentence(),
            'is_correct' => $this->faker->boolean(50),  // 50% chance of being correct
        ];
    }
}
