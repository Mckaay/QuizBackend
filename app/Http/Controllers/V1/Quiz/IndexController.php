<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Quiz;

use App\Http\Controllers\Controller;
use App\Repositories\Quiz\QuizRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class IndexController extends Controller
{
    public function __invoke(Request $request, QuizRepository $quizRepository)
    {
        $includes = $request->query('include', '');
        $page = $request->query('page', '1');
        $cacheKey = 'quizzes' . $includes . $page;

        return Cache::tags(['quiz', 'quizzes'])->rememberForever($cacheKey, fn() => $quizRepository->getAll());
    }
}
