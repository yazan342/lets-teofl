<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This will generate questions with their answers
        Question::factory()
            ->hasAnswers(4)  // Each question will have 4 answers
            ->create();
    }
}
