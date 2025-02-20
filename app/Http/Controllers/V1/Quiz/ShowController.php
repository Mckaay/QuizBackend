<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Quiz\QuizResource;
use App\Models\Quiz;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\Request;

final class ShowController extends Controller
{
    public function __invoke(Request $request, Quiz $quiz, QuizRepository $quizRepository): QuizResource
    {
        return new QuizResource($quizRepository->show($quiz));
    }
}
