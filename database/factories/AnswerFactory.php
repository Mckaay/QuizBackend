<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Answer>
 */
final class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->words(3, true),
            'is_correct' => false,
        ];
    }
}
