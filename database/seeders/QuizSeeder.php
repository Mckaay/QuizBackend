<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

final class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = database_path('json/quizzes.json');
        if ( ! file_exists($filePath)) {
            return;
        }

        $quizzes = json_decode(file_get_contents($filePath), true);
        if (empty($quizzes)) {
            return;
        }

        foreach ($quizzes as $quizData) {
            $quiz = Quiz::factory()->create([
                'title' => $quizData['title'],
                'description' => $quizData['description'],
                'time' => $quizData['time'],
            ]);

            foreach ($quizData['questions'] as $questionData) {
                $question = Question::factory()->create([
                    'quiz_id' => $quiz->id,
                    'content' => $questionData['text'],
                ]);

                foreach ($questionData['answers'] as $answerData) {
                    Answer::factory()->create([
                        'question_id' => $question->id,
                        'content' => $answerData['text'],
                        'is_correct' => $answerData['isCorrect'],
                    ]);
                }
            }
        }
    }
}
