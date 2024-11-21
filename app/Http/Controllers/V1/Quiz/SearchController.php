<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\Request;

final class SearchController extends Controller
{
    public function __invoke(Request $request, QuizRepository $quizRepository)
    {
        return response()->json($quizRepository->search($request->search ?? ''));
    }

}
