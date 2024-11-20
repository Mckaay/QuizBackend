<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Http\Resources\V1\Quiz\QuizCollection;
use App\Http\Resources\V1\Quiz\QuizResource;
use App\Models\Quiz;
use DB;
use Spatie\QueryBuilder\QueryBuilder;

final class QuizRepository implements QuizRepositoryInterface
{
    public function getAll(): QuizCollection
    {
        $quizzes = QueryBuilder::for(subject: Quiz::class)
            ->allowedIncludes(
                includes: [
                    'questions',
                    'questions.answers',
                ],
            )->getEloquentBuilder()->simplePaginate(perPage: 10);

        return new QuizCollection(resource: $quizzes);
    }

    public function show(Quiz $quiz): QuizResource
    {
        $quiz->load(relations: [
            'questions',
            'questions.answers',
        ]);
        return new QuizResource($quiz);
    }

    public function store(array $data): ?bool
    {
        return DB::transaction(callback: function () use ($data) {
            $quiz = Quiz::create([
                'title' => $data['title'],
                'icon' => $data['icon'] ?? null,
            ]);

            foreach ($data['questions'] as $questionData) {
                $question = $quiz->questions()->create([
                    'content' => $questionData['content'],
                ]);

                $question->answers()->createMany($questionData['answers']);
            }

            return true;
        });
    }

    public function update(array $data, Quiz $quiz): ?bool
    {
        return DB::transaction(callback: function () use ($data, $quiz) {
            $quiz->delete();

            $quizz = Quiz::create([
                'title' => $data['title'],
                'icon' => $data['icon'] ?? null,
            ]);

            foreach ($data['questions'] as $questionData) {
                $question = $quizz->questions()->create([
                    'content' => $questionData['content'],
                ]);

                $question->answers()->createMany($questionData['answers']);
            }

            return true;
        });
    }

    public function destroy(Quiz $quiz): ?bool
    {
        return DB::transaction(callback: fn() => $quiz->delete());
    }
}
