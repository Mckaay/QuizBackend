<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Quiz;
use Illuminate\Support\Facades\Cache;

final class QuizObserver
{
    public function created(Quiz $quiz): void
    {
        $this->clearQuizCache();
    }

    public function updated(Quiz $quiz): void
    {
        $this->clearQuizCache();
    }

    public function deleted(Quiz $quiz): void
    {
        $this->clearQuizCache();
    }

    public function clearQuizCache(): void
    {
        Cache::tags(['quiz', 'quizzes'])->flush();
    }
}
