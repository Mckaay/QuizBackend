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
        Quiz::factory()->has(
            Question::factory()->has(Answer::factory()->count(4))
                ->count(10),
        )
            ->count(4)
            ->create();
    }
}
