<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Quiz\QuizCollection;
use App\Models\Quiz;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(): ResourceCollection
    {
        $quizzes = Quiz::simplePaginate();

        return new QuizCollection(
            resource: $quizzes,
        );
    }
}
