<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate 10 stories, each with questions and answers
        Story::factory()
            ->hasQuestions(5)  // Each story will have 5 questions
            ->create();
    }
}
