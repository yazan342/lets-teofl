<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function getStories()
    {
        $stories = Story::with(['questions.answers'])
            ->where('title', '!=', 'Generated Story')
            ->get();

        return response()->json($stories);
    }


    public function deleteStory($id)
    {
        Story::destroy($id);

        return response()->json("Story deleted successfully");
    }





    public function processStory(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'title' => 'sometimes|string'
        ]);

        try {
            $response = sendTextToPythonApi($request->input('text'));

            if (!isset($response) || !is_array($response)) {
                return response()->json([
                    'error' => 'Invalid response from the API.',
                ], 500);
            }

            $story = Story::create([
                'title' => $request->has('title') ? $request->input('title') : 'Generated Story',
                'story' => $request->input('text'),
            ]);

            foreach ($response as $data) {
                $question = $story->questions()->create([
                    'question' => $data['question'] ?? '',
                ]);

                foreach ($data['options'] as $key => $option) {
                    $isCorrect = $option === $data['answer'];
                    $question->answers()->create([
                        'answer' => $option,
                        'is_correct' => $isCorrect,
                    ]);
                }
            }

            $storyq = Story::with('questions.answers')->find($story->id);

            return response()->json([
                'message' => 'Story and questions processed successfully.',
                'story' => $storyq,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error processing story: ' . $e->getMessage(),
            ], 500);
        }
    }
}
