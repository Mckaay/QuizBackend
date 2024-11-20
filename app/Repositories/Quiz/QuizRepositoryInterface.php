<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Http\Resources\V1\Quiz\QuizCollection;
use App\Http\Resources\V1\Quiz\QuizResource;
use App\Models\Quiz;

interface QuizRepositoryInterface
{
    public function getAll(): QuizCollection;
    public function show(Quiz $quiz): QuizResource;
    public function store(array $data): ?bool;
    public function update(array $data, Quiz $quiz): ?bool;
    public function destroy(Quiz $quiz): ?bool;
}
