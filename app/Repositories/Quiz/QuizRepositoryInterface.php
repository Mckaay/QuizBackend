<?php

declare(strict_types=1);

namespace App\Repositories\Quiz;

use App\Models\Quiz;
use Illuminate\Pagination\LengthAwarePaginator;

interface QuizRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
    public function show(Quiz $quiz): Quiz;
    public function store(array $data): ?bool;
    public function update(array $data, Quiz $quiz): ?bool;
    public function destroy(Quiz $quiz): ?bool;
}
