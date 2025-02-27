<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Models\Quiz;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

final class QuizRepository implements QuizRepositoryInterface
{
    public function getAll(int $page = 1, string $searchQuery = ''): LengthAwarePaginator
    {
        return Quiz::query()
            ->when($searchQuery, function ($query) use ($searchQuery): void {
                $query->where('title', 'like', '%' . $searchQuery . '%');
            })
            ->withCount('questions')
            ->orderBy('timesPlayed', 'desc')
            ->paginate(5);
    }

    public function show(Quiz $quiz): Quiz
    {
        return Quiz::query()
            ->where('id', '=', $quiz->id)
            ->with(['questions', 'questions.answers'])
            ->withCount('questions')
            ->first();
    }

    public function store(array $data): ?bool
    {
        return DB::transaction(callback: function () use ($data) {
            $quiz = Quiz::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'time' => $data['time'],
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
