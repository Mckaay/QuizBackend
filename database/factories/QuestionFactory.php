<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
final class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence() . '?',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Question $question): void {
            $answer = $question->answers()->first();
            $answer->is_correct = true;
            $answer->save();
        });
    }
}
